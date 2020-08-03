<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('show', [
          'product' => $product
        ]);
    }
}
