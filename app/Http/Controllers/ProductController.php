<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if($archive=$request->file('file')){
            $name_file=$archive->getClientOriginalName();
            $archive->move('images', $name_file);
            $input['img_route']=$name_file;
        }

        Product::create($input);
        /*Product::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);*/

        return redirect('/products');
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

        return view('products.show', [
          'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit')->with('product', $product);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->get('title');
        $product->slug = $request->get('slug');
        $product->price = $request->get();
        $product->status = $request->get('active', 'inactive');
        $product->category_id = $request->get();
        $product->img_route = $request->get();

        $user->save();
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return back();
    }
}
