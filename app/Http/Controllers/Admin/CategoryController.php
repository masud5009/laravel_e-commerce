<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $categories = Category::all();

            return DataTables::of($categories)
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



        return view('admin.pages.category.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->category_id) {
            $category = Category::find($request->category_id);

            if (!$category) {
                abort(404);
            } else {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '_'),
                    'description' => $request->description
                ]);
                return response()->json(['success' => 'Category update success']);
            }
        } else {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'nullable',
            ]);
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name, '_');
            $category->description = $request->description;
            $category->save();

            return response()->json(['success' => 'Category create success']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            abort(404);
        }
        return $category;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::destroy($id);

        if (!$category) {
            abort(404);
        }

        return response()->json(['success' => 'Category deleted successfully']);
    }
}
