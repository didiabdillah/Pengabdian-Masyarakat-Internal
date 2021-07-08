<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Usulanpengabdian;
use App\Models\Anggotapengabdian;
use App\Models\Dokumenusulan;
use App\Models\Dokumen_rab;
use App\Models\Mitra_sasaran;

class PengabdianController extends Controller
{
    public function index()
    {
        $usulan_pengabdian = Usulanpengabdian::where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', '!=', 'pending')
            ->orderBy('usulan_pengabdian_tahun', 'desc')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->get();

        $view_data = [
            'usulan_pengabdian' => $usulan_pengabdian,
        ];

        return view('reviewer.pengabdian.index', $view_data);
    }

    public function detail($id)
    {
        $ketua = Anggotapengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $dokumen_usulan = Dokumenusulan::where('dokumen_usulan_pengabdian_id', $id)->first();

        $anggota = Anggotapengabdian::where('anggota_pengabdian_pengabdian_id', $id)
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
        ];

        return view('reviewer.pengabdian.detail', $view_data);
    }

    public function konfirmasi($id)
    {
        $ketua = Anggotapengabdian::where('anggota_pengabdian_pengabdian_id', $id)
            ->join('users', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'users.user_id')
            ->leftjoin('biodata', 'anggota_pengabdian.anggota_pengabdian_user_id', '=', 'biodata.biodata_user_id')
            ->where('anggota_pengabdian_role', 'ketua')
            ->first();

        $dokumen_usulan = Dokumenusulan::where('dokumen_usulan_pengabdian_id', $id)->first();

        $anggota = Anggotapengabdian::where('anggota_pengabdian_pengabdian_id', $id)
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
        ];

        return view('reviewer.pengabdian.konfirmasi', $view_data);
    }

    public function konfirmasi_update(Request $request, $id)
    {
        // Input Validation
        $request->validate(
            [
                'status'  => 'required',
                'komentar'  => 'max:60000',
            ]
        );

        $status = htmlspecialchars($request->status);
        $komentar = $request->note;

        $konfirmasi = ($status == 1) ? "diterima" : "ditolak";

        //Update Data
        $data = [
            'usulan_pengabdian_status' => $konfirmasi,
            'usulan_pengabdian_komentar' => $komentar,
        ];
        Usulanpengabdian::where('usulan_pengabdian_id', $id)->update($data);

        //Flash Message
        flash_alert(
            __('alert.icon_success'), //Icon
            'Update Status Success', //Alert Message 
            'Usulan pengabdian Status Updated' //Sub Alert Message
        );

        return redirect()->route('reviewer_pengabdian');
    }
}
