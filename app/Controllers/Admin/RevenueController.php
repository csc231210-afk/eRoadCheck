<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RevenueModel;
use App\Models\VehicleModel;

class RevenueController extends BaseController
{
    public function index()
    {
        $records = (new RevenueModel())->withVehicle()->findAll();
        return view('admin/revenue/index', ['title' => 'Revenue records', 'records' => $records]);
    }

    public function add()
    {
        $vehicles = (new VehicleModel())->orderBy('plate_number')->findAll();
        if ($this->request->getMethod() === 'post') {
            $data = [
                'vehicle_id' => $this->request->getPost('vehicle_id'),
                'revenue_type' => trim($this->request->getPost('revenue_type')),
                'reference_number' => trim($this->request->getPost('reference_number')),
                'amount' => trim($this->request->getPost('amount')),
                'payment_date' => $this->request->getPost('payment_date'),
                'expiry_date' => $this->request->getPost('expiry_date'),
                'payment_status' => $this->request->getPost('payment_status') ?: 'pending',
            ];
            $id = (new RevenueModel())->insert($data);
            if ($id) return redirect()->to('/admin/revenue')->with('success', 'Revenue record saved successfully.');
            return redirect()->back()->withInput()->with('error', 'Unable to save revenue record.');
        }
        return view('admin/revenue/add', ['title' => 'Add revenue record', 'vehicles' => $vehicles]);
    }

    public function edit($id)
    {
        $model = new RevenueModel();
        $record = $model->find($id);
        if (! $record) return redirect()->to('/admin/revenue')->with('error', 'Revenue record not found.');
        $vehicles = (new VehicleModel())->orderBy('plate_number')->findAll();
        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'vehicle_id' => $this->request->getPost('vehicle_id'),
                'revenue_type' => trim($this->request->getPost('revenue_type')),
                'reference_number' => trim($this->request->getPost('reference_number')),
                'amount' => trim($this->request->getPost('amount')),
                'payment_date' => $this->request->getPost('payment_date'),
                'expiry_date' => $this->request->getPost('expiry_date'),
                'payment_status' => $this->request->getPost('payment_status') ?: 'pending',
            ]);
            return redirect()->to('/admin/revenue')->with('success', 'Revenue record updated successfully.');
        }
        return view('admin/revenue/edit', ['title' => 'Edit revenue record', 'record' => $record, 'vehicles' => $vehicles]);
    }
}
