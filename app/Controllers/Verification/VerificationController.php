<?php

namespace App\Controllers\Verification;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use App\Models\DriverModel;
use App\Models\LicenseModel;
use App\Models\QrCodeModel;
use App\Models\RevenueModel;
use App\Models\VehicleModel;
use App\Models\VerificationLogModel;
use App\Libraries\DocumentStatusService;
use App\Libraries\RevenueStatusService;

class VerificationController extends BaseController
{
    public function index()
    {
        return view('verification/invalid', ['title' => 'Verification', 'message' => 'No QR token was provided.']);
    }

    public function verify($token)
    {
        $qrModel = new QrCodeModel();
        $qr = $qrModel->byToken($token);
        if (! $qr) return $this->renderInvalid('Invalid QR code.');
        if (($qr['status'] ?? 'active') === 'revoked') return $this->renderInvalid('QR code inactive or revoked.');

        $driver = (new DriverModel())->find($qr['driver_id']);
        $vehicle = (new VehicleModel())->find($qr['vehicle_id']);
        $license = (new LicenseModel())->where('driver_id', $driver['id'])->orderBy('expiry_date', 'DESC')->first();
        $documents = (new DocumentModel())->where('vehicle_id', $vehicle['id'])->findAll();
        $revenue = (new RevenueModel())->where('vehicle_id', $vehicle['id'])->orderBy('expiry_date', 'DESC')->findAll();
        $documentStatus = new DocumentStatusService();
        $revenueStatus = new RevenueStatusService();

        $overall = 'valid';
        $checks = [];
        $checks[] = 'Driver profile found.';
        if (! $license) { $overall = 'attention_required'; $checks[] = 'No active license found.'; }
        elseif (($license['status'] ?? 'active') !== 'active' || (! empty($license['expiry_date']) && $license['expiry_date'] < date('Y-m-d'))) { $overall = 'expired'; $checks[] = 'License status is not valid.'; }

        foreach ($documents as $doc) {
            $status = $documentStatus->status($doc);
            if ($status !== 'valid') { $overall = $status === 'expired' ? 'expired' : 'attention_required'; $checks[] = ucfirst($doc['document_type']) . ' document is ' . $status . '.'; }
        }

        foreach ($revenue as $item) {
            $status = $revenueStatus->status($item);
            if ($status !== 'paid') { $overall = 'attention_required'; $checks[] = ucfirst($item['revenue_type']) . ' payment status: ' . $status; }
        }

        $userId = session('user_id') ?: 1;
        (new VerificationLogModel())->insert([
            'qr_id' => $qr['id'], 'user_id' => $userId, 'result' => $overall, 'summary' => implode(' | ', $checks), 'verified_at' => date('Y-m-d H:i:s')
        ]);

        return view('verification/result', [
            'title' => 'Verification result',
            'driver' => $driver,
            'vehicle' => $vehicle,
            'license' => $license,
            'documents' => $documents,
            'revenue' => $revenue,
            'result' => $overall,
            'checks' => $checks,
        ]);
    }

    private function renderInvalid(string $message)
    {
        return view('verification/invalid', ['title' => 'Verification failed', 'message' => $message]);
    }
}
