<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ADmin\Attribute;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {


            $attribute = Attribute::query();

            return DataTables::of($attribute)
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



        return view('admin.pages.attributes.index');
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
        if ($request->attribute_id) {
            $attribute = Attribute::find($request->attribute_id);

            if (!$attribute) {
                abort(404);
            } else {
                $attribute->update([
                    'name' => $request->name,
                ]);
                return response()->json(['success' => 'Attribute update success']);
            }
        } else {
            $this->validate($request, [
                'name' => 'required',
            ]);
            $attribute = new Attribute();
            $attribute->create([
                'name' => $request->name,
            ]);

            return response()->json(['success' => 'Attribute create success']);
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
        $attribute = Attribute::find($id);
        if (!$attribute) {
            abort(404);
        }
        return $attribute;
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
        $attribute = Attribute::destroy($id);

        if (!$attribute) {
            abort(404);
        }

        return response()->json(['success' => 'Attribute deleted successfully']);
    }
}
