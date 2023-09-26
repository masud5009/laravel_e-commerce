<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addCart($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $amount = $product->unit_price - $product->discount_price;
        $discount = ($amount / $product->unit_price) * 100;
        $cart = session()->get('cart', []);
        if (isset($cart[$slug])) {
            $cart[$slug]['qty']++;
        } else {
            $cart[$slug] = [
                'name' => $product->name,
                'qty' => 1,
                'price' => $discount,
                'image' => $product->thumbnail,
                'shipping_charge' => 10,
            ];
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('success','Your product add to cart');
    }

    public function viewcart()
    {
        return view('frontend.page.cart');
    }
}
