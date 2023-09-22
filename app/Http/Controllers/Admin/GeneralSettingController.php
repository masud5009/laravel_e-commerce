<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $generalSetting = GeneralSetting::find(1);
        return view('admin.pages.settings.general.index', compact('generalSetting'));
    }

    /**
     * Store data from request
     */
    public function store(Request $request)
    {
        $generalSetting = GeneralSetting::find(1);

        if ($generalSetting) {

            $generalSetting->update([
                'site_name' => $request->name,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('storage/images/generalSetting', $fileName);
                $generalSetting->site_logo = 'storage/images/generalSetting/' . $fileName;
            }
            $generalSetting->save();
        } else {

            $generalSetting = GeneralSetting::create([
                'site_name' => $request->name,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'linkedin' => $request->linkedin,
            ]);

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('storage/images/generalSetting', $fileName);
                $generalSetting->site_logo = 'storage/images/generalSetting/' . $fileName;
            }
            $generalSetting->save();
        }

        return redirect()->back();
    }
}
