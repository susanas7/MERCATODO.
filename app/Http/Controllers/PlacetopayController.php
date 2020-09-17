<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay as PlacetoPay;
use App\Order;
use App\Cart;
use Session;
use Auth;
use Dnetix\Redirection\Exceptions\PlacetoPayException;

class PlacetopayController extends Controller
{
    public function pay($id)
    {
        /*funciona pero no creo que sea funcional si se quieren pagar ordnes anteriores
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $quantity = $cart->totalQty;*/

        $order = Order::find($id);

        $placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
        ]);

        $request = [
            'locale' => 'es_CO',
            'buyer' => [
                'name' => $order->user->name,
                'email' => $order->user->email,
                'document_type' => $order->user->document_type,
                'document' => $order->user->document,
                'phone' => $order->user->phone,
                'address' => $order->user->address
            ],
            'payment' => [
                'reference' => $order->id,
                'description' => 'Iusto sit et voluptatem.',
                "amount" => [
                    "currency" => "COP",
                    "total" => $order->total,
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->header('user-agent'),
            'returnUrl' => 'http://google.com', 
            'cancelUrl' => 'https://dnetix.co',
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null,
        ];

        $response = $placetopay->request($request);

        /*if($response->isSuccessful()){
            return 'ok';
        }else{
            return 'no';
        }*/

        //dd($request);
        //dd($response);

        if ($response->isSuccessful()) {
            return redirect($response->processUrl());
        } else {
            $response->status()->message();
        }

    }
}
