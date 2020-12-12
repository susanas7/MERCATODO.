<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ver orden');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::query()
            ->forIndex()
            ->paginate();

        return view('admin.orders.index', ['orders' => $orders]);
    }

    /**
     * Displays all the orders.
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $order = Order::find($id);

        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }
}
