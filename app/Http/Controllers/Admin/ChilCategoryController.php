<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\ChildCategory;
use App\Models\Admin\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class ChilCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $childcategories = ChildCategory::with('category', 'subcategory')->get(); // category & subcategory is foreignKey
            return DataTables::of($childcategories)
                ->addColumn('action', function ($row) {
                    return '<a href="javascript:void()" class="btn-sm btn btn-primary editBtn" data-id="' . $row->id . '">
                            <i class="bx bx-edit"></i>
                        </a>
                        <a href="javascript:void()" class="btn-sm btn btn-danger deletBtn" data-id="' . $row->id . '">
                            <i class="bx bx-trash"></i>
                        </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $category = Category::all();
        $subcategory = Subcategory::all();
        return view('admin.pages.childcategory.index', compact('category', 'subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->childcategory_id) {
            $childcategory = ChildCategory::find($request->childcategory_id);

            if (!$childcategory) {
                abort(404);
            } else {

                $childcategory->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '_'),
                    'category_id' => $request->category_name,
                    'subcategory_id' => $request->subcategory_name,
                    'description' => $request->description
                ]);
                return response()->json(['success' => 'Child Category update success']);
            }
        } else {

            $this->validate($request, [
                'name' => 'required',
                'description' => 'nullable',
                'category_name' => 'required'
            ]);
            $childcategory = new ChildCategory();
            $childcategory->name = $request->name;
            $childcategory->slug = Str::slug($request->name, '_');
            $childcategory->description = $request->description;
            $childcategory->category_id = $request->category_name;
            $childcategory->subcategory_id = $request->subcategory_name;
            $childcategory->save();

            return response()->json(['success' => 'Child Category create success']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $childcategory =  ChildCategory::find($id);
        return response()->json($childcategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childcategory = ChildCategory::destroy($id);

        if (!$childcategory) {
            abort(404);
        }

        return response()->json(['success' => 'Child Category deleted successfully']);
    }
}
