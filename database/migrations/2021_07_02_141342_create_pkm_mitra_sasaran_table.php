<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmMitraSasaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_mitra_sasaran', function (Blueprint $table) {
            $table->bigIncrements('mitra_sasaran_id');
            $table->string('mitra_sasaran_pengabdian_id', 64);
            $table->string('mitra_sasaran_tipe_mitra');
            $table->string('mitra_sasaran_jenis_mitra');
            $table->string('mitra_sasaran_nama_pimpinan_mitra');
            $table->string('mitra_sasaran_jabatan_pimpinan_mitra');
            $table->string('mitra_sasaran_nama_mitra');
            $table->string('mitra_sasaran_alamat_mitra');
            $table->string('mitra_sasaran_provinsi_mitra');
            $table->string('mitra_sasaran_kota_mitra');
            $table->string('mitra_sasaran_kecamatan_mitra');
            $table->string('mitra_sasaran_desa_mitra');
            $table->string('mitra_sasaran_jarak_mitra');
            $table->text('mitra_sasaran_bidang_masalah_mitra');
            $table->string('mitra_sasaran_kontribusi_pendanaan_mitra')->nullable();

            $table->timestamps();

            $table->foreign('mitra_sasaran_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_mitra_sasaran', function (Blueprint $table) {
            $table->dropForeign('pkm_mitra_sasaran_mitra_sasaran_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_mitra_sasaran');
    }
}
