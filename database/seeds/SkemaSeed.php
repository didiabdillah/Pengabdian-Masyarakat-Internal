<?php

use Illuminate\Database\Seeder;

use App\Models\Skema;

class SkemaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skema::create([
            'skema_label' => "Program Kemitraan Masyarakat"
        ]);

        Skema::create([
            'skema_label' => "Program Pengembangan Kewirausahaan"
        ]);

        Skema::create([
            'skema_label' => "Program Pengembangan Usaha Produk Intelektual Kampus"
        ]);

        Skema::create([
            'skema_label' => "Program Kemitraan Wilayah"
        ]);

        Skema::create([
            'skema_label' => "KKN Pembelajaran Pemberdayaan Masyarakat"
        ]);

        Skema::create([
            'skema_label' => "Program Kemitraan Masyarakat Stimulus"
        ]);

        Skema::create([
            'skema_label' => "Program Pengembangan Produk Unggulan Daerah"
        ]);

        Skema::create([
            'skema_label' => "Program Pengembangan Desa Mitra"
        ]);
    }
}
