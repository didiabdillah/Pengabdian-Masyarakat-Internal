<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmKategoriLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_kategori_luaran', function (Blueprint $table) {
            $table->bigIncrements('kategori_luaran_id');

            $table->string('kategori_luaran_label');

            $table->enum('kategori_luaran_required', ['wajib', 'tambahan']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pkm_kategori_luaran');
    }
}
