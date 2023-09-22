<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class IndexpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.index',compact('categories','products'));
     }
}
