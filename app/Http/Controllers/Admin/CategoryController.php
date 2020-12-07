<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Paginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ProductCategory::class, 'category');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title = $request->get('title');
        $categories = Paginator::paginate($request, ProductCategory::categoriesCached());

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $category = ProductCategory::create($request->all());
        ProductCategory::flushCache();

        toast('Categoria creada correctamente', 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param ProductCategory $category
     * @return \Illuminate\View\View
     */
    public function show(ProductCategory $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCategory $category
     * @return \Illuminate\View\View
     */
    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, ProductCategory $category)
    {
        $category->title = $request->title;
        $category->save();
        ProductCategory::flushCache();

        toast('Categoria actualizada correctamente', 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCategory $category
     * @return RedirectResponse
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();
        ProductCategory::flushCache();

        return back();
    }
}
