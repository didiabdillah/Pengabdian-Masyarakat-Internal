<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usulan_pengabdian;

class Is_Diterima
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
        $pengabdian_id = $request->route('pengabdian_id');

        $is_diterima = Usulan_pengabdian::where('usulan_pengabdian_id', $pengabdian_id)->first()->usulan_pengabdian_status;

        if ($is_diterima == 'selesai') {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Pengabdian Sudah Selesai' //Sub Alert Message
            );

            return redirect()->back();
        } elseif ($is_diterima == 'diterima' || $is_diterima == 'dimonev') {
            return $next($request);
        } else {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Usulan Belum Diterima' //Sub Alert Message
            );

            return redirect()->back();
        }
    }
}
