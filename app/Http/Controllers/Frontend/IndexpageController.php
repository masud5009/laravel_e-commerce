<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Product;
use App\Models\Admin\Review;
use Illuminate\Http\Request;

class IndexpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesWithImage = Category::take(6)->get();
        $trendyProducts = Product::where('active_status', 1)
            ->where('trandy', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        $justProducts = Product::where('active_status', 1)
            ->orderBy('created_at', 'desc')
            ->inRandomOrder()
            ->paginate(12);
        $generalSetting = GeneralSetting::find(1);
        $todaysDealProducts = Product::where('todays_deal', 1)->take(5)->get();
        return view('frontend.index', compact('categoriesWithImage', 'trendyProducts', 'generalSetting', 'justProducts', 'todaysDealProducts'));
    }

    /**
     * Product Details page
     */
    public function details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $randomProducts = Product::all();
        $reviews = Review::all();
        return view('frontend.page.product_detail_page', compact('product', 'randomProducts', 'reviews'));
    }

    /**
     * Dispaly product by search
     */
    public function productSearch(Request $request)
    {
        $product = $request->input('product');

        $products = Product::where('active_status', 1)
            ->where('name', 'LIKE', '%' . $product . '%')
            ->orWhere('slug', 'LIKE', '%' . $product . '%')
            ->get();


        return view('frontend.page.seach_product', compact('products'));
    }
}
