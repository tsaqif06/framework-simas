<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Config\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return $this->view("register/index");
    }
}
