<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; protected $primaryKey = 'id'; protected $returnType = 'array';
    protected $allowedFields = ['full_name','username','email','password_hash','role','status'];
    protected $useTimestamps = false;
    public function byUsername(string $username): ?array { return $this->where('username', $username)->first(); }
}
