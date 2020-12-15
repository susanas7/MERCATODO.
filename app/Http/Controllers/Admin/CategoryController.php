<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Paginator;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ProductCategory::class, 'category');
    }

    /**
     * Display a listing of categories.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $title = $request->get('title');
        $categories = Paginator::paginate($request, ProductCategory::categoriesCached());

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $category = ProductCategory::create($request->all());
        ProductCategory::flushCache();

        toast('Categoria creada correctamente', 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified category.
     *
     * @param ProductCategory $category
     * @return View
     */
    public function show(ProductCategory $category): View
    {
        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param ProductCategory $category
     * @return View
     */
    public function edit(ProductCategory $category): View
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param UpdateRequest $request
     * @param ProductCategory $category
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, ProductCategory $category): RedirectResponse
    {
        $category->title = $request->title;
        $category->save();
        ProductCategory::flushCache();

        toast('Categoria actualizada correctamente', 'success');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param ProductCategory $category
     * @return RedirectResponse
     */
    public function destroy(ProductCategory $category): RedirectResponse
    {
        $category->delete();
        ProductCategory::flushCache();

        return back();
    }
}
