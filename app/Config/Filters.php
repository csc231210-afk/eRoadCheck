<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use App\Filters\AuthFilter;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf' => CSRF::class,
        'toolbar' => DebugToolbar::class,
        'auth' => AuthFilter::class,
    ];

    public array $globals = [
        'before' => [
            'csrf' => ['except' => ['login']],
        ],
        'after' => [
            'toolbar' => ['except' => ['login']],
        ],
    ];

    public array $methods = [];
    public array $filters = [];
}
