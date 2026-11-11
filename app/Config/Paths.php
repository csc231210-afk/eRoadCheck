<?php

namespace Config;

use CodeIgniter\Config\Paths as BasePaths;

class Paths extends BasePaths
{
    public string $systemDirectory = ROOTPATH . 'vendor/codeigniter4/framework/system';
    public string $appDirectory = APPPATH;
    public string $writableDirectory = ROOTPATH . 'writable';
    public string $testsDirectory = ROOTPATH . 'tests';
    public string $viewDirectory = APPPATH . 'Views';
}
