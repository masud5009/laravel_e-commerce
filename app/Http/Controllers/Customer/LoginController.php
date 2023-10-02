<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login page Dispaly
     */
    public function login()
    {
        if (!auth()->check()) {
            return view('frontend.page.login-register.login');
        } else {
            return redirect()->route('customer.profile');
        }
    }
    /**
     * Customer profile display
     */
    public function customerProfile()
    {
        return view('frontend.page.customer.profile');
    }
}
