<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store($id)
    {
        $order = Order::find($id);

        $invoice = new Invoice;
        $invoice->order_id = $order->id;

        return redirect('/invoices/'.$order->id)->with('invoice');
    }
}
