<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('superAdmin');
    }

    /**
     * Admin dashboard page
     */
    public function admin(){
        return view('admin.index');
    }
}
