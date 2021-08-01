<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianMonevTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_monev', function (Blueprint $table) {
            $table->bigIncrements('penilaian_monev_id');
            $table->string('penilaian_monev_pengabdian_id', 64);

            $table->timestamps();

            $table->foreign('penilaian_monev_pengabdian_id')->references('usulan_pengabdian_id')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penilaian_monev', function (Blueprint $table) {
            $table->dropForeign('penilaian_monev_penilaian_monev_pengabdian_id_foreign');
        });
        Schema::dropIfExists('penilaian_monev');
    }
}
