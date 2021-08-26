<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmDokumenRabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_dokumen_rab', function (Blueprint $table) {
            $table->bigIncrements('dokumen_rab_id');
            $table->string('dokumen_rab_pengabdian_id', 64);
            $table->string('dokumen_rab_original_name', 255);
            $table->string('dokumen_rab_hash_name', 255);
            $table->string('dokumen_rab_base_name', 255);
            $table->string('dokumen_rab_file_size', 255);
            $table->string('dokumen_rab_extension', 50);

            $table->timestamps();

            $table->foreign('dokumen_rab_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_dokumen_rab', function (Blueprint $table) {
            $table->dropForeign('pkm_dokumen_rab_dokumen_rab_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_dokumen_rab');
    }
}
