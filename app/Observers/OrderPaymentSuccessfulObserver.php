<?php

namespace App\Observers;

use App\Mail\OrderPaymentSuccessfulMail;
use App\Order;
use Illuminate\Support\Facades\Mail;

class OrderPaymentSuccessfulObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param Order  $order
     * @return void
     */
    public function created(Order $order): void
    {
        if ($order->status == 'APPROVED') {
            Mail::to($order->user->email)->send(new OrderPaymentSuccessfulMail($order));
        }
    }

    /**
     * Handle the order "updated" event.
     *
     * @param Order  $order
     * @return void
     */
    public function updated(Order $order): void
    {
        if ($order->status == 'APPROVED') {
            Mail::to($order->user->email)->send(new OrderPaymentSuccessfulMail($order));
        }
    }
}
