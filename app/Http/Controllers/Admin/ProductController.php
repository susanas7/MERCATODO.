<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Exports\ProductsExportAll;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Imports\ProductsImport;
use App\Product;
use App\ProductCategory;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = $request->get('title');
        $slug = $request->get('slug');
        $categories = ProductCategory::all();

        $products = Product::title($title)->paginate();

        return view('admin.products.index', ['products' => $products, 'categories' => $categories]);
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
        $this->authorize('viewAny', $product);
        $product = Product::create($request->all());

        if ($request->file('img_route')) {
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

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
        $this->authorize('view', $product);
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
        $this->authorize('update', $product);
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
        $this->authorize('update', $product);
        $categories = ProductCategory::all();
        $product->update($request->all());

        if ($request->file('img_route')) {
            Storage::disk('public')->delete($product->img_route);
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }

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
        $this->authorize('delete', $product);
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
        $this->authorize('update', $product);
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
     * @param Request $request
     * @return Response
     */
    public function export(Request $request)
    {
        $this->authorize('update', auth()->user());
        if ($request->input('category_id') . $request->input('is_active') == null) {
            return Excel::download(new ProductsExportAll, 'products.xlsx');
        }
        $category_id = $request->input('category_id');
        $is_active = $request->input('is_active');
        $request = $request->input();

        return (new ProductsExport($request))->download('products.xlsx');
    }

    /**
     * Import Products.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function import(Request $request)
    {
        $this->authorize('update', $product);
        $import = new ProductsImport;
        $import->import($request->file('file'));

        return redirect(route('admin.products.index'));
    }
}
