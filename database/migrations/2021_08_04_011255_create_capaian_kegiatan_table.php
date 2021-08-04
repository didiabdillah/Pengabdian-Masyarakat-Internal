<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapaianKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capaian_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('capaian_kegiatan_id');
            $table->string('capaian_kegiatan_pengabdian_id', 64);

            $table->unsignedInteger('capaian_kegiatan_urutan');
            // $table->text('capaian_kegiatan_pertanyaan');
            $table->text('capaian_kegiatan_jawaban');
            // $table->string('capaian_kegiatan_kategori');

            $table->timestamps();

            $table->foreign('capaian_kegiatan_pengabdian_id')->references('usulan_pengabdian_id')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capaian_kegiatan', function (Blueprint $table) {
            $table->dropForeign('capaian_kegiatan_capaian_kegiatan_pengabdian_id_foreign');
        });
        Schema::dropIfExists('capaian_kegiatan');
    }
}
