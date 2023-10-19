<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Model\User;
use Rakit\Validation\Validator;
use FrameworkSimas\Config\Flasher;
use FrameworkSimas\Config\Controller;

class UserController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }
    // main page
    public function index()
    {
        return $this->view("home/index", [
            'user' => $this->model->all()
        ]);
    }

    /** 
     * page for create
     */
    public function create()
    {
        return $this->view("home/create");
    }

    /** 
     * process to create data
     */
    public function store()
    {
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
        $validator = new Validator;

        $validation = $validator->make($_POST, [
            'name'                  => 'required',
            'email'                 => 'required',
            'password'              => 'required|min:5'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            header("Location: /user/create");
            exit();
        }

        if ($this->model->create($_POST) > 0) {
            Flasher::setFlash('BERHASIL', 'Store', 'success');
            header("Location: " . BASEURL . "/user");
        } else {
            echo "Failed to store data";
        }
    }

    /** 
     * page for edit or update
     */
    public function edit($request)
    {
        return $this->view("home/edit", [
            'user' => $this->model->find($request['id']),
        ]);
    }

    /** 
     * process to update data
     */
    public function update($request)
    {
        if ($this->model->update($request['id'], $_POST) > 0) {
            Flasher::setFlash('BERHASIL', 'Update', 'success');
            header("Location: " . BASEURL . "/user");
        } else {
            echo "Failed to update data";
        }
    }

    /**
     * process to delete data
     */

    public function delete($request)
    {
        if ($this->model->delete($request['id']) > 0) {
            Flasher::setFlash('BERHASIL', 'Delete', 'success');
            header("Location: " . BASEURL . "/user");
        } else {
            echo "Failed to delete data";
        }
    }
}
