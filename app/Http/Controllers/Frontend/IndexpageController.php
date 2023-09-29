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
        $categoriesWithImage = Category::limit(3)->get();
        $products = Product::paginate(12);
        $generalSetting = GeneralSetting::find(1);
        return view('frontend.index',compact('categoriesWithImage','products','generalSetting'));
     }

     /**
      * Product Details page
      */
      public function details($slug)
      {
        $product = Product::where('slug',$slug)->first();
        $randomProducts = Product::all();
        return view('frontend.page.product_detail_page',compact('product','randomProducts'));
      }

      /**
       * Dispaly product on shop page
       */

       public function shop()
       {
        $products = Product::paginate(9);
        return view('frontend.page.shop',compact('products'));
       }
}
