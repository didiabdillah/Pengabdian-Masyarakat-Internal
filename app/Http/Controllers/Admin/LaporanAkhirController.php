<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_pengabdian;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        $laporan_akhir = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', 'diterima')
            ->orWhere('usulan_pengabdian_status', 'dimonev')
            ->orWhere('usulan_pengabdian_status', 'selesai')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $view_data = [
            'laporan_akhir' => $laporan_akhir,
        ];

        return view('admin.laporan_akhir.index', $view_data);
    }
}
