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
use App\Models\Laporan_kemajuan;
use App\Models\Penilaian_monev;
use App\Models\Capaian_kegiatan;

class MonevController extends Controller
{
    public function index()
    {
        $is_nilai_unlock = false;
        $nilai_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.monev_laporan_kemajuan_pengabdian'));
        if ($nilai_unlock) {
            if (strtotime($nilai_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($nilai_unlock["end_time"])) {
                $is_nilai_unlock = true;
            }
        }

        $usulan_pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_reviewer_monev_id', Session::get('user_id'))
            ->where('usulan_pengabdian_status', '=', 'diterima')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->get();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'is_nilai_unlock' => $is_nilai_unlock,
            'nilai_unlock' => $nilai_unlock,
        ];

        return view('reviewer.monev.index', $view_data);
    }

    public function detail($id)
    {
        $pengabdian_id = $id;

        $laporan_kemajuan = Laporan_kemajuan::where('laporan_kemajuan_pengabdian_id', $pengabdian_id)->where('laporan_kemajuan_tipe', 'kemajuan')->first();

        $laporan_keuangan = Laporan_kemajuan::where('laporan_kemajuan_pengabdian_id', $pengabdian_id)->where('laporan_kemajuan_tipe', 'keuangan')->first();

        $luaran_wajib = Usulan_luaran::where('usulan_luaran_pengabdian_id', $pengabdian_id)
            ->where('usulan_luaran_pengabdian_tipe', 'wajib')
            ->get();

        $luaran_tambahan = Usulan_luaran::where('usulan_luaran_pengabdian_id', $pengabdian_id)
            ->where('usulan_luaran_pengabdian_tipe', 'tambahan')
            ->get();

        $view_data = [
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_keuangan' => $laporan_keuangan,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'pengabdian_id' => $pengabdian_id,
        ];

        return view('reviewer.monev.detail', $view_data);
    }

