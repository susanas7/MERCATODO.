<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = ProductCategory::all();
        $products = Product::query()
            ->forIndex()
            ->where('is_active', 1)
            ->title($request->title)
            ->paginate();

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
        $categories = ProductCategory::all();
        $products = Product::where('category_id', $id)->paginate();
        $id_ = $id;
        return view('home', compact('products', 'id_', 'categories'));
    }
}
