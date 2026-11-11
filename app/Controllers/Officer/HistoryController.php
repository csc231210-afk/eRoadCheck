<?php

namespace App\Controllers\Officer;

use App\Controllers\BaseController;
use App\Models\VerificationLogModel;

class HistoryController extends BaseController
{
    public function index() { return view('officer/history', ['title' => 'My verification history', 'logs' => (new VerificationLogModel())->recentForUser((int) session('user_id'), 100)]); }
}
