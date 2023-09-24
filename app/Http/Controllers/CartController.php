<?php

namespace App\Http\Controllers;

use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function addCart($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity']++;
        } else {
            $cart[$slug] = [
                'name' => $product->name,
                'quantity' => 1,
                'unit_price' => $product->unit_price,
                'discount_price' => $product->discount_price,
                'image' => $product->thumbnail,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'product add successfull');
    }


    public function viewcart()
    {
        return view('frontend.page.cart');
    }
}
