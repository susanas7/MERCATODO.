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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->authorizeResource(Product::class, 'product');
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of products.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $products = Product::query()
            ->forIndex()
            ->title($request->title)
            ->paginate();

        return view('admin.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = ProductCategory::all();

        return view('admin.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $this->productRepository->store($request);

        toast('Producto creado correctamente', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified product.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('admin.products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product): View
    {
        $categories = ProductCategory::all();

        return view('admin.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param UpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product): RedirectResponse
    {
        $this->productRepository->update($request, $product);

        toast('Producto actualizado correctamente', 'success');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $this->productRepository->delete($product);

        return back();
    }

    /**
     * Enable or disable the status of a product.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function changeStatus(int $id): RedirectResponse
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
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
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
    public function import(Request $request): RedirectResponse
    {
        $this->authorize('update', auth()->user());
        $import = new ProductsImport;
        $import->import($request->file('file'));

        return redirect(route('admin.products.index'));
    }
}
