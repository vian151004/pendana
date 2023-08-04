<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TripayController extends Controller
{
    function getPaymentChannels() {
        $apiKey = config('tripay.api_key');
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_FRESH_CONNECT  => true,
        CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
        CURLOPT_FAILONERROR    => false,
        CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        
        return $response ? $response : $error;
    }

    function requestTransaction($method, $donation) {
        $merchantRef = 'PX-' . time();
        $user = auth()->user();
        
        $apiKey = config('tripay.api_key');
        $privateKey = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');

        $data = [
            'method'        => $method,
            'merchant_ref'  => $merchantRef,
            'amount'         => $donation->nominal,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'order_items'    => [
                [
                    'name'        => $donation->order_number,
                    'price'       => $donation->nominal,
                    'quantity'    => 1
                ]
            ],
            'signature'     => hash_hmac('sha256', $merchantCode.$merchantRef.$donation->nominal, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        return $response ?: $error;
    }

    function detailTransaction($reference) {
        $apiKey = config('tripay.api_key');
        $payload = [
            'reference' => $reference
        ]; //payload harus dalam bentuk array

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        
        $response = json_decode($response)->data;
        return $response ?: $error;
    }
}
