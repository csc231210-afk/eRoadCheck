<?php

namespace App\Controllers\Officer;

use App\Controllers\BaseController;

class ScannerController extends BaseController
{
    public function index() { return view('officer/scan', ['title' => 'Verify a QR code']); }
}
