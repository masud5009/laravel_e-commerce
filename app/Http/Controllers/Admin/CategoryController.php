<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $categories = Category::query();

            return DataTables::of($categories)
                ->addColumn('action', function ($row) {
                    return '<a href="javascript:void(0)" class="btn-sm btn btn-primary editBtn" data-id="' . $row->id . '">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-danger deletBtn" data-id="' . $row->id . '">
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
        $this->validate($request, [
            'name' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->category_id) {
            $category = Category::find($request->category_id);

            if (!$category) {
                abort(404);
            } else {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name, '_'),
                    'description' => $request->description,
                ]);
                if ($request->hasFile('banner')) {
                    $banner_file = $request->file('banner');
                    $filename = time() . '.' . $banner_file->getClientOriginalExtension();
                    $banner_file->move('storage/images/category_img', $filename);
                    $category->banner = $filename;
                }
                if ($request->hasFile('icon')) {
                    $icon_file = $request->file('icon');
                    $filename = time() . '.' . $icon_file->getClientOriginalExtension();
                    $icon_file->move('storage/images/category_img', $filename);
                    $category->icon = $filename;
                }
                if ($request->hasFile('cover_img')) {
                    $coverImg_file = $request->file('cover_img');
                    $filename = time() . '.' . $coverImg_file->getClientOriginalExtension();
                    $coverImg_file->move('storage/images/category_img', $filename);
                    $category->cover_img = $filename;
                }
                $category->save();

                return response()->json(['success' => 'Category update success']);
            }
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = Str::slug($request->name, '_');
            $category->description = $request->description;

            if ($request->hasFile('banner')) {
                $banner_file = $request->file('banner');
                $banner_filename = time() . '_' . uniqid() . '.' . $banner_file->getClientOriginalExtension();
                $banner_file->move('storage/images/category_img', $banner_filename);
                $category->banner = $banner_filename;
            }
            if ($request->hasFile('icon')) {
                $icon_file = $request->file('icon');
                $icon_filename = time() . '_' . uniqid() . '.' . $icon_file->getClientOriginalExtension();
                $icon_file->move('storage/images/category_img', $icon_filename);
                $category->icon = $icon_filename;
            }
            if ($request->hasFile('cover_img')) {
                $coverImg_file = $request->file('cover_img');
                $coverImg_filename = time() . '_' . uniqid() . '.' . $coverImg_file->getClientOriginalExtension();
                $coverImg_file->move('storage/images/category_img', $coverImg_filename);
                $category->cover_img = $coverImg_filename;
            }

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
