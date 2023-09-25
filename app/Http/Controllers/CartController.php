<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addCart($id,Cart $cart)
    {
        $product = Product::find($id);
        $amount = $product->unit_price - $product->discount_price;
        $discount = ($amount / $product->unit_price) * 100;
        $data = array();
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['qty'] = 1;
        $data['price'] = $discount;
        $data['options']['image'] = $product->thumbnail;

        $userId = auth()->user()->id;
       Cart::session($userId)->add($data);
        return response()->json('success','ok');
    }

    public function viewcart()
    {
        return view('frontend.page.cart');
    }
}
