<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
    protected $helpers = ['url', 'form', 'app', 'format'];
    protected $session;
    public function initController($request, $response, $logger)
    {
        parent::initController($request, $response, $logger);
        $this->session = service('session');
    }
}
