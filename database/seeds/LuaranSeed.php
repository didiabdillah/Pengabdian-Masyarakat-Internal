<?php

use Illuminate\Database\Seeder;

use App\Models\Kategori_luaran;
use App\Models\Jenis_luaran;
use App\Models\Status_luaran;

class LuaranSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Publikasi di prosiding seminar nasional ber ISBN",
            'kategori_luaran_required' => "wajib"
        ]);

        // Jenis
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Artikel di prosiding seminar nasional ber ISBN"
        ]);

        // Status
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Published"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Publikasi di media massa cetak",
            'kategori_luaran_required' => "wajib"
        ]);

        // Jenis
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Artikel di media massa cetak"
        ]);

        // Status
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Published"
        ]);


        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Publikasi di media massa elektronik",
            'kategori_luaran_required' => "wajib"
        ]);

        // Jenis
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Artikel di media massa elektronik"
        ]);

        // Status
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Published"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Video pelaksanaan kegiatan",
            'kategori_luaran_required' => "wajib"
        ]);

        // Jenis
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Konten Video pelaksanaan kegiatan"
        ]);

        // Status
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Bisa Diakses"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Peningkatan pemberdayaan mitra",
            'kategori_luaran_required' => "wajib"
        ]);

        // Jenis
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan jenis produk mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan keterampilan mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan pendapatan mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan jumlah aset mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan jumlah tenaga kerja mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan kemampuan manajemen mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan jumlah omset mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan income generating mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan jumlah produk mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan revenue generating mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan kesehatan mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan pengetahuan mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan pelayanan mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Peningkatan kualitas produk mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Keberhasilan mitra melakukan pemasaran antar pulau"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Keberhasilan mitra melakukan ekspor"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Produk terstandarisasi mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Produk tersertifikasi mitra"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Unit usaha berbadan hukum"
        ]);

        // Status
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Tercapai"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Publikasi di jurnal Internasional",
            'kategori_luaran_required' => "tambahan"
        ]);

        // Jenis
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Artikel di jurnal internasional"
        ]);
        Jenis_luaran::create([
            'jenis_luaran_kategori_id' => $query->kategori_luaran_id,
            'jenis_luaran_label' => "Artikel di jurnal internasional terindeks di pengindeks bereputasi"
        ]);

        // Status
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Accepted"
        ]);
        Status_luaran::create([
            'status_luaran_kategori_id' => $query->kategori_luaran_id,
            'status_luaran_label' => "Published"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Publikasi di prosiding Seminar Internasional",
            'kategori_luaran_required' => "tambahan"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Buku cetak hasil pengabdian",
            'kategori_luaran_required' => "tambahan"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Buku elektronik hasil pengabdian",
            'kategori_luaran_required' => "tambahan"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Book chapter",
            'kategori_luaran_required' => "tambahan"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Paten",
            'kategori_luaran_required' => "tambahan"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Paten sederhana",
            'kategori_luaran_required' => "tambahan"
        ]);

        // =======================================================================

        // Kategori
        $query = Kategori_luaran::create([
            'kategori_luaran_label' => "Hak cipta",
            'kategori_luaran_required' => "tambahan"
        ]);
    }
}
