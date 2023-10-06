<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display Categroy wise product
     */
    public function categoryProduct($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $categoryProduct = Product::where('active_status', 1)
                ->where('category_id', $category->id)
                ->paginate(12);
            return view('frontend.page.shop', compact('categoryProduct'));
        }
    }
}
