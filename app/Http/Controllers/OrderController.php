<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Session;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        /*if(Session::has('cart')){
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'status' => 'created',
                'quantity' => $totalQty,
                'total' => $totalPrice,
            ]);
        }

        return redirect('/orders/'.$order->id)->with('order');*/

        /*if (Session::has('cart')) {
            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->status = 'created';
            $order->quantity = $totalQty;
            $order->total = $totalPrice;

            Auth::user()->orders()->save($order);

            return redirect('/orders/'.$order->id)->with('order');

        }*/

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $quantity = $cart->totalQty;

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status' => 'created',
            'quantity' => $quantity,
            'total' => $total,
        ]);
        return redirect('/orders/'.$order->id)->with('order');


    }

    public function show($id)
    {
        //$order = Order::where('user_id', auth()->user()->id);
        $order = Order::find($id);

        return view('orders.show', [
            'order' => $order,
        ]);
    }

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
     * @param App\Role $role
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::paginate();

        return view('orders.index', ['orders' => $orders]);
    }
    
}
