<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = \App\Product::paginate(10);
        return view('home', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('show', [
          'product' => $product
        ]);
    }
}
