<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $req)
    {
        if (Auth::check()) {
            Review::create([
                'user_id' => Auth::id(),
                'product_id' => $req->product_id,
                'rating' => $req->rating,
                'review' => $req->review,
                'review_date' => date('d-M-Y'),
                'review_month' => date('F'),
                'review_year' => date('Y')
            ]);
            session()->flash('success', 'Thanks for review');
            return redirect()->back();
        }else{
            session()->flash('error', 'At first login your account');
            return redirect()->back();
        }

    }
}
