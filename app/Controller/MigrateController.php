<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Model\User;
use FrameworkSimas\Config\Controller;

class MigrateController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $this->model->runMigration();
    }
}
