<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulanPengabdianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulan_pengabdian', function (Blueprint $table) {
            $table->string('usulan_pengabdian_id', 64)->primary()->unique();
            $table->string('usulan_pengabdian_reviewer_id', 64);
            $table->string('usulan_pengabdian_judul');
            $table->boolean('usulan_pengabdian_kategori'); //[Kompetitif Nasional / Desentralisasi]
            $table->bigInteger('usulan_pengabdian_skema_id')->unsigned()->nullable();
            $table->bigInteger('usulan_pengabdian_bidang_id')->unsigned()->nullable();
            $table->integer('usulan_pengabdian_lama_kegiatan');
            $table->integer('usulan_pengabdian_mahasiswa_terlibat');
            $table->year('usulan_pengabdian_tahun');
            $table->boolean('usulan_pengabdian_submit');
            $table->enum('usulan_pengabdian_status', ['dikirim', 'diterima', 'ditolak', 'pending']);
            $table->text('usulan_pengabdian_komentar')->nullable();

            $table->timestamps();

            $table->foreign('usulan_pengabdian_skema_id')->references('skema_id')->on('skema_pengabdian')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('usulan_pengabdian_bidang_id')->references('bidang_id')->on('bidang_pengabdian')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usulan_pengabdian', function (Blueprint $table) {
            $table->dropForeign('usulan_pengabdian_usulan_pengabdian_skema_id_foreign');
            $table->dropForeign('usulan_pengabdian_usulan_pengabdian_bidang_id_foreign');
        });
        Schema::dropIfExists('usulan_pengabdian');
    }
}
