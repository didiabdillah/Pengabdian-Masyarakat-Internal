<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;

use Closure;

class Is_Login
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
        if (Session::get('id') && Session::get('role') && Session::get('email') && Session::get('nama')) {
            $user = User::where('id', Session::get('id'))
                ->where('email', Session::get('email'))
                ->where('role', Session::get('role'))
                ->where('nama', Session::get('nama'))
                ->count();

            if ($user > 0) {
                return $next($request);
            } else {
                return redirect()->route('logout');
            }
        } else {
            Session::flush();

            return redirect()->route('login');
        }
    }
}
