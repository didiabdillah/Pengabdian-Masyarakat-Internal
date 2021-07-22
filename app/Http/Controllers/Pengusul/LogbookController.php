<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Usulan_pengabdian;
use App\Models\Logbook;
use App\Models\User;

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
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $is_suspend = User::find(Session::get('user_id'))->user_ban;

        $view_data = [
            'is_suspend' => $is_suspend,
            'pengabdian' => $pengabdian,
        ];

        return view('pengusul.logbook.index', $view_data);
    }

    // ================================================================================================

    // Logbook Detail
    public function logbook_index($pengabdian_id)
    {
        $logbook = Logbook::where('logbook_pengabdian_id', $pengabdian_id)->orderBy('created_at', 'asc')->get();


        $view_data = [
            'logbook' => $logbook,
            'pengabdian_id' => $pengabdian_id,
        ];

        return view('pengusul.logbook.logbook_index', $view_data);
    }

    public function logbook_insert($pengabdian_id)
    {
        $view_data = [
            'pengabdian_id' => $pengabdian_id,
        ];

        return view('pengusul.logbook.logbook_insert', $view_data);
    }

    public function logbook_store(Request $request, $pengabdian_id)
    {
        // Input Validation
        $request->validate(
            [
                'file' => 'required|mimes:pdf,doc,docx|max:10000',
            ],
            [
                'file.mimes' => 'Tipe File Harus PDF Atau Word'
            ]
        );

        $file = $request->file('file');
        $destination = "assets/file/logbook/";

        //Update Data
        $data = [
            'logbook_pengabdian_id' => $pengabdian_id,
            'logbook_original_name' => $file->getClientOriginalName(),
            'logbook_hash_name' => $file->hashName(),
            'logbook_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'logbook_file_size' => intval($file->getSize() / 1024),
            'logbook_extension' => $file->getClientOriginalExtension(),
            'logbook_date' => date('Y-m-d H:i:s'),
        ];

        Logbook::create($data);

        $file->move($destination, $file->hashName());

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Dokumen Ditambahkan' //Sub Alert Message
        );

        return redirect()->route('pengusul_logbook_detail', $pengabdian_id);
    }

    public function logbook_edit($pengabdian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $view_data = [
            'pengabdian_id' => $pengabdian_id,
            'logbook' => $logbook,
        ];

        return view('pengusul.logbook.logbook_edit', $view_data);
    }

    public function logbook_update(Request $request, $pengabdian_id, $id)
    {
        // Input Validation
        $request->validate(
            [
                'file' => 'required|mimes:pdf,doc,docx|max:10000',
            ],
            [
                'file.mimes' => 'Tipe File Harus PDF Atau Word'
            ]
        );

        $file = $request->file('file');
        $destination = "assets/file/logbook/";

        $fileOld =  Logbook::where('logbook_id', $id)
            ->first();

        $file_path = public_path($destination . $fileOld->laporan_akhir_hash_name);


        File::delete($file_path);

        //Update Data
        $data = [
            'logbook_original_name' => $file->getClientOriginalName(),
            'logbook_hash_name' => $file->hashName(),
            'logbook_base_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'logbook_file_size' => intval($file->getSize() / 1024),
            'logbook_extension' => $file->getClientOriginalExtension(),
            'logbook_date' => date('Y-m-d H:i:s'),
        ];

        Logbook::where('logbook_id', $id)->update($data);

        $file->move($destination, $file->hashName());

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Sukses', //Alert Message 
            'Dokumen Diubah' //Sub Alert Message
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
}
