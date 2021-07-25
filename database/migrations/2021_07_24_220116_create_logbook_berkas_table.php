<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook_berkas', function (Blueprint $table) {
            $table->bigIncrements('logbook_berkas_id');
            $table->string('logbook_berkas_pengabdian_id', 64);
            $table->date('logbook_berkas_date');
            $table->string('logbook_berkas_keterangan');
            $table->string('logbook_berkas_original_name', 255);
            $table->string('logbook_berkas_hash_name', 255);
            $table->string('logbook_berkas_base_name', 255);
            $table->string('logbook_berkas_file_size', 255);
            $table->string('logbook_berkas_extension', 50);

            $table->timestamps();

            // $table->foreign('logbook_pengabdian_id')->references('usulan_pengabdian_id')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('logbook', function (Blueprint $table) {
        //     $table->dropForeign('logbook_logbook_pengabdian_id_foreign');
        // });
        Schema::dropIfExists('logbook_berkas');
    }
}
