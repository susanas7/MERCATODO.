<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\OrderProduct;
use Auth;
use Illuminate\Http\Request;
use Session;

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
     * Displays all the orders.
     *
     * @param Order $order
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $order = Order::find($id);

        return view('orders.show', [
            'order' => $order,
        ]);

        //return $order->products;
    }

    /**
     * The cart data is stored in an order.
     *
     * @param Request $request
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

        foreach ($cart->items as $items) {
            $s = $items['item'];
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $s['id'],
            ]);
        }

        return redirect(route('orders.show', $order))->with('order');
    }

    /**
     * Lists all orders of the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function myOrders()
    {
        $orders = Order::where('user_id', '=', auth()->user()->id, null)->paginate();

        return view('orders.index', ['orders' => $orders]);
    }
}
