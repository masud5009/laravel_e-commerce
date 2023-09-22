<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Attribute;
use App\Models\Admin\AttributeValue;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {


            $products = Product::query();

            return DataTables::of($products)
                ->addColumn('action', function ($row) {
                    return '<a href="javascript::void()" class="btn-sm btn btn-primary editBtn" data-id="' . $row->id . '">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="javascript::void()" class="btn-sm btn btn-danger deletBtn" data-id="' . $row->id . '">
                                <i class="bx bx-trash"></i>
                            </a>
                            <a href="javascript::void()" class="btn-sm btn btn-success deletBtn" data-id="' . $row->id . '">
                                <i class="bx bx-eye"></i>
                            </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:products',
            'category' => 'required|exists:categories,id',
        ]);
        //  dd($request->cash_on_delivery_status);
        $product = Product::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name, '_'),
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand' => $request->brand,
            'sku' => $request->sku,
            'weight' => $request->weight,
            'barcode' => $request->barcode,
            'unit' => $request->unit,
            'tags' => json_encode($request->tags),
            'unit_price' => $request->unit_price,
            'discount_date' => $request->discount_date,
            'discount_price' => $request->discount_price,
            'quantity' => $request->quantity,
            'color' => json_encode($request->color),
            'attattribute_valuesributes' => json_encode($request->attribute_values),
            'description' => $request->description,
            'free_shipping_status' => $request->free_shipping_status,
            'flat_rate' => $request->flat_rate,
            'cash_on_delivery_status' => $request->cash_on_delivery_status,
            'warning_quantity' => $request->warning_quantity,
            'show_stock_quantity' => $request->show_stock_quantity,
            'show_stock_text' => $request->show_stock_text,
            'hide_stock' => $request->hide_stock,
            'featured' => $request->featured,
            'todays_deal' => $request->todays_deal,
            'shipping_day' => $request->shipping_day,
        ]);
        // Thumbnail image
        if ($request->hasFile('thumbnail')) {
            $thumbnail_file = $request->file('thumbnail');
            $thumbnail_filename = time() . '_' . uniqid() . '.' . $thumbnail_file->getClientOriginalExtension();
            $thumbnail_file->move('storage/images/product/thumbnail', $thumbnail_filename);
            $product->thumbnail = 'storage/images/product/thumbnail/' . $thumbnail_filename;
        }

        // Multiple product images
        $imagesArray = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $productImagesExtension = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('storage/images/product/images', $productImagesExtension);
                $imagesArray[] = 'storage/images/product/images/' . $productImagesExtension;
            }
        }

        $imagesJson = json_encode($imagesArray);
        $product->images = $imagesJson;

        $product->save();


        return response()->json(['success', 'Product Added successfull']);
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
        $product = Product::find($id);
        return view('admin.pages.product.edit', compact('product'));
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
