<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addcart(Request $request)
    {
        $product_id = $request->product_id;


        $product = Product::find($product_id);


        $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId)->add($product_id, $product->title, $product->price, 1, array());

        $cartTotalQuantity = \Cart::session($userId)->getTotalQuantity();
        return $cartTotalQuantity;

    }

}
