<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitraFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra_file', function (Blueprint $table) {
            $table->bigIncrements('mitra_file_id');
            $table->unsignedBigInteger('mitra_file_mitra_sasaran_id');
            $table->enum('mitra_file_kategori', ['dokumen1', 'dokumen2']);
            $table->string('mitra_sasaran_file_original_name', 255)->nullable();
            $table->string('mitra_sasaran_file_hash_name', 255)->nullable();
            $table->string('mitra_sasaran_file_base_name', 255)->nullable();
            $table->string('mitra_sasaran_file_size', 255)->nullable();
            $table->string('mitra_sasaran_file_extension', 50)->nullable();
            $table->date('mitra_sasaran_file_date')->nullable();

            $table->timestamps();

            $table->foreign('mitra_file_mitra_sasaran_id')->references('mitra_sasaran_id')->on('mitra_sasaran')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mitra_file', function (Blueprint $table) {
            $table->dropForeign('mitra_file_mitra_file_mitra_sasaran_id_foreign');
        });
        Schema::dropIfExists('mitra_file');
    }
}
