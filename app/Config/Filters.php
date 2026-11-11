<?php

namespace App\Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use App\Filters\AuthFilter;
use App\Filters\RoleFilter;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf' => CSRF::class,
        'auth' => AuthFilter::class,
        'role' => RoleFilter::class,
    ];

    public array $globals = [
        'before' => [
            'csrf' => ['except' => ['login', 'verify/*']]
        ],
        'after' => []
    ];
}
