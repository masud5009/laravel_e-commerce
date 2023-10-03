<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Color;
use App\Models\Admin\Attribute;
use App\Models\Admin\AttributeValue;
use App\Models\Admin\ChildCategory;
use App\Models\Admin\Product;
use App\Models\Admin\Subcategory;
use Exception;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

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
                    $editUrl = route('product.edit', ['product' => $row->id]);
                    return '<a href="javascript:void()" class="btn-sm btn btn-success viewBtn" data-id="' . $row->id . '">
                            <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="' . $editUrl . '" class="btn-sm btn btn-primary editBtn">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="javascript:void()" class="btn-sm btn btn-danger deletBtn" data-id="' . $row->id . '">
                                <i class="bx bx-trash"></i>
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
            // 'category' => 'required|exists:categories,id',
        ]);
        $product = Product::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'childcategory_id' => $request->childcategory,
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
            'flat_rate' => $request->flat_rate,
            'free_shipping_status' => $request->has('free_shipping_status') ? 1 : 0,
            'cash_on_delivery_status' => $request->has('cash_on_delivery_status') ? 1 : 0,
            'warning_quantity' => $request->has('warning_quantity') ? 1 : 0,
            'show_stock_quantity' => $request->has('show_stock_quantity') ? 1 : 0,
            'show_stock_text' => $request->has('show_stock_text') ? 1 : 0,
            'hide_stock' => $request->has('hide_stock') ? 1 : 0,
            'featured' => $request->has('featured') ? 1 : 0,
            'todays_deal' => $request->has('todays_deal') ? 1 : 0,
            'shipping_day' => $request->has('shipping_day') ? 1 : 0,
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

        session()->flash('success', 'Your Product Added successfull');
        return redirect()->back();
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
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        $colors = Color::select('name')->get();
        $attributes = Attribute::all();
        return view('admin.pages.product.edit', compact('product', 'brands', 'subcategories', 'colors', 'attributes'));
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
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $thumbnailPath = 'storage/images/product/thumbnail/' . $product->thumbnail;
        $imagesPath = 'storage/images/product/images/' . $product->images;

        if (File::exists($imagesPath)) {
            if (File::delete($imagesPath)) {
                // File deleted successfully
            } else {
                return response()->json(['error' => 'Failed to delete images file'], 500);
            }
        }

        if (File::exists($thumbnailPath)) {
            if (File::delete($thumbnailPath)) {
                // File deleted successfully
            } else {
                return response()->json(['error' => 'Failed to delete thumbnail file'], 500);
            }
        }

        $product->delete();

        return response()->json(['success' => 'Product deleted successfully']);
    }

    public function getSelectedSubcategory($id)
    {
        $subcategories = Subcategory::where('category_id', $id)->get();
        return json_encode($subcategories);
    }
    public function getSelectedChildcategory($id)
    {
        $childcategories = ChildCategory::where('subcategory_id', $id)->get();
        return json_encode($childcategories);
    }
}
