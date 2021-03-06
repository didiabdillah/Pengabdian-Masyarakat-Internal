<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use App\Models\Wilayah_provinsi;
use App\Models\Wilayah_kabupaten;
use App\Models\Wilayah_kecamatan;
use App\Models\Wilayah_desa;

class WilayahIndonesiaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinsi = get_local_db_json('dummy_data/provinsi.json');

        foreach ($provinsi as $data) {
                Wilayah_provinsi::create([
                    'id' => $data["id"],
                    'nama' => $data["nama"],
                ]);
        }

        $kabupaten = get_local_db_json('dummy_data/kabupaten.json');

        foreach ($kabupaten as $data) {
                Wilayah_kabupaten::create([
                    'id' => $data["id"],
                    'provinsi_id' => $data["provinsi_id"],
                    'nama' => $data["nama"],
                ]);
        }
     
        $kecamatan = get_local_db_json('dummy_data/kecamatan.json');

        foreach ($kecamatan as $data) {
                Wilayah_kecamatan::create([
                    'id' => $data["id"],
                    'kabupaten_id' => $data["kabupaten_id"],
                    'nama' => $data["nama"],
                ]);
        }
       
        $desa = get_local_db_json('dummy_data/desa.json');

        foreach ($desa as $data) {
                Wilayah_desa::create([
                    'id' => $data["id"],
                    'kecamatan_id' => $data["kecamatan_id"],
                    'nama' => $data["nama"],
                ]);
        }
    }
}
