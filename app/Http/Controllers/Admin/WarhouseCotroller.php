<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Warhouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WarhouseCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $warehouse = Warhouse::query();

            return DataTables::of($warehouse)
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
        return view('admin.pages.warehouse.index');
    }
    /**
     * (Store/Update) a (newly/old) created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->warehouse_id) {

            $warehouse = Warhouse::find($request->warehouse_id);

            if (!$warehouse) {
                abort(404);
            } else {
                $warehouse->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone
                ]);
                return response()->json(['success' => 'Warehouse update success']);
            }
        } else {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'nullable',
            ]);
            $warehouse = new Warhouse();
            $warehouse->create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            return response()->json(['success' => 'Warehouse create success']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warehouse = Warhouse::find($id);
        if (!$warehouse) {
            abort(404);
        } else {
            return response()->json($warehouse);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destory(string $id)
    {
        $warehouse = Warhouse::find($id);

        if (!$warehouse) {
            abort(404);
        }else{
            $warehouse->delete();
        }

        return response()->json(['success' => 'Warehouse deleted successfully']);
    }
}
