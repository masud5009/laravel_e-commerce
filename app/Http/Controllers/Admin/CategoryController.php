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
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
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
                //unlink the old path of image and upate new image
                $uploadFields = ['banner', 'icon', 'cover_img'];
                $basePath = 'storage/images/category_img/';

                foreach ($uploadFields as $field) {
                    if ($request->hasFile($field)) {
                        $currentPath = $basePath . $category->$field;
                        if (file_exists($currentPath)) {
                            unlink($currentPath);
                        }

                        $file = $request->file($field);
                        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move($basePath, $filename);
                        $category->$field = $filename;
                    }
                }
                $category->update();
                return redirect()->back();
            }
        } else {
            $category = new Category();
            $category->name = $request->name;
            $category->slug =  Str::slug($request->name, '_');
            $category->description =  $request->description;

            $uploadFields = ['banner', 'icon', 'cover_img'];
            $basePath = 'storage/images/category_img/';

            foreach ($uploadFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($basePath, $filename);
                    $category->$field = $filename;
                }
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
        $category = Category::find($id);

        if ($category) {
            $uploadFields = ['banner', 'icon', 'cover_img'];
            $basePath = 'storage/images/category_img/';

            // Delete files associated with the category
            foreach ($uploadFields as $field) {
                $currentPath = $basePath . $category->$field;
                if(File::exists($currentPath)){
                    File::delete($currentPath);
                }
                $category->delete();
            }
        } else {
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
        $categories = Category::where('name', 'like', '%' . $req->Searchdata . '%')
            ->orderBy('id', 'desc')
            ->paginate(3);

        if ($categories->count() >= 1) {
            return view('admin.pages.category.data', compact('categories'))->render();
        } else {
            return response()->json([
                'status' => 'nothing found !'
            ]);
        }
    }
}
