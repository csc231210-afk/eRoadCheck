<?php

namespace Config;

use CodeIgniter\Config\Session as BaseSession;

class Session extends BaseSession
{
    public string $driver = 'CodeIgniter\\Session\\Handlers\\FileHandler';
    public string $cookieName = 'eroadcheck_session';
    public int $expiration = 7200;
    public string $savePath = WRITEPATH . 'session';
    public bool $matchIP = false;
    public int $timeToUpdate = 300;
    public bool $regenerateDestroy = true;
}
