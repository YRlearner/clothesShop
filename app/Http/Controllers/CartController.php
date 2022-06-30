<?php

namespace App\Http\Controllers;

use App\Models\Product;
//use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //return cart items
    public function index()
    {
        
        return view('cart.index')->with([
            'items' => Cart::getContent()
        ]);
    }
        //add item to cart
    public function addProductToCart(Request $request,Product $product)
    {
        
        Cart::add(array(
            "id" => $product->id,
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => $request->quantity,
            "description" => $product->description,
            "slug" => $product->slug,
            "in_stock" => $product->in_stock,
            "attributes" => array(),
            "associatedModel" => $product,
        ));
        return redirect()->route('cart.index');
    }
    //update item to cart
    public function updateProductOnCart(Request $request,Product $product)
    {
        Cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity
            ),
        ));
        return redirect()->route("cart.index");
    }
//remove item to cart
public function removeProductFromCart(Product $product)
{
    Cart::remove($product->id);
        return redirect()->route("cart.index");
}
}
