<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session('user_id')) {
            return redirect()->to('/login')->with('error', 'Please log in to continue.');
        }

        if (is_array($arguments) && ! empty($arguments)) {
            $allowed = $arguments;
            if (! in_array((string) session('role'), $allowed, true)) {
                $redirect = (session('role') === 'admin') ? '/admin/dashboard' : '/officer/dashboard';
                return redirect()->to($redirect)->with('error', 'Access denied for this role.');
            }
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
