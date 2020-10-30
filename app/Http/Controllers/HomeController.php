<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Requests\User\UpdateRequest;
use App\Product;
use App\ProductCategory;
use App\User;
use Illuminate\Http\Request;
use Session;

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
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = $request->get('title');
        $categories = ProductCategory::all();
        $products = Product::where('is_active', 1)->title($title)->paginate(20);

        return view('home', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('show', [
            'product' => $product,
        ]);
    }

    /**
     * List products by category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showCategory(int $id)
    {
        $category = ProductCategory::all();
        $categories = Product::where('category_id', $id)->get();
        $id_ = $id;
        return view('category', compact('categories', 'id_', 'category'));
    }

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
        return redirect()->route('shoppingCart');
    }

    /**
     * Add a product from de cart.
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
        return redirect()->route('shoppingCart');
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
        return redirect()->route('shoppingCart');
    }

    /**
     * Shows all current products in the cart.
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
     * Shows authenticated user data.
     *
     * @return \Illuminate\View\View
     */
    public function myProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('users.show', ['user' => $user]);
    }

    /**
     * Shows authenticated user data.
     *
     * @return \Illuminate\View\View
     */
    public function editMyProfile()
    {
        $user = User::where('id', '=', auth()->user()->id)->first();

        return view('users.editMyProfile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function updateMyProfile(UpdateRequest $request)
    {
        $user = User::where('id', '=', auth()->user()->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('myProfile', ['user' => $user]);
    }
}
