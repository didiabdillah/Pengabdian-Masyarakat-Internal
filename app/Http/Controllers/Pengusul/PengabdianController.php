<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Skema;
use App\Models\Bidang;
use App\Models\Usulan_pengabdian;
use App\Models\Anggota_pengabdian;
use App\Models\Dokumen_usulan;
use App\Models\Dokumen_rab;
use App\Models\Mitra_sasaran;

class PengabdianController extends Controller
{
    public function index()
    {
        $usulan_pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) {
            $query->where('anggota_pengabdian_user_id', Session::get('user_id'));
        })
            // ->where('usulan_pengabdian_status', 'pending')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->get();

        return view('pengusul.pengabdian.index', ['usulan_pengabdian' => $usulan_pengabdian]);
    }

    public function tambah()
    {
        $skema = Skema::orderBy('skema_label', 'asc')->get();
        $bidang = Bidang::orderBy('bidang_label', 'asc')->get();

        return view('pengusul.pengabdian.tambah', ['skema' => $skema, 'bidang' => $bidang]);
    }

    public function store(Request $request)
    {
        // Input Validation
        $request->validate([
            'judul'  => 'required|max:255',
            'kategori'  => 'required',
            'skema'  => 'required',
            'bidang'  => 'required',
            'lama_kegiatan'  => 'required',
            'jumlah_mahasiswa'  => 'required|max:3',
        ]);

        $id = hexdec(uniqid()) . strtotime(now());
        $judul = htmlspecialchars($request->judul);
        $kategori = htmlspecialchars($request->kategori);
        $skema = htmlspecialchars($request->skema);
        $bidang = htmlspecialchars($request->bidang);
        $lama_kegiatan = htmlspecialchars($request->lama_kegiatan);
        $jumlah_mahasiswa = htmlspecialchars($request->jumlah_mahasiswa);

        //Insert Data Usulan Pengabdian
        $data = [
            'usulan_pengabdian_id' => $id,
            'usulan_pengabdian_judul' => $judul,
            'usulan_pengabdian_kategori' => $kategori,
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
            'kategori'  => 'required',
            'skema'  => 'required',
            'bidang'  => 'required',
            'lama_kegiatan'  => 'required',
            'jumlah_mahasiswa'  => 'required|max:3',
        ]);

        $judul = htmlspecialchars($request->judul);
        $kategori = htmlspecialchars($request->kategori);
        $skema = htmlspecialchars($request->skema);
        $bidang = htmlspecialchars($request->bidang);
        $lama_kegiatan = htmlspecialchars($request->lama_kegiatan);
        $jumlah_mahasiswa = htmlspecialchars($request->jumlah_mahasiswa);

        //Insert Data Usulan Pengabdian
        $data = [
            'usulan_pengabdian_judul' => $judul,
            'usulan_pengabdian_kategori' => $kategori,
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

        if ($role_access->anggota_pengabdian_role != "ketua") {
            return redirect()->route('pengusul_pengabdian');
        }


        if ($page == 1) {
            $skema = Skema::orderBy('skema_label', 'asc')->get();
            $bidang = Bidang::orderBy('bidang_label', 'asc')->get();
            $usulan = Usulan_pengabdian::where('usulan_pengabdian_id', $id)->first();

            $view_data = [
                'skema' => $skema,
                'bidang' => $bidang,
                'usulan' => $usulan,
                'page' => $page,
                'id' => $id,
            ];

            return view('pengusul.pengabdian.usulan_1', $view_data);
        } elseif ($page == 2) {
            $anggota = Anggota_pengabdian::where('anggota_pengabdian_pengabdian_id', $id)
                ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
                ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
                ->where('anggota_pengabdian_role', '!=', 'ketua')
                ->orderBy('anggota_pengabdian_role', 'asc')
                ->get();

            $view_data = [
                'anggota' => $anggota,
                'id' => $id,
                'page' => $page,
            ];

            return view('pengusul.pengabdian.usulan_2', $view_data);
        } elseif ($page == 3) {
            $dokumen_info = Dokumen_usulan::where('dokumen_usulan_pengabdian_id', $id)->first();

            $view_data = [
                'id' => $id,
                'page' => $page,
                'dokumen_info' => $dokumen_info,
            ];

            return view('pengusul.pengabdian.usulan_3', $view_data);
        } elseif ($page == 4) {
            $view_data = [
                'id' => $id,
                'page' => $page,
            ];

            return view('pengusul.pengabdian.usulan_4', $view_data);
        } elseif ($page == 5) {
            $dokumen_info = Dokumen_rab::where('dokumen_rab_pengabdian_id', $id)->first();

            $view_data = [
                'id' => $id,
                'page' => $page,
                'dokumen_info' => $dokumen_info,
            ];

            return view('pengusul.pengabdian.usulan_5', $view_data);
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

            $view_data = [
                'mitra_sasaran' => $mitra_sasaran,
                'dokumen_rab' => $dokumen_rab,
                'anggota' => $anggota,
                'dokumen_usulan' => $dokumen_usulan,
                'ketua' => $ketua,
                'id' => $id,
                'page' => $page,
            ];

            return view('pengusul.pengabdian.usulan_7', $view_data);
        } else {
            return redirect()->route('pengusul_pengabdian');
        }
    }

    public function tambah_anggota(Request $request, $id)
    {
        $nidn = $request->input('nidn');
        $result = NULL;

        if ($nidn) {
            $result = User::where('user_nidn', $nidn)
                ->first();
        }

        return view('pengusul.pengabdian.tambah_anggota', ['id' => $id, 'result' => $result]);
    }

    public function tambah_mitra($id)
    {
        $provinsi = DB::table('wilayah_provinsi')->get();
        $kabupaten = DB::table('wilayah_kabupaten')->get();
        $kecamatan = DB::table('wilayah_kecamatan')->get();
        $desa = DB::table('wilayah_desa')->get();

        $view_data = [
            'id' => $id,
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
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

        return redirect()->route('pengusul_pengabdian_usulan', [6, $id]);
    }

    public function upload_dokumen_mitra(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'dokumen_mitra' => 'required|mimes:pdf|max:10000',
            ],
            [
                'dokumen_mitra.mimes' => 'Tipe File Harus PDF'
            ]
        );

        $id = $request->mitra_id;
        $file = $request->file('dokumen_mitra');
        $destination = "assets/file/dokumen_mitra/";
        $file_original_name = $file->getClientOriginalName();
        $file_hash_name = $file->hashName();
        $file_base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_size = intval($file->getSize() / 1024);
        $file_extension = $file->getClientOriginalExtension();

        $is_exist = Mitra_sasaran::where('mitra_sasaran_id', $id)
            ->where('mitra_sasaran_file_hash_name', '!=', NULL)
            ->count();

        if ($is_exist > 0) {
            $fileOld =  Mitra_sasaran::where('mitra_sasaran_id', $id)->first();
            $file_path = public_path($destination . $fileOld->mitra_sasaran_file_hash_name);

            $file->move($destination, $file->hashName());

            File::delete($file_path);
        } else {
            $file->move($destination, $file->hashName());
        }

        //Update Data
        $data = [
            'mitra_sasaran_file_original_name' => $file_original_name,
            'mitra_sasaran_file_hash_name' => $file_hash_name,
            'mitra_sasaran_file_base_name' => $file_base_name,
            'mitra_sasaran_file_size' => $file_size,
            'mitra_sasaran_file_extension' => $file_extension,
            'mitra_sasaran_file_date' => date('Y-m-d'),
        ];

        Mitra_sasaran::where('mitra_sasaran_id', $id)
            ->update($data);

        return redirect()->back();
    }

    public function edit_mitra($id, $editid)
    {
        $provinsi = DB::table('wilayah_provinsi')->get();
        $kabupaten = DB::table('wilayah_kabupaten')->get();
        $kecamatan = DB::table('wilayah_kecamatan')->get();
        $desa = DB::table('wilayah_desa')->get();

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

        return redirect()->route('pengusul_pengabdian_usulan', [6, $id]);
    }

    public function hapus_mitra($id, $removeid)
    {
        $destination = "assets/file/dokumen_mitra/";
        $fileOld =  Mitra_sasaran::where('mitra_sasaran_id', $removeid)->first();
        $file_path = public_path($destination . $fileOld->mitra_sasaran_file_hash_name);

        Mitra_sasaran::destroy('mitra_sasaran_id', $removeid);

        File::delete($file_path);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Remove Success', //Alert Message 
            'Mitra Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [6, $id]);
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
        $peran = htmlspecialchars($request->peran);
        $tugas = htmlspecialchars($request->tugas);

        //Insert Data Anggota Pengabdian
        $data = [
            'anggota_pengabdian_user_id' => $user_id,
            'anggota_pengabdian_pengabdian_id' => $id,
            'anggota_pengabdian_role' => $peran,
            'anggota_pengabdian_tugas' => $tugas,
        ];
        Mitra_sasaran::create($data);

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function upload_dokumen(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'dokumen_usulan' => 'required|mimes:pdf|max:10000',
            ],
            [
                'dokumen_usulan.mimes' => 'Tipe File Harus PDF'
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
        }

        return redirect()->route('pengusul_pengabdian_usulan', [3, $id]);
    }

    public function upload_rab(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'dokumen_rab' => 'required|mimes:pdf|max:10000',
            ],
            [
                'dokumen_rab.mimes' => 'Tipe File Harus PDF'
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
        }

        return redirect()->route('pengusul_pengabdian_usulan', [5, $id]);
    }

    public function remove_anggota($id, $removeid)
    {
        Anggota_pengabdian::destroy('anggota_pengabdian_id', $removeid);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Remove Success', //Alert Message 
            'Anggota Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function usulan_submit(Request $request, $id)
    {
        $data = [
            'usulan_pengabdian_status' => 'diproses',
            'usulan_pengabdian_submit' => true,
        ];

        Usulan_pengabdian::where('usulan_pengabdian_id', $id)
            ->update($data);

        return redirect()->route('pengusul_pengabdian');
    }
}
