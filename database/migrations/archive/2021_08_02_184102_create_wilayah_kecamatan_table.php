<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_kecamatan', function (Blueprint $table) {
            $table->string('id', 7)->primary();
            $table->string('kabupaten_id', 4);

            $table->string('nama', 30);

            $table->timestamps();

            $table->foreign('kabupaten_id')->references('id')->on('wilayah_kabupaten')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wilayah_kecamatan', function (Blueprint $table) {
            $table->dropForeign('wilayah_kecamatan_kabupaten_id_foreign');
        });
        Schema::dropIfExists('wilayah_kecamatan');
    }
}
