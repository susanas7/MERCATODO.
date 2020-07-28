<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function __construct()
    {
      $this->middleware(['permission:ver producto']);
      $this->middleware(['verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->get('title');
        $slug = $request->get('slug');

        $products = Product::title($title)->slug($slug)->paginate(20);
        return view('products.index', ['products' => $products]);

        /*$products = Product::paginate(10);
        return view('products.index', [
            'products' => $products
        ]);*/
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
    public function store(ProductRequest $request)
    {
        /*$input = $request->all();

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

        $product = new Product;
        $product->title = $request->title;
        $product->slug = $request->slug;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->img_route = $request->img_route;
        $product->save();

        if($request->file('img_route')){
            $product->img_route = $request->file('img_route')->store('images', 'public');
            $product->save();
        }
        return redirect()->route('products.index');
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
    public function update(ProductRequest $request, $id)
    {
       /*$product = Product::find($id);
        $product->title = $request->get('title');
        $product->slug = $request->get('slug');
        $product->price = $request->get('price');
        $product->status = $request->get('status');
        $product->category_id = $request->get('category_id');
        $product->img_route = $request->get('img_route');

        $product->save();
        return redirect('/products');*/

        //actualiza todos los datos pero no actualiza la imagen

        /*$product=Product::find($id);
        if ($request->hasFile('img_route')){
                // aquí compruebo que exista la foto anterior
                if (\Storage::exists($product->img_route))
                {
                     // aquí la borro
                     \Storage::delete($product->img_route);
                }
                $product->img_route=\Storage::putFile('public', $request->file('img_route'));
            }
            $product->update($request->all());
            return redirect("/products");*/

        //dd($request->all());
        $product = Product::find($id);
        $product->update($request->all());

        if($request->file('img_route')){
            Storage::disk('public')->delete($product->img_route);
            $product->img_route = $request->file('img_route')->store('images','public');
            $product->save();
        }
        return redirect()->route('products  .index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->img_route);
        $product->delete();

        return back();
    }

    public function changeStatus($id){
        $product = Product::find($id);
        
        $product->is_active=!$product->is_active;
  
        if($product->save()){
          return redirect(route('products.index'));
        }else{
          return redirect(route('products.index'));
        }
      }

}
