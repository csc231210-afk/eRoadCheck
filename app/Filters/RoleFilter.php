<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session('user_id') || ! $arguments || ! in_array((string) session('role'), $arguments, true)) return redirect()->to('/login');
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
