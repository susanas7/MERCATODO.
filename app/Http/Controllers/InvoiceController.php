<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function successful($id)
    {
        $order = Order::find($id);

        return view('invoices.successful', [
            'order' => $order
        ]);
    }

    public function store($id)
    {
        $order = Order::find($id);

        $invoice = Invoice::create([
            'order_id' => $id,
        ]);

        return redirect(route('invoices.show', $order->id));
    }

    public function show($id)
    {
        $invoice = Invoice::where('order_id', $id)->first();

        return view('invoices.show', [
            'invoice' => $invoice,
        ]);
    }
}
