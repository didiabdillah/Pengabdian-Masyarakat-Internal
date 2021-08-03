<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_desa', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('kecamatan_id', 7);

            $table->string('nama', 40);

            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('wilayah_kecamatan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wilayah_desa', function (Blueprint $table) {
            $table->dropForeign('wilayah_desa_kecamatan_id_foreign');
        });
        Schema::dropIfExists('wilayah_desa');
    }
}
