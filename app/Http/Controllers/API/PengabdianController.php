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

class PengabdianController extends Controller
{
    public function get_pengabdian($api_code, $id)
    {
        // $user_id = $id;

        // $usulan_pengabdian = Usulan_pengabdian::whereHas('anggota_pengabdian', function ($query) use ($user_id) {
        //     $query->where('anggota_pengabdian_user_id', $user_id);
        // })
        //     ->where('usulan_pengabdian_tahun', date('Y'))
        //     ->orderBy('usulan_pengabdian.updated_at', 'desc')
        //     ->orderBy('usulan_pengabdian_tahun', 'asc')
        //     ->get();

        // $api_data = [
        //     'status' => true,
        //     'message' => "Login Berhasil",
        //     'data' => [
        //         "user_id" => $user->user_id,
        //         "user_email" => $user->user_email,
        //         "user_name" => $user->user_name,
        //         "user_role" => $user->user_role,
        //         "user_nidn" => $user->user_nidn,
        //         "user_image" => $user->user_image,
        //         "user_image_url" => URL::asset("assets/img/profile/" . $user->user_image),
        //         "biodata_id" => $user->biodata->biodata_id,
        //         "biodata_user_id" => $user->biodata->biodata_user_id,
        //         "biodata_sex" => $user->biodata->biodata_sex,
        //         "biodata_sex_label" => ($user->biodata->biodata_sex == 0) ? "Laki-Laki" : "Perempuan",
        //         "biodata_institusi" => $user->biodata->biodata_institusi,
        //         "biodata_jurusan" => $user->biodata->biodata_jurusan,
        //         "biodata_program_studi" => $user->biodata->biodata_program_studi,
        //         "biodata_jabatan" => $user->biodata->biodata_jabatan,
        //         "biodata_pendidikan" => $user->biodata->biodata_pendidikan,
        //         "biodata_alamat" => $user->biodata->biodata_alamat,
        //         "biodata_tempat_lahir" => $user->biodata->biodata_tempat_lahir,
        //         "biodata_tanggal_lahir" => $user->biodata->biodata_tanggal_lahir,
        //         "biodata_no_ktp" => $user->biodata->biodata_no_ktp,
        //         "biodata_no_hp" => $user->biodata->biodata_no_hp,
        //         "biodata_no_telp" => $user->biodata->biodata_no_telp,
        //         "biodata_web_personal" => $user->biodata->biodata_web_personal,
        //         "biodata_scopus_id" => $user->biodata->biodata_scopus_id,
        //         "biodata_google_schoolar_id" => $user->biodata->biodata_google_schoolar_id,
        //     ]
        // ];
        // return json_encode($api_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
