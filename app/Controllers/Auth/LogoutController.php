<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login')->with('success', 'You have signed out.');
    }
}
