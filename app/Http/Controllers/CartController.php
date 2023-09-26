<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function addCart($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $amount = $product->unit_price - $product->discount_price;
        $discount = ($amount / $product->unit_price) * 100;
        $cart = session()->get('cart', []);
        if (!$product) {
            abort(404);
        } else {
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
            session()->put('cart', $cart);
            Session::flash('success', 'Your product has been added to the cart.');
            return redirect()->back();
        }
    }

    public function viewcart()
    {
        return view('frontend.page.cart');
    }
}
