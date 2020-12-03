<?php

namespace App\Repositories;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Product;
use App\ProductCategory;

class ProductRepository
{
    public function storeProduct(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        if ($request->file('img_route')) {
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

        return $product;
    }

    public function updateProduct(UpdateRequest $request, Product $product)
    {
        $categories = ProductCategory::all();
        $product->update($request->all());
        if ($request->file('img_route')) {
            Storage::disk('public')->delete($product->img_route);
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

        return $product;
    }
}
