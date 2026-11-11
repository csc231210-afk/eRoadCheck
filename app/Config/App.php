<?php

namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL = 'http://localhost/e-roadcheck/';
    public string $indexPage = '';
    public string $uriProtocol = 'REQUEST_URI';
    public string $defaultLocale = 'en';
    public string $negotiateLocale = false;
    public string $appTimezone = 'Africa/Lagos';
    public string $charset = 'UTF-8';
    public bool $forceGlobalSecureRequests = false;
    public bool $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public bool $cookiePrefix = '';
    public bool $cookieDomain = '';
    public bool $cookiePath = '/';
    public bool $cookieSecure = false;
    public int $cookieHTTPOnly = 1;
    public int $cookieSameSite = 0;
    public string $sessionCookieName = 'eroadcheck_session';
    public int $sessionExpiration = 7200;
    public bool $sessionSavePath = WRITEPATH . 'session';
    public bool $sessionMatchIP = false;
    public bool $sessionTimeToUpdate = 300;
    public bool $sessionRegenerateDestroy = true;
    public string $CSRFTokenName = 'csrf';
    public string $CSRFHeaderName = 'X-CSRF-TOKEN';
    public string $CSRFCookieName = 'csrf_cookie';
    public int $CSRFExpiration = 7200;
    public bool $CSRFProtectAll = false;
    public bool $CSRFRegenerate = true;
    public bool $CSRFExcludeGlobal = false;
    public string $allowedHostnames = '';
}
