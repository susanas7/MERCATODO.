<?php

namespace App\Http\Controllers\User;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use App\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Add product to cart.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function addToCart(Request $request, int $id): RedirectResponse
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
    public function reduceByOne(int $id): RedirectResponse
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
    public function addByOne(int $id): RedirectResponse
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
    public function removeItem(int $id): RedirectResponse
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
     * @return View
     */
    public function shoppingCart(): View
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
    public function storeCart(Request $request): RedirectResponse
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
                'quantity' => $items['qty'],
                'price' => $items['qty'] * $s['price'],
            ]);
        }

        return redirect(route('user.checkout', $order));
    }
}
