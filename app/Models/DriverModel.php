<?php

namespace App\Models;

use CodeIgniter\Model;

class DriverModel extends Model
{
    protected $table = 'drivers'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['full_name','date_of_birth','gender','phone','address','photo_path'];
    protected $useTimestamps = false;
    public function search(string $term = '') { return $term === '' ? $this->orderBy('id','DESC')->paginate(15) : $this->groupStart()->like('full_name',$term)->orLike('phone',$term)->groupEnd()->orderBy('id','DESC')->paginate(15); }
}
