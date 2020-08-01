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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $title = $request->get('title');
        //$role = $user->roles->implode('name', ',');
        $data = Cache::remember('products',6000 , function(){
            return Product::all();
        });
        Cache::get('products');
        $products = Product::title($title)->paginate(20);
        return view('home', compact('products', 'data'));
        /*$products = \App\Product::paginate(10);
        return view('home', compact('products'));*/
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('show', [
          'product' => $product
        ]);
    }
}
