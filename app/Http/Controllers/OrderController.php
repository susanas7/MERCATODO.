<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Session;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(Order $orders)
    {
        //$this->middleware(['role:Administrador de productos|Super-administrador']);
        $this->orders = $orders;
    }

    /**
     * The cart data is stored in an order
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
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
        return redirect('/orders/' . $order->id)->with('order');
    }

    /**
     * Displays all the orders
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

    /**
     * Redirect from successful payment
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function orderSuccessful($id)
    {
        $order = Order::find($id);

        return view('orders.successful', [
            'order' => $order,
        ]);
    }

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
