<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Database extends BaseConfig
{
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public string $defaultGroup = 'default';
    public array $default = [
        'DSN' => '', 'hostname' => 'localhost', 'username' => 'root', 'password' => '',
        'database' => 'eroadcheck', 'DBDriver' => 'MySQLi', 'DBPrefix' => '',
        'pConnect' => false, 'DBDebug' => true, 'charset' => 'utf8mb4',
        'DBCollat' => 'utf8mb4_general_ci', 'swapPre' => '', 'encrypt' => false,
        'compress' => false, 'strictOn' => false, 'failover' => [], 'port' => 3306,
        'foreignKeys' => true, 'busyTimeout' => 1000, 'dateFormat' => [
            'date' => 'Y-m-d', 'datetime' => 'Y-m-d H:i:s', 'time' => 'H:i:s'
        ],
    ];
}
