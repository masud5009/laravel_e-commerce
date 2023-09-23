<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class IndexpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
        $categories = Category::limit(3)->get();
        $products = Product::all();
        $generalSetting = GeneralSetting::find(1);
        return view('frontend.index',compact('categories','products','generalSetting'));
     }
}
