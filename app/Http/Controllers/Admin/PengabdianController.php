<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_pengabdian;
use App\Models\Penilaian_usulan;
use App\Models\Anggota_pengabdian;
use App\Models\Jurusan;
use App\Models\Usulan_luaran;
use App\Models\Dokumen_rab;
use App\Models\Dokumen_usulan;
use App\Models\Mitra_sasaran;
use App\Models\Penilaian_monev;
use App\Models\Capaian_kegiatan;

class PengabdianController extends Controller
{
    public function usulan_pengabdian()
    {
        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', '!=', 'pending')
            ->where('usulan_pengabdian_status', '!=', 'dikirim')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('pkm_usulan_pengabdian.updated_at', 'desc')
            ->get();

        $jurusan = Jurusan::all();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'jurusan' => $jurusan,
        ];

        return view('admin.pengabdian.usulan', $view_data);
    }

    public function unlock($id)
    {
        $waktu = Usulan_pengabdian::where('usulan_pengabdian_id', $id)->first();

        $tanggal = NULL;
        $jam = NULL;
        $menit = NULL;

        if ($waktu->usulan_pengabdian_unlock_pass) {
            $tanggal = date('Y-m-d', $waktu->usulan_pengabdian_unlock_pass);
            $jam = intval(date('H', $waktu->usulan_pengabdian_unlock_pass));
            $menit = intval(date('i', $waktu->usulan_pengabdian_unlock_pass));
        }

        $view_data = [
            'waktu' => $waktu,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'menit' => $menit,
            'id' => $id,
        ];

        return view('admin.pengabdian.unlock', $view_data);
    }

    public function unlock_update(Request $request, $id)
    {
        // Input Validation
        $request->validate([
            'tanggal'  => 'required',
            'jam'  => 'required',
            'menit'  => 'required',
        ]);

        $tanggal = htmlspecialchars($request->tanggal);
        $jam = htmlspecialchars($request->jam);
        $menit = htmlspecialchars($request->menit);

        $timecode =  strtotime($tanggal . ' ' . $jam . ':' . $menit);

        $data = [
            'usulan_pengabdian_unlock_pass' => $timecode
        ];

        Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Akses Dibuka' //Sub Alert Message
        );

        return redirect()->route('admin_pengabdian_usulan');
    }

    public function riwayat()
    {
        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', '!=', 'pending')
            ->where('usulan_pengabdian_status', '!=', 'dikirim')
            ->where('usulan_pengabdian_tahun', '<', date('Y'))
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('pkm_usulan_pengabdian.updated_at', 'desc')
            ->get();

        $jurusan = Jurusan::all();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'jurusan' => $jurusan,
        ];

        return view('admin.pengabdian.riwayat', $view_data);
    }

    public function usulan_pengabdian_jurusan($jurusan_id)
    {
        $current_jurusan = Jurusan::where('jurusan_id', $jurusan_id)->first();

        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->join('pkm_anggota_pengabdian', 'pkm_anggota_pengabdian.anggota_pengabdian_pengabdian_id', '=', 'pkm_usulan_pengabdian.usulan_pengabdian_id')
            ->join('biodata', 'biodata.biodata_user_id', '=', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id')
            ->where('biodata.biodata_jurusan', '=', $current_jurusan->jurusan_nama)
            ->where('usulan_pengabdian_status', '!=', 'pending')
            ->where('usulan_pengabdian_status', '!=', 'dikirim')
            ->where('pkm_anggota_pengabdian.anggota_pengabdian_role', '=', 'ketua')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('pkm_usulan_pengabdian.updated_at', 'desc')
            ->get();

        $jurusan = Jurusan::all();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'jurusan' => $jurusan,
            'current_jurusan' => $current_jurusan->jurusan_nama,
        ];

        return view('admin.pengabdian.usulan_jurusan', $view_data);
    }

    public function riwayat_jurusan($jurusan_id)
    {
        $current_jurusan = Jurusan::where('jurusan_id', $jurusan_id)->first();

        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->join('pkm_anggota_pengabdian', 'pkm_anggota_pengabdian.anggota_pengabdian_pengabdian_id', '=', 'pkm_usulan_pengabdian.usulan_pengabdian_id')
            ->join('biodata', 'biodata.biodata_user_id', '=', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id')
            ->where('biodata.biodata_jurusan', '=', $current_jurusan->jurusan_nama)
            ->where('usulan_pengabdian_status', '!=', 'pending')
            ->where('usulan_pengabdian_status', '!=', 'dikirim')
            ->where('pkm_anggota_pengabdian.anggota_pengabdian_role', '=', 'ketua')
            ->where('usulan_pengabdian_tahun', '<', date('Y'))
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('pkm_usulan_pengabdian.updated_at', 'desc')
            ->get();

        $jurusan = Jurusan::all();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'jurusan' => $jurusan,
            'current_jurusan' => $current_jurusan->jurusan_nama,
        ];

        return view('admin.pengabdian.riwayat_jurusan', $view_data);
    }

    public function detail($id, $back_param)
    {
        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $dokumen_usulan = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $dokumen_rab = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->first();

        $mitra_sasaran = Mitra_sasaran::where('mitra_sasaran_pengabdian_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        $luaran_wajib = Usulan_luaran::where('usulan_luaran_pengabdian_id', $id)
            ->where('usulan_luaran_pengabdian_tipe', 'wajib')
            ->orderBy('usulan_luaran_pengabdian_tahun', 'asc')
            ->get();

        $luaran_tambahan = Usulan_luaran::where('usulan_luaran_pengabdian_id', $id)
            ->where('usulan_luaran_pengabdian_tipe', 'tambahan')
            ->orderBy('usulan_luaran_pengabdian_tahun', 'asc')
            ->get();

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('pkm_skema_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'pkm_skema_pengabdian.skema_id')
            ->join('pkm_bidang_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'pkm_bidang_pengabdian.bidang_id')
            ->first();
        $nilai = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)->first();

        $capaian = NULL;
        if ($nilai) {
            $capaian = Capaian_kegiatan::where('capaian_kegiatan_monev_id', $nilai->penilaian_monev_id)->first();
        }

        $back_url = NULL;
        if ($back_param == 'usulan') {
            $back_url = route('admin_pengabdian_usulan');
        } elseif ($back_param == 'riwayat') {
            // $back_url = route('admin_pengabdian_riwayat');
        } elseif ($back_param == 'plotting') {
            $back_url = route('admin_plotting_reviewer');
        } else if ($back_param == 'riwayat') {
            $back_url = route('admin_pengabdian_riwayat');
        }

        $view_data = [
            'mitra_sasaran' => $mitra_sasaran,
            'dokumen_rab' => $dokumen_rab,
            'anggota' => $anggota,
            'dokumen_usulan' => $dokumen_usulan,
            'ketua' => $ketua,
            'id' => $id,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'back_url' => $back_url,

            // 'anggota' => $anggota,
            'usulan' => $usulan,
            // 'ketua' => $ketua,
            'nilai' => $nilai,
            'capaian' => $capaian,
        ];

        return view('admin.pengabdian.detail', $view_data);
    }


    public function konfirmasi($id)
    {
        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('pkm_skema_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'pkm_skema_pengabdian.skema_id')
            ->join('pkm_bidang_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'pkm_bidang_pengabdian.bidang_id')
            ->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $nilai = Penilaian_usulan::where('penilaian_usulan_pengabdian_id', $id)->first();

        $keterangan_nilai = [
            "0" => "-",
            "1" => "Sangat Buruk",
            "2" => "Buruk Sekali",
            "3" => "Buruk",
            "4" => "Baik",
            "5" => "Baik Sekali",
            "6" => "Istimewa",
        ];

        $total_nilai = [
            "1" => ($nilai) ? $nilai->penilaian_usulan_nilai_1 * 10 : 0,
            "2" => ($nilai) ? $nilai->penilaian_usulan_nilai_2 * 15 : 0,
            "3" => ($nilai) ? $nilai->penilaian_usulan_nilai_3 * 20 : 0,
            "4" => ($nilai) ? $nilai->penilaian_usulan_nilai_4 * 25 : 0,
            "5" => ($nilai) ? $nilai->penilaian_usulan_nilai_5 * 10 : 0,
            "6" => ($nilai) ? $nilai->penilaian_usulan_nilai_6 * 20 : 0,
        ];

        $konfirmasi = Usulan_pengabdian::select('usulan_pengabdian_status as status')
            ->where('usulan_pengabdian_id', $id)
            ->first();

        $view_data = [
            'id' => $id,
            'konfirmasi' => $konfirmasi,
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'nilai' => $nilai,
            'ket_nilai' => $keterangan_nilai,
            'total_nilai' => $total_nilai,
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

        $konfirmasi = $status;

        //Update Data
        $data = [
            'usulan_pengabdian_status' => $konfirmasi,
        ];
        Usulan_pengabdian::where('usulan_pengabdian_id', $id)->update($data);

        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->where('anggota_pengabdian_role', 'ketua')->first();

        $user = $ketua->anggota_pengabdian_user_id;
        $to = "/topics/" . $user;
        $notif = array(
            'title' => 'Status Usulan',
            'body' => 'Ada Update Data Status Usulan Cek Sekarang!!!'
        );
        send_notif($to, $notif);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Status Usulan pengabdian Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('admin_pengabdian_usulan');
    }

    // public function pelaksanaan_pengabdian()
    // {
    //     $waktu = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_usulan_pengabdian'));

    //     $view_data = [
    //         'waktu' => $waktu,
    //     ];

    //     return view('admin.pengabdian.pelaksanaan', $view_data);
    // }

    // public function pelaksanaan_pengabdian_update(Request $request)
    // {
    //     $waktu = explode(" - ", htmlspecialchars($request->waktu));

    //     $year_start = htmlspecialchars($request->tahun_mulai);
    //     $year_end = htmlspecialchars($request->tahun_selesai);

    //     $time_start = date('Y-m-d H:i:s', strtotime($waktu[0]));
    //     $time_end = date('Y-m-d H:i:s', strtotime($waktu[1]));

    //     $data = [
    //         "id" => $request->id,
    //         "name" => __('unlock.tambah_usulan_pengabdian'),
    //         "start_year" => $year_start,
    //         "end_year" => $year_end,
    //         "start_time" => $time_start,
    //         "end_time" => $time_end,
    //     ];

    //     update_local_db_json("unlock_feature.json", "id", $request->id, $data);

    //     //Flash Message
    //     flash_alert(
    //         __('alert.icon_success'), //Icon
    //         'Sukses', //Alert Message 
    //         'Waktu Pelaksanaan Diubah' //Sub Alert Message
    //     );

    //     return redirect()->route('admin_pengabdian_pelaksanaan');
    // }

    // public function pelaksanaan_penilaian()
    // {
    //     $waktu = get_where_local_db_json("unlock_feature.json", "name", __('unlock.nilai_usulan_pengabdian'));

    //     $view_data = [
    //         'waktu' => $waktu,
    //     ];

    //     return view('admin.pengabdian.pelaksanaan_penilaian', $view_data);
    // }

    // public function pelaksanaan_penilaian_update(Request $request)
    // {
    //     $waktu = explode(" - ", htmlspecialchars($request->waktu));

    //     $year_start = htmlspecialchars($request->tahun_mulai);
    //     $year_end = htmlspecialchars($request->tahun_selesai);

    //     $time_start = date('Y-m-d H:i:s', strtotime($waktu[0]));
    //     $time_end = date('Y-m-d H:i:s', strtotime($waktu[1]));

    //     $data = [
    //         "id" => $request->id,
    //         "name" => __('unlock.nilai_usulan_pengabdian'),
    //         "start_year" => $year_start,
    //         "end_year" => $year_end,
    //         "start_time" => $time_start,
    //         "end_time" => $time_end,
    //     ];

    //     update_local_db_json("unlock_feature.json", "id", $request->id, $data);

    //     //Flash Message
    //     flash_alert(
    //         __('alert.icon_success'), //Icon
    //         'Sukses', //Alert Message 
    //         'Waktu Pelaksanaan Diubah' //Sub Alert Message
    //     );

    //     return redirect()->route('admin_penilaian_pelaksanaan');
    // }
}
