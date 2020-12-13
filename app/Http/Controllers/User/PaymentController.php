<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Dnetix\Redirection\PlacetoPay as PlacetoPay;

class PaymentController extends Controller
{
    public function pay(Order $order, Placetopay $placetopay)
    {
        $payment = new Payment;
        $payment::pay($order, $placetopay);

        return redirect($order->processUrl);
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

        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }
}
