<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function checkout()
    {
        $cart = session('cart');
        // $cartTotal = $this->calculateCartTotal($cart);
        // session()->forget('cart');

        return view('frontend.page.checkout', compact('cart'));
    }
      private function calculateCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $id => $item) {
            $total += $item['quantity'] * $item['product']->price;
        }

        return $total;
    }
}
