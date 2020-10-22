<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Session;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::paginate();

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Displays all the orders
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }
    /**
     * The cart data is stored in an order
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $quantity = $cart->totalQty;

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => 'CREADO',
            'quantity' => $quantity,
            'total' => $total,
        ]);

        return redirect(route('orders.show', $order))->with('order');
    }

    /**
     * Lists all orders of the authenticated user
     *
     * @return \Illuminate\View\View
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id, null)->paginate();

        return view('orders.index', ['orders' => $orders]);
    }
}
