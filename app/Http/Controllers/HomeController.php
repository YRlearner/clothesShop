<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show products.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with([
            "products" => Product::latest()->paginate(6),
            "categories" => Category::Has("products")->get(),
            //"gender"=> Gender::Has("categories")->get(),
        ]);
    }

     /**
     * Show products by category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getProdcutByCategory(Category $category)
    {
        $products = $category->products()->paginate(10);
        return view('home')->with([
            "products" => $products,
            "categories" => Category::Has("products")->get(),
            //"gender"=> Gender::Has("categories")->get(),
        ]);
    }
}
