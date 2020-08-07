<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador de productos|Super-administrador']);
        $this->middleware(['verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = Cache::remember('products', 6000, function () {
            return Product::all();
        });
        Cache::get('products');
        $title = $request->get('title');
        $slug = $request->get('slug');

        $products = Product::title($title)->slug($slug)->paginate(20);

        return view('products.index', ['products' => $products, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $product = Product::create($request->all());

        if ($request->file('img_route')) {
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::all();
        $product->update($request->all());

        if ($request->file('img_route')) {
            Storage::disk('public')->delete($product->img_route);
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $product
     *
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->img_route);
        $product->delete();

        return back();
    }

    /**
     * Enable or disable the status of a product.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function changeStatus($id)
    {
        $product = Product::find($id);

        $product->is_active = !$product->is_active;

        if ($product->save()) {
            return redirect(route('products.index'));
        }

        return redirect(route('products.index'));
    }
}
