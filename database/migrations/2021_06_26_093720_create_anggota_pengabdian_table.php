<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaPengabdianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_pengabdian', function (Blueprint $table) {
            $table->bigIncrements('anggota_pengabdian_id');
            $table->string('anggota_pengabdian_user_id', 64);
            $table->string('anggota_pengabdian_pengabdian_id', 64);
            $table->enum('anggota_pengabdian_role', ['ketua', 'anggota']);
            $table->text('anggota_pengabdian_tugas')->nullable();

            $table->timestamps();

            $table->foreign('anggota_pengabdian_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('anggota_pengabdian_pengabdian_id')->references('usulan_pengabdian_id')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anggota_pengabdian', function (Blueprint $table) {
            $table->dropForeign('anggota_pengabdian_anggota_pengabdian_user_id_foreign');
            $table->dropForeign('anggota_pengabdian_anggota_pengabdian_pengabdian_id_foreign');
        });
        Schema::dropIfExists('anggota_pengabdian');
    }
}
