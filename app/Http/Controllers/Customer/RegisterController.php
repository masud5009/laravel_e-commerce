<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Login page Dispaly
     */
    public function register()
    {
        return view('frontend.page.login-register.register');
    }
}
