<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmStatusLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_status_luaran', function (Blueprint $table) {
            $table->bigIncrements('status_luaran_id');
            $table->unsignedBigInteger('status_luaran_kategori_id');

            $table->string('status_luaran_label');

            $table->timestamps();

            $table->foreign('status_luaran_kategori_id')->references('kategori_luaran_id')->on('pkm_kategori_luaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_status_luaran', function (Blueprint $table) {
            $table->dropForeign('pkm_status_luaran_status_luaran_kategori_id_foreign');
        });
        Schema::dropIfExists('pkm_status_luaran');
    }
}
