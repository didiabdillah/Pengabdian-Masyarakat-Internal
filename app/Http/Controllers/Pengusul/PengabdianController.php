<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Skema;
use App\Models\Bidang;
use App\Models\Usulan_pengabdian;
use App\Models\Anggota_pengabdian;
use App\Models\Dokumen_usulan;
use App\Models\Dokumen_rab;
use App\Models\Jenis_luaran;
use App\Models\Kategori_luaran;
use App\Models\Status_luaran;
use App\Models\Mitra_sasaran;
use App\Models\Mitra_file;
use App\Models\Usulan_luaran;
use App\Models\Lama_kegiatan;

class PengabdianController extends Controller
{
    public function index()
    {
        $usulan_pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) {
            $query->where('anggota_pengabdian_user_id', Session::get('user_id'));
        })
            ->where('usulan_pengabdian_tahun', date('Y'))
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $is_tambah_unlock = false;
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_usulan_pengabdian'));
        if ($tambah_unlock) {
            if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
                $is_tambah_unlock = true;
            }
        }

        $is_suspend = User::find(Session::get('user_id'))->user_ban;

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
            'is_tambah_unlock' => $is_tambah_unlock,
            'tambah_unlock' => $tambah_unlock,
            'is_suspend' => $is_suspend,
        ];

        return view('pengusul.pengabdian.index', $view_data);
    }

    public function riwayat()
    {
        $riwayat_pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) {
            $query->where('anggota_pengabdian_user_id', Session::get('user_id'));
        })
            ->where('usulan_pengabdian_tahun', '<', date('Y'))
            ->orderBy('usulan_pengabdian.created_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->get();

        $view_data = [
            'riwayat_pengabdian' => $riwayat_pengabdian,
        ];

        return view('pengusul.pengabdian.riwayat.riwayat', $view_data);
    }

    public function detail($id, $back_param)
    {
        $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $dokumen_usulan = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();

        $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
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
            ->join('skema_pengabdian', 'usulan_pengabdian.usulan_pengabdian_skema_id', '=', 'skema_pengabdian.skema_id')
            ->join('bidang_pengabdian', 'usulan_pengabdian.usulan_pengabdian_bidang_id', '=', 'bidang_pengabdian.bidang_id')
            ->first();

        $back_url = NULL;
        if ($back_param == 'usulan') {
            $back_url = route('pengusul_pengabdian');
        } elseif ($back_param == 'riwayat') {
            $back_url = route('pengusul_pengabdian_riwayat');
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
            'usulan' => $usulan,
        ];

        return view('pengusul.pengabdian.detail', $view_data);
    }

    public function tambah()
    {
        $skema = Skema::orderBy('skema_label', 'asc')->get();
        $bidang = Bidang::orderBy('bidang_label', 'asc')->get();
        $lama_kegiatan = Lama_kegiatan::orderBy('lama_kegiatan_tahun', 'asc')->get();

        return view('pengusul.pengabdian.tambah', ['skema' => $skema, 'bidang' => $bidang, 'lama_kegiatan' => $lama_kegiatan]);
    }

    public function hapus($id)
    {
        // Mitra Sasaran
        $mitra_sasaran = Mitra_sasaran::where('mitra_sasaran_pengabdian_id', $id)->get();
        if ($mitra_sasaran) {
            foreach ($mitra_sasaran as $mitra) {
                $mitra_file = $mitra->mitra_file()->where('mitra_file_mitra_sasaran_id', $mitra->mitra_sasaran_id)->get();
                if ($mitra_file) {
                    $dokumen_mitra_destination = "assets/file/dokumen_mitra/";
                    foreach ($mitra_file as $file) {
                        $dokumen_mitra_file_path = public_path($dokumen_mitra_destination . $file->mitra_sasaran_file_hash_name);
                        File::delete($dokumen_mitra_file_path);
                    }
                }
            }
        }

        // Dokumen RAB Pengabdian
        $dokumen_rab = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->first();
        if ($dokumen_rab) {
            $dokumen_rab_destination = "assets/file/dokumen_rab/";
            $dokumen_rab_file_path = public_path($dokumen_rab_destination . $dokumen_rab->dokumen_rab_hash_name);
            File::delete($dokumen_rab_file_path);
        }

        // Dokumen Usulan Pengabdian
        $dokumen_usulan = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();
        if ($dokumen_usulan) {
            $dokumen_usulan_destination = "assets/file/dokumen_usulan/";
            $dokumen_usulan_file_path = public_path($dokumen_usulan_destination . $dokumen_usulan->dokumen_usulan_hash_name);
            File::delete($dokumen_usulan_file_path);
        }

        // Usulan pengabdian
        Usulan_pengabdian::destroy('usulan_pengabdian_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Usulan Pengabdian Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian');
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate([
            'judul'  => 'required|max:255',
            // 'kategori'  => 'required',
            'skema'  => 'required',
            'bidang'  => 'required',
            'lama_kegiatan'  => 'required',
            'jumlah_mahasiswa'  => 'required|max:3|numeric',
        ]);

        $id = str_replace("-", "", Str::uuid()) . dechex(strtotime(now()));
        $judul = htmlspecialchars($request->judul);
        // $kategori = htmlspecialchars($request->kategori);
        $skema = htmlspecialchars($request->skema);
        $bidang = htmlspecialchars($request->bidang);
        $lama_kegiatan = htmlspecialchars($request->lama_kegiatan);
        $jumlah_mahasiswa = htmlspecialchars($request->jumlah_mahasiswa);

        //Insert Data Usulan Pengabdian
        $data = [
            'usulan_pengabdian_id' => $id,
            'usulan_pengabdian_judul' => $judul,
            // 'usulan_pengabdian_kategori' => $kategori,
            'usulan_pengabdian_skema_id' => $skema,
            'usulan_pengabdian_bidang_id' => $bidang,
            'usulan_pengabdian_tahun' => date('Y'),
            'usulan_pengabdian_lama_kegiatan' => $lama_kegiatan,
            'usulan_pengabdian_mahasiswa_terlibat' => $jumlah_mahasiswa,
            'usulan_pengabdian_submit' => 0,
            'usulan_pengabdian_status' => "pending",
            'komentar' => NULL,
        ];
        Usulan_pengabdian::create($data);

        //Insert Data Ketua
        $data_anggota = [
            'anggota_pengabdian_user_id' => $request->session()->get('user_id'),
            'anggota_pengabdian_pengabdian_id' => $id,
            'anggota_pengabdian_role' => 'ketua',
            'anggota_pengabdian_role_position' => 0,
            'anggota_pengabdian_tugas' => NULL,
        ];
        Anggota_pengabdian::create($data_anggota);

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function update(Request $request, $id)
    {
        // Input Validation
        $request->validate([
            'judul'  => 'required|max:255',
            // 'kategori'  => 'required',
            'skema'  => 'required',
            'bidang'  => 'required',
            'lama_kegiatan'  => 'required',
            'jumlah_mahasiswa'  => 'required|max:3|numeric',
        ]);

        $judul = htmlspecialchars($request->judul);
        // $kategori = htmlspecialchars($request->kategori);
        $skema = htmlspecialchars($request->skema);
        $bidang = htmlspecialchars($request->bidang);
        $lama_kegiatan = htmlspecialchars($request->lama_kegiatan);
        $jumlah_mahasiswa = htmlspecialchars($request->jumlah_mahasiswa);

        //Insert Data Usulan Pengabdian
        $data = [
            'usulan_pengabdian_judul' => $judul,
            // 'usulan_pengabdian_kategori' => $kategori,
            'usulan_pengabdian_skema_id' => $skema,
            'usulan_pengabdian_bidang_id' => $bidang,
            'usulan_pengabdian_tahun' => date('Y'),
            'usulan_pengabdian_lama_kegiatan' => $lama_kegiatan,
            'usulan_pengabdian_mahasiswa_terlibat' => $jumlah_mahasiswa,
        ];
        Usulan_pengabdian::where('usulan_pengabdian_id', $id)->update($data);

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function usulan($page, $id)
    {
        $role_access = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->where('anggota_pengabdian_user_id', Session::get('user_id'))
            ->first();

        if ($role_access) {
            if ($role_access->anggota_pengabdian_role != "ketua") {
                return redirect()->route('pengusul_pengabdian');
            }
        } else {
            return redirect()->route('not_found');
        }

        // HALAMAN 1
        if ($page == 1) {
            $skema = Skema::orderBy('skema_label', 'asc')->get();
            $bidang = Bidang::orderBy('bidang_label', 'asc')->get();
            $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)->first();
            $lama_kegiatan = Lama_kegiatan::orderBy('lama_kegiatan_tahun', 'asc')->get();

            $view_data = [
                'skema' => $skema,
                'bidang' => $bidang,
                'usulan' => $usulan,
                'page' => $page,
                'id' => $id,
                'lama_kegiatan' => $lama_kegiatan,
            ];

            return view('pengusul.pengabdian.usulan_1', $view_data);

            // HALAMAN 2
        } elseif ($page == 2) {
            $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
                ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
                ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
                ->where('anggota_pengabdian_role', '!=', 'ketua')
                ->orderBy('anggota_pengabdian_role_position', 'asc')
                ->get();

            $view_data = [
                'anggota' => $anggota,
                'id' => $id,
                'page' => $page,
            ];

            return view('pengusul.pengabdian.usulan_2', $view_data);

            // HALAMAN 3
        } elseif ($page == 3) {
            $dokumen_info = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();
            $template = get_where_local_db_json("template_dokumen.json", "name", __('template.dokumen_usulan'));

            $view_data = [
                'id' => $id,
                'page' => $page,
                'dokumen_info' => $dokumen_info,
                'template' => $template,
            ];

            return view('pengusul.pengabdian.usulan_3', $view_data);

            // HALAMAN 4
        } elseif ($page == 4) {

            $luaran_wajib = Usulan_luaran::where('usulan_luaran_pengabdian_id', $id)
                ->where('usulan_luaran_pengabdian_tipe', 'wajib')
                ->orderBy('usulan_luaran_pengabdian_tahun', 'asc')
                ->get();

            $luaran_tambahan = Usulan_luaran::where('usulan_luaran_pengabdian_id', $id)
                ->where('usulan_luaran_pengabdian_tipe', 'tambahan')
                ->orderBy('usulan_luaran_pengabdian_tahun', 'asc')
                ->get();

            $view_data = [
                'id' => $id,
                'page' => $page,
                'luaran_wajib' => $luaran_wajib,
                'luaran_tambahan' => $luaran_tambahan,
            ];

            return view('pengusul.pengabdian.usulan_4', $view_data);

            // HALAMAN 5
        } elseif ($page == 5) {
            $dokumen_info = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->first();
            $template = get_where_local_db_json("template_dokumen.json", "name", __('template.dokumen_rab'));

            $view_data = [
                'id' => $id,
                'page' => $page,
                'dokumen_info' => $dokumen_info,
                'template' => $template,
            ];

            return view('pengusul.pengabdian.usulan_5', $view_data);

            // HALAMAN 6
        } elseif ($page == 6) {
            $mitra_sasaran = Mitra_sasaran::where('mitra_sasaran_pengabdian_id', $id)
                ->orderBy('created_at', 'asc')
                ->get();

            $view_data = [
                'id' => $id,
                'page' => $page,
                'mitra_sasaran' => $mitra_sasaran,
            ];

            return view('pengusul.pengabdian.usulan_6', $view_data);

            // HALAMAN 7
        } elseif ($page == 7) {
            $ketua = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
                ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
                ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
                ->where('anggota_pengabdian_role', 'ketua')
                ->first();

            $dokumen_usulan = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();

            $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
                ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
                ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
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

            $view_data = [
                'mitra_sasaran' => $mitra_sasaran,
                'dokumen_rab' => $dokumen_rab,
                'anggota' => $anggota,
                'dokumen_usulan' => $dokumen_usulan,
                'ketua' => $ketua,
                'id' => $id,
                'page' => $page,
                'luaran_wajib' => $luaran_wajib,
                'luaran_tambahan' => $luaran_tambahan,
            ];

            return view('pengusul.pengabdian.usulan_7', $view_data);

            // HALAMAN TIDAK TERSEDIA
        } else {
            return redirect()->route('pengusul_pengabdian');
        }
    }

    public function tambah_anggota(Request $request, $id)
    {
        $nidn = $request->input('nidn');
        $result = NULL;
        $anggota1 = NULL;
        $anggota2 = NULL;

        if ($nidn) {
            // Get User Data
            $user = User::where('user_nidn', $nidn)
                ->where('user_role', 'pengusul')
                ->first();

            if ($user) {
                // Get User ID
                $user_id = $user->user_id;

                $result = $user;

                // Cek Apakah User Sudah Terdaftar Di Usulan Ini
                $query = Anggota_pengabdian::where([['anggota_pengabdian_pengabdian_id', $id], ['anggota_pengabdian_user_id', $user_id]])->count();
                if ($query > 0) {
                    $result = NULL;

                    //Flash Message
                    flash_alert(
                        __('alert.icon_error'), //Icon
                        'Gagal', //Alert Message 
                        'Nama Pengusul Sudah Masuk Usulan Kelompok Ini' //Sub Alert Message
                    );
                }

                //Cek Apakah User Ketua Di Usulan Lain Dan Sudah Terdaftar 1x Di Usulan Lain Di tahun Ini
                $jadi_ketua = Anggota_pengabdian::join('usulan_pengabdian', 'anggota_pengabdian.anggota_pengabdian_pengabdian_id', '=', 'usulan_pengabdian.usulan_pengabdian_id')
                    ->where('usulan_pengabdian.usulan_pengabdian_tahun', date('Y'))
                    ->where('anggota_pengabdian.anggota_pengabdian_pengabdian_id', '!=', $id)
                    ->where('anggota_pengabdian_user_id', $user_id)
                    ->where('anggota_pengabdian_role', 'ketua')
                    ->count();

                $jadi_anggota = Anggota_pengabdian::join('usulan_pengabdian', 'anggota_pengabdian.anggota_pengabdian_pengabdian_id', '=', 'usulan_pengabdian.usulan_pengabdian_id')
                    ->where('usulan_pengabdian.usulan_pengabdian_tahun', date('Y'))
                    ->where('anggota_pengabdian.anggota_pengabdian_pengabdian_id', '!=', $id)
                    ->where('anggota_pengabdian_user_id', $user_id)
                    ->where('anggota_pengabdian_role', 'anggota')
                    ->count();

                if ($jadi_ketua > 0 && $jadi_anggota > 0) {
                    $result = NULL;

                    //Flash Message
                    flash_alert(
                        __('alert.icon_error'), //Icon
                        'Gagal', //Alert Message 
                        'Nama Pengusul Sudah Mencapai Batas Masuk Usulan Kelompok Lain' //Sub Alert Message
                    );
                }

                $anggota1 = Anggota_pengabdian::where([['anggota_pengabdian_pengabdian_id', $id], ['anggota_pengabdian_role', 'anggota'], ['anggota_pengabdian_role_position', 1]])->first();
                $anggota2 = Anggota_pengabdian::where([['anggota_pengabdian_pengabdian_id', $id], ['anggota_pengabdian_role', 'anggota'], ['anggota_pengabdian_role_position', 2]])->first();
            } else {
                $result = NULL;

                //Flash Message
                flash_alert(
                    __('alert.icon_error'), //Icon
                    'Gagal', //Alert Message 
                    'Nama Pengusul Tidak Ditemukan' //Sub Alert Message
                );
            }
        }

        $view_data = [
            'id' => $id,
            'result' => $result,
            'anggota1' => $anggota1,
            'anggota2' => $anggota2,
        ];

        return view('pengusul.pengabdian.tambah_anggota', $view_data);
    }

    public function store_anggota(Request $request, $id)
    {
        // Input Validation
        $request->validate([
            'user_id'  => 'required',
            'peran'  => 'required',
            'tugas'  => 'required|max:1024',
        ]);

        $user_id = htmlspecialchars($request->user_id);
        $peran = 'anggota';
        $tugas = htmlspecialchars($request->tugas);

        $position = intval(str_replace("anggota", "", htmlspecialchars($request->peran)));

        //Insert Data Anggota Pengabdian
        $data = [
            'anggota_pengabdian_user_id' => $user_id,
            'anggota_pengabdian_pengabdian_id' => $id,
            'anggota_pengabdian_role' => $peran,
            'anggota_pengabdian_role_position' => $position,
            'anggota_pengabdian_tugas' => $tugas,
        ];
        Anggota_pengabdian::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Anggota Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function tambah_mitra($id)
    {
        $provinsi = DB::table('wilayah_provinsi')->get();

        $view_data = [
            'id' => $id,
            'provinsi' => $provinsi,
        ];

        return view('pengusul.pengabdian.tambah_mitra', $view_data);
    }

    public function store_tambah_mitra(Request $request, $id)
    {
        // Input Validation
        $request->validate([
            'tipe_mitra'  => 'required',
            'jenis_mitra'  => 'required',
            'nama_pimpinan'  => 'required|max:255',
            'jabatan_pimpinan'  => 'required|max:255',
            'nama_mitra'  => 'required|max:255',
            'alamat_mitra'  => 'required|max:255',
            'provinsi'  => 'required',
            'kabupaten'  => 'required',
            'kecamatan'  => 'required',
            'desa'  => 'required',
            'jarak_mitra'  => 'required|max:11',
            'bidang_masalah'  => 'required|max:60000',
            'kontribusi_pendanaan'  => 'required|max:20',
        ]);

        $tipe_mitra = htmlspecialchars($request->tipe_mitra);
        $jenis_mitra = htmlspecialchars($request->jenis_mitra);
        $nama_pimpinan = htmlspecialchars($request->nama_pimpinan);
        $jabatan_pimpinan = htmlspecialchars($request->jabatan_pimpinan);
        $nama_mitra = htmlspecialchars($request->nama_mitra);
        $alamat_mitra = htmlspecialchars($request->alamat_mitra);
        $provinsi = htmlspecialchars($request->provinsi);
        $kabupaten = htmlspecialchars($request->kabupaten);
        $kecamatan = htmlspecialchars($request->kecamatan);
        $desa = htmlspecialchars($request->desa);
        $jarak_mitra = htmlspecialchars($request->jarak_mitra);
        $bidang_masalah = htmlspecialchars($request->bidang_masalah);
        $kontribusi_pendanaan = htmlspecialchars($request->kontribusi_pendanaan);

        //Insert Data Anggota Pengabdian
        $data = [
            'mitra_sasaran_pengabdian_id' => $id,
            'mitra_sasaran_tipe_mitra' => $tipe_mitra,
            'mitra_sasaran_jenis_mitra' => $jenis_mitra,
            'mitra_sasaran_nama_pimpinan_mitra' => $nama_pimpinan,
            'mitra_sasaran_jabatan_pimpinan_mitra' => $jabatan_pimpinan,
            'mitra_sasaran_nama_mitra' => $nama_mitra,
            'mitra_sasaran_alamat_mitra' => $alamat_mitra,
            'mitra_sasaran_provinsi_mitra' => $provinsi,
            'mitra_sasaran_kota_mitra' => $kabupaten,
            'mitra_sasaran_kecamatan_mitra' => $kecamatan,
            'mitra_sasaran_desa_mitra' => $desa,
            'mitra_sasaran_jarak_mitra' => $jarak_mitra,
            'mitra_sasaran_bidang_masalah_mitra' => $bidang_masalah,
            'mitra_sasaran_kontribusi_pendanaan_mitra' => $kontribusi_pendanaan,
        ];
        Mitra_sasaran::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Mitra Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [6, $id]);
    }

    public function upload_dokumen_mitra(Request $request, $id)
    {
        $file = NULL;
        $category = NULL;
        // $destination = NULL;

        // Input Validation
        if ($request->doc_category == 'dokumen1') {
            $request->validate(
                [
                    'dokumen_mitra' => 'required|mimes:pdf|max:10000',
                ],
                [
                    'dokumen_mitra.mimes' => 'Tipe File Harus PDF'
                ]
            );

            $file = $request->file('dokumen_mitra');
            $category = "dokumen1";
            // $destination = "assets/file/dokumen_mitra/dokumen1/";
        } elseif ($request->doc_category == 'dokumen2') {
            $request->validate(
                [
                    'dokumen_mitra2' => 'required|mimes:pdf|max:10000',
                ],
                [
                    'dokumen_mitra2.mimes' => 'Tipe File Harus PDF'
                ]
            );

            $file = $request->file('dokumen_mitra2');
            $category = "dokumen2";
            // $destination = "assets/file/dokumen_mitra/dokumen2/";
        }

        $destination = "assets/file/dokumen_mitra/";
        $id = $request->mitra_id;
        $file_original_name = $file->getClientOriginalName();
        $file_hash_name = $file->hashName();
        $file_base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_size = intval($file->getSize() / 1024);
        $file_extension = $file->getClientOriginalExtension();

        $is_exist = Mitra_file::where('mitra_file_mitra_sasaran_id', $id)
            ->where('mitra_file_kategori', $category)
            ->count();

        if ($is_exist > 0) {
            $fileOld =  Mitra_file::where('mitra_file_mitra_sasaran_id', $id)
                ->where('mitra_file_kategori', $category)
                ->first();

            $file_path = public_path($destination . $fileOld->mitra_sasaran_file_hash_name);

            $file->move($destination, $file->hashName());

            File::delete($file_path);
        } else {
            $file->move($destination, $file->hashName());
        }

        //Update Data
        $data = [
            'mitra_file_mitra_sasaran_id' => $id,
            'mitra_file_kategori' => $category,
            'mitra_sasaran_file_original_name' => $file_original_name,
            'mitra_sasaran_file_hash_name' => $file_hash_name,
            'mitra_sasaran_file_base_name' => $file_base_name,
            'mitra_sasaran_file_size' => $file_size,
            'mitra_sasaran_file_extension' => $file_extension,
            'mitra_sasaran_file_date' => date('Y-m-d'),
        ];

        Mitra_file::updateOrInsert(
            ['mitra_file_mitra_sasaran_id' => $id, 'mitra_file_kategori' => $category],
            $data
        );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Dokumen Terunggah' //Sub Alert Message
        );


        return redirect()->back();
    }

    public function edit_mitra($id, $editid)
    {

        $mitra_sasaran = Mitra_sasaran::select(
            'mitra_sasaran_id',
            'mitra_sasaran_tipe_mitra',
            'mitra_sasaran_jenis_mitra',
            'mitra_sasaran_nama_pimpinan_mitra',
            'mitra_sasaran_jabatan_pimpinan_mitra',
            'mitra_sasaran_nama_mitra',
            'mitra_sasaran_alamat_mitra',
            'mitra_sasaran_provinsi_mitra',
            'mitra_sasaran_kota_mitra',
            'mitra_sasaran_kecamatan_mitra',
            'mitra_sasaran_desa_mitra',
            'mitra_sasaran_jarak_mitra',
            'mitra_sasaran_bidang_masalah_mitra',
            'mitra_sasaran_kontribusi_pendanaan_mitra'
        )->where('mitra_sasaran_id', $editid)
            ->first();

        $provinsi = DB::table('wilayah_provinsi')->get();
        $kabupaten = DB::table('wilayah_kabupaten')->where('provinsi_id', $mitra_sasaran->mitra_sasaran_provinsi_mitra)->get();
        $kecamatan = DB::table('wilayah_kecamatan')->where('kabupaten_id', $mitra_sasaran->mitra_sasaran_kota_mitra)->get();
        $desa = DB::table('wilayah_desa')->where('kecamatan_id', $mitra_sasaran->mitra_sasaran_kecamatan_mitra)->get();

        $view_data = [
            'id' => $id,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'mitra' => $mitra_sasaran,
        ];

        return view('pengusul.pengabdian.edit_mitra', $view_data);
    }

    public function update_mitra(Request $request, $id, $editid)
    {
        // Input Validation
        $request->validate([
            'tipe_mitra'  => 'required',
            'jenis_mitra'  => 'required',
            'nama_pimpinan'  => 'required|max:255',
            'jabatan_pimpinan'  => 'required|max:255',
            'nama_mitra'  => 'required|max:255',
            'alamat_mitra'  => 'required|max:255',
            'provinsi'  => 'required',
            'kabupaten'  => 'required',
            'kecamatan'  => 'required',
            'desa'  => 'required',
            'jarak_mitra'  => 'required|max:11',
            'bidang_masalah'  => 'required|max:60000',
            'kontribusi_pendanaan'  => 'required|max:20',
        ]);

        $tipe_mitra = htmlspecialchars($request->tipe_mitra);
        $jenis_mitra = htmlspecialchars($request->jenis_mitra);
        $nama_pimpinan = htmlspecialchars($request->nama_pimpinan);
        $jabatan_pimpinan = htmlspecialchars($request->jabatan_pimpinan);
        $nama_mitra = htmlspecialchars($request->nama_mitra);
        $alamat_mitra = htmlspecialchars($request->alamat_mitra);
        $provinsi = htmlspecialchars($request->provinsi);
        $kabupaten = htmlspecialchars($request->kabupaten);
        $kecamatan = htmlspecialchars($request->kecamatan);
        $desa = htmlspecialchars($request->desa);
        $jarak_mitra = htmlspecialchars($request->jarak_mitra);
        $bidang_masalah = htmlspecialchars($request->bidang_masalah);
        $kontribusi_pendanaan = htmlspecialchars($request->kontribusi_pendanaan);

        //Insert Data Anggota Pengabdian
        $data = [
            'mitra_sasaran_tipe_mitra' => $tipe_mitra,
            'mitra_sasaran_jenis_mitra' => $jenis_mitra,
            'mitra_sasaran_nama_pimpinan_mitra' => $nama_pimpinan,
            'mitra_sasaran_jabatan_pimpinan_mitra' => $jabatan_pimpinan,
            'mitra_sasaran_nama_mitra' => $nama_mitra,
            'mitra_sasaran_alamat_mitra' => $alamat_mitra,
            'mitra_sasaran_provinsi_mitra' => $provinsi,
            'mitra_sasaran_kota_mitra' => $kabupaten,
            'mitra_sasaran_kecamatan_mitra' => $kecamatan,
            'mitra_sasaran_desa_mitra' => $desa,
            'mitra_sasaran_jarak_mitra' => $jarak_mitra,
            'mitra_sasaran_bidang_masalah_mitra' => $bidang_masalah,
            'mitra_sasaran_kontribusi_pendanaan_mitra' => $kontribusi_pendanaan,
        ];
        Mitra_sasaran::where('mitra_sasaran_id', $editid)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Mitra Diperbaharui' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [6, $id]);
    }

    public function hapus_mitra($id, $removeid)
    {
        $destination = "assets/file/dokumen_mitra/";

        $data =  Mitra_file::where('mitra_file_mitra_sasaran_id', $removeid)->get();

        foreach ($data as $fileOld) {
            $file_path = public_path($destination . $fileOld->mitra_sasaran_file_hash_name);

            File::delete($file_path);
        }

        Mitra_sasaran::destroy('mitra_sasaran_id', $removeid);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Mitra Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [6, $id]);
    }

    public function upload_dokumen(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'dokumen_usulan' => 'required|mimes:pdf,doc,docx|max:10000',
            ],
            [
                'dokumen_usulan.mimes' => 'Tipe File Harus PDF Atau Word'
            ]
        );

        $file = $request->file('dokumen_usulan');
        $destination = "assets/file/dokumen_usulan/";

        $is_exist = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->count();

        if ($is_exist > 0) {
            $fileOld =  Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();
            $file_path = public_path($destination . $fileOld->dokumen_usulan_hash_name);

            //Update Data
            $data = [
                'dokumen_usulan_original_name' => $file->getClientOriginalName(),
                'dokumen_usulan_hash_name' => $file->hashName(),
                'dokumen_usulan_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'dokumen_usulan_file_size' => intval($file->getSize() / 1024),
                'dokumen_usulan_extension' => $file->getClientOriginalExtension(),
            ];

            Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)
                ->update($data);

            $file->move($destination, $file->hashName());

            File::delete($file_path);

            //Flash Message
            flash_alert(
                __('alert.icon_success'), //Icon
                'Sukses', //Alert Message 
                'Dokumen Diperbaharui' //Sub Alert Message
            );
        } else {
            //Insert Data
            $data = [
                'dokumen_usulan_pengabdian_id' => $id,
                'dokumen_usulan_original_name' => $file->getClientOriginalName(),
                'dokumen_usulan_hash_name' => $file->hashName(),
                'dokumen_usulan_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'dokumen_usulan_file_size' => intval($file->getSize() / 1024),
                'dokumen_usulan_extension' => $file->getClientOriginalExtension(),
            ];

            Dokumen_usulan::create($data);

            $file->move($destination, $file->hashName());

            //Flash Message
            flash_alert(
                __('alert.icon_success'), //Icon
                'Sukses', //Alert Message 
                'Dokumen Ditambahkan' //Sub Alert Message
            );
        }

        return redirect()->route('pengusul_pengabdian_usulan', [3, $id]);
    }

    public function upload_rab(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'dokumen_rab' => 'required|mimes:xls,xlsx|max:10000',
            ],
            [
                'dokumen_rab.mimes' => 'Tipe File Harus Excel'
            ]
        );

        $file = $request->file('dokumen_rab');
        $destination = "assets/file/dokumen_rab/";

        $is_exist = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->count();

        if ($is_exist > 0) {
            $fileOld =  Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->first();
            $file_path = public_path($destination . $fileOld->dokumen_rab_hash_name);

            //Update Data
            $data = [
                'dokumen_rab_original_name' => $file->getClientOriginalName(),
                'dokumen_rab_hash_name' => $file->hashName(),
                'dokumen_rab_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'dokumen_rab_file_size' => intval($file->getSize() / 1024),
                'dokumen_rab_extension' => $file->getClientOriginalExtension(),
            ];

            Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)
                ->update($data);

            $file->move($destination, $file->hashName());

            File::delete($file_path);

            //Flash Message
            flash_alert(
                __('alert.icon_success'), //Icon
                'Sukses', //Alert Message 
                'Dokumen Diperbaharui' //Sub Alert Message
            );
        } else {
            //Insert Data
            $data = [
                'dokumen_rab_pengabdian_id' => $id,
                'dokumen_rab_original_name' => $file->getClientOriginalName(),
                'dokumen_rab_hash_name' => $file->hashName(),
                'dokumen_rab_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'dokumen_rab_file_size' => intval($file->getSize() / 1024),
                'dokumen_rab_extension' => $file->getClientOriginalExtension(),
            ];

            Dokumen_rab::create($data);

            $file->move($destination, $file->hashName());

            //Flash Message
            flash_alert(
                __('alert.icon_success'), //Icon
                'Sukses', //Alert Message 
                'Dokumen Ditambahkan' //Sub Alert Message
            );
        }

        return redirect()->route('pengusul_pengabdian_usulan', [5, $id]);
    }

    public function remove_anggota($id, $removeid)
    {
        Anggota_pengabdian::destroy('anggota_pengabdian_id', $removeid);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Anggota Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function usulan_submit(Request $request, $id)
    {
        $submit_pass = true;

        // Cek Apakah Form Dan Dokumen Lengkap
        // cek dokumen usulan
        $dokumen_usulan = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->count();
        if ($dokumen_usulan <= 0) {
            $submit_pass = false;
        }
        // cek dokumen rab
        $dokumen_rab = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->count();
        if ($dokumen_rab <= 0) {
            $submit_pass = false;
        }
        // cek ada anggota
        $anggota_pengabdian = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)->count();
        if ($anggota_pengabdian <= 0) {
            $submit_pass = false;
        }
        // cek ada mitra
        $mitra = Mitra_sasaran::where('mitra_sasaran_pengabdian_id', $id)->get();
        if ($mitra->count() <= 0) {
            $submit_pass = false;
        } else {
            // cek mitra file
            foreach ($mitra as $data) {
                $mitra_file = Mitra_file::where('mitra_file_mitra_sasaran_id', $data->mitra_sasaran_id)->count();

                if ($mitra_file <= 0) {
                    $submit_pass = false;
                }
            }
        }

        // Check is submit pass false
        if ($submit_pass == false) {
            //Flash Message
            flash_alert(
                __('alert.icon_error'), //Icon
                'Gagal Kirim Usulan', //Alert Message 
                'Mohon Lengakpi Isian Form Usulan Dan Dokumen' //Sub Alert Message
            );
            return redirect()->back();
        }

        // Update
        $data = [
            'usulan_pengabdian_status' => 'dikirim',
            'usulan_pengabdian_submit' => true,
        ];

        Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Usulan pengabdian Terkirim' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian');
    }

    public function get_kabupaten(Request $request)
    {
        $kabupaten = DB::table('wilayah_kabupaten')->where('provinsi_id', $request->id_provinsi)->get();
        $old_kabupaten = ($request->id_kabupaten) ? $request->id_kabupaten : NULL;

        return view('pengusul.pengabdian.wilayah_list.list_kabupaten', ['kabupaten' => $kabupaten, 'old_kabupaten' => $old_kabupaten]);
    }

    public function get_kecamatan(Request $request)
    {
        $kecamatan = DB::table('wilayah_kecamatan')->where('kabupaten_id', $request->id_kabupaten)->get();
        $old_kecamatan = ($request->id_kecamatan) ? $request->id_kecamatan : NULL;

        return view('pengusul.pengabdian.wilayah_list.list_kecamatan', ['kecamatan' => $kecamatan, 'old_kecamatan' => $old_kecamatan]);
    }

    public function get_desa(Request $request)
    {
        $desa = DB::table('wilayah_desa')->where('kecamatan_id', $request->id_kecamatan)->get();
        $old_desa = ($request->id_desa) ? $request->id_desa : NULL;

        return view('pengusul.pengabdian.wilayah_list.list_desa', ['desa' => $desa, 'old_desa' => $old_desa]);
    }

    // LUARAN
    public function tambah_luaran($id, $tipe)
    {
        $tahun_kegiatan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)->first()->usulan_pengabdian_lama_kegiatan;
        $kategori = Kategori_luaran::where('kategori_luaran_required', $tipe)->get();
        $lama_kegiatan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)->first();

        $view_data = [
            'id' => $id,
            'tahun_kegiatan' => $tahun_kegiatan,
            'kategori' => $kategori,
            'tipe' => $tipe,
            'lama_kegiatan' => $lama_kegiatan,
        ];

        return view('pengusul.pengabdian.luaran.tambah_luaran', $view_data);
    }

    public function store_luaran(Request $request, $id, $tipe)
    {
        // Input Validation
        $request->validate([
            'tahun'  => 'required',
            'kategori'  => 'required',
            'jenis'  => 'required',
            'rencana'  => 'required|max:255',
            'status'  => 'required',
        ]);

        $tahun = htmlspecialchars($request->tahun);
        $kategori = Kategori_luaran::where('kategori_luaran_id', htmlspecialchars($request->kategori))->first();
        $jenis = Jenis_luaran::where('jenis_luaran_id', htmlspecialchars($request->jenis))->first();
        $rencana = htmlspecialchars($request->rencana);
        $status = Status_luaran::where('status_luaran_id', htmlspecialchars($request->status))->first();

        $data = [
            'usulan_luaran_pengabdian_id' => $id,
            'usulan_luaran_pengabdian_tipe' => $tipe,
            'usulan_luaran_pengabdian_tahun' => $tahun,
            'usulan_luaran_pengabdian_kategori' => ($kategori) ? $kategori->kategori_luaran_label : NULL,
            'usulan_luaran_pengabdian_jenis' => ($jenis) ? $jenis->jenis_luaran_label : NULL,
            'usulan_luaran_pengabdian_rencana' => $rencana,
            'usulan_luaran_pengabdian_status' => ($status) ? $status->status_luaran_label : NULL,
        ];

        Usulan_luaran::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Luaran Sukses Ditambahkan', //Alert Message 
            'Luaran ' . $tipe . ' ditambahkan'  //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [4, $id]);
    }

    public function edit_luaran($id, $luaran_id, $tipe)
    {
        $luaran = Usulan_luaran::where('usulan_luaran_id', $luaran_id)
            ->first();

        $tipe = $luaran->usulan_luaran_pengabdian_tipe;
        $page = $luaran->usulan_luaran_pengabdian_urutan;

        $view_data = [
            'id' => $id,
            'luaran' => $luaran,
        ];

        if ($tipe == "wajib") {
            if ($page == 1) {
                return view('pengusul.pengabdian.luaran.ubah_luaran_wajib1', $view_data);
            } elseif ($page == 2) {
                return view('pengusul.pengabdian.luaran.ubah_luaran_wajib2', $view_data);
            } elseif ($page == 3) {
                return view('pengusul.pengabdian.luaran.ubah_luaran_wajib3', $view_data);
            } elseif ($page == 4) {
                return view('pengusul.pengabdian.luaran.ubah_luaran_wajib4', $view_data);
            }
        } elseif ($tipe == "tambahan") {
            return view('pengusul.pengabdian.luaran.ubah_luaran_tambahan', $view_data);
        }
    }

    public function update_luaran(Request $request, $id, $luaran_id, $tipe)
    {
        // Input Validation
        $request->validate([
            'tahun'  => 'required',
            'kategori'  => 'required',
            'jenis'  => 'required',
            'rencana'  => 'required|max:255',
            'status'  => 'required',
        ]);

        $tahun = htmlspecialchars($request->tahun);
        $kategori = htmlspecialchars($request->kategori);
        $jenis = htmlspecialchars($request->jenis);
        $rencana = htmlspecialchars($request->rencana);
        $status = htmlspecialchars($request->status);

        $data = [
            'usulan_luaran_pengabdian_tahun' => $tahun,
            'usulan_luaran_pengabdian_kategori' => $kategori,
            'usulan_luaran_pengabdian_jenis' => $jenis,
            'usulan_luaran_pengabdian_rencana' => $rencana,
            'usulan_luaran_pengabdian_status' => $status,
        ];

        Usulan_luaran::where('usulan_luaran_id', $luaran_id)
            ->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Luaran Sukses Diubah', //Alert Message 
            'Luaran diubah'  //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [4, $id]);
    }

    public function destroy_luaran($id, $luaran_id)
    {
        Usulan_luaran::destroy('usulan_luaran_id', $luaran_id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Usulan Luaran Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [4, $id]);
    }

    public function get_luaran_jenis(Request $request)
    {
        $jenis = Jenis_luaran::where('jenis_luaran_kategori_id', $request->id_kategori)->get();
        $old_jenis = ($request->id_jenis) ? $request->id_jenis : NULL;

        return view('pengusul.pengabdian.luaran.list_jenis', ['jenis' => $jenis, 'old_jenis' => $old_jenis]);
    }

    public function get_luaran_status(Request $request)
    {
        $status = Status_luaran::where('status_luaran_kategori_id', $request->id_kategori)->get();
        $old_status = ($request->id_status) ? $request->id_status : NULL;

        return view('pengusul.pengabdian.luaran.list_status', ['status' => $status, 'old_status' => $old_status]);
    }
}
