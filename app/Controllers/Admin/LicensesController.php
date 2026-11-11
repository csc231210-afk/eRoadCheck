<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DriverModel;
use App\Models\LicenseModel;

class LicensesController extends BaseController
{
    public function index()
    {
        $licenses = (new LicenseModel())->withDriver()->findAll();
        return view('admin/licenses/index', ['title' => 'Driver licenses', 'licenses' => $licenses]);
    }

    public function add()
    {
        $drivers = (new DriverModel())->orderBy('full_name')->findAll();
        if ($this->request->getMethod() === 'post') {
            $data = [
                'driver_id' => $this->request->getPost('driver_id'),
                'license_number' => trim($this->request->getPost('license_number')),
                'license_class' => trim($this->request->getPost('license_class')),
                'issue_date' => $this->request->getPost('issue_date'),
                'expiry_date' => $this->request->getPost('expiry_date'),
                'status' => $this->request->getPost('status') ?: 'active',
            ];
            $id = (new LicenseModel())->insert($data);
            if ($id) return redirect()->to('/admin/licenses')->with('success', 'License record created successfully.');
            return redirect()->back()->withInput()->with('error', 'Unable to save license record.');
        }
        return view('admin/licenses/add', ['title' => 'Add license', 'drivers' => $drivers]);
    }

    public function edit($id)
    {
        $model = new LicenseModel();
        $license = $model->find($id);
        if (! $license) return redirect()->to('/admin/licenses')->with('error', 'License record not found.');
        $drivers = (new DriverModel())->orderBy('full_name')->findAll();
        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'driver_id' => $this->request->getPost('driver_id'),
                'license_number' => trim($this->request->getPost('license_number')),
                'license_class' => trim($this->request->getPost('license_class')),
                'issue_date' => $this->request->getPost('issue_date'),
                'expiry_date' => $this->request->getPost('expiry_date'),
                'status' => $this->request->getPost('status') ?: 'active',
            ]);
            return redirect()->to('/admin/licenses')->with('success', 'License record updated successfully.');
        }
        return view('admin/licenses/edit', ['title' => 'Edit license', 'license' => $license, 'drivers' => $drivers]);
    }
}
