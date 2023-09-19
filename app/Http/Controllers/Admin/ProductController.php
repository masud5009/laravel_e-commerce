<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Attribute;
use App\Models\Admin\AttributeValue;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $brands = Brand::all();
        $colors = Color::select('name')->get();
        $attributes = Attribute::all();
        return view('admin.pages.product.create', compact('category', 'brands', 'colors', 'attributes'));
    }
    /**
     *  GET Attribute value form product  controller
     */

    public function getAttributeValue($attributeValueId)
    {
        $attributeValues = AttributeValue::where('attribute_id', $attributeValueId)->get();

        if ($attributeValues->count() > 0) {
            $valuesArray = $attributeValues->pluck('value')->toArray();
            return response()->json($valuesArray);
        }

        return response()->json('Attribute value not found.', 404);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
