<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmPenilaianMonevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_penilaian_monev', function (Blueprint $table) {
            $table->bigIncrements('penilaian_monev_id');
            $table->string('penilaian_monev_pengabdian_id', 64);

            $table->boolean('penilaian_monev_lock')->default(false);

            // $table->integer('penilaian_monev_urutan')->nullable();
            // $table->string('penilaian_monev_kriteria');

            $table->text('penilaian_monev_skor')->nullable();
            $table->text('penilaian_monev_nilai')->nullable();
            $table->text('penilaian_monev_justifikasi')->nullable();

            $table->text('penilaian_monev_catatan')->nullable();

            $table->mediumText('penilaian_monev_tanda_tangan')->nullable();

            $table->timestamps();

            $table->foreign('penilaian_monev_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_penilaian_monev', function (Blueprint $table) {
            $table->dropForeign('pkm_penilaian_monev_penilaian_monev_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_penilaian_monev');
    }
}
