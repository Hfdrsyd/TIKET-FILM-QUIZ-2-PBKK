<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function register(): string
    {
        return view('auth/register');
    }

    public function login(): string
    {
        return view('auth/login');
    }

    public function create()
    {
        $session = \Config\Services::session();
        $role = $session->get('role');
        if($role !== 'admin'){
            return redirect()->route('home.index');
        }
        return view('film/upload');
    }
    
    public function logout()
    {
        $session = \Config\Services::session();
        $session->destroy();
        return view('auth/login');
    }
}
