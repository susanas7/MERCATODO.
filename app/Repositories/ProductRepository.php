<?php

namespace App\Repositories;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Product;
use App\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    /**
     * Store products.
     *
     * @param StoreProductRequest $request
     * @return Product $product
     */
    public function store(StoreProductRequest $request): Product
    {
        $product = Product::create($request->all());
        if ($request->file('img_route')) {
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

        return $product;
    }

    /**
     * Update products.
     *
     * @param UpdateRequest $request
     * @param Product $product
     * @return Product $product
     */
    public function update(UpdateRequest $request, Product $product): Product
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

    /**
     * Delete products.
     *
     * @param Product $product
     * @return bool
     */
    public function delete(Product $product): bool
    {
        Storage::disk('public')->delete($product->img_route);
        return $product->delete();
    }
}
