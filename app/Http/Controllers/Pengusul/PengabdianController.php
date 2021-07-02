<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Skema;
use App\Models\Bidang;
use App\Models\Usulanpengabdian;
use App\Models\Anggotapengabdian;
use App\Models\Dokumenusulan;

class PengabdianController extends Controller
{
    public function index()
    {
        $usulan_pengabdian = Usulanpengabdian::whereHas('anggotapengabdian', function ($query) {
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
        Usulanpengabdian::create($data);

        //Insert Data Ketua
        $data_anggota = [
            'anggota_pengabdian_user_id' => $request->session()->get('user_id'),
            'anggota_pengabdian_pengabdian_id' => $id,
            'anggota_pengabdian_role' => 'ketua',
            'anggota_pengabdian_tugas' => NULL,
        ];
        Anggotapengabdian::create($data_anggota);

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
        Usulanpengabdian::where('usulan_pengabdian_id', $id)->update($data);

        return redirect()->route('pengusul_pengabdian_usulan', [2, $id]);
    }

    public function usulan($page, $id)
    {
        $role_access = Anggotapengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->where('anggota_pengabdian_user_id', Session::get('user_id'))
            ->first();

        if ($role_access->anggota_pengabdian_role != "ketua") {
            return redirect()->route('pengusul_pengabdian');
        }


        if ($page == 1) {
            $skema = Skema::orderBy('skema_label', 'asc')->get();
            $bidang = Bidang::orderBy('bidang_label', 'asc')->get();
            $usulan = Usulanpengabdian::where('usulan_pengabdian_id', $id)->first();

            $view_data = [
                'skema' => $skema,
                'bidang' => $bidang,
                'usulan' => $usulan,
                'page' => $page,
                'id' => $id,
            ];

            return view('pengusul.pengabdian.usulan_1', $view_data);
        } elseif ($page == 2) {
            $anggota = Anggotapengabdian::where('anggota_pengabdian_pengabdian_id', $id)
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
            $dokumen_info = Dokumenusulan::where('dokumen_usulan_pengabdian_id', $id)->first();

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
            $view_data = [
                'id' => $id,
                'page' => $page,
            ];

            return view('pengusul.pengabdian.usulan_5', $view_data);
        } elseif ($page == 6) {
            $view_data = [
                'id' => $id,
                'page' => $page,
            ];

            return view('pengusul.pengabdian.usulan_6', $view_data);
        } elseif ($page == 7) {
            $view_data = [
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
        Anggotapengabdian::create($data);

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

        $is_exist = Dokumenusulan::where('dokumen_usulan_pengabdian_id', $id)->count();

        if ($is_exist > 0) {
            $fileOld =  Dokumenusulan::where('dokumen_usulan_pengabdian_id', $id)->first();
            $file_path = public_path($destination . $fileOld->dokumen_usulan_hash_name);

            //Update Data
            $data = [
                'dokumen_usulan_original_name' => $file->getClientOriginalName(),
                'dokumen_usulan_hash_name' => $file->hashName(),
                'dokumen_usulan_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'dokumen_usulan_file_size' => intval($file->getSize() / 1024),
                'dokumen_usulan_extension' => $file->getClientOriginalExtension(),
            ];

            Dokumenusulan::where('dokumen_usulan_pengabdian_id', $id)
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

            Dokumenusulan::create($data);

            $file->move($destination, $file->hashName());
        }

        return redirect()->route('pengusul_pengabdian_usulan', [3, $id]);
    }

    public function remove_anggota($id, $removeid)
    {
        Anggotapengabdian::destroy('anggota_pengabdian_id', $removeid);

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

        Usulanpengabdian::where('usulan_pengabdian_id', $id)
            ->update($data);

        return redirect()->route('pengusul_pengabdian');
    }
}
