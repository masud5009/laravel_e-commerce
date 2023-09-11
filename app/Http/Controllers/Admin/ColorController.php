<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $color = Color::query();

            return DataTables::of($color)
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



        return view('admin.pages.colors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->color_id) {
            $color = Color::find($request->color_id);

            if (!$color) {
                abort(404);
            } else {
                $color->update([
                    'name' => $request->name,
                    'color_code' => $request->code
                ]);
                return response()->json(['success' => 'Color update success']);
            }
        } else {
            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
            ]);
            $color = new Color();
            $color->create([
                'name' => $request->name,
                'color_code' => $request->code
            ]);

            return response()->json(['success' => 'Color create success']);
        }
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
        $color = Color::find($id);
        if (!$color) {
            abort(404);
        }
        return $color;
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
        $color = Color::destroy($id);

        if (!$color) {
            abort(404);
        }

        return response()->json(['success' => 'Color deleted successfully']);
    }
}
