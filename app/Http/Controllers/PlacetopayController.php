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
    /**
     * Create the request to send to the gateway
     *
     * @param Order $order
     * @param Placetopay $placetopay
     * @return RedirectResponse
     */
    public function pay(Order $order, Placetopay $placetopay)
    {
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
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->total,
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'ipAddress' => request()->ip(),
            'userAgent' => request()->header('user-agent'),
            'returnUrl' => route('payment', [$order->id]),
            'cancelUrl' => route('home'), //route('orders.show', [$order->id]),
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null,
        ];

        $response = $placetopay->request($request);

        if ($response->isSuccessful()) {
            Session::forget('cart');
            $order->update([
                'requestId' => $response->requestId(),
                'processUrl' => $response->processUrl(),
            ]);
            return redirect($response->processUrl());
        } else {
            $response->status()->message();
        }
    }

    /**
     * Show the payment result
     * 
     * @param Order $order
     * @param Placetopay $placetopay
     * @return \Illuminate\View\View
     */
    public function payment(Order $order, Placetopay $placetopay)
    {
        $response = $placetopay->query($order->requestId);

        $order->update([
            'status' => $response->status()->status(),
        ]);

        return view('orders.payment',[
            'order' => $order
        ]);
    }
}
