<?php

namespace Config;

use CodeIgniter\Config\Security as BaseSecurity;

class Security extends BaseSecurity
{
    public string $csrfProtection = 'session';
    public string $tokenRandomize = false;
    public string $tokenName = 'csrf_test_name';
    public string $headerName = 'X-CSRF-TOKEN';
    public string $cookieName = 'csrf_cookie_name';
    public int $expires = 7200;
    public bool $regenerate = true;
    public bool $redirect = false;
    public string $samesite = 'Lax';
}
