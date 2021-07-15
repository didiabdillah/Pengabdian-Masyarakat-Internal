<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\DB;

class Is_Unlock_Nilai_Usulan
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
        $tambah_unlock = DB::table('unlock_feature')->where('unlock_feature_name', __('unlock.nilai_usulan_pengabdian'))->first();
        if ($tambah_unlock) {
            if (strtotime($tambah_unlock->unlock_feature_start_time) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock->unlock_feature_end_time)) {
                return $next($request);
            } else {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Akses Ditutup', //Alert Message 
                    'Akses Belum Dibuka' //Sub Alert Message
                );

                return redirect()->route('reviewer_pengabdian');
            }
        }
    }
}
