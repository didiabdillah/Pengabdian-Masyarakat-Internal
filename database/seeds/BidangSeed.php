<?php

use Illuminate\Database\Seeder;

use App\Models\Bidang;

class BidangSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bidang::create([
            'bidang_label' => "Pangan dan Pertanian"
        ]);

        Bidang::create([
            'bidang_label' => "Kesehatan dan Obat"
        ]);

        Bidang::create([
            'bidang_label' => "Energi dan Energi Terbarukan"
        ]);

        Bidang::create([
            'bidang_label' => "Pertahanan dan Keamanan"
        ]);

        Bidang::create([
            'bidang_label' => "Teknologi Informasi dan Komunikasi"
        ]);

        Bidang::create([
            'bidang_label' => "Kemaritiman"
        ]);

        Bidang::create([
            'bidang_label' => "Kebencanaan"
        ]);

        Bidang::create([
            'bidang_label' => "Transportasi"
        ]);

        Bidang::create([
            'bidang_label' => "Material Maju"
        ]);

        Bidang::create([
            'bidang_label' => "Sosial Humaniora, Seni Budaya, Pendidikan"
        ]);
    }
}
