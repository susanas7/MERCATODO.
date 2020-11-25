<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource as ProductResource;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        if ($request->file('image')) {
            $product->img_route = $request->file('image')->store('images', 'public');
            $product->save();
        }

        return response()->json([
            'product' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return response()->json([
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $product->update($request->all());
        if ($request->file('image')) {
            Storage::disk('public')->delete($product->img_route);
            $product->img_route = $request->file('image')->store('images', 'public');
            $product->save();
        }

        return response()->json([
            'product' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json();
    }

    public function image($img_route)
    {
        $img = Product::find($img_route);

        return $img;
    }
}
