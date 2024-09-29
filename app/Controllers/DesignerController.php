<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PesananModel as Pesanan;

class DesignerController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pesanans');

        // Joining the product table
        $builder->select('pesanans.*, products.nama_product as product_name, products.harga as product_harga');
        $builder->join('products', 'products.id_product = pesanans.product_id');
        $builder->orderBy('created_at', 'DESC');

        $query = $builder->get();
        $data['pesanan'] = $query->getResult();
        $data['title'] = 'Dashboard';

        return view('designer/index', $data);
    }

    public function approval($id)
    {
        $model = new Pesanan();

        if (isset($_POST['approve'])) {
            $model->update($id, [
                'status_id' => 't',
            ]);
            return redirect()->to('/designer');
        } elseif (isset($_POST['reject'])) {
            $model->update($id, [
                'status_id' => 'r',
            ]);
            return redirect()->to('/designer');
        } elseif (isset($_POST['selesai'])) {
            $model->update($id, [
                'status_id' => 'y',
            ]);
            return redirect()->to('/designer');
        }
    }
}
