<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Dnetix\Redirection\PlacetoPay as PlacetoPay;
use Illuminate\Http\Request;
use Session;

class PaymentController extends Controller
{
    public $payment;

    /*public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
    public function pay(Order $order, Placetopay $placetopay)
    {
        //$payment = Payment::pay($order, $placetopay);

        $this->payment->pay($order, $placetopay);
    }*/

    public static function pay(Order $order, Placetopay $placetopay)
    {
        $request = [
            'locale' => 'es_CO',
            'buyer' => [
                'name' => $order->user->name,
                'email' => $order->user->email,
                'document_type' => $order->user->document_type,
                'document' => $order->user->document,
                'phone' => $order->user->phone,
                'address' => $order->user->address,
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
            'returnUrl' => route('user.payment', [$order->id]),
            'cancelUrl' => route('user.payment', [$order->id]),
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
     * Show the payment result.
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

        return view('user.orders.payment', [
            'order' => $order,
        ]);
    }
}
