<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DriverModel;
use App\Models\VehicleModel;

class VehiclesController extends BaseController
{
    public function index()
    {
        $vehicles = (new VehicleModel())->withDriver()->findAll();
        return view('admin/vehicles/index', ['title' => 'Vehicles', 'vehicles' => $vehicles]);
    }

    public function add()
    {
        $drivers = (new DriverModel())->orderBy('full_name')->findAll();
        if ($this->request->getMethod() === 'post') {
            $data = [
                'driver_id' => $this->request->getPost('driver_id'),
                'plate_number' => trim($this->request->getPost('plate_number')),
                'make' => trim($this->request->getPost('make')),
                'model' => trim($this->request->getPost('model')),
                'colour' => trim($this->request->getPost('colour')),
                'manufacture_year' => $this->request->getPost('manufacture_year'),
                'vin' => trim($this->request->getPost('vin')),
                'engine_number' => trim($this->request->getPost('engine_number')),
            ];
            $id = (new VehicleModel())->insert($data);
            if ($id) return redirect()->to('/admin/vehicles')->with('success', 'Vehicle added successfully.');
            return redirect()->back()->withInput()->with('error', 'Unable to save vehicle.');
        }
        return view('admin/vehicles/add', ['title' => 'Add vehicle', 'drivers' => $drivers]);
    }

    public function edit($id)
    {
        $model = new VehicleModel();
        $vehicle = $model->find($id);
        if (! $vehicle) return redirect()->to('/admin/vehicles')->with('error', 'Vehicle not found.');
        $drivers = (new DriverModel())->orderBy('full_name')->findAll();
        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'driver_id' => $this->request->getPost('driver_id'),
                'plate_number' => trim($this->request->getPost('plate_number')),
                'make' => trim($this->request->getPost('make')),
                'model' => trim($this->request->getPost('model')),
                'colour' => trim($this->request->getPost('colour')),
                'manufacture_year' => $this->request->getPost('manufacture_year'),
                'vin' => trim($this->request->getPost('vin')),
                'engine_number' => trim($this->request->getPost('engine_number')),
            ]);
            return redirect()->to('/admin/vehicles')->with('success', 'Vehicle updated successfully.');
        }
        return view('admin/vehicles/edit', ['title' => 'Edit vehicle', 'vehicle' => $vehicle, 'drivers' => $drivers]);
    }

    public function view($id)
    {
        $vehicle = (new VehicleModel())->find($id);
        if (! $vehicle) return redirect()->to('/admin/vehicles')->with('error', 'Vehicle not found.');
        return view('admin/vehicles/view', ['title' => 'Vehicle details', 'vehicle' => $vehicle]);
    }
}
