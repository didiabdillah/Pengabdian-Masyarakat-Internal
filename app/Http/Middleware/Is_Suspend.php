<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Usulan_pengabdian;

use Closure;

class Is_Suspend
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
        $unlock_pass = Usulan_pengabdian::where('usulan_pengabdian_id',  $request->route('pengabdian_id'))->first();

        if ($unlock_pass) {
            if (strtotime(date('Y-m-d H:i:s')) <= $unlock_pass->usulan_pengabdian_unlock_pass) {
                return $next($request);
            }
        }

        if (Session::get('user_id')) {
            $user = User::where('user_id', Session::get('user_id'))
                ->first();
            // $unlock_pass = Usulan_pengabdian::where
            if ($user->user_pengabdian_ban == false) {
                return $next($request);
            } else {
                return redirect()->route('suspend');
            }
        } else {
            return redirect()->route('logout');
        }
    }
}
