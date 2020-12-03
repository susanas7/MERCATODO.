<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource as ProductResource;
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
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
        $product = $this->productRepository->storeProduct($request);

        return response()->json([
            'Status' => '200',
            'Message' => 'Product created successfully',
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
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $this->productRepository->updateProduct($request, $product);

        return response()->json([
            'Status' => '200',
            'Message' => 'Product updated successfully',
            'product' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'Status' => '200',
            'Message' => 'Product deleted successfully',
        ]);
    }

    public function image($img_route)
    {
        $img = Product::find($img_route);

        return $img;
    }
}
