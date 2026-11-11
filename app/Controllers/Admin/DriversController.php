<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DriverModel;
use App\Models\LicenseModel;
use App\Models\VehicleModel;

class DriversController extends BaseController
{
    public function index()
    {
        $model = new DriverModel();
        $search = $this->request->getGet('q');
        $drivers = $search ? $model->search($search) : $model->orderBy('id','DESC')->paginate(15);
        return view('admin/drivers/index', ['title' => 'Drivers', 'drivers' => $drivers, 'pager' => $model->pager, 'q' => $search]);
    }

    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'full_name' => trim($this->request->getPost('full_name')),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'gender' => $this->request->getPost('gender'),
                'phone' => trim($this->request->getPost('phone')),
                'address' => trim($this->request->getPost('address')),
            ];
            $id = (new DriverModel())->insert($data);
            if ($id) return redirect()->to('/admin/drivers')->with('success', 'Driver added successfully.');
            return redirect()->back()->withInput()->with('error', 'Unable to save driver.');
        }
        return view('admin/drivers/add', ['title' => 'Add Driver']);
    }

    public function edit($id)
    {
        $model = new DriverModel();
        $driver = $model->find($id);
        if (! $driver) return redirect()->to('/admin/drivers')->with('error', 'Driver not found.');
        if ($this->request->getMethod() === 'post') {
            $updated = [
                'full_name' => trim($this->request->getPost('full_name')),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'gender' => $this->request->getPost('gender'),
                'phone' => trim($this->request->getPost('phone')),
                'address' => trim($this->request->getPost('address')),
            ];
            $model->update($id, $updated);
            return redirect()->to('/admin/drivers')->with('success', 'Driver updated successfully.');
        }
        return view('admin/drivers/edit', ['title' => 'Edit Driver', 'driver' => $driver]);
    }

    public function view($id)
    {
        $driver = (new DriverModel())->find($id);
        if (! $driver) return redirect()->to('/admin/drivers')->with('error', 'Driver not found.');
        $licenses = (new LicenseModel())->where('driver_id', $id)->findAll();
        $vehicles = (new VehicleModel())->where('driver_id', $id)->findAll();
        return view('admin/drivers/view', ['title' => 'Driver details', 'driver' => $driver, 'licenses' => $licenses, 'vehicles' => $vehicles]);
    }
}
