<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmLaporanKemajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_laporan_kemajuan', function (Blueprint $table) {
            $table->bigIncrements('laporan_kemajuan_id');
            $table->string('laporan_kemajuan_pengabdian_id', 64);
            $table->date('laporan_kemajuan_date');
            $table->enum('laporan_kemajuan_tipe', ['kemajuan', 'keuangan']);
            $table->string('laporan_kemajuan_original_name', 255);
            $table->string('laporan_kemajuan_hash_name', 255);
            $table->string('laporan_kemajuan_base_name', 255);
            $table->string('laporan_kemajuan_file_size', 255);
            $table->string('laporan_kemajuan_extension', 50);

            $table->timestamps();

            $table->foreign('laporan_kemajuan_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_laporan_kemajuan', function (Blueprint $table) {
            $table->dropForeign('pkm_laporan_kemajuan_laporan_kemajuan_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_laporan_kemajuan');
    }
}
