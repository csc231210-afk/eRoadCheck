<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404直? (false);
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('login', 'Auth\\LoginController::index');
$routes->post('login', 'Auth\\LoginController::login');
$routes->post('logout', 'Auth\\LogoutController::logout', ['filter' => 'auth']);
$routes->get('logout', 'Auth\\LogoutController::logout', ['filter' => 'auth']);
$routes->get('verify/(:segment)', 'Verification\\VerificationController::verify/$1');
$routes->get('verify', 'Verification\\VerificationController::index');

$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('dashboard', 'Admin\\DashboardController::index');
    $routes->get('users', 'Admin\\UsersController::index');
    $routes->match(['get', 'post'], 'users/add', 'Admin\\UsersController::add');
    $routes->match(['get', 'post'], 'users/edit/(:num)', 'Admin\\UsersController::edit/$1');
    $routes->get('drivers', 'Admin\\DriversController::index');
    $routes->match(['get', 'post'], 'drivers/add', 'Admin\\DriversController::add');
    $routes->match(['get', 'post'], 'drivers/edit/(:num)', 'Admin\\DriversController::edit/$1');
    $routes->get('drivers/view/(:num)', 'Admin\\DriversController::view/$1');
    $routes->get('licenses', 'Admin\\LicensesController::index');
    $routes->match(['get', 'post'], 'licenses/add', 'Admin\\LicensesController::add');
    $routes->match(['get', 'post'], 'licenses/edit/(:num)', 'Admin\\LicensesController::edit/$1');
    $routes->get('vehicles', 'Admin\\VehiclesController::index');
    $routes->match(['get', 'post'], 'vehicles/add', 'Admin\\VehiclesController::add');
    $routes->match(['get', 'post'], 'vehicles/edit/(:num)', 'Admin\\VehiclesController::edit/$1');
    $routes->get('vehicles/view/(:num)', 'Admin\\VehiclesController::view/$1');
    $routes->get('documents', 'Admin\\DocumentsController::index');
    $routes->match(['get', 'post'], 'documents/add', 'Admin\\DocumentsController::add');
    $routes->match(['get', 'post'], 'documents/edit/(:num)', 'Admin\\DocumentsController::edit/$1');
    $routes->get('revenue', 'Admin\\RevenueController::index');
    $routes->match(['get', 'post'], 'revenue/add', 'Admin\\RevenueController::add');
    $routes->match(['get', 'post'], 'revenue/edit/(:num)', 'Admin\\RevenueController::edit/$1');
    $routes->get('qr-codes', 'Admin\\QrCodesController::index');
    $routes->match(['get', 'post'], 'qr-codes/generate', 'Admin\\QrCodesController::generate');
    $routes->get('qr-codes/download/(:num)', 'Admin\\QrCodesController::download/$1');
    $routes->post('qr-codes/revoke/(:num)', 'Admin\\QrCodesController::revoke/$1');
    $routes->get('verification-logs', 'Admin\\VerificationLogsController::index');
});

$routes->group('officer', ['filter' => 'auth:officer'], static function ($routes) {
    $routes->get('dashboard', 'Officer\\DashboardController::index');
    $routes->get('scan', 'Officer\\ScannerController::index');
    $routes->get('history', 'Officer\\HistoryController::index');
});
