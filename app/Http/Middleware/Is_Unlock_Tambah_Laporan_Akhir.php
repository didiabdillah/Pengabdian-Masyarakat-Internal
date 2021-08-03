<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usulan_pengabdian;

class Is_Unlock_Tambah_Laporan_Akhir
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
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_laporan_akhir_pengabdian'));
        $unlock_pass = Usulan_pengabdian::where('usulan_pengabdian_id',  $request->route('pengabdian_id'))->first();

        if ($unlock_pass->usulan_pengabdian_unlock_pass) {
            if (strtotime(date('Y-m-d H:i:s')) <= $unlock_pass->usulan_pengabdian_unlock_pass) {
                return $next($request);
            }
        }

        if ($tambah_unlock) {
            if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
                return $next($request);
            } else {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Akses Ditutup', //Alert Message 
                    'Akses Belum Dibuka' //Sub Alert Message
                );

                return redirect()->route('pengusul_laporan_akhir');
            }
        }
    }
}
