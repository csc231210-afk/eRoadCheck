<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        if (session('user_id')) return redirect()->to(session('role') === 'admin' ? '/admin/dashboard' : '/officer/dashboard');
        return view('auth/login', ['title' => 'Sign in']);
    }

    public function login()
    {
        $rules = ['username' => 'required|min_length[3]|max_length[60]', 'password' => 'required|min_length[1]|max_length[200]'];
        if (! $this->validate($rules)) return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        $user = (new UserModel())->byUsername(trim((string) $this->request->getPost('username')));
        if (! $user || $user['status'] !== 'active' || ! password_verify((string) $this->request->getPost('password'), $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'The username or password was not recognized.');
        }
        $this->session->regenerate(true);
        $this->session->set(['user_id' => (int) $user['id'], 'full_name' => $user['full_name'], 'username' => $user['username'], 'role' => $user['role'], 'account_status' => $user['status']]);
        return redirect()->to($user['role'] === 'admin' ? '/admin/dashboard' : '/officer/dashboard')->with('success', 'Welcome back.');
    }
}
