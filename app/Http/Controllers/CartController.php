<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Cart;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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

            $unit_price = $product->unit_price;
            $discount_value = number_format($product->discount_price);
            $discountPrecente = $unit_price * ($discount_value / 100);
            $price_real = $unit_price - $discountPrecente;
            $price = round($price_real, 0, PHP_ROUND_HALF_DOWN);


            $cart = session()->get('cart', []);


            if (isset($cart[$req->id])) {
                $cart[$req->id]['qty']++;
                session(['cart' => $cart]);
                session()->flash('success', 'Product added your cart');
                return redirect()->route('view.cart');
            } else {
                $cart[$req->id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'qty' => $req->quantity,
                    'price' => $price,
                    'unit_price' => $unit_price,
                    'discount' => $discount_value,
                    'image' => $product->thumbnail,
                ];
                session(['cart' => $cart]);
                session(['cart_expires_at' => now()->addSeconds(1)]);
                session()->flash('success', 'Product added your cart');
                return redirect()->route('view.cart');
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
        $cart = session('cart');
        return view('frontend.page.cart', compact('cart'));
    }

    public function cartInfo($id)
    {
        $product = Product::where('id', $id)->first();
        return view('frontend.page.product.quickview', compact('product'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $newQuantity = $request->quantity;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = $newQuantity;
            session(['cart' => $cart]);
            return response()->json('Quantity updated successfully');
        } else {
            return response()->json('Product not found in cart', 404);
        }
    }
}
