<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\Biodata;

class ReviewerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        $reviewer = get_local_db_json('data_reviewer.json');

        foreach ($reviewer as $data) {
            if ($data["email"] != "" && $data["nidn"] != "") {
                $user_id = str_replace("-", "", Str::uuid()) . dechex(strtotime(now()));
                User::create([
                    'user_id' => $user_id,
                    'user_name' => $data["nama"],
                    'user_email' => $data["email"],
                    'user_role' => 'reviewer_pengabdian',
                    'user_password' => Hash::make($data["nidn"]),
                    'user_image' => 'default.jpg',
                    'user_nidn' => $data["nidn"],
                ]);
                Biodata::create([
                    'biodata_user_id' => $user_id,
                    'biodata_sex' => ($data["gender"] == "L") ? 0 : 1, //0 = Laki-Laki, 1 = Perempuan
                    'biodata_institusi' => $data["institusi"],
                    'biodata_jurusan' => $data["jurusan"],
                    'biodata_program_studi' => $data["prodi"],
                    'biodata_jabatan' => $data["jabatan"],
                    'biodata_pendidikan' => "",
                    'biodata_alamat' => "",
                    'biodata_tempat_lahir' => "",
                    // 'biodata_tanggal_lahir' => "",
                    'biodata_no_ktp' => "",
                    'biodata_no_hp' => "",
                    'biodata_no_telp' => "",
                    'biodata_web_personal' => "",
                    'biodata_scopus_id' => $data["id_scopus"],
                    'biodata_sinta_id' => $data["id_sinta"],
                    'biodata_google_schoolar_id' => $data["id_google_scholar"]
                ]);
            }
        }
    }
}
