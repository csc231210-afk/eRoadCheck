<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UsersController extends BaseController
{
    public function index()
    {
        $users = (new UserModel())->orderBy('id','DESC')->findAll();
        return view('admin/users/index', ['title' => 'System users', 'users' => $users]);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $model = new UserModel();
            $data = [
                'full_name' => trim($this->request->getPost('full_name')),
                'username' => trim($this->request->getPost('username')),
                'email' => trim($this->request->getPost('email')),
                'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role') ?: 'officer',
                'status' => 'active',
            ];
            if ($model->insert($data)) return redirect()->to('/admin/users')->with('success', 'User created successfully.');
            return redirect()->back()->withInput()->with('error', 'Unable to create user.');
        }
        return view('admin/users/add', ['title' => 'Add user']);
    }
}
