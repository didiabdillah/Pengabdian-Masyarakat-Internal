<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmLaporanAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_laporan_akhir', function (Blueprint $table) {
            $table->bigIncrements('laporan_akhir_id');
            $table->string('laporan_akhir_pengabdian_id', 64);
            $table->date('laporan_akhir_date');
            $table->enum('laporan_akhir_tipe', ['akhir', 'keuangan']);
            $table->string('laporan_akhir_original_name', 255);
            $table->string('laporan_akhir_hash_name', 255);
            $table->string('laporan_akhir_base_name', 255);
            $table->string('laporan_akhir_file_size', 255);
            $table->string('laporan_akhir_extension', 50);

            $table->timestamps();

            $table->foreign('laporan_akhir_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_laporan_akhir', function (Blueprint $table) {
            $table->dropForeign('pkm_laporan_akhir_laporan_akhir_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_laporan_akhir');
    }
}
