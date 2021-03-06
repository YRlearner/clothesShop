<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('home')->with([
            "products" => Product::latest()->paginate(10),
            "categories" => Category::Has("products")->get()
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.products.create')->with([
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //validated() is a method in the StoreProductRequest class
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|numeric'
        ]);
    //add product to database
    if ($request->has("image")){
        $file =$request->image;
        $imageName ="images/products/".time()."_".$file->getClientOriginalName();
        $file->move(public_path('images/products'), $imageName);
        $name =$request->name;
        Product::create([
            'name' => $name,
            "slug" => Str::slug($name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'in_stock' => $request->in_stock,
            'category_id' => $request->category_id,
            'image' => $imageName,
            
        ]);
        return redirect()->route('admin.products')->withSuccess('Product created successfully');
        
    }
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('products.show')->with(['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('admin.products.edit')->with([
            "product" => $product,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required|min:10',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|numeric'
        ]);
    //update product to database
    if ($request->has("image")){
        $image_path=public_path("images/products/".$product->image);
        if(File::exists($image_path)){
            unlink($image_path);
        }
        $file =$request->image;
        $imageName ="images/products/".time()."_".$file->getClientOriginalName();
        $file->move(public_path('images/products'), $imageName);
        $product->image=$imageName;
    }
    $name =$request->name;
        $product->update([
            'name' => $name,
            "slug" => Str::slug($name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'in_stock' => $request->in_stock,
            'category_id' => $request->category_id,
            'image' => $product->image,
            
        ]);
        return redirect()->route('admin.products')->withSuccess('Product updated successfully');
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
       
    //delete product to database
        $image_path=public_path("images/products/".$product->image);
        if(File::exists($image_path)){
            unlink($image_path);
        }
        
    
  
        $product->delete();
        return redirect()->route('admin.products')->withSuccess('Product deleted successfully');
        
    }
}
