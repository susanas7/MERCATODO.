<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\ImportRequest;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Exports\ProductsExportAll;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Imports\ProductsImport;

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
        $title = $request->get('title');
        $slug = $request->get('slug');
        $categories = ProductCategory::all();

        $products = Product::title($title)->paginate();

        return view('products.index', ['products' => $products, 'categories' => $categories]);
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
    public function store(StoreProductRequest $request)
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
        $product = Product::findOrFail($id);

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

    public function export(Request $request)
    {
        if($request->input('category_id').$request->input('is_active') == null){
            return Excel::download(new ProductsExportAll, 'products.xlsx');
        }
        $category_id = $request->input('category_id');
        $is_active = $request->input('is_active');
        $request = $request->input();

        return (new ProductsExport($request))->download('products.xlsx');

    }

    public function import(Request $request)
    {
        $file = $request->file('file');

        (new ProductsImport)->import($file);

        return redirect(route('products.index'));
    }
}
