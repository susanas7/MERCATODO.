<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Session;
use App\Cart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = $request->get('title');
        $data = Cache::remember('products', 6000, function () {
            return Product::all();
        });
        Cache::get('products');
        $products = Product::where('is_active', 1)->title($title)->paginate(20);

        return view('home', compact('products', 'data'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('show', [
            'product' => $product,
        ]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('home');
    }

    public function shoppingCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shoppingCart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shoppingCart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
