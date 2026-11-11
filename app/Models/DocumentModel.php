<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table = 'vehicle_documents'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['vehicle_id','document_type','reference_number','issue_date','expiry_date','status','notes'];
    protected $useTimestamps = false;
    public function withVehicle() { return $this->select('vehicle_documents.*, vehicles.plate_number')->join('vehicles','vehicles.id=vehicle_documents.vehicle_id')->orderBy('vehicle_documents.id','DESC'); }
}
