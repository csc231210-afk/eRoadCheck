<?php

use CodeIgniter\Boot;
use Config\Paths;

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('ROOTPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);

require APPPATH . 'Config/Paths.php';
$paths = new Paths();
require rtrim($paths->systemDirectory, '\\ ') . DIRECTORY_SEPARATOR . 'Boot.php';
exit(Boot::bootWeb($paths));
