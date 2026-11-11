<?php

namespace App\Config;

use CodeIgniter\Config\Database as BaseDatabase;

class Database extends BaseDatabase
{
    public array $default = [
        'DSN' => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'eroadcheck',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug' => true,
        'charset' => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci',
        'swapPre' => '',
        'encrypt' => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port' => 3306,
    ];
}
