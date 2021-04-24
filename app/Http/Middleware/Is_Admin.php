<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use App\Models\User;

use Closure;

class Is_Admin
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
        $role = User::where('id', Session::get('id'))->first()->role;
        if ($role == "admin") {
            return $next($request);
        } else {
            return redirect()->route('forbidden');
        }
    }
}
