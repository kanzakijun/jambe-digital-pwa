<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel as Product;
use App\Models\PesananModel as Pesanan;
use Ramsey\Uuid\Uuid;
use Midtrans\Config;
use Midtrans\Snap;

class DashboardController extends BaseController
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

        return view('dashboard/index', $data);
    }

    public function pesanan($id)
    {
        $model = new Product();
        $data['products'] = $model->find($id);
        $data['title'] = 'dashboard';
        return view('dashboard/pesanan', $data);
    }

    public function pesan()
    {
        $file = $this->request->getFile('inputFile');
        $jml_cetak = $this->request->getPost('jml_cetak');
        $panjang_pesan = $this->request->getPost('panjang') / 100;
        $lebar_pesan = $this->request->getPost('lebar') / 100;
        $harga = $this->request->getPost('price');
        $subTotal = ($panjang_pesan * $lebar_pesan) * $harga;
        $totalHarga = $subTotal * $jml_cetak;

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'pesanan_' . date('Ymd_His') . '.' . $file->getExtension();

            $file->move(ROOTPATH . 'public/pesanan/', $newName);
        } else {
            $newName = 'fileGambar.jpg';
        }
        $data = [
            'id_pesan' => Uuid::uuid4()->toString(),
            'user_id' => $this->request->getPost('id_user'),
            'product_id' => $this->request->getPost('id_product'),
            'status_id' => 'n',
            'panjang_pesan' => $panjang_pesan,
            'lebar_pesan' => $lebar_pesan,
            'jml_pesan' => $jml_cetak,
            'total_harga' => $totalHarga,
            'file' => $newName,
            'keterangan' => $this->request->getPost('ket'),
        ];

        $model = new Pesanan();
        if ($model->insert($data)) {
            session()->setFlashdata('success', 'Pesanan added successfully');
        } else {
            session()->setFlashdata('error', 'Failed to add pesanan');
        }
        return redirect()->to('/dashboard');
    }

    public function bayar($id_pesanan)
    {

        $model = new Pesanan();
        $pesanan = $model->find($id_pesanan);
        $totalHarga = $pesanan['total_harga'];

        // Load the database connection
        $db = \Config\Database::connect();

        // Initialize the Query Builder for the 'users' table
        $builder = $db->table('users a');

        // Select the columns you need
        $builder->select('a.*, b.*, c.nama_product');

        // Perform the LEFT JOIN operations
        $builder->join('pesanans b', 'a.id = b.user_id', 'left');
        $builder->join('products c', 'c.id_product = b.product_id', 'left');

        // Add the WHERE clause to filter by the specific 'id_pesan'
        $builder->where('b.id_pesan', $id_pesanan);

        // Execute the query and fetch the result
        $query = $builder->get();

        // Fetch the result as a single row
        $result = $query->getRow();

        // If you want to fetch all rows, you can use:
        // $results = $query->getResult();

        // Accessing the name of the 'pemesan'
        $namaPemesan = $result->username;
        $emailPemesan = $result->email;
        $transactionDetails = [
            'order_id' => rand(),
            'gross_amount' => $totalHarga,
        ];

        $customerDetails = [
            'first_name' => $namaPemesan,
            'last_name' => $namaPemesan,
            'email' => $emailPemesan,
            //'phone' => '081234567890',
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            //'enabled_payments' => [$paymentMethod],
        ];
        $data = [
            'id_pesan' => $result->id_pesan,
            'nama_product' => $result->nama_product,
            'jml_pesan' => $result->jml_pesan,
            'panjang_pesan' => $result->panjang_pesan,
            'lebar_pesan' => $result->lebar_pesan,
            'total_harga' => $result->total_harga,
            'clientKey' => Config::$clientKey,
            'snapToken' => Snap::getSnapToken($transaction),
        ];
        return view('bayar/index', $data);
        //$snapToken = Snap::getSnapToken($transaction);
        //return json_encode(['token' => $snapToken]);
    }

    public function notification()
    {
        $json = file_get_contents('php://input');
        $notification = json_decode($json);

        echo "<pre>";
        print_r($notification);
        echo "</pre>";

        // Lakukan sesuatu dengan notifikasi, misalnya memperbarui status pesanan di database

        //return 'OK';
    }
}
