<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentModel;
use App\Models\VehicleModel;

class DocumentsController extends BaseController
{
    public function index()
    {
        $documents = (new DocumentModel())->withVehicle()->findAll();
        return view('admin/documents/index', ['title' => 'Vehicle documents', 'documents' => $documents]);
    }

    public function add()
    {
        $vehicles = (new VehicleModel())->orderBy('plate_number')->findAll();
        if ($this->request->getMethod() === 'post') {
            $data = [
                'vehicle_id' => $this->request->getPost('vehicle_id'),
                'document_type' => $this->request->getPost('document_type'),
                'reference_number' => trim($this->request->getPost('reference_number')),
                'issue_date' => $this->request->getPost('issue_date'),
                'expiry_date' => $this->request->getPost('expiry_date'),
                'status' => $this->request->getPost('status') ?: 'valid',
                'notes' => trim($this->request->getPost('notes')),
            ];
            $id = (new DocumentModel())->insert($data);
            if ($id) return redirect()->to('/admin/documents')->with('success', 'Document record saved successfully.');
            return redirect()->back()->withInput()->with('error', 'Unable to save document.');
        }
        return view('admin/documents/add', ['title' => 'Add document', 'vehicles' => $vehicles]);
    }

    public function edit($id)
    {
        $model = new DocumentModel();
        $document = $model->find($id);
        if (! $document) return redirect()->to('/admin/documents')->with('error', 'Document not found.');
        $vehicles = (new VehicleModel())->orderBy('plate_number')->findAll();
        if ($this->request->getMethod() === 'post') {
            $model->update($id, [
                'vehicle_id' => $this->request->getPost('vehicle_id'),
                'document_type' => $this->request->getPost('document_type'),
                'reference_number' => trim($this->request->getPost('reference_number')),
                'issue_date' => $this->request->getPost('issue_date'),
                'expiry_date' => $this->request->getPost('expiry_date'),
                'status' => $this->request->getPost('status') ?: 'valid',
                'notes' => trim($this->request->getPost('notes')),
            ]);
            return redirect()->to('/admin/documents')->with('success', 'Document updated successfully.');
        }
        return view('admin/documents/edit', ['title' => 'Edit document', 'document' => $document, 'vehicles' => $vehicles]);
    }
}
