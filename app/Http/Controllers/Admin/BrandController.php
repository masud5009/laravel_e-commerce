<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $brand = Brand::all();

            return DataTables::of($brand)
                ->addColumn('action', function ($row) {
                    return '<a href="javascript::void()" class="btn-sm btn btn-primary editBtn" data-id="' . $row->id . '">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="javascript::void()" class="btn-sm btn btn-danger deletBtn" data-id="' . $row->id . '">
                                <i class="bx bx-trash"></i>
                            </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.brand.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->brand_id) {
            $brand = Brand::find($request->brand_id);

            if (!$brand) {
                abort(404);
            } else {
                $brand->name = $request->name;
                $brand->slug = Str::slug($request->name, '_');
                $brand->description = $request->description;

                $image_path = public_path('storage/brand/' . $brand->logo);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $filname = time() . '.' . $file->getClientOriginalExtension();
                    $file->move('storage/brand', $filname);
                    $brand->logo = $filname;
                }
                $brand->save();
                return response()->json(['success' => 'Brand update success']);
            }
        } else {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'nullable',
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name, '_');
            $brand->description = $request->description;

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filname = time() . '.' . $file->getClientOriginalExtension();
                $file->move('storage/Brand', $filname);
                $brand->logo = $filname;
            }

            $brand->save();

            return response()->json(['success' => 'Brand create success']);
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            abort(404);
        }
        return $brand;
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
        $brand = Brand::destroy($id);

        if (!$brand) {
            abort(404);
        }

        return response()->json(['success' => 'Brand deleted successfully']);
    }
}
