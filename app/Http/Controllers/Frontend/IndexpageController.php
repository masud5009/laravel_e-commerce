<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Admin\Review;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;

class IndexpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesWithImage = Category::select('slug', 'name', 'cover_img')
            ->take(6)
            ->get();

        $trendyProducts = Product::where('active_status', 1)
            ->select('id', 'slug', 'thumbnail', 'name', 'unit_price', 'discount_price')
            ->where('trandy', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $justProducts = Product::where('active_status', 1)
            ->select('id', 'slug', 'thumbnail', 'name', 'unit_price', 'discount_price')
            ->orderBy('created_at', 'desc')
            ->inRandomOrder()
            ->paginate(12);

        $todaysDealProducts = Product::where('active_status', 1)
            ->where('todays_deal', 1)
            ->select('id', 'slug', 'thumbnail', 'name', 'unit_price', 'discount_price')
            ->take(5)
            ->get();

        return view('frontend.index', compact('categoriesWithImage', 'trendyProducts', 'justProducts', 'todaysDealProducts'));
    }

    /**
     * Product Details page
     */
    public function details($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $randomProducts = Product::where('active_status', 1)
            ->select('id', 'slug', 'thumbnail', 'name', 'unit_price', 'discount_price')
            ->orderBy('created_at', 'desc')
            ->get();
        $reviews = Review::all();
        return view('frontend.page.product_detail_page', compact('product', 'randomProducts', 'reviews'));
    }

    /**
     * Dispaly product by search
     */
    public function productSearch(Request $request)
    {
        $product = $request->input('product');

        if ($product) {
            $products = Product::where('active_status', 1)
                ->where('name', 'LIKE', '%' . $product . '%')
                ->orWhere('slug', 'LIKE', '%' . $product . '%')
                ->get();
        }


        return view('frontend.page.seach_product', compact('products'));
    }
}
