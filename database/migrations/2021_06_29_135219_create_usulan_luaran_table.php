<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanLuaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_luaran', function (Blueprint $table) {
            $table->bigIncrements('usulan_luaran_id');
            $table->string('usulan_luaran_pengabdian_id', 64);
            $table->enum('usulan_luaran_pengabdian_tipe', ['wajib', 'tambahan']);
            $table->string('usulan_luaran_pengabdian_tahun');
            $table->string('usulan_luaran_pengabdian_kategori');
            $table->string('usulan_luaran_pengabdian_jenis');
            $table->string('usulan_luaran_pengabdian_status');
            $table->string('usulan_luaran_pengabdian_rencana');
            $table->timestamps();

            $table->foreign('usulan_luaran_pengabdian_id')->references('usulan_pengabdian_id')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_luaran', function (Blueprint $table) {
            $table->dropForeign('usulan_luaran_usulan_luaran_pengabdian_id_foreign');
        });
        Schema::dropIfExists('usulan_luaran');
    }
}
