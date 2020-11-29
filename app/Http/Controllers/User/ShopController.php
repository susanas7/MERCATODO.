<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;
use Session;

class ShopController extends Controller
{
    /**
     * Add product to cart.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function addToCart(Request $request, int $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        toast('Producto agregado correctamente', 'success');
        return back();
    }

    /**
     * Reduce a product from the cart.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function reduceByOne(int $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);
        return redirect()->route('user.shoppingCart');
    }

    /**
     * Add a product to de cart.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function addByOne(int $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addByOne($id);

        Session::put('cart', $cart);
        return redirect()->route('user.shoppingCart');
    }

    /**
     * Remove the item from de cart.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function removeItem(int $id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        Session::put('cart', $cart);
        return redirect()->route('user.shoppingCart');
    }

    /**
     * Shows all current products in the cart.
     *
     * @return \Illuminate\View\View
     */
    public function shoppingCart()
    {
        if (!Session::has('cart')) {
            return view('user.shop.shoppingCart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        return view('user.shop.shoppingCart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    /**
     * The cart data is stored in an order.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeCart(Request $request)
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

        return redirect(route('admin.orders.show', $order))->with('order');
    }
}
