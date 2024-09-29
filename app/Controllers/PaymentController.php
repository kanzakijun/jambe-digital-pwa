<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\PesananModel as Pesanan;

class PaymentController extends BaseController
{
    public function __construct()
    {
        Config::$serverKey;
        Config::$clientKey;
        Config::$isProduction;
        Config::$isSanitized;
        Config::$is3ds;
    }
    public function index()
    {

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );


        $data = [
            'clientKey' => Config::$clientKey,
            'snapToken' => Snap::getSnapToken($params)
        ];


        return view('payment/index', $data);
    }

    public function token()
    {
        $request = $this->request->getJSON();
        $paymentMethod = $request->payment_type ?? 'credit_card';

        $transactionDetails = [
            'order_id' => rand(),
            'gross_amount' => 10000,
        ];

        $customerDetails = [
            'first_name' => 'Mita',
            'last_name' => 'Mita',
            'email' => 'mita@jambe.com',
            //'phone' => '081234567890',
        ];

        $transaction = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            //'enabled_payments' => [$paymentMethod],
        ];

        $snapToken = Snap::getSnapToken($transaction);
        return json_encode(['token' => $snapToken]);
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

    public function success($id_pesan)
    {

        $model = new Pesanan();
        $model->update($id_pesan, [
            'status_id' => 'p',
        ]);
        return redirect()->to('/dashboard');
    }
}
