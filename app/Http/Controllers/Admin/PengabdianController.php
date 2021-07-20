<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_pengabdian;

class PengabdianController extends Controller
{
    public function usulan_pengabdian()
    {
        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', '!=', 'pending')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->get();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
        ];

        return view('admin.pengabdian.usulan', $view_data);
    }

    public function konfirmasi($id)
    {
        $konfirmasi = Usulan_pengabdian::select('usulan_pengabdian_status as status')
            ->where('usulan_pengabdian_id', $id)
            ->first();

        $view_data = [
            'id' => $id,
            'konfirmasi' => $konfirmasi,
        ];

        return view('admin.pengabdian.konfirmasi', $view_data);
    }

    public function konfirmasi_update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'status'  => 'required',
            ]
        );

        $status = htmlspecialchars($request->status);

        $konfirmasi = ($status == 1) ? "diterima" : "ditolak";

        //Update Data
        $data = [
            'usulan_pengabdian_status' => $konfirmasi,
        ];
        Usulan_pengabdian::where('usulan_pengabdian_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Status Usulan pengabdian Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('admin_pengabdian_usulan');
    }

    public function pelaksanaan_pengabdian()
    {
        $waktu = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_usulan_pengabdian'));

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
            "id" => $request->id,
            "name" => __('unlock.tambah_usulan_pengabdian'),
            "start_year" => $year_start,
            "end_year" => $year_end,
            "start_time" => $time_start,
            "end_time" => $time_end,
        ];

        update_local_db_json("unlock_feature.json", "id", $request->id, $data);

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
        $waktu = get_where_local_db_json("unlock_feature.json", "name", __('unlock.nilai_usulan_pengabdian'));

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
            "id" => $request->id,
            "name" => __('unlock.nilai_usulan_pengabdian'),
            "start_year" => $year_start,
            "end_year" => $year_end,
            "start_time" => $time_start,
            "end_time" => $time_end,
        ];

        update_local_db_json("unlock_feature.json", "id", $request->id, $data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Waktu Pelaksanaan Diubah' //Sub Alert Message
        );

        return redirect()->route('admin_penilaian_pelaksanaan');
    }
}
