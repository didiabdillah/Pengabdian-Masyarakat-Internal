<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Logbook;
use App\Models\Logbook_berkas;
use App\Models\Usulan_pengabdian;

class LogbookController extends Controller
{
    public function index()
    {
        $pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', 'diterima')
            ->orWhere('usulan_pengabdian_status', 'dimonev')
            ->orWhere('usulan_pengabdian_status', 'selesai')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $view_data = [
            'pengabdian' => $pengabdian,
        ];

        return view('admin.logbook.index', $view_data);
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

        return view('admin.logbook.logbook_index', $view_data);
    }

    public function logbook_uraian($pengabdian_id, $id)
    {
        $logbook = Logbook::where('logbook_id', $id)->first();

        $view_data = [
            'pengabdian_id' => $pengabdian_id,
            'logbook' => $logbook,
        ];

        return view('admin.logbook.logbook_uraian', $view_data);
    }
}
