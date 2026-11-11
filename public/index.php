<?php

use CodeIgniter\Boot;
use Config\Paths;

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
define('ROOTPATH', dirname(FCPATH) . DIRECTORY_SEPARATOR);

// Load the paths config
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
require APPPATH . 'Config/Paths.php';
$paths = new Paths();

// Load the framework bootstrap file
require rtrim($paths->systemDirectory, '\\ ') . DIRECTORY_SEPARATOR . 'Boot.php';
exit(Boot::bootWeb($paths));
