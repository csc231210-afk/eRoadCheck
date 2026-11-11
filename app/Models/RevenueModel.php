<?php

namespace App\Models;

use CodeIgniter\Model;

class RevenueModel extends Model
{
    protected $table = 'revenue_records'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['vehicle_id','revenue_type','reference_number','amount','payment_date','expiry_date','payment_status'];
    protected $useTimestamps = false;
    public function withVehicle() { return $this->select('revenue_records.*, vehicles.plate_number')->join('vehicles','vehicles.id=revenue_records.vehicle_id')->orderBy('revenue_records.id','DESC'); }
}
