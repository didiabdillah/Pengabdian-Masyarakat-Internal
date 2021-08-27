<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use Closure;

class Is_Not_Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('user_id') && Session::get('user_email') && Session::get('user_role')) {
            if (Session::get('user_role') == "admin") {
                //Goto Admin Home
                return redirect()->route('admin_home');
            } else if (Session::get('user_role') == "reviewer_pengabdian") {
                //Goto Reviewer Home
                return redirect()->route('reviewer_home');
            } else if (Session::get('user_role') == "pengusul") {
                //Goto Pengusul Home
                return redirect()->route('pengusul_home');
            }
        } else {
            return $next($request);
        }
    }
}
