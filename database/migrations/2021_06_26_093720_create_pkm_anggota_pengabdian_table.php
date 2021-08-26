<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmAnggotaPengabdianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_anggota_pengabdian', function (Blueprint $table) {
            $table->bigIncrements('anggota_pengabdian_id');
            $table->string('anggota_pengabdian_user_id', 64);
            $table->string('anggota_pengabdian_pengabdian_id', 64);
            $table->enum('anggota_pengabdian_role', ['ketua', 'anggota']);
            $table->unsignedInteger('anggota_pengabdian_role_position');
            $table->text('anggota_pengabdian_tugas')->nullable();

            $table->timestamps();

            $table->foreign('anggota_pengabdian_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('anggota_pengabdian_pengabdian_id')->references('usulan_pengabdian_id')->on('pkm_usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_anggota_pengabdian', function (Blueprint $table) {
            $table->dropForeign('pkm_anggota_pengabdian_anggota_pengabdian_user_id_foreign');
            $table->dropForeign('pkm_anggota_pengabdian_anggota_pengabdian_pengabdian_id_foreign');
        });
        Schema::dropIfExists('pkm_anggota_pengabdian');
    }
}
