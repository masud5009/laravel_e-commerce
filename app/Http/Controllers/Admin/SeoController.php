<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Seo;
use Illuminate\Http\Request;
use Alert;

class SeoController extends Controller
{
    public function index()
    {
        $seo = Seo::find(1);
        return view('admin.pages.settings.seo.index', compact('seo'));
    }

    public function update(Request $request)
    {
        $seo = Seo::find(1);
        if ($seo) {
            $seo->update([
                'seo_title' => $request->seo_title,
                'meta_author' => $request->meta_author,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'canonical_url' => $request->canonical_url,
                'google_verification' => $request->google_verification,
                'google_analytics' => $request->google_analytics,
                'alexa_verification' => $request->alexa_verification,
            ]);
            return redirect()->back();
        } else {
            $seo = new Seo();
            $seo->create([
                'seo_title' => $request->seo_title,
                'meta_author' => $request->meta_author,
                'meta_description' => $request->meta_description,
                'meta_keywords' => $request->meta_keywords,
                'canonical_url' => $request->canonical_url,
                'google_verification' => $request->google_verification,
                'google_analytics' => $request->google_analytics,
                'alexa_verification' => $request->alexa_verification,
            ]);

            return redirect()->back();
        }
    }
}
