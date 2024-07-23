<?php

namespace App\Livewire\Payment;

use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Redirect;


class Payment extends Component
{

    public $product_name;
    public $price;
    public $qty;
    public $refCommand;

    public $commandName;
    public $token;
    
    public $apiKey;
    public $secretKey;

    public $baseUrl = 'https://paytech.sn/api';
    

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.payment.payment');
    }

    public function mount(){

        $this->apiKey = "c99d7dcddefa9aa1f162bf40711030e12cdf4ad69f2225c9bd9a73a3c74f5f86";
        $this->secretKey = "63bb4345958423af5ec7dc50121558d41e57a09b39ffbdbb81b408ed3d91660f";

    }

    public function payment()
    {
        $api_key = $this->apiKey;
        $api_secret = $this->secretKey;
        $url = $this->baseUrl . '/payment/request-payment';
        
        // $total = $this->price * $this->qty = 5;
        $total = 100;
        $ref_commande = $this->refCommand;
        $commande = $this->commandName;
        $environment = 'test'; 
        $code = "47";
        $success_url = route('payment.success', ['code' => $code]);

        $ipn_url = 'https://hotbleepreviews.webmasterspark.com';
        $cancel_url = route('payment.success', ['code' => $code]);


        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'API_KEY' => $api_key,
                'API_SECRET' => $api_secret,
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
            ],
            'form_params' => [
                'item_name' => $this->product_name,
                'item_price' => $total,
                'currency' => 'XOF',
                'ref_command' => $ref_commande,
                'command_name' => $commande,
                'env' => $environment,
                'success_url' => $success_url,
                'ipn_url' => $ipn_url,
                'cancel_url' => $cancel_url,
                '3d_secure' => false, 
            ]
        ]);

        $jsonResponse = $response->getBody()->getContents();
            $responseData = json_decode($jsonResponse, true);

            if ($responseData && array_key_exists('success', $responseData)) {
                if ($responseData['success'] < 0) {
                    // Handle error response
                    $errorMessage = $responseData['message'] ?? 'Unknown error occurred.';
                    if (strpos($errorMessage, 'activer votre compte') !== false) {
                        
                        session()->flash('error', 'Unknown error occurred');

                    } else {
                        session()->flash('error', $errorMessage);
                    }
                } elseif ($responseData['success'] == 1) {
                    // Handle success response
                    $token = $responseData['token'] ?? null;
                    if ($token) {
                        session(['token' => $token]);
                        return redirect()->to($responseData['redirect_url']);
                    } else {
                        session()->flash('error', 'Token not found in response');

                    }
                } else {
                    session()->flash('error', 'Unexpected response');

                }
            } else {
                session()->flash('Invalid response format.');
            }
            
    }
    

}
