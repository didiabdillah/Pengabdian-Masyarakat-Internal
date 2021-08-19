<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Rules\Captcha;

use App\Models\Usulan_pengabdian;
use Illuminate\Support\Facades\URL;

class LogbookController extends Controller
{
    public function get_pengabdian($api_code, $id)
    {
        $user_id = $id;

        $usulan_pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) use ($user_id) {
            $query->where('anggota_pengabdian_user_id', $user_id)
                ->where('anggota_pengabdian_role', "ketua");
        })
            ->where('usulan_pengabdian_submit', true)
            ->where('usulan_pengabdian_status', 'diterima')
            ->orWhere('usulan_pengabdian_status', 'dimonev')
            ->orWhere('usulan_pengabdian_status', 'selesai')
            ->orderBy('usulan_pengabdian.updated_at', 'desc')
            ->orderBy('usulan_pengabdian_tahun', 'asc')
            ->get();


        return json_encode($usulan_pengabdian, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function store(Request $request, $api_code, $id)
    {
        $logbook_id = $request->logbook_id;
        $tanggal = $request->tanggal;
        $kegiatan = $request->kegiatan;
        $presentase = $request->presentase;
    }

    public function update(Request $request, $api_code, $id)
    {
        $logbook_id = $request->logbook_id;
        $tanggal = $request->tanggal;
        $kegiatan = $request->kegiatan;
        $presentase = $request->presentase;
    }

    public function delete(Request $request, $api_code, $id)
    {
        $logbook_id = $request->logbook_id;
    }
}
