<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExportAll;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Imports\ProductsImport;
use App\Product;
use App\ProductCategory;
use App\Repositories\ProductRepository;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->authorizeResource(Product::class, 'product');
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $products = Product::query()
            ->forIndex()
            ->title($request->title)
            ->paginate();

        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = ProductCategory::all();

        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $this->productRepository->storeProduct($request);

        toast('Producto creado correctamente', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('admin.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $this->productRepository->updateProduct($request, $product);

        toast('Producto actualizado correctamente', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
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
     * @return RedirectResponse
     */
    public function changeStatus(int $id)
    {
        $product = Product::find($id);

        $product->is_active = !$product->is_active;

        if ($product->save()) {
            return redirect(route('admin.products.index'));
        }

        return redirect(route('admin.products.index'));
    }

    /**
     * Export products.
     *
     * @return Response
     */
    public function export()
    {
        $this->authorize('update', auth()->user());

        return Excel::download(new ProductsExportAll, 'products.xlsx');
    }

    /**
     * Import Products.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request)
    {
        $this->authorize('update', auth()->user());
        $import = new ProductsImport;
        $import->import($request->file('file'));

        return redirect(route('admin.products.index'));
    }
}
