<?php

namespace App\Models;

use CodeIgniter\Model;

class LicenseModel extends Model
{
    protected $table = 'driver_licenses'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['driver_id','license_number','license_class','issue_date','expiry_date','status'];
    protected $useTimestamps = false;
    public function withDriver() { return $this->select('driver_licenses.*, drivers.full_name')->join('drivers','drivers.id=driver_licenses.driver_id')->orderBy('driver_licenses.id','DESC'); }
}
