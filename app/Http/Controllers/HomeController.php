<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Session;
use App\Cart;
use App\ProductCategory;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

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
        $categories = ProductCategory::all();
        $products = Product::where('is_active', 1)->title($title)->paginate(20);

        return view('home', compact('products', 'data', 'categories'));
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

    /**
     * List products by category
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function showCategory($id)
    {
        $category = ProductCategory::all();
        $categories = Product::where('category_id', $id)->get();
        $id_ = $id;
        return view('category', compact('categories', 'id_', 'category'));
    }

    /**
     * Add product to cart
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return back();
    }

    /**
     * Reduce a product from the cart
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function reduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        Session::put('cart', $cart);
        return redirect()->route('shoppingCart');
    }

    /**
     * Add a product from de cart
     *
     * @return RedirectResponse
     */
    public function addByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addByOne($id);

        Session::put('cart', $cart);
        return redirect()->route('shoppingCart');
    }

    /**
     * Remove the item from de cart
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function removeItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        Session::put('cart', $cart);
        return redirect()->route('shoppingCart');
    }

    /**
     * Shows all current products in the cart
     *
     * @return \Illuminate\View\View
     */
    public function shoppingCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shoppingCart', ['products' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shoppingCart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    /**
     * Shows authenticated user data
     *
     * @return \Illuminate\View\View
     */
    public function myProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('users.show', ['user' => $user]);
    }

    /**
     * Shows authenticated user data
     *
     * @return \Illuminate\View\View
     */
    public function editMyProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('users.editMyProfile', ['user' => $user]);
    }
}
