<?php

namespace FrameworkSimas\Controller;

use FrameworkSimas\Model\Product;
use FrameworkSimas\Config\Flasher;
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
            'products' => $this->model->all()
        ]);
    }

    /** 
     * page for create
     */
    public function create()
    {
        return $this->view("product/create");
    }

    /** 
     * process to create data
     */
    public function store()
    {
        if ($this->model->create($_POST) > 0) {
            Flasher::setFlash('BERHASIL', 'Store', 'success');
            header("Location: " . BASEURL . "/product");
        } else {
            echo "Failed to store data";
        }
    }

    /** 
     * page for edit or update
     */
    public function edit($request)
    {
        return $this->view("product/edit", [
            'product' => $this->model->find($request['id']),
        ]);
    }

    /** 
     * process to update data
     */
    public function update($request)
    {
        if ($this->model->update($request['id'], $_POST) > 0) {
            Flasher::setFlash('BERHASIL', 'Update', 'success');
            header("Location: " . BASEURL . "/product");
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
            header("Location: " . BASEURL . "/product");
        } else {
            echo "Failed to delete data";
        }
    }
}
