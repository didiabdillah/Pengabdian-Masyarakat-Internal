<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Usulan_pengabdian;
use App\Models\Anggota_pengabdian;
use App\Models\Dokumen_usulan;
use App\Models\Dokumen_rab;
use App\Models\Mitra_sasaran;
use App\Models\Usulan_luaran;
use App\Models\Laporan_kemajuan;
use App\Models\Penilaian_monev;
use App\Models\User;

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
            ->orderBy('pkm_usulan_pengabdian.updated_at', 'desc')
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

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('pkm_skema_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'pkm_skema_pengabdian.skema_id')
            ->join('pkm_bidang_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'pkm_bidang_pengabdian.bidang_id')
            ->first();

        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $view_data = [
            'laporan_kemajuan' => $laporan_kemajuan,
            'laporan_keuangan' => $laporan_keuangan,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'pengabdian_id' => $pengabdian_id,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'anggota' => $anggota,
        ];

        return view('reviewer.monev.detail', $view_data);
    }

    public function nilai($id)
    {
        // Check Is Penilaian Locked
        $penilaian_monev = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)
            ->first();


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

        $penilaian_monev = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)->first();

        $skor = ($penilaian_monev) ? json_decode($penilaian_monev->penilaian_monev_skor, true) : NULL;
        $justifikasi = ($penilaian_monev) ? json_decode($penilaian_monev->penilaian_monev_justifikasi, true) : NULL;

        $view_data = [
            'anggota' => $anggota,
            'usulan' => $usulan,
            'ketua' => $ketua,
            'penilaian_monev' => $penilaian_monev,
            'id' => $id,
            'skor' => $skor,
            'justifikasi' => $justifikasi,
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
                'catatan'  => 'max:60000',
                'signature'  => 'required',
                'kota_penilaian'  => 'required|max:255',
                'justifikasi_1'  => 'max:255',
                'justifikasi_2a'  => 'max:255',
                'justifikasi_2b'  => 'max:255',
                'justifikasi_2c'  => 'max:255',
                'justifikasi_2d'  => 'max:255',
                'justifikasi_2e'  => 'max:255',
                'justifikasi_2f'  => 'max:255',
                'justifikasi_3'  => 'max:255',
                'justifikasi_4'  => 'max:255',
                'justifikasi_5'  => 'max:255',
                'justifikasi_6'  => 'max:255',
            ]
        );

        $tanda_tangan = $request->signature;


        $catatan = htmlspecialchars($request->catatan);

        $justifikasi["1"] = htmlspecialchars($request->justifikasi_1);
        $justifikasi["2a"] = htmlspecialchars($request->justifikasi_2a);
        $justifikasi["2b"] = htmlspecialchars($request->justifikasi_2b);
        $justifikasi["2c"] = htmlspecialchars($request->justifikasi_2c);
        $justifikasi["2d"] = htmlspecialchars($request->justifikasi_2d);
        $justifikasi["2e"] = htmlspecialchars($request->justifikasi_2e);
        $justifikasi["2f"] = htmlspecialchars($request->justifikasi_2f);
        $justifikasi["3"] = htmlspecialchars($request->justifikasi_3);
        $justifikasi["4"] = htmlspecialchars($request->justifikasi_4);
        $justifikasi["5"] = htmlspecialchars($request->justifikasi_5);
        $justifikasi["6"] = htmlspecialchars($request->justifikasi_6);

        $skor["1"] = ($request->skor_1 != NULL || $request->skor_1 != 0) ? $request->skor_1 : 0;
        $skor["2a"] = ($request->skor_2a != NULL || $request->skor_2a != 0) ? $request->skor_2a : 0;
        $skor["2b"] = ($request->skor_2b != NULL || $request->skor_2b != 0) ? $request->skor_2b : 0;
        $skor["2c"] = ($request->skor_2c != NULL || $request->skor_2c != 0) ? $request->skor_2c : 0;
        $skor["2d"] = ($request->skor_2d != NULL || $request->skor_2d != 0) ? $request->skor_2d : 0;
        $skor["2e"] = ($request->skor_2e != NULL || $request->skor_2e != 0) ? $request->skor_2e : 0;
        $skor["2f"] = ($request->skor_2f != NULL || $request->skor_2f != 0) ? $request->skor_2f : 0;
        $skor["3"] = ($request->skor_3 != NULL || $request->skor_3 != 0) ? $request->skor_3 : 0;
        $skor["4"] = ($request->skor_4 != NULL || $request->skor_4 != 0) ? $request->skor_4 : 0;
        $skor["5"] = ($request->skor_5 != NULL || $request->skor_5 != 0) ? $request->skor_5 : 0;
        $skor["6"] = ($request->skor_6 != NULL || $request->skor_6 != 0) ? $request->skor_6 : 0;

        $skor_2 = [
            1 => ($skor["2a"] != NULL || $skor["2a"] != 0) ? $skor["2a"] : 0,
            2 => ($skor["2b"] != NULL || $skor["2b"] != 0) ? $skor["2b"] : 0,
            3 => ($skor["2c"] != NULL || $skor["2c"] != 0) ? $skor["2c"] : 0,
            4 => ($skor["2d"] != NULL || $skor["2d"] != 0) ? $skor["2d"] : 0,
            5 => ($skor["2e"] != NULL || $skor["2e"] != 0) ? $skor["2e"] : 0,
            6 => ($skor["2f"] != NULL || $skor["2f"] != 0) ? $skor["2f"] : 0,
        ];

        $is_skor2_not_null = 0;

        foreach ($skor_2 as $skor2) {
            if ($skor2 != NULL || $skor2 != 0) {
                $is_skor2_not_null++;
            }
        }
        $var_skor2_not_empty = ($is_skor2_not_null == 0) ? 1 : $is_skor2_not_null;

        $skor_avg = ($skor_2[1] + $skor_2[2] + $skor_2[3] + $skor_2[4] + $skor_2[5] + $skor_2[6]) / $var_skor2_not_empty;

        $nilai["1"] = ($skor["1"]) ? $skor["1"] * 10 : 0 * 10;
        $nilai["2a"] = ($skor_2[1] != 0) ? $skor_avg * 15 : 0;
        $nilai["2b"] = ($skor_2[2] != 0) ? $skor_avg * 15 : 0;
        $nilai["2c"] = ($skor_2[3] != 0) ? $skor_avg * 15 : 0;
        $nilai["2d"] = ($skor_2[4] != 0) ? $skor_avg * 15 : 0;
        $nilai["2e"] = ($skor_2[5] != 0) ? $skor_avg * 15 : 0;
        $nilai["2f"] = ($skor_2[6] != 0) ? $skor_avg * 15 : 0;
        $nilai["3"] = ($skor["3"]) ? $skor["3"] * 25 : 0 * 25;
        $nilai["4"] = ($skor["4"]) ? $skor["4"] * 25 : 0 * 25;
        $nilai["5"] = ($skor["5"]) ? $skor["5"] * 15 : 0 * 15;
        $nilai["6"] = ($skor["6"]) ? $skor["6"] * 10 : 0 * 10;

        $json_skor = json_encode([
            "1" => $skor["1"],
            "2a" => $skor["2a"],
            "2b" => $skor["2b"],
            "2c" => $skor["2c"],
            "2d" => $skor["2d"],
            "2e" => $skor["2e"],
            "2f" => $skor["2f"],
            "3" => $skor["3"],
            "4" => $skor["4"],
            "5" => $skor["5"],
            "6" => $skor["6"],
        ]);

        $json_nilai = json_encode([
            "1" => $nilai["1"],
            "2a" => $nilai["2a"],
            "2b" => $nilai["2b"],
            "2c" => $nilai["2c"],
            "2d" => $nilai["2d"],
            "2e" => $nilai["2e"],
            "2f" => $nilai["2f"],
            "3" => $nilai["3"],
            "4" => $nilai["4"],
            "5" => $nilai["5"],
            "6" => $nilai["6"],
        ]);

        $json_justifikasi = json_encode([
            "1" => $justifikasi["1"],
            "2a" => $justifikasi["2a"],
            "2b" => $justifikasi["2b"],
            "2c" => $justifikasi["2c"],
            "2d" => $justifikasi["2d"],
            "2e" => $justifikasi["2e"],
            "2f" => $justifikasi["2f"],
            "3" => $justifikasi["3"],
            "4" => $justifikasi["4"],
            "5" => $justifikasi["5"],
            "6" => $justifikasi["6"],
        ]);

        // Signature
        $signatureFileName = uniqid() . '_' . date('Y-m-d-H-i-s') . '.png';
        $signature = str_replace('data:image/png;base64,', '', $tanda_tangan);
        $signature = str_replace(' ', '+', $signature);
        $data = base64_decode($signature);
        $file = public_path('assets/file/tanda_tangan/' . $signatureFileName);
        file_put_contents($file, $data);
        $old = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)->first();
        if ($old) {
            if ($old->penilaian_monev_tanda_tangan) {
                File::delete(public_path('assets/file/tanda_tangan/' . $old->penilaian_monev_tanda_tangan));
            }
        }

        // Data Pelengkap 
        $user = User::find(Session::get('user_id'));
        $kota_penilaian = htmlspecialchars($request->kota_penilaian);
        $nama_reviewer = $user->user_name;
        $nidn_reviewer = $user->user_nidn;

        //Input Data
        $data = [
            'penilaian_monev_pengabdian_id' => $id,
            'penilaian_monev_nama_reviewer' => $nama_reviewer,
            'penilaian_monev_nidn_reviewer' => $nidn_reviewer,
            'penilaian_monev_kota_penilaian' => $kota_penilaian,
            'penilaian_monev_skor' => "$json_skor",
            'penilaian_monev_nilai' =>    "$json_nilai",
            'penilaian_monev_justifikasi' => "$json_justifikasi",
            'penilaian_monev_catatan' => $catatan,
            'penilaian_monev_tanda_tangan' => $signatureFileName,
            'created_at' => ($old) ? $old->created_at : date('Y-m-d H:i:s'),
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

        return redirect()->route('reviewer_monev_nilai_ulasan', $id);
    }

    public function capaian($id)
    {
        // Check Is Penilaian Locked
        $penilaian_monev = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)->first();
        $capaian = NULL;

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
            // $capaian = Capaian_kegiatan::where('capaian_kegiatan_monev_id', $penilaian_monev->penilaian_monev_id)->first();
        } elseif ($penilaian_monev == NULL) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Monev Tidak Ditemukan', //Alert Message 
                'Mohon Isi Monev Terlebih Dahulu' //Sub Alert Message
            );

            return redirect()->route('reviewer_monev');
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
            'capaian' => $capaian,
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

        // Input Validation
        $request->validate(
            [
                // CAPAIAN
                'mitra_kegiatan'  => 'max:255',
                'jumlah_mitra_orang'  => 'nullable|numeric|max:255',
                'jumlah_mitra_usaha'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_s3'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_s2'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_s1'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_diploma'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_sma'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_smp'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_sd'  => 'nullable|numeric|max:255',
                'pendidikan_mitra_ts'  => 'nullable|numeric|max:255',

                'persoalan_mitra'  => 'max:255',
                'status_sosial_mitra'  => 'max:255',

                // LOKASI
                'jarak_lokasi_mitra'  => 'max:255',
                'sarana_transportasi'  => 'max:255',
                'sarana_komunikasi'  => 'max:255',

                // IDENTITAS
                'jumlah_dosen'  => 'nullable|numeric|max:255',
                'jumlah_mahasiswa'  => 'nullable|numeric|max:255',
                'gelar_akademik_tim_s3'  => 'nullable|numeric|max:255',
                'gelar_akademik_tim_s2'  => 'nullable|numeric|max:255',
                'gelar_akademik_tim_s1'  => 'nullable|numeric|max:255',
                'gelar_akademik_tim_gb'  => 'nullable|numeric|max:255',
                'gender_pria'  => 'nullable|numeric|max:255',
                'gender_wanita'  => 'nullable|numeric|max:255',

                'metode_pelaksanaan_kegiatan'  => 'max:255',
                'waktu_efektif_pelaksanaan'  => 'max:255',
                'keberhasilan'  => 'max:255',
                'keberlanjutan_kegiatan'  => 'max:255',
                'kapasitas_produksi_sebelum'  => 'max:9999999999',
                'kapasitas_produksi_setelah'  => 'max:9999999999',
                'omzet_per_bulan_sebelum'  => 'max:9999999999',
                'omzet_per_bulan_setelah'  => 'max:9999999999',
                'persoalan_masyarakat_mitra'  => 'max:255',

                // BIAYA PROGRAM
                'biaya_pnbp'  => 'nullable|numeric|max:9999999999',
                'biaya_sumber_lain'  => 'nullable|numeric|max:9999999999',

                // LIKUIDITAS DANA PROGRAM
                'tahap_pencairan_dana'  => 'max:255',
                'jumlah_dana'  => 'max:255',

                // KONTRIBUSI MITRA
                'peran_serta_mitra'  => 'max:255',
                'kontribusi_pendanaan'  => 'max:255',
                'peran_mitra'  => 'max:255',

                // KEBERLANJUTAN
                'alasan_kelanjutan_kegiatan'  => 'max:255',

                // Usul penyempurnaan program Pengabdian Masyarakat
                'model_usulan_kegiatan'  => 'max:255',
                'anggaran_biaya'  => 'nullable|numeric|max:9999999999',
                'usul_lain_lain'  => 'max:255',

                // DOKUMENTASI
                'kegiatan_dinilai_bermanfaat'  => 'max:255',
                'permasalahan_lain_terekam'  => 'max:255',

                // Luaran program Pengabdian Masyarakat berupa
                'jasa'  => 'max:255',
                'metode'  => 'max:255',
                'produk'  => 'max:255',
                'paten'  => 'max:255',
                'publikasi_artikel'  => 'max:255',
                'publikasi_media_masa'  => 'max:255',
            ]
        );

        // PROGRESS START HERE

        $mitra_kegiatan = htmlspecialchars($request->mitra_kegiatan);
        $jumlah_mitra = json_encode([
            'orang' => htmlspecialchars($request->jumlah_mitra_orang),
            'usaha' => htmlspecialchars($request->jumlah_mitra_usaha)
        ]);
        $pendidikan_mitra = json_encode([
            's3' => htmlspecialchars($request->pendidikan_mitra_s3),
            's2' => htmlspecialchars($request->pendidikan_mitra_s2),
            's1' => htmlspecialchars($request->pendidikan_mitra_s1),
            'diploma' => htmlspecialchars($request->pendidikan_mitra_diploma),
            'sma' => htmlspecialchars($request->pendidikan_mitra_sma),
            'smp' => htmlspecialchars($request->pendidikan_mitra_smp),
            'sd' => htmlspecialchars($request->pendidikan_mitra_sd),
            'tidak_berpendidikan' => htmlspecialchars($request->pendidikan_mitra_ts)
        ]);

        $persoalan_mitra = htmlspecialchars($request->persoalan_mitra);
        $status_sosial_mitra = htmlspecialchars($request->status_sosial_mitra);

        $jarak_lokasi_mitra = htmlspecialchars($request->jarak_lokasi_mitra);
        $sarana_transportasi = htmlspecialchars($request->sarana_transportasi);
        $sarana_komunikasi = htmlspecialchars($request->sarana_komunikasi);

        $jumlah_dosen = htmlspecialchars($request->jumlah_dosen);
        $jumlah_mahasiswa = htmlspecialchars($request->jumlah_mahasiswa);
        $gelar_akademik_tim = json_encode([
            's3' => htmlspecialchars($request->gelar_akademik_tim_s3),
            's2' => htmlspecialchars($request->gelar_akademik_tim_s2),
            's1' => htmlspecialchars($request->gelar_akademik_tim_s1),
            'gb' => htmlspecialchars($request->gelar_akademik_tim_gb)
        ]);
        $gender = json_encode([
            'pria' => htmlspecialchars($request->gender_pria),
            'wanita' => htmlspecialchars($request->gender_wanita)
        ]);
        $metode_pelaksanaan_kegiatan = htmlspecialchars($request->metode_pelaksanaan_kegiatan);
        $waktu_efektif_pelaksanaan = htmlspecialchars($request->waktu_efektif_pelaksanaan);
        $keberhasilan = htmlspecialchars($request->keberhasilan);
        $keberlanjutan_kegiatan = htmlspecialchars($request->keberlanjutan_kegiatan);
        $kapasitas_produksi = json_encode([
            'sebelum' => htmlspecialchars($request->kapasitas_produksi_sebelum),
            'setelah' => htmlspecialchars($request->kapasitas_produksi_setelah)
        ]);
        $omzet_per_bulan = json_encode([
            'sebelum' => htmlspecialchars($request->omzet_per_bulan_sebelum),
            'setelah' => htmlspecialchars($request->omzet_per_bulan_setelah)
        ]);
        $persoalan_masyarakat_mitra = htmlspecialchars($request->persoalan_masyarakat_mitra);

        $biaya_pnbp = htmlspecialchars($request->biaya_pnbp);
        $biaya_sumber_lain = htmlspecialchars($request->biaya_sumber_lain);

        $tahap_pencairan_dana = htmlspecialchars($request->tahap_pencairan_dana);
        $jumlah_dana = htmlspecialchars($request->jumlah_dana);

        $peran_serta_mitra = htmlspecialchars($request->peran_serta_mitra);
        $kontribusi_pendanaan = htmlspecialchars($request->kontribusi_pendanaan);
        $peran_mitra = htmlspecialchars($request->peran_mitra);

        $alasan_kelanjutan_kegiatan = htmlspecialchars($request->alasan_kelanjutan_kegiatan);

        $model_usulan_kegiatan = htmlspecialchars($request->model_usulan_kegiatan);
        $anggaran_biaya = htmlspecialchars($request->anggaran_biaya);
        $usul_lain_lain = htmlspecialchars($request->usul_lain_lain);

        $kegiatan_dinilai_bermanfaat = htmlspecialchars($request->kegiatan_dinilai_bermanfaat);
        $permasalahan_lain_terekam = htmlspecialchars($request->permasalahan_lain_terekam);

        $jasa = htmlspecialchars($request->jasa);
        $metode = htmlspecialchars($request->metode);
        $produk = htmlspecialchars($request->produk);
        $paten = htmlspecialchars($request->paten);
        $publikasi_artikel = htmlspecialchars($request->publikasi_artikel);
        $publikasi_media_masa = htmlspecialchars($request->publikasi_media_masa);

        $monev_id = $is_lock;

        //Input Data
        $data_insert = [
            'capaian_kegiatan_monev_id' => $monev_id->penilaian_monev_id,
            'mitra_kegiatan' => $mitra_kegiatan,
            'jumlah_mitra' => "$jumlah_mitra",
            'pendidikan_mitra' => "$pendidikan_mitra",
            'persoalan_mitra' => $persoalan_mitra,
            'status_sosial_mitra' => $status_sosial_mitra,
            'jarak_lokasi_mitra' => $jarak_lokasi_mitra,
            'sarana_transportasi' => $sarana_transportasi,
            'sarana_komunikasi' => $sarana_komunikasi,
            'jumlah_dosen' => $jumlah_dosen,
            'jumlah_mahasiswa' => $jumlah_mahasiswa,
            'gelar_akademik_tim' => "$gelar_akademik_tim",
            'gender' => "$gender",
            'metode_pelaksanaan_kegiatan' => $metode_pelaksanaan_kegiatan,
            'waktu_efektif_pelaksanaan_kegiatan' => $waktu_efektif_pelaksanaan,
            'keberhasilan' => $keberhasilan,
            'keberlanjutan_kegiatan_mitra' => $keberlanjutan_kegiatan,
            'kapasitas_produksi' => "$kapasitas_produksi",
            'omzet_perbulan' => "$omzet_per_bulan",
            'persoalan_masyarakat_mitra' => $persoalan_masyarakat_mitra,
            'biaya_pnbp' => $biaya_pnbp,
            'biaya_sumber_lain' => $biaya_sumber_lain,
            'tahapan_pencairan_dana' => $tahap_pencairan_dana,
            'jumlah_dana' => $jumlah_dana,
            'peran_serta_mitra' => $peran_serta_mitra,
            'kontribusi_pendanaan' => $kontribusi_pendanaan,
            'peranan_mitra' => $peran_mitra,
            'alasan_kelanjutan_kegiatan' => $alasan_kelanjutan_kegiatan,
            'model_usulan_kegiatan' => $model_usulan_kegiatan,
            'anggaran_biaya' => $anggaran_biaya,
            'lain_lain' => $usul_lain_lain,
            'kegiatan_yang_dinilai' => $kegiatan_dinilai_bermanfaat,
            'potret_permasalahan' => $permasalahan_lain_terekam,
            'jasa' => $jasa,
            'metode' => $metode,
            'produk' => $produk,
            'paten' => $paten,
            'publikasi_artikel' => $publikasi_artikel,
            'publikasi_media_massa' => $publikasi_media_masa
        ];


        // Capaian_kegiatan::updateOrInsert(
        //     ['capaian_kegiatan_monev_id' => $monev_id->penilaian_monev_id],
        //     $data_insert
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
        } else {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Monev Tidak Ditemukan', //Alert Message 
                'Mohon Isi Monev Terlebih Dahulu' //Sub Alert Message
            );

            return redirect()->route('reviewer_monev');
        }

        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->join('pkm_skema_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'pkm_skema_pengabdian.skema_id')
            ->join('pkm_bidang_pengabdian', 'pkm_usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'pkm_bidang_pengabdian.bidang_id')
            ->join('users', 'pkm_usulan_pengabdian.usulan_pengabdian_reviewer_monev_id', '=', 'users.user_id')
            ->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'pkm_anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', '!=', 'ketua')
            ->orderBy('anggota_pengabdian_role', 'asc')
            ->get();

        $penilaian_monev = Penilaian_monev::where('penilaian_monev_pengabdian_id', $id)->first();

        $skor = json_decode($penilaian_monev->penilaian_monev_skor, true);
        $nilai = json_decode($penilaian_monev->penilaian_monev_nilai, true);
        $justifikasi = json_decode($penilaian_monev->penilaian_monev_justifikasi, true);

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
            'penilaian_monev' => $penilaian_monev,
            'id' => $id,
            'skor' => $skor,
            'justifikasi' => $justifikasi,
            'nilai' => $nilai,
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
