<?php

namespace App\Models;

use CodeIgniter\Model;

class QrCodeModel extends Model
{
    protected $table = 'qr_codes'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['driver_id','vehicle_id','token','image_path','status','generated_by'];
    protected $useTimestamps = false;
    public function byToken(string $token): ?array { return $this->where('token',$token)->first(); }
    public function listing() { return $this->select('qr_codes.*, drivers.full_name, vehicles.plate_number')->join('drivers','drivers.id=qr_codes.driver_id')->join('vehicles','vehicles.id=qr_codes.vehicle_id')->orderBy('qr_codes.id','DESC'); }
}
