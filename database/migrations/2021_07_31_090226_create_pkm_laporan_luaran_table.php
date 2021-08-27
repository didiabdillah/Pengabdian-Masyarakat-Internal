<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmLaporanLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_laporan_luaran', function (Blueprint $table) {
            $table->bigIncrements('laporan_luaran_id');
            $table->unsignedBigInteger('laporan_luaran_luaran_id');
            $table->string('laporan_luaran_nama_publikasi');
            $table->string('laporan_luaran_judul');
            $table->string('laporan_luaran_link')->nullable();
            $table->date('laporan_luaran_date');
            $table->string('laporan_luaran_original_name', 255);
            $table->string('laporan_luaran_hash_name', 255);
            $table->string('laporan_luaran_base_name', 255);
            $table->string('laporan_luaran_file_size', 255);
            $table->string('laporan_luaran_extension', 50);

            $table->timestamps();

            $table->foreign('laporan_luaran_luaran_id')->references('usulan_luaran_id')->on('pkm_usulan_luaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_laporan_luaran', function (Blueprint $table) {
            $table->dropForeign('pkm_laporan_luaran_laporan_luaran_luaran_id_foreign');
        });
        Schema::dropIfExists('pkm_laporan_luaran');
    }
}
