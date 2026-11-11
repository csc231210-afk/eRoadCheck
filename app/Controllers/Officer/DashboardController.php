<?php

namespace App\Controllers\Officer;

use App\Controllers\BaseController;
use App\Models\VerificationLogModel;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('officer/dashboard', ['title' => 'Officer dashboard', 'recent' => (new VerificationLogModel())->recentForUser((int) session('user_id'), 8)]);
    }
}
