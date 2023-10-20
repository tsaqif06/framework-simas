<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Config\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return $this->view("login/index", [
            'title' => 'Login',
        ]);
    }
}
