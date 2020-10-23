<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrador de productos|Super-administrador']);
        $this->middleware(['verified']);
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

        $categories = ProductCategory::categoriesCached();

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $category = new ProductCategory();
        $category->title = $request->title;
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCategory $category
     * @return \Illuminate\View\View
     */
    public function edit(ProductCategory $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        $category = ProductCategory::find($id);
        $category->title = $request->title;
        $category->save();

        return redirect()->route('categories.index');
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

        return back();
    }
}
