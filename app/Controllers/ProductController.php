<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Ramsey\Uuid\Uuid;
use App\Models\ProductModel as Product;

class ProductController extends BaseController
{
    /**
     * Displays the list of products.
     *
     * @return ResponseInterface
     */

    public function index(): ResponseInterface
    {
        //
        $model = new Product();
        $data['products'] = $model->orderBy('nama_product', 'ASC')->findAll();
        $view = view('product/index', $data);
        return $this->response->setBody($view);
    }

    public function addProduct(): ResponseInterface
    {
        $view = view('product/addProduct');
        return $this->response->setBody($view);
    }

    public function editProduct($id)
    {
        $model = new Product();
        $data['products'] = $model->find($id);
        $view = view('product/editProduct', $data);
        return $this->response->setBody($view);
    }

    public function saveProduct()
    {
        $file = $this->request->getFile('gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'product_' . date('Ymd_His') . '.' . $file->getExtension();

            $file->move(ROOTPATH . 'public/products/', $newName);
        } else {
            $newName = 'fileGambar.jpg';
        }
        $data = [
            'id_product' => Uuid::uuid4()->toString(),
            'nama_product' => $this->request->getPost('nama_product'),
            'jenis_product' => strtoupper($this->request->getPost('jenis_product')),
            'deskripsi_product' => $this->request->getPost('deskripsi_product'),
            'panjang' => $this->request->getPost('panjang'),
            'lebar' => $this->request->getPost('lebar'),
            'harga' => $this->request->getPost('harga'),
            'min_pesan' => $this->request->getPost('minPesan'),
            'gambar' => $newName
        ];
        $model = new Product();
        if ($model->insert($data)) {
            session()->setFlashdata('success', 'Product added successfully');
        } else {
            session()->setFlashdata('error', 'Failed to add product');
        }
        return redirect()->to('/product');
    }

    public function updateProduct($id)
    {
        $model = new Product();
        $product = $model->find($id);

        if (!$product) {
            session()->setFlashdata('error', 'Product not found');
            return redirect()->to('/product');
        }

        $file = $this->request->getFile('gambar');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'product_' . date('Ymd_His') . '.' . $file->getExtension();
            $file->move(ROOTPATH . 'public/products', $newName);
            $data = [
                'id_product' => $id,
                'nama_product' => $this->request->getPost('nama_product'),
                'jenis_product' => strtoupper($this->request->getPost('jenis_product')),
                'deskripsi_product' => $this->request->getPost('deskripsi_product'),
                'panjang' => $this->request->getPost('panjang'),
                'lebar' => $this->request->getPost('lebar'),
                'harga' => $this->request->getPost('harga'),
                'min_pesan' => $this->request->getPost('minPesan'),
                'gambar' => $newName
            ];
        } else {
            $data = [
                'id_product' => $id,
                'nama_product' => $this->request->getPost('nama_product'),
                'jenis_product' => strtoupper($this->request->getPost('jenis_product')),
                'deskripsi_product' => $this->request->getPost('deskripsi_product'),
                'panjang' => $this->request->getPost('panjang'),
                'lebar' => $this->request->getPost('lebar'),
                'harga' => $this->request->getPost('harga'),
                'min_pesan' => $this->request->getPost('minPesan'),
            ];
        }
        if ($model->update($id, $data)) {
            session()->setFlashdata('success', 'Product updated successfully');
        } else {
            session()->setFlashdata('error', 'Failed to update product');
        }
        return redirect()->to('/product');
    }

    public function deleteProduct($id)
    {
        $model = new Product();
        $product = $model->find($id);
        if ($product) {
            if ($product['gambar'] != 'fileGambar.jpg') {
                $filePath = ROOTPATH . 'public/products/' . $product['gambar'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $model->delete($id);
            session()->setFlashdata('success', 'Product has been deleted successfully');
        } else {
            session()->setFlashdata('error', 'Product not found');
        }
        return redirect()->to('/product');
    }
}