    public function nilai($id)
    {
        // Check Is Penilaian Locked
        $penilaian_monev = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->first();

        // $nilai = [];

        if ($penilaian_monev) {
            if ($penilaian_monev->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }

        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('skema_pengabdian', 'usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'skema_pengabdian.skema_id')
            ->join('bidang_pengabdian', 'usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'bidang_pengabdian.bidang_id')
            ->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'id' => $id,
            'nilai' => $penilaian_monev,
        ];

        return view('reviewer.monev.nilai', $view_data);
    }

    public function nilai_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }

        // Input Validation
        $request->validate(
            [
                'komentar'  => 'max:60000',
            ]
        );

        $status[1] = $request->status_1;
        $status[2] = $request->status_2;
        $status[3] = $request->status_3;
        $status[4] = $request->status_4;
        $status[5] = $request->status_5;
        $status[6] = $request->status_6;
        $status[7] = $request->status_7;
        $status[8] = $request->status_8;
        $status[9] = $request->status_9;

        $skor[1] = $request->skor_1;
        $skor[2] = $request->skor_2;
        $skor[3] = $request->skor_3;
        $skor[4] = $request->skor_4;
        $skor[5] = $request->skor_5;
        $skor[6] = $request->skor_6;
        $skor[7] = $request->skor_7;
        $skor[8] = $request->skor_8;
        $skor[9] = $request->skor_9;

        $komentar = htmlspecialchars($request->komentar);

        $nilai[1] = 0;
        $nilai[2] = 0;
        $nilai[3] = 0;
        $nilai[4] = 0;
        $nilai[5] = 0;
        $nilai[6] = 0;
        $nilai[7] = 0;
        $nilai[8] = 0;
        $nilai[9] = 0;

        if ($skor[1] != NULL && $skor[2] != NULL) {
            $nilai_avg = ($skor[1] + $skor[2]) / 2;
            $nilai[1] = $nilai_avg * 20;
            $nilai[2] = $nilai_avg * 20;
        } else if ($skor[1] != NULL) {
            $nilai_avg = ($skor[1]) / 1;
            $nilai[1] = $nilai_avg * 20;
        } else if ($skor[2] != NULL) {
            $nilai_avg = ($skor[2]) / 1;
            $nilai[2] = $nilai_avg * 20;
        } else {
            $nilai[1] = 0;
            $nilai[2] = 0;
        }

        if ($skor[3] != NULL && $skor[4] != NULL && $skor[5] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[3] + $skor[4] + $skor[5] + $skor[6]) / 4;
            $nilai[3] = $nilai_avg * 60;
            $nilai[4] = $nilai_avg * 60;
            $nilai[5] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
        } elseif ($skor[3] != NULL && $skor[4] != NULL && $skor[5] != NULL) {
            $nilai_avg = ($skor[3] + $skor[4] + $skor[5]) / 3;
            $nilai[3] = $nilai_avg * 60;
            $nilai[4] = $nilai_avg * 60;
            $nilai[5] = $nilai_avg * 60;
        } elseif ($skor[3] != NULL && $skor[5] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[3] + $skor[5] + $skor[6]) / 3;
            $nilai[3] = $nilai_avg * 60;
            $nilai[5] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
        } elseif ($skor[3] != NULL && $skor[4] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[3] + $skor[4] + $skor[6]) / 3;
            $nilai[3] = $nilai_avg * 60;
            $nilai[4] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
            // 
        } elseif ($skor[4] != NULL && $skor[5] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[4] + $skor[5] + $skor[6]) / 3;
            $nilai[4] = $nilai_avg * 60;
            $nilai[5] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
        } elseif ($skor[3] != NULL && $skor[4] != NULL) {
            $nilai_avg = ($skor[3] + $skor[4]) / 2;
            $nilai[3] = $nilai_avg * 60;
            $nilai[4] = $nilai_avg * 60;
        } elseif ($skor[3] != NULL && $skor[5] != NULL) {
            $nilai_avg = ($skor[3] + $skor[5]) / 2;
            $nilai[3] = $nilai_avg * 60;
            $nilai[5] = $nilai_avg * 60;
        } elseif ($skor[3] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[3] + $skor[6]) / 2;
            $nilai[3] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
            // 
        } elseif ($skor[4] != NULL && $skor[5] != NULL) {
            $nilai_avg = ($skor[4] + $skor[5]) / 2;
            $nilai[4] = $nilai_avg * 60;
            $nilai[5] = $nilai_avg * 60;
        } elseif ($skor[4] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[4] + $skor[6]) / 2;
            $nilai[4] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
            // 
        } elseif ($skor[5] != NULL && $skor[6] != NULL) {
            $nilai_avg = ($skor[5] + $skor[6]) / 2;
            $nilai[5] = $nilai_avg * 60;
            $nilai[6] = $nilai_avg * 60;
            // 
        } elseif ($skor[3] != NULL) {
            $nilai_avg = ($skor[3]) / 1;
            $nilai[3] = $nilai_avg * 60;
        } elseif ($skor[4] != NULL) {
            $nilai_avg = ($skor[4]) / 1;
            $nilai[4] = $nilai_avg * 60;
        } elseif ($skor[5] != NULL) {
            $nilai_avg = ($skor[5]) / 1;
            $nilai[5] = $nilai_avg * 60;
        } elseif ($skor[6] != NULL) {
            $nilai_avg = ($skor[6]) / 1;
            $nilai[6] = $nilai_avg * 60;
            // 
        } else {
            $nilai[3] = 0;
            $nilai[4] = 0;
            $nilai[5] = 0;
            $nilai[6] = 0;
        }

        if ($skor[7] != NULL && $skor[8] != NULL) {
            $nilai_avg = ($skor[7] + $skor[8]) / 2;
            $nilai[7] = $nilai_avg * 20;
            $nilai[8] = $nilai_avg * 20;
        } elseif ($skor[7] != NULL) {
            $nilai_avg = ($skor[7]) / 1;
            $nilai[7] = $nilai_avg * 20;
        } elseif ($skor[8] != NULL) {
            $nilai_avg = ($skor[8]) / 1;
            $nilai[8] = $nilai_avg * 20;
        } else {
            $nilai[7] = 0;
            $nilai[8] = 0;
        }

        if ($skor[9] != NULL) {
            $nilai_avg = ($skor[9]) / 1;
            $nilai[9] = $nilai_avg * 10;
        } else {
            $nilai[9] = 0;
        }

        //Input Data
        $data = [
            'penilaian_monev_pengabdian_id' => $id,
            'penilaian_monev_komentar' => $komentar,

            'penilaian_monev_status_1' => $status[1],
            'penilaian_monev_status_2' => $status[2],
            'penilaian_monev_status_3' => $status[3],
            'penilaian_monev_status_4' => $status[4],
            'penilaian_monev_status_5' => $status[5],
            'penilaian_monev_status_6' => $status[6],
            'penilaian_monev_status_7' => $status[7],
            'penilaian_monev_status_8' => $status[8],
            'penilaian_monev_status_9' => $status[9],

            'penilaian_monev_skor_1' => $skor[1],
            'penilaian_monev_skor_2' => $skor[2],
            'penilaian_monev_skor_3' => $skor[3],
            'penilaian_monev_skor_4' => $skor[4],
            'penilaian_monev_skor_5' => $skor[5],
            'penilaian_monev_skor_6' => $skor[6],
            'penilaian_monev_skor_7' => $skor[7],
            'penilaian_monev_skor_8' => $skor[8],
            'penilaian_monev_skor_9' => $skor[9],

            'penilaian_monev_nilai_1' => $nilai[1],
            'penilaian_monev_nilai_2' => $nilai[2],
            'penilaian_monev_nilai_3' => $nilai[3],
            'penilaian_monev_nilai_4' => $nilai[4],
            'penilaian_monev_nilai_5' => $nilai[5],
            'penilaian_monev_nilai_6' => $nilai[6],
            'penilaian_monev_nilai_7' => $nilai[7],
            'penilaian_monev_nilai_8' => $nilai[8],
            'penilaian_monev_nilai_9' => $nilai[9],

            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Penilaian_monev::updateOrInsert(
            ['penilaian_monev_pengabdian_id' => $id],
            $data
        );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Nilai Monev Ditambah' //Sub Alert Message
        );

        return redirect()->route('reviewer_monev_capaian', $id);
    }

    public function capaian($id)
    {
        // Check Is Penilaian Locked
        $penilaian_monev = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->first();

        // $nilai = [];

        if ($penilaian_monev) {
            if ($penilaian_monev->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Penilaian Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }

        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('skema_pengabdian', 'usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'skema_pengabdian.skema_id')
            ->join('bidang_pengabdian', 'usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'bidang_pengabdian.bidang_id')
            ->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'id' => $id,
            'nilai' => $penilaian_monev,
        ];

        return view('reviewer.monev.capaian_kegiatan', $view_data);
    }

    public function capaian_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_monev');
            }
        }

        $no = -1;
        foreach ($request->post() as $data) {
            if ($no > 0) {
                //Input Data
                $data_insert = [
                    'capaian_kegiatan_pengabdian_id' => $id,
                    'capaian_kegiatan_urutan' => $no,
                    'capaian_kegiatan_jawaban' => htmlspecialchars($data),
                ];

                Capaian_kegiatan::updateOrInsert(
                    ['capaian_kegiatan_pengabdian_id' => $id, 'capaian_kegiatan_urutan' => $no],
                    $data_insert
                );
            }
            $no++;
        }

        // Input Validation
        // $request->validate(
        //     [
        //         'komentar'  => 'max:60000',
        //     ]
        // );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Capaian Monev Ditambah' //Sub Alert Message
        );

        return redirect()->route('reviewer_monev_nilai_ulasan', $id);
    }

    public function nilai_ulasan($id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
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
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('skema_pengabdian', 'usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'skema_pengabdian.skema_id')
            ->join('bidang_pengabdian', 'usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'bidang_pengabdian.bidang_id')
            ->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $nilai = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)->first();

        // $keterangan_nilai = [
        //     "1" => "Sangat Buruk",
        //     "2" => "Buruk Sekali",
        //     "3" => "Buruk",
        //     "4" => "Baik",
        //     "5" => "Baik Sekali",
        //     "6" => "Istimewa",
        // ];

        // $total_nilai = [
        //     "1" => $nilai->penilaian_usulan_nilai_1 * 10,
        //     "2" => $nilai->penilaian_usulan_nilai_2 * 15,
        //     "3" => $nilai->penilaian_usulan_nilai_3 * 20,
        //     "4" => $nilai->penilaian_usulan_nilai_4 * 25,
        //     "5" => $nilai->penilaian_usulan_nilai_5 * 10,
        //     "6" => $nilai->penilaian_usulan_nilai_6 * 20,
        // ];

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'nilai' => $nilai,
            'id' => $id,
            // 'ket_nilai' => $keterangan_nilai,
            // 'total_nilai' => $total_nilai,
        ];

        return view('reviewer.monev.ulasan_nilai', $view_data);
    }

    public function nilai_ulasan_update(Request $request, $id)
    {
        // Check Is Penilaian Locked
        $is_lock = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->first();

        if ($is_lock) {
            if ($is_lock->penilaian_monev_lock == true) {
                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Monev Dikunci', //Alert Message 
                    'Tidak Dapat Melakukan Perubahan' //Sub Alert Message
                );

                return redirect()->route('reviewer_pengabdian');
            }
        }

        //Input Data
        $data = [
            'penilaian_monev_pengabdian_id' => $id,
            'penilaian_monev_lock' => true,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->update($data);

        Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->update(['usulan_pengabdian_status' => 'dimonev']);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Nilai Monev Dikirimkan' //Sub Alert Message
        );

        return redirect()->route('reviewer_monev');
    }
}
