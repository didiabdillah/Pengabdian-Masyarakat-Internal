<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\Models\User;
use App\Models\Biodata;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $user_id = hexdec(uniqid()) . strtotime(now());

        User::create([
            'user_id' => $user_id,
            'user_name' => 'Rehn',
            'user_email' => 'rehn@email.com',
            'user_role' => 'pengusul',
            'user_password' => Hash::make('12345678'), // 12345678
            'user_image' => 'default.jpg',
            'user_nidn' => 1234567890,
        ]);

        Biodata::create([
            'biodata_user_id' => $user_id,
            'biodata_sex' => 0,
            'biodata_institusi' => "Politeknik Negeri Indramayu",
            'biodata_jurusan' => "Teknik Informatika",
            'biodata_program_studi' => "D3 Teknik Informatika",
            'biodata_jabatan' => "Dosen",
            'biodata_pendidikan' => "S-2",
            'biodata_alamat' => $faker->address,
            'biodata_tempat_lahir' => $faker->city,
            'biodata_tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'biodata_no_ktp' => rand(1000000000000000, 9999999999999999),
            'biodata_no_hp' => $faker->e164PhoneNumber,
            'biodata_no_telp' => $faker->tollFreePhoneNumber,
            'biodata_web_personal' => $faker->domainName,
        ]);

        $user_id = hexdec(uniqid()) . strtotime(now());

        User::create([
            'user_id' => $user_id,
            'user_name' => 'Steven',
            'user_email' => 'steven@email.com',
            'user_role' => 'pengusul',
            'user_password' => Hash::make('12345678'), // 12345678
            'user_image' => 'default.jpg',
            'user_nidn' => 1234567891,
        ]);

        Biodata::create([
            'biodata_user_id' => $user_id,
            'biodata_sex' => 0,
            'biodata_institusi' => "Politeknik Negeri Indramayu",
            'biodata_jurusan' => "Teknik Informatika",
            'biodata_program_studi' => "D3 Teknik Informatika",
            'biodata_jabatan' => "Dosen",
            'biodata_pendidikan' => "S-2",
            'biodata_alamat' => $faker->address,
            'biodata_tempat_lahir' => $faker->city,
            'biodata_tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'biodata_no_ktp' => rand(1000000000000000, 9999999999999999),
            'biodata_no_hp' => $faker->e164PhoneNumber,
            'biodata_no_telp' => $faker->tollFreePhoneNumber,
            'biodata_web_personal' => $faker->domainName,
        ]);

        $user_id = hexdec(uniqid()) . strtotime(now());

        User::create([
            'user_id' => $user_id,
            'user_name' => 'Didi Abdillah',
            'user_email' => 'didiabdillah@student.polindra.ac.id',
            'user_role' => 'admin',
            'user_password' => Hash::make('12345678'), // 12345678
            'user_image' => 'default.jpg',
            'user_nidn' => rand(1000000000, 9999999999),
        ]);

        Biodata::create([
            'biodata_user_id' => $user_id,
            'biodata_sex' => 0,
            'biodata_institusi' => "Politeknik Negeri Indramayu",
            'biodata_jurusan' => "Teknik Informatika",
            'biodata_program_studi' => "D3 Teknik Informatika",
            'biodata_jabatan' => "Dosen",
            'biodata_pendidikan' => "S-2",
            'biodata_alamat' => $faker->address,
            'biodata_tempat_lahir' => $faker->city,
            'biodata_tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'biodata_no_ktp' => rand(1000000000000000, 9999999999999999),
            'biodata_no_hp' => $faker->e164PhoneNumber,
            'biodata_no_telp' => $faker->tollFreePhoneNumber,
            'biodata_web_personal' => $faker->domainName,
        ]);

        $user_id = hexdec(uniqid()) . strtotime(now());

        User::create([
            'user_id' => $user_id,
            'user_name' => 'Alex',
            'user_email' => 'alex@email.com',
            'user_role' => 'reviewer',
            'user_password' => Hash::make('12345678'), // 12345678
            'user_image' => 'default.jpg',
            'user_nidn' => rand(1000000000, 9999999999),
        ]);

        Biodata::create([
            'biodata_user_id' => $user_id,
            'biodata_sex' => 0,
            'biodata_institusi' => "Politeknik Negeri Indramayu",
            'biodata_jurusan' => "Teknik Informatika",
            'biodata_program_studi' => "D4 Rekayasa Perangkat Lunak",
            'biodata_jabatan' => "Dosen",
            'biodata_pendidikan' => "S-2",
            'biodata_alamat' => $faker->address,
            'biodata_tempat_lahir' => $faker->city,
            'biodata_tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'biodata_no_ktp' => rand(1000000000000000, 9999999999999999),
            'biodata_no_hp' => $faker->e164PhoneNumber,
            'biodata_no_telp' => $faker->tollFreePhoneNumber,
            'biodata_web_personal' => $faker->domainName,
        ]);
    }
}
