<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseConnection;

class DashboardController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $stats = [];
        foreach (['drivers','vehicles','driver_licenses','vehicle_documents','qr_codes'] as $table) $stats[$table] = $db->table($table)->countAllResults();
        $stats['expired_documents'] = $db->table('vehicle_documents')->where('expiry_date <', date('Y-m-d'))->countAllResults();
        $stats['outstanding_revenue'] = $db->table('revenue_records')->whereIn('payment_status', ['unpaid','pending'])->countAllResults();
        $recent = $db->table('verification_logs')->select('verification_logs.*, users.full_name AS officer_name')->join('users','users.id=verification_logs.user_id','left')->orderBy('verified_at','DESC')->limit(8)->get()->getResultArray();
        return view('admin/dashboard', ['title' => 'Administrator dashboard', 'stats' => $stats, 'recent' => $recent]);
    }
}
