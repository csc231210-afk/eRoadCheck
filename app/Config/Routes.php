<?php

namespace App\Config;

use CodeIgniter\Config\Routes as BaseRoutes;

class Routes extends BaseRoutes
{
    public static function init() {
        self::get('/', 'Home::index');
        self::get('login', 'Auth\\LoginController::index');
        self::post('login', 'Auth\\LoginController::login');
        self::get('logout', 'Auth\\LogoutController::logout');

        self::get('admin/dashboard', 'Admin\\DashboardController::index', ['filter' => 'auth:admin']);
        self::get('admin/users', 'Admin\\UsersController::index', ['filter' => 'auth:admin']);
        self::get('admin/users/add', 'Admin\\UsersController::add', ['filter' => 'auth:admin']);
        self::post('admin/users/save', 'Admin\\UsersController::save', ['filter' => 'auth:admin']);
        self::get('admin/drivers', 'Admin\\DriversController::index', ['filter' => 'auth:admin']);
        self::get('admin/drivers/add', 'Admin\\DriversController::add', ['filter' => 'auth:admin']);
        self::post('admin/drivers/save', 'Admin\\DriversController::save', ['filter' => 'auth:admin']);
        self::get('admin/licenses', 'Admin\\LicensesController::index', ['filter' => 'auth:admin']);
        self::get('admin/licenses/add', 'Admin\\LicensesController::add', ['filter' => 'auth:admin']);
        self::post('admin/licenses/save', 'Admin\\LicensesController::save', ['filter' => 'auth:admin']);
        self::get('admin/vehicles', 'Admin\\VehiclesController::index', ['filter' => 'auth:admin']);
        self::get('admin/vehicles/add', 'Admin\\VehiclesController::add', ['filter' => 'auth:admin']);
        self::post('admin/vehicles/save', 'Admin\\VehiclesController::save', ['filter' => 'auth:admin']);
        self::get('admin/documents', 'Admin\\DocumentsController::index', ['filter' => 'auth:admin']);
        self::get('admin/documents/add', 'Admin\\DocumentsController::add', ['filter' => 'auth:admin']);
        self::post('admin/documents/save', 'Admin\\DocumentsController::save', ['filter' => 'auth:admin']);
        self::get('admin/revenue', 'Admin\\RevenueController::index', ['filter' => 'auth:admin']);
        self::get('admin/revenue/add', 'Admin\\RevenueController::add', ['filter' => 'auth:admin']);
        self::post('admin/revenue/save', 'Admin\\RevenueController::save', ['filter' => 'auth:admin']);
        self::get('admin/qr-codes', 'Admin\\QrCodesController::index', ['filter' => 'auth:admin']);
        self::get('admin/qr-codes/generate', 'Admin\\QrCodesController::generate', ['filter' => 'auth:admin']);
        self::post('admin/qr-codes/save', 'Admin\\QrCodesController::save', ['filter' => 'auth:admin']);

        self::get('officer/dashboard', 'Officer\\DashboardController::index', ['filter' => 'auth:officer']);
        self::get('officer/scan', 'Officer\\ScannerController::index', ['filter' => 'auth:officer']);
        self::post('officer/scan/submit', 'Officer\\ScannerController::submitScan', ['filter' => 'auth:officer']);
        self::get('officer/history', 'Officer\\HistoryController::index', ['filter' => 'auth:officer']);

        self::get('verify/(:alphanum)', 'Verification\\VerificationController::verify/$1');
        self::get('verify', 'Verification\\VerificationController::index');

        self::get('admin/verification-logs', 'Admin\\VerificationLogsController::index', ['filter' => 'auth:admin']);
    }
}
