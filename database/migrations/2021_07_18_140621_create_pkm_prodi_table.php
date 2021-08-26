<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmProdiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_prodi', function (Blueprint $table) {
            $table->bigIncrements('prodi_id');
            $table->unsignedBigInteger('prodi_jurusan_id');
            $table->string('prodi_nama', 255);

            $table->timestamps();

            $table->foreign('prodi_jurusan_id')->references('jurusan_id')->on('pkm_jurusan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_prodi', function (Blueprint $table) {
            $table->dropForeign('pkm_prodi_prodi_jurusan_id_foreign');
        });
        Schema::dropIfExists('pkm_prodi');
    }
}
