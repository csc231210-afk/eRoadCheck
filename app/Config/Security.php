<?php

namespace App\Config;

use CodeIgniter\Config\Security as BaseSecurity;

class Security extends BaseSecurity
{
    public bool $csrfProtection = true;
    public string $csrfTokenName = 'csrf';
    public string $csrfHeaderName = 'X-CSRF-TOKEN';
    public string $csrfCookieName = 'csrf_cookie';
    public int $csrfExpires = 7200;
    public bool $csrfRegenerate = true;
    public bool $csrfRedirect = false;
}
