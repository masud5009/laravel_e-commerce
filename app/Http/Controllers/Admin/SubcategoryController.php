<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subcategories = Subcategory::with('category')->get();
            return DataTables::of($subcategories)
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
        return view('admin.pages.subcategory.index', compact('category'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->subcategory_id) {
            $subcategory = Subcategory::find($request->subcategory_id);

            if (!$subcategory) {
                abort(404);
            } else {
                $this->validate($request, [
                    'name' => 'required|unique:subcategories',
                    'category_name' => 'required'
                ]);

                $subcategory->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '_'),
                    'category_id' => $request->category_name,
                    'description' => $request->description
                ]);
                return response()->json(['success' => 'Subcategory update success']);
            }
        } else {

            $this->validate($request, [
                'name' => 'required',
                'description' => 'nullable',
                'category_name' => 'required'
            ]);
            $subcategory = new Subcategory();
            $subcategory->name = $request->name;
            $subcategory->slug = Str::slug($request->name, '_');
            $subcategory->description = $request->description;
            $subcategory->category_id = $request->category_name;
            $subcategory->save();

            return response()->json(['success' => 'Subategory create success']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory =  Subcategory::find($id);
        return response()->json($subcategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::destroy($id);

        if (!$subcategory) {
            abort(404);
        }

        return response()->json(['success' => 'Subcategory deleted successfully']);
    }
}
