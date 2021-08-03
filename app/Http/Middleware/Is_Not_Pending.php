<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Usulan_pengabdian;

class Is_Not_Pending
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
        $pengabdian_id = $request->route('id');

        $is_diterima = Usulan_pengabdian::where('usulan_pengabdian_id', $pengabdian_id)->first();

        if ($is_diterima) {
            if ($is_diterima->usulan_pengabdian_status != 'pending') {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Gagal', //Alert Message 
                    'Usulan Pengabdian Sudah Dikirim' //Sub Alert Message
                );

                return redirect()->route('pengusul_pengabdian');
            } else {
                return $next($request);
            }
        } else {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Usulan Pengabdian Salah' //Sub Alert Message
            );

            return redirect()->route('pengusul_pengabdian');
        }
    }
}
