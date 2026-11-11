<?php

namespace App\Models;

use CodeIgniter\Model;

class VerificationLogModel extends Model
{
    protected $table = 'verification_logs'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['qr_id','user_id','result','summary','verified_at'];
    protected $useTimestamps = false;
    public function recentForUser(int $userId, int $limit = 20) { return $this->select('verification_logs.*, qr_codes.token, vehicles.plate_number')->join('qr_codes','qr_codes.id=verification_logs.qr_id','left')->join('vehicles','vehicles.id=qr_codes.vehicle_id','left')->where('verification_logs.user_id',$userId)->orderBy('verified_at','DESC')->findAll($limit); }
}
