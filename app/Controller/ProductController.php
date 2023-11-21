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
        $data = $this->model->all();

        // API RESPONSE
        if (!isWebRequest()) {
            if ($data['status'] != 200) {
                return jsonResponse($data, $data['status']);
            }

            return jsonResponse($data);
        }

        // WEB RESPONSE
        return $this->view("product/index", [
            'title' => 'Product - Main',
            'products' => $data,
        ]);
    }

    public function find($request)
    {
        $data = $this->model->find('id', $request['id']);

        // API RESPONSE
        if (!isWebRequest()) {
            if ($data['status'] != 200) {
                return jsonResponse($data, $data['status']);
            }

            return jsonResponse($data);
        }

        // return $this->view("product/index", [
        //     'title' => 'Product - Main',
        //     'products' => $data,
        // ]);
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

        $validation = $validator->make(request() + $_FILES, [
            'name'                 => 'required',
            'photo'                => 'required|uploaded_file:0'
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = request();
            redirect("/product/create");
            exit();
        }

        $result = $this->model->create(request());

        // API RESPONSE
        if (!isWebRequest()) {
            $status = 200;
            if (!$result) {
                $status = 500;
            }

            return jsonResponse($result, $status);
        }

        // WEB RESPONSE
        if (!$result['success'] && !$result['data']) {
            failedFlash('Storing data');
        } else {
            successFlash('Storing data');
        }

        redirect("/product");
    }

    /** 
     * page for edit or update
     */
    public function edit($request)
    {
        return $this->view("product/edit", [
            'title' => "Product - Edit",
            'product' => $this->model->find('id', $request['id']),
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

        $validation = $validator->make(request(), [
            'name'                 => 'required',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $errors = $validation->errors()->firstOfAll();
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = request();
            redirect("/product/edit/{$request['id']}");
            exit();
        }

        $result = $this->model->where('id', '=', $request['id'])->update(request());

        // API RESPONSE
        if (!isWebRequest()) {
            $status = 200;
            if (!$result) {
                $status = 500;
            }

            return jsonResponse($result, $status);
        }

        // WEB RESPONSE
        if (!$result['success'] && !$result['data']) {
            failedFlash('Updating data');
        } else {
            successFlash('Updating data');
        }

        redirect("/product");
    }

    /**
     * process to delete data
     */

    public function delete($request)
    {
        $result = $this->model->delete($request['id']);

        // API RESPONSE
        if (!isWebRequest()) {
            $status = 200;
            if (!$result) {
                $status = 500;
            }

            return jsonResponse($result, $status);
        }

        // WEB RESPONSE
        if (!$result['success']) {
            failedFlash('Deleting data');
        } else {
            successFlash('Deleting data');
        }
        redirect("/product");
    }
}
