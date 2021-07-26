<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Usulan_pengabdian;
use App\Models\User;
use App\Models\Usulan_luaran;
use App\Models\Laporan_kemajuan;

class LaporanKemajuanController extends Controller
{
    public function index()
    {
        $pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) {
            $query->where('anggota_pengabdian_user_id', Session::get('user_id'))
                ->where('anggota_pengabdian_role', "ketua");
        })
            ->where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', 'diterima')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $is_suspend = User::find(Session::get('user_id'))->user_ban;

        $view_data = [
            'is_suspend' => $is_suspend,
            'pengabdian' => $pengabdian,
        ];

        return view('pengusul.laporan_kemajuan.index', $view_data);
    }

    // ==================================================================================

    public function luaran($pengabdian_id)
    {
        $luaran_wajib = Usulan_luaran::where('usulan_luaran_pengabdian_id', $pengabdian_id)
            ->where('usulan_luaran_pengabdian_tipe', 'wajib')
            ->get();

        $luaran_tambahan = Usulan_luaran::where('usulan_luaran_pengabdian_id', $pengabdian_id)
            ->where('usulan_luaran_pengabdian_tipe', 'tambahan')
            ->get();

        $view_data = [
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'pengabdian_id' => $pengabdian_id,
        ];

        return view('pengusul.laporan_kemajuan.luaran', $view_data);
    }

    public function insert($pengabdian_id, $id)
    {
        $view_data = [
            'id' => $id,
            'pengabdian_id' => $pengabdian_id,
        ];

        return view('pengusul.laporan_kemajuan.insert', $view_data);
    }

    public function store(Request $request, $pengabdian_id, $id)
    {
        // Input Validation
        $request->validate(
            [
                'file' => 'required',
                'file.*'  => 'required|mimes:doc,docx,pdf,xls,xlsx|max:10000',
            ],
            [
                'file.*.mimes' => 'File harus bertipe:doc, docx, pdf, xls, xlsx'
            ]
        );

        $file = $request->file('file');
        $pengabdian_id = $pengabdian_id;
        $user_id = $request->session()->get('user_id');
        $original_name = $file->getClientOriginalName();
        $hash_name = $file->hashName();
        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_size = intval($file->getSize() / 1024);
        $extension = $file->getClientOriginalExtension();

        $destination = "assets/file/laporan_kemajuan/";

        $is_exist = Laporan_kemajuan::where('laporan_kemajuan_luaran_id', $id)
            ->count();

        if ($is_exist > 0) {
            $fileOld =  Laporan_kemajuan::where('laporan_kemajuan_luaran_id', $id)
                ->first();

            $file_path = public_path($destination . $fileOld->laporan_kemajuan_hash_name);

            $file->move($destination, $file->hashName());

            File::delete($file_path);
        } else {
            $file->move($destination, $file->hashName());
        }

        //Insert Data
        $data = [
            'laporan_kemajuan_luaran_id' => $id,
            'laporan_kemajuan_date' => date('Y-m-d'),
            'laporan_kemajuan_original_name' => $original_name,
            'laporan_kemajuan_hash_name' => $hash_name,
            'laporan_kemajuan_base_name' => $base_name,
            'laporan_kemajuan_file_size' => $file_size,
            'laporan_kemajuan_extension' => $extension,
        ];
        Laporan_kemajuan::updateOrInsert(
            ['laporan_kemajuan_luaran_id' => $id],
            $data
        );

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Laporan kemajuan Terupload' //Sub Alert Message
        );

        return redirect()->route('pengusul_laporan_kemajuan_luaran', $pengabdian_id);
    }
}
