<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmPenilaianUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_penilaian_usulan', function (Blueprint $table) {
            $table->bigIncrements('penilaian_usulan_id');
            $table->string('penilaian_usulan_pengabdian_id', 64);
            $table->boolean('penilaian_usulan_lock')->default(false);
            $table->text('penilaian_usulan_komentar')->nullable();
            $table->integer('penilaian_usulan_nilai_1');
            $table->integer('penilaian_usulan_nilai_2');
            $table->integer('penilaian_usulan_nilai_3');
            $table->integer('penilaian_usulan_nilai_4');
            $table->integer('penilaian_usulan_nilai_5');
            $table->integer('penilaian_usulan_nilai_6');
            $table->timestamps();

            $table->foreign('penilaian_usulan_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_penilaian_usulan', function (Blueprint $table) {
            $table->dropForeign('pkm_penilaian_usulan_penilaian_usulan_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_penilaian_usulan');
    }
}
