<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->role == 1){
                return $next($request);
            }else{
                session()->flash('success', 'You are logged in');
                return redirect()->route('customer.profile');
            }
        }else{
            session()->flash('error', 'At first login your account');
            return redirect()->route('customer.account.login');
        }
    }
}
