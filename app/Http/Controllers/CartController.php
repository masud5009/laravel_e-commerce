<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function addCartQuickView(Request $req)
    {
        if (Auth::check()) {
            $product = Product::find($req->id);
            $cart = session()->get('cart', []);


            if (isset($cart[$req->id])) {
                $cart[$req->id]['qty']++;
            } else {
                $cart[$req->id] = [
                    'id' => $req->id,
                    'name' => $product->name,
                    'qty' => $req->quantity,
                    'price' => $req->price,
                    'shipping_charge' => 50,
                ];
                session()->put('cart', $cart);
                return response()->json('success', 'Product add your cart');
            }
        } else {
            session()->flash('error', 'At first login your account');
            return redirect()->back();
        }
    }

    // public function

    public function viewcart()
    {
        return view('frontend.page.cart');
    }

    public function cartInfo($id)
    {
        $product = Product::where('id', $id)->first();
        return view('frontend.page.product.quickview', compact('product'));
    }
}
