<?php

namespace App\Observers;

use App\Order;
use App\Mail\OrderPaymentSuccessfulMail;
use Illuminate\Support\Facades\Mail;

class OrderPaymentSuccessfulObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        if($order->status == 'APPROVED'){
            Mail::to($order->user->email)->send(new OrderPaymentSuccessfulMail($order));
        }
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if($order->status == 'APPROVED'){
            Mail::to($order->user->email)->send(new OrderPaymentSuccessfulMail($order));
        }
    }
}
