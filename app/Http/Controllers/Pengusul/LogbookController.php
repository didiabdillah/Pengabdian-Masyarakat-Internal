<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Usulan_pengabdian;
use App\Models\Logbook;
use App\Models\User;
use App\Models\Logbook_berkas;

class LogbookController extends Controller
{
    public function index()
    {
        $pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) {
            $query->where('anggota_pengabdian_user_id', Session::get('user_id'))
                ->where('anggota_pengabdian_role', "ketua");
        })
            ->where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', 'diterima')
            ->orWhere('usulan_pengabdian_status', 'dimonev')
            ->orWhere('usulan_pengabdian_status', 'selesai')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $is_tambah_unlock = false;
        $tambah_unlock = get_where_local_db_json("unlock_feature.json", "name", __('unlock.tambah_logbook_pengabdian'));
        if ($tambah_unlock) {
            if (strtotime($tambah_unlock["start_time"]) <= strtotime(date('Y-m-d H:i:s')) &&  strtotime(date('Y-m-d H:i:s')) <= strtotime($tambah_unlock["end_time"])) {
                $is_tambah_unlock = true;
            }
        }

        $is_suspend = User::find(Session::get('user_id'))->user_ban;

        $view_data = [
            'is_suspend' => $is_suspend,
            'pengabdian' => $pengabdian,
            'is_tambah_unlock' => $is_tambah_unlock,
            'tambah_unlock' => $tambah_unlock,
        ];

        return view('pengusul.logbook.index', $view_data);
    }

    // ================================================================================================

    // Logbook Detail
    public function logbook_index($pengabdian_id)
    {
        $logbook = Logbook::where('logbook_pengabdian_id', $pengabdian_id)->orderBy('created_at', 'asc')->get();
        $berkas = Logbook_berkas::where('logbook_berkas_pengabdian_id', $pengabdian_id)->orderBy('created_at', 'desc')->get();

        $view_data = [
            'logbook' => $logbook,
            'pengabdian_id' => $pengabdian_id,
            'berkas' => $berkas,
        ];

        return view('pengusul.logbook.logbook_index', $view_data);
    }

    public function logbook_uraian($pengabdian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $view_data = [
            'pengabdian_id' => $pengabdian_id,
            'logbook' => $logbook,
        ];

        return view('pengusul.logbook.logbook_uraian', $view_data);
    }

    public function logbook_insert($pengabdian_id)
    {
        $pengabdian = Usulan_pengabdian::where('usulan_pengabdian_id', $pengabdian_id)->first();

        $view_data = [
            'pengabdian_id' => $pengabdian_id,
            'time' => date('Y-m-d', strtotime($pengabdian->created_at)),
        ];

        return view('pengusul.logbook.logbook_insert', $view_data);
    }

    public function logbook_store(Request $request, $pengabdian_id)
    {
        // Input Validation
        $request->validate(
            [
                'tanggal' => 'required',
                'uraian' => 'required|max:4294967200',
                'presentase' => 'required|numeric|min:0|max:100',
            ]
        );

        $tanggal = htmlspecialchars($request->tanggal);
        $uraian = $request->uraian;
        $presentase = htmlspecialchars($request->presentase);

        //Update Data
        $data = [
            'logbook_pengabdian_id' => $pengabdian_id,
            'logbook_date' => $tanggal,
            'logbook_uraian_kegiatan' => $uraian,
            'logbook_presentase' => intval($presentase),
        ];

        Logbook::create($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Catatan Kegiatan Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $pengabdian_id);
    }

    public function logbook_edit($pengabdian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $pengabdian = Usulan_pengabdian::where('usulan_pengabdian_id', $pengabdian_id)->first();

        $view_data = [
            'pengabdian_id' => $pengabdian_id,
            'logbook' => $logbook,
            'time' => date('Y-m-d', strtotime($pengabdian->created_at)),
        ];

        return view('pengusul.logbook.logbook_edit', $view_data);
    }

    public function logbook_update(Request $request, $pengabdian_id, $id)
    {
        // Input Validation
        $request->validate(
            [
                'tanggal' => 'required',
                'uraian' => 'required|max:4294967200',
                'presentase' => 'required|numeric|min:0|max:100',
            ]
        );

        $tanggal = htmlspecialchars($request->tanggal);
        $uraian = $request->uraian;
        $presentase = htmlspecialchars($request->presentase);

        //Update Data
        $data = [
            'logbook_date' => $tanggal,
            'logbook_uraian_kegiatan' => $uraian,
            'logbook_presentase' => $presentase,
        ];

        Logbook::where('logbook_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Catatan Kegiatan Diubah' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $pengabdian_id);
    }

    public function logbook_destroy($pengabdian_id, $id)
    {
        $destination = "assets/file/logbook/";

        $fileOld =  Logbook::where('logbook_id', $id)
            ->first();

        $file_path = public_path($destination . $fileOld->laporan_akhir_hash_name);

        File::delete($file_path);

        Logbook::destroy('logbook_id', $id);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Dokumen Terhapus' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $pengabdian_id);
    }

    // Logbook Berkas
    public function logbook_store_berkas(Request $request, $pengabdian_id)
    {
        // Input Validation
        $request->validate(
            [
                'keterangan' => 'required|max:255',
                'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:15360',
            ],
            [
                'file.mimes' => 'Tipe File Harus PDF, Word, Excel, JPG, JPEG, PNG'
            ]
        );

        $file = $request->file('file');
        $keterangan = $request->keterangan;
        $destination = "assets/file/logbook_berkas/";

        //Update Data
        $data = [
            'logbook_berkas_pengabdian_id' => $pengabdian_id,
            'logbook_berkas_keterangan' => $keterangan,
            'logbook_berkas_original_name' => $file->getClientOriginalName(),
            'logbook_berkas_hash_name' => $file->hashName(),
            'logbook_berkas_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'logbook_berkas_file_size' => intval($file->getSize() / 1024),
            'logbook_berkas_extension' => $file->getClientOriginalExtension(),
            'logbook_berkas_date' => date('Y-m-d'),
        ];

        Logbook_berkas::create($data);

        $file->move($destination, $file->hashName());

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Berkas Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $pengabdian_id);
    }
}
