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
        $categories = Category::orderBy('created_at', 'DESC')->paginate(3);
        return view('admin.pages.category.index', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'banner' => 'nullable|image|mimes:jpeg,png,webp,jpg,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,,webp,jpg,gif|max:2048',
            'cover_img' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:2048',
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
                $currentBannerPath = 'storage/images/category_img/' . $category->banner;
                $currentIconPath = 'storage/images/category_img/' . $category->icon;
                $currentCoverImgPath = 'storage/images/category_img/' . $category->cover_img;

                $category->name = $request->name;
                $category->slug = Str::slug($request->name, '_');
                $category->description = $request->description;

                if ($request->hasFile('banner')) {
                    // Delete the current banner image file
                    if (file_exists($currentBannerPath)) {
                        unlink($currentBannerPath);
                    }

                    $banner_file = $request->file('banner');
                    $banner_filename = time() . '_' . uniqid() . '.' . $banner_file->getClientOriginalExtension();
                    $banner_file->move('storage/images/category_img', $banner_filename);
                    $category->banner = $banner_filename;
                }

                if ($request->hasFile('icon')) {
                    // Delete the current icon image file
                    if (file_exists($currentIconPath)) {
                        unlink($currentIconPath);
                    }

                    $icon_file = $request->file('icon');
                    $icon_filename = time() . '_' . uniqid() . '.' . $icon_file->getClientOriginalExtension();
                    $icon_file->move('storage/images/category_img', $icon_filename);
                    $category->icon = $icon_filename;
                }

                if ($request->hasFile('cover_img')) {
                    // Delete the current cover image file
                    if (file_exists($currentCoverImgPath)) {
                        unlink($currentCoverImgPath);
                    }

                    $coverImg_file = $request->file('cover_img');
                    $coverImg_filename = time() . '_' . uniqid() . '.' . $coverImg_file->getClientOriginalExtension();
                    $coverImg_file->move('storage/images/category_img', $coverImg_filename);
                    $category->cover_img = $coverImg_filename;
                }
                $category->update();

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

    /**
     * Display the pagination data
     */
    public function pagination(Request $request)
    {
        $categories = Category::latest()->paginate(3);
        return view('admin.pages.category.data', compact('categories'))->render();
    }
    /**
     * Display the Search data
     */
    public function search(Request $req)
    {
        $categories = Category::where('name', 'like', '%'.$req->Searchdata.'%')
            ->orderBy('id', 'desc')
            ->paginate(3);

        if ($categories->count() >= 1) {
            return view('admin.pages.category.data', compact('categories'))->render();
        }else{
            return response()->json([
                'status' => 'nothing found !'
            ]);
        }
    }
}
