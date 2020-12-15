<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ver orden');
    }

    /**
     * Display a listing of orders.
     *
     * @return View
     */
    public function index(): View
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
     * @return View
     */
    public function show(Order $order): View
    {
        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }
}
