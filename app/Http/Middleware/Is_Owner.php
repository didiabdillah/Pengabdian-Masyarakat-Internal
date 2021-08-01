<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Closure;
use App\Models\Anggota_pengabdian;

class Is_Owner
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

        $is_owner = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $pengabdian_id)
            ->where('anggota_pengabdian_user_id', Session::get('user_id'))
            ->where('anggota_pengabdian_role', 'ketua')
            ->count();

        if ($is_owner == 0) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal', //Alert Message 
                'Anda Bukan Ketua Usulan Ini' //Sub Alert Message
            );

            return redirect()->route('not_found');
        } else {
            return $next($request);
        }
    }
}
