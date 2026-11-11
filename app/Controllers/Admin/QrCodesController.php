<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DriverModel;
use App\Models\QrCodeModel;
use App\Models\VehicleModel;
use App\Libraries\QrCodeGenerator;

class QrCodesController extends BaseController
{
    public function index()
    {
        $codes = (new QrCodeModel())->listing()->findAll();
        return view('admin/qr_codes/index', ['title' => 'QR codes', 'codes' => $codes]);
    }

    public function generate()
    {
        $drivers = (new DriverModel())->orderBy('full_name')->findAll();
        if ($this->request->getMethod() === 'post') {
            $driverId = (int) $this->request->getPost('driver_id');
            $vehicleId = (int) $this->request->getPost('vehicle_id');
            $driver = (new DriverModel())->find($driverId);
            $vehicle = (new VehicleModel())->find($vehicleId);
            if (! $driver || ! $vehicle) return redirect()->back()->with('error', 'Selected driver or vehicle was not found.');
            $generator = new QrCodeGenerator();
            $data = $generator->generate($driverId, $vehicleId, (int) session('user_id'));
            return redirect()->to('/admin/qr-codes')->with('success', 'QR code generated successfully.');
        }
        return view('admin/qr_codes/generate', ['title' => 'Generate QR code', 'drivers' => $drivers]);
    }

    public function save()
    {
        $driverId = (int) $this->request->getPost('driver_id');
        $vehicleId = (int) $this->request->getPost('vehicle_id');
        $token = bin2hex(random_bytes(32));
        $url = site_url('verify/' . $token);
        $imagePath = 'uploads/qrcodes/' . $token . '.png';
        $path = FCPATH . 'uploads/qrcodes/' . $token . '.png';
        if (! is_dir(dirname($path))) mkdir(dirname($path), 0777, true);
        $this->createQrPng($url, $path);
        $id = (new QrCodeModel())->insert([
            'driver_id' => $driverId,
            'vehicle_id' => $vehicleId,
            'token' => $token,
            'image_path' => $imagePath,
            'status' => 'active',
            'generated_by' => (int) session('user_id'),
        ]);
        if ($id) return redirect()->to('/admin/qr-codes')->with('success', 'QR image created.');
        return redirect()->back()->with('error', 'Could not save QR code.');
    }

    private function createQrPng(string $content, string $path): void
    {
        $qr = new \Chillerlan\QRCode\QRCode();
        $data = $qr->render($content);
        file_put_contents($path, $data);
    }
}
