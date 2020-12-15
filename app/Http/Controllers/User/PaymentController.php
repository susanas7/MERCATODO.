<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use Dnetix\Redirection\PlacetoPay as PlacetoPay;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * Redirects to the placetopay gateway.
     *
     * @param Order $order
     * @param Placetopay $placetopay
     * @return RedirectResponse
     */
    public function pay(Order $order, Placetopay $placetopay): RedirectResponse
    {
        $payment = new Payment;
        $payment::pay($order, $placetopay);

        return redirect($order->processUrl);
    }

    /**
     * Show and update the payment result.
     *
     * @param Order $order
     * @param Placetopay $placetopay
     * @return View
     */
    public function payment(Order $order, Placetopay $placetopay): View
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
