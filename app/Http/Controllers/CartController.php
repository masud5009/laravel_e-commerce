<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    /**
     * Store product on cart page using session
     */
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
                    'image' => $req->image,
                ];
                session()->put('cart', $cart);
                session()->flash('success', 'Product added your cart');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'At first login your account');
            return redirect()->back();
        }
    }
    /**
     * Remove product on cart page using session
     */
    public function removeCartItem($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            session()->flash('success', 'Product removed from your cart');
        }

        return redirect()->back();
    }
    /**
     * Display Cart page
     */
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
