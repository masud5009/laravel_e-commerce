<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $coupon = Coupon::query();

            return DataTables::of($coupon)
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
        return view('admin.pages.coupon.index');
    }

    /**
     * Coupon status update
     */
    public function toggleStatus(Coupon $coupon)
    {
        $coupon->update([
            'status' => !$coupon->status // Toggle the status (0 to 1 or 1 to 0)
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->coupon_id) {
            $coupon = Coupon::find($request->coupon_id);
            if (!$coupon) {
                abort(404);
            } else {
                $this->validate($request, [
                    'code' => 'required|max:12',
                    'discount_amount' => 'required',
                    'date' => 'required',
                    'type' => 'required'
                ]);
                $coupon = $coupon->update([
                    'code' => $request->code,
                    'type' => $request->type,
                    'discount_amount' => $request->discount_amount,
                    'date' => $request->date,
                ]);
                return $coupon;
                return response()->json(['success' => 'Coupon update success']);
            }
        } else {
            $this->validate($request, [
                'code' => 'required|max:12|unique:coupons,code',
                'discount_amount' => 'required',
                'date' => 'required',
                'type' => 'required'
            ]);
            $coupon = new Coupon();
            $coupon->create([
                'code' => $request->code,
                'type' => $request->type,
                'discount_amount' => $request->discount_amount,
                'date' => $request->date,
            ]);
            return response()->json(['success' => 'Coupon create success']);
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
        $coupon = Coupon::find($id);
        if (!$coupon) {
            abort(404);
        } else {
            return response()->json($coupon);
        }
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
        $coupon = Coupon::find($id);

        if (!$coupon) {
            abort(404);
        } else {
            $coupon->delete();
        }

        return response()->json(['success' => 'Coupon deleted successfully']);
    }
}
