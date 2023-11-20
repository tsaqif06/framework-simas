<?php

namespace FrameworkSimas\Controller;

use Rakit\Validation\Validator;

use FrameworkSimas\Model\Product;
use FrameworkSimas\Config\Controller;

class ProductController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Product();
    }
    // main page
    public function index()
    {
        return $this->view("product/index", [
            'title' => 'Product - Main',
            'products' => $this->model->all(),
        ]);
    }

    /** 
     * page for create
     */
    public function create()
    {
        return $this->view("product/create", [
            'title' => 'Product - Create',
        ]);
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

        $validation = $validator->make($_POST + $_FILES, [
            'name'                 => 'required',
            'photo'                => 'required|uploaded_file:0'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            redirect("/product/create");
            exit();
        }

        $result = $this->model->create($_POST);

        if ($result['success'] && $result['data']) {
            successFlash('Storing data');
            redirect("/product");
        } else {
            failedFlash('Storing data');
            redirect("/product");
        }
    }

    /** 
     * page for edit or update
     */
    public function edit($request)
    {
        return $this->view("product/edit", [
            'title' => "Product - Edit",
            'product' => $this->model->find($request['id']),
        ]);
    }

    /** 
     * process to update data
     */
    public function update($request)
    {
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
        $validator = new Validator;

        $validation = $validator->make($_POST, [
            'name'                 => 'required',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            redirect("/product/edit/{$request['id']}");
            exit();
        }

        $result = $this->model->where('id', '=', $request['id'])->update($_POST);

        if ($result['success'] && $result['data']) {
            successFlash('Updating data');
            redirect("/product");
        } else {
            failedFlash('Updating data');
            redirect("/product");
        }
    }

    /**
     * process to delete data
     */

    public function delete($request)
    {
        if ($this->model->delete($request['id']) > 0) {
            successFlash('Deleting data');
            redirect("/product");
        } else {
            failedFlash('Deleting data');
            redirect("/product");
        }
    }
}
