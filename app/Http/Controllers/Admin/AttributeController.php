<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.pages.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store & Update a resource in storage.
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
                return redirect()->back();
            }
        } else {

            $this->validate($request, [
                'name' => 'required|string'
            ]);
            $attribute = new Attribute();
            $attribute->create([
                'name' => $request->name
            ]);
            return redirect()->back();
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
        } else {
            return view('admin.pages.attributes.edit', compact('attribute'));
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
        $attribute = Attribute::destroy($id);

        if (!$attribute) {
            abort(404);
        }

        return response()->json(['success' => 'Attribute deleted successfully']);
    }
}
