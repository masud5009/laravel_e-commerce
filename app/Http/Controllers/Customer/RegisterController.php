<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Registration page Dispaly
     */
    public function register()
    {
        if (!auth()->check()) {
            return view('frontend.page.login-register.register');
        } else {
            return redirect()->route('customer.profile');
        }
    }
}
