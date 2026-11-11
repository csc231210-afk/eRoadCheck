<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table = 'vehicles'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['driver_id','plate_number','make','model','colour','manufacture_year','vin','engine_number'];
    protected $useTimestamps = false;
    public function withDriver() { return $this->select('vehicles.*, drivers.full_name AS driver_name')->join('drivers','drivers.id=vehicles.driver_id')->orderBy('vehicles.id','DESC'); }
}
