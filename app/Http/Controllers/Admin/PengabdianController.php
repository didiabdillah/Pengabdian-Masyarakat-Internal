<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Unlock_feature;

class PengabdianController extends Controller
{
    public function usulan_pengabdian()
    {
        return view('admin.pengabdian.usulan');
    }

    public function pelaksanaan_pengabdian()
    {
        $waktu = Unlock_feature::where('unlock_feature_name', __('unlock.tambah_usulan_pengabdian'))->first();

        $view_data = [
            'waktu' => $waktu,
        ];

        return view('admin.pengabdian.pelaksanaan', $view_data);
    }

    public function pelaksanaan_pengabdian_update(Request $request)
    {
        $waktu = explode(" - ", htmlspecialchars($request->waktu));

        $year_start = htmlspecialchars($request->tahun_mulai);
        $year_end = htmlspecialchars($request->tahun_selesai);

        $time_start = date('Y-m-d H:i:s', strtotime($waktu[0]));
        $time_end = date('Y-m-d H:i:s', strtotime($waktu[1]));

        $data = [
            'unlock_feature_start_year' => $year_start,
            'unlock_feature_end_year' => $year_end,
            'unlock_feature_start_time' => $time_start,
            'unlock_feature_end_time' => $time_end,
        ];

        Unlock_feature::where('unlock_feature_id', $request->id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Waktu Pelaksanaan Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_pengabdian_pelaksanaan');
    }

    public function pelaksanaan_penilaian()
    {
        $waktu = Unlock_feature::where('unlock_feature_name', __('unlock.nilai_usulan_pengabdian'))->first();

        $view_data = [
            'waktu' => $waktu,
        ];

        return view('admin.pengabdian.pelaksanaan_penilaian', $view_data);
    }

    public function pelaksanaan_penilaian_update(Request $request)
    {
        $waktu = explode(" - ", htmlspecialchars($request->waktu));

        $year_start = htmlspecialchars($request->tahun_mulai);
        $year_end = htmlspecialchars($request->tahun_selesai);

        $time_start = date('Y-m-d H:i:s', strtotime($waktu[0]));
        $time_end = date('Y-m-d H:i:s', strtotime($waktu[1]));

        $data = [
            'unlock_feature_start_year' => $year_start,
            'unlock_feature_end_year' => $year_end,
            'unlock_feature_start_time' => $time_start,
            'unlock_feature_end_time' => $time_end,
        ];

        Unlock_feature::where('unlock_feature_id', $request->id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Waktu Pelaksanaan Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_penilaian_pelaksanaan');
    }
}
