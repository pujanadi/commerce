<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

//defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends ResourceController {
    protected $modelName = 'App\Models\Barang';
    protected $format    = 'json';

    function index() {
        $kontak =
            [
                'message' => 'Hello World',
                'status' => 'ok'
            ];

        return $this->respond($kontak);
    }


    function sendPayment(){

    }

    function sendHostPaymentRequest(){
        $paymentRespond =
            [
                'company_code' => '70001',
                'customer_no' => '1234567890',
                'request_id' => random_string('1234567890',6),
                'name' => 'John Doe',
                'amount' => '10000'
            ];
    }

    function getHostPaymentRespond(){
        helper('date');
        helper('text');
        $paymentRespond =
            [
                'company_code' => '70001',
                'customer_number' => 'ok',
                'request_id' => random_string('1234567890',6),
                'payment_status' => '01',
                'payment_reason_english' => 'failed',
                'payment_reason_indonesia' => 'gagal',
                'customer_name' => 'John Doe',
                'currency_code' => 'IDR',
                'amount' => '10000',
                'transaction_date' => date("d-m-Y h:i:s")
            ];
        return $this->respond($paymentRespond);
    }
}
?>