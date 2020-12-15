<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource as ProductResource;
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    /**
     * Display a listing of products.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productRepository->store($request);

        return response()->json([
            'Status' => '200',
            'Message' => 'Product created successfully',
            'product' => $product,
        ]);
    }

    /**
     * Display the specified product.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);

        return response()->json([
            'product' => $product,
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  Request $request
     * @param  Product $product
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Product $product): JsonResponse
    {
        $this->productRepository->update($request, $product);

        return response()->json([
            'Status' => '200',
            'Message' => 'Product updated successfully',
            'product' => $product,
        ]);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'Status' => '200',
            'Message' => 'Product deleted successfully',
        ]);
    }
}
