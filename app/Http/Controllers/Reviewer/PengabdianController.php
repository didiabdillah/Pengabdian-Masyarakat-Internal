<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_pengabdian;
use App\Models\Anggota_pengabdian;
use App\Models\Dokumen_usulan;
use App\Models\Dokumen_rab;
use App\Models\Mitra_sasaran;
use App\Models\Usulan_luaran;
use App\Models\Penilaian_usulan;

class PengabdianController extends Controller
{
    public function index()
    {
        $is_nilai_unlock = false;
        $nilai_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.nilai_usulan_pengabdian'));
        if ($nilai_unlock) {
            if (strtotime($nilai_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($nilai_unlock["end_time"])) {
                $is_nilai_unlock = true;
            }
        }

        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_reviewer_id', Session::get('user_id'))
            ->where('usulan_pengabdian_status', '=', 'dikirim')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->get();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'is_nilai_unlock' => $is_nilai_unlock,
            'nilai_unlock' => $nilai_unlock,
        ];

        return view('reviewer.pengabdian.index', $view_data);
    }

    public function detail($id)
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

        $view_data = [
            'mitra_sasaran' => $mitra_sasaran,
            'dokumen_rab' => $dokumen_rab,
            'anggota' => $anggota,
            'dokumen_usulan' => $dokumen_usulan,
            'ketua' => $ketua,
            'id' => $id,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'usulan' => $usulan,
        ];

        return view('reviewer.pengabdian.detail', $view_data);
    }

    public function nilai($id)
    {
        // Check Is Penilaian Locked
        $penilaian_usulan = Penilaian_usulan::where('penilaian_usulan_pengabdian_id', $id)
            ->first();

        // $nilai = [];

        if ($penilaian_usulan) {
            if ($penilaian_usulan->penilaian_usulan_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_pengabdian');
            }
        }

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

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'id' => $id,
            'nilai' => $penilaian_usulan,
        ];

        return view('reviewer.pengabdian.nilai', $view_data);
    }

    public function nilai_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_usulan::where('penilaian_usulan_pengabdian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_usulan_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_pengabdian');
            }
        }

        // Input Validation
        $request->validate(
            [
                'nilai_1'  => 'required',
                'nilai_2'  => 'required',
                'nilai_3'  => 'required',
                'nilai_4'  => 'required',
                'nilai_5'  => 'required',
                'nilai_6'  => 'required',
                'komentar'  => 'max:60000',
            ]
        );

        $nilai_1 = $request->nilai_1;
        $nilai_2 = $request->nilai_2;
        $nilai_3 = $request->nilai_3;
        $nilai_4 = $request->nilai_4;
        $nilai_5 = $request->nilai_5;
        $nilai_6 = $request->nilai_6;
        $komentar = htmlspecialchars($request->komentar);

        //Input Data
        $data = [
            'penilaian_usulan_pengabdian_id' => $id,
            'penilaian_usulan_komentar' => $komentar,
            'penilaian_usulan_nilai_1' => $nilai_1,
            'penilaian_usulan_nilai_2' => $nilai_2,
            'penilaian_usulan_nilai_3' => $nilai_3,
            'penilaian_usulan_nilai_4' => $nilai_4,
            'penilaian_usulan_nilai_5' => $nilai_5,
            'penilaian_usulan_nilai_6' => $nilai_6,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Penilaian_usulan::updateOrInsert(
            ['penilaian_usulan_pengabdian_id' => $id],
            $data
        );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Nilai Ditambah' //Sub Alert Message
        );

        return redirect()->route('reviewer_pengabdian_nilai_ulasan', $id);
    }

    public function nilai_ulasan($id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_usulan::where('penilaian_usulan_pengabdian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_usulan_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_pengabdian');
            }
        }

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
            "1" => "Sangat Buruk",
            "2" => "Buruk Sekali",
            "3" => "Buruk",
            "4" => "Baik",
            "5" => "Baik Sekali",
            "6" => "Istimewa",
        ];

        $total_nilai = [
            "1" => $nilai->penilaian_usulan_nilai_1 * 10,
            "2" => $nilai->penilaian_usulan_nilai_2 * 15,
            "3" => $nilai->penilaian_usulan_nilai_3 * 20,
            "4" => $nilai->penilaian_usulan_nilai_4 * 25,
            "5" => $nilai->penilaian_usulan_nilai_5 * 10,
            "6" => $nilai->penilaian_usulan_nilai_6 * 20,
        ];

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'nilai' => $nilai,
            'id' => $id,
            'ket_nilai' => $keterangan_nilai,
            'total_nilai' => $total_nilai,
        ];

        return view('reviewer.pengabdian.ulasan_nilai', $view_data);
    }

    public function nilai_ulasan_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_usulan::where('penilaian_usulan_pengabdian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_usulan_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_pengabdian');
            }
        }

        //Input Data
        $data = [
            'penilaian_usulan_pengabdian_id' => $id,
            'penilaian_usulan_lock' => true,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Penilaian_usulan::where('penilaian_usulan_pengabdian_id', $id)
            ->update($data);

        Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->update(['usulan_pengabdian_status' => 'dinilai']);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Nilai Dikirimkan' //Sub Alert Message
        );

        return redirect()->route('reviewer_pengabdian');
    }
}
