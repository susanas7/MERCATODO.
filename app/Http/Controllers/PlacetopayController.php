<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay as PlacetoPay;
use App\Order;
use App\Cart;
use Session;
use Auth;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\Message;
use Dnetix\Redirection\Entities\Status as Status;
use Dnetix\Redirection\Contracts\Entity;
use Dnetix\Redirection\Message\RedirectInformation;
use Dnetix\Redirection\Message\RedirectResponse;
use Dnetix\Redirection\Message\ReverseResponse;
use Dnetix\Redirection\Traits\StatusTrait as RevResp;

class PlacetopayController extends Controller
{
    public function pay($id, Placetopay $placetopay)
    {
        $order = Order::find($id);

        /*$placetopay = new PlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
        ]);*/

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
            'userAgent' => request  ()->header('user-agent'),
            'returnUrl' => route('orders.show', [$order->id]), //route('invoices.successful', [$order->id]),
            'cancelUrl' => route('orders.show', [$order->id]),
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null,
        ];

        $response = $placetopay->request($request);

        if ($response->isSuccessful()) {
                Session::forget('cart');
                $order->update([
                    'status' => $response->status()->status().$response->status()->message(),
                    'requestId' => $response->requestId(),
                    'processUrl' => $response->processUrl(),
                    ]);
                return redirect($response->processUrl());
        } else {
            $response->status()->message();
        }
        
        
    }

    /*public function showStatus()
    {
        $this->$response->status()->status()-
    }*/
}