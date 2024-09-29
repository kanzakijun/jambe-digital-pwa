<?php

namespace App\Controllers;

use App\Models\ProductModel as Product;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function index(): ResponseInterface
    {
        $model = new Product();
        $data['products'] = $model->orderBy('id_product', 'ASC')->findAll();
        return $this->response->setBody(view('home/index', $data));
    }

    public function detailProduct($id): ResponseInterface
    {
        $model = new Product();
        $data['products'] = $model->find($id);
        $view = view('home/detailProduct', $data);
        return $this->response->setBody($view);
    }

    public function detail(): ResponseInterface
    {
        return $this->response->setBody(view('home/detailProduct'));
    }
}
