<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWilayahKabupatenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah_kabupaten', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('provinsi_id', 2);

            $table->string('nama', 30);

            $table->timestamps();

            $table->foreign('provinsi_id')->references('id')->on('wilayah_provinsi')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wilayah_kabupaten', function (Blueprint $table) {
            $table->dropForeign('wilayah_kabupaten_provinsi_id_foreign');
        });
        Schema::dropIfExists('wilayah_kabupaten');
    }
}
