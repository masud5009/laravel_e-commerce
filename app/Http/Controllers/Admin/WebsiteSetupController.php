<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteSetupController extends Controller
{
    /**
     * Display Hader page
     */
    public function header()
    {
        return view('admin.pages.website_setup.header.index');
    }
    /**
     * Display footer page
     */
    public function footer()
    {
    }
}
