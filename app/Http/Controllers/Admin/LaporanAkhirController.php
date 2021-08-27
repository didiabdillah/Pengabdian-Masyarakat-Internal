<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulan_pengabdian;
use App\Models\Laporan_akhir;
use App\Models\Usulan_luaran;

class LaporanAkhirController extends Controller
{
    public function index()
    {
        $pengabdian = Usulan_pengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', 'diterima')
            ->orWhere('usulan_pengabdian_status', 'dimonev')
            ->orWhere('usulan_pengabdian_status', 'selesai')
            ->orderBy('pkm_usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();

        $view_data = [
            'pengabdian' => $pengabdian,
        ];

        return view('admin.laporan_akhir.index', $view_data);
    }

    // ==================================================================================

    public function list($pengabdian_id)
    {
        $laporan_akhir = Laporan_akhir::where('laporan_akhir_pengabdian_id', $pengabdian_id)->where('laporan_akhir_tipe', 'akhir')->first();

        $laporan_keuangan = Laporan_akhir::where('laporan_akhir_pengabdian_id', $pengabdian_id)->where('laporan_akhir_tipe', 'keuangan')->first();

        $luaran_wajib = Usulan_luaran::where('usulan_luaran_pengabdian_id', $pengabdian_id)
            ->where('usulan_luaran_pengabdian_tipe', 'wajib')
            ->get();

        $luaran_tambahan = Usulan_luaran::where('usulan_luaran_pengabdian_id', $pengabdian_id)
            ->where('usulan_luaran_pengabdian_tipe', 'tambahan')
            ->get();

        $view_data = [
            'laporan_akhir' => $laporan_akhir,
            'laporan_keuangan' => $laporan_keuangan,
            'luaran_wajib' => $luaran_wajib,
            'luaran_tambahan' => $luaran_tambahan,
            'pengabdian_id' => $pengabdian_id,
        ];

        return view('admin.laporan_akhir.list', $view_data);
    }
}
