<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VerificationLogModel;

class VerificationLogsController extends BaseController
{
    public function index()
    {
        $logs = (new VerificationLogModel())->select('verification_logs.*, users.full_name AS officer_name, qr_codes.token, vehicles.plate_number')->join('users', 'users.id = verification_logs.user_id', 'left')->join('qr_codes', 'qr_codes.id = verification_logs.qr_id', 'left')->join('vehicles', 'vehicles.id = qr_codes.vehicle_id', 'left')->orderBy('verification_logs.verified_at', 'DESC')->findAll();
        return view('admin/verification_logs/index', ['title' => 'Verification logs', 'logs' => $logs]);
    }
}
