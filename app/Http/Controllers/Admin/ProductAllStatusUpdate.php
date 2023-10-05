<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class ProductAllStatusUpdate extends Controller
{
    /**
     * Product Active Status
     */
    public function productAactive($id)
    {
        Product::where('id', $id)->update(['active_status' => 1]);
        return response()->json('Product is Active');
    }
    /**
     * Product Dactive Status
     */
    public function productDeactive($id)
    {
        Product::where('id', $id)->update(['active_status' => 0]);
        return response()->json('Product is Dactive');
    }
    /**
     * Featured Product Active Status
     */
    public function featuredActive($id)
    {
        Product::where('id', $id)->update(['featured' => 1]);
        return response()->json('Feature Product is Active');
    }
    /**
     * Featured Product Active Status
     */
    public function featuredDactive($id)
    {
        Product::where('id', $id)->update(['featured' => 0]);
        return response()->json('Feature Product is Dactive');
    }

    /**
     * Todays_Deal Product Active Status
     */
    public function todaysDealActive($id)
    {
        Product::where('id', $id)->update(['todays_deal' => 1]);
        return response()->json('Todays Deal Product Aactive');
    }
    /**
     * Todays_Deal Product Active Status
     */
    public function todaysDealDctive($id)
    {
        Product::where('id', $id)->update(['todays_deal' => 0]);
        return response()->json('Todays Deal Product Dactive');
    }

    /**
     * Trandy Product Active Status
     */
    public function trandyActive($id)
    {
        Product::where('id', $id)->update(['trandy' => 1]);
        return response()->json('Trandy Product Active');
    }
    /**
     * Trandy Product Active Status
     */
    public function trandyDctive($id)
    {
        Product::where('id', $id)->update(['trandy' => 0]);
        return response()->json('Trandy Product Dactive');
    }
}
