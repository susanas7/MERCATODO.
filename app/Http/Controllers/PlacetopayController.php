<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay as PlacetoPay;
use App\Order;
use Dnetix\Redirection\Exceptions\PlacetoPayException;

class PlacetopayController extends Controller
{
    public function pay(Order $order)
    {
        $placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
        ]);

        $request = [
            'locale' => 'es_CO',
            'buyer' => [
                'name' => 'Kellie Gerhold',
                'email' => 'flowe@anderson.com',
                'document_type' => 'CC',
                'document' => '1848839248',
                'phone' => '3006108300',
                'address' => '123 calle oscura'
            ],
            'payment' => [
                'reference' => $order->id,
                'description' => 'Iusto sit et voluptatem.',
                "amount" => [
                    "currency" => "COP",
                    "total" => $order->total,
                    "taxes" => [
                        [
                            "kind" => "iva",
                            "amount" => 0.00
                        ]
                    ]
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36',
            'returnUrl' => 'http://dnetix.dev/p2p/client',
            'cancelUrl' => 'https://dnetix.co',
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null,
        ];

        $response = $placetopay->request($request);

        if($response->isSuccessful()){
            return 'ok';
        }else{
            return 'no';
        }

    }
}
