<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $brand = Page::query();

            return DataTables::of($brand)
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('page.edit', [$row->id]) . '" class="btn-sm btn btn-primary">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="'. route('page.destroy',[$row->id]).'" class="btn-sm btn btn-danger">
                                <i class="bx bx-trash"></i>
                            </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.pages.settings.page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.settings.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pages = new Page();
        $pages->create([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'slug' => Str::slug($request->page_name,'_'),
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
        ]);

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
        $page = Page::find($id);
        return view('admin.pages.settings.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pages = Page::find($id);
        $pages->update([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'slug' => Str::slug($request->page_name,'_'),
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::find($id);
        if(!$page){
            abort(404);
        }else{
            $page->delete();
        }
    }
}
