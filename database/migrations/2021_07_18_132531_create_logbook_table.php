<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logbook', function (Blueprint $table) {
            $table->bigIncrements('logbook_id');
            $table->string('logbook_pengabdian_id', 64);
            $table->date('logbook_date');
            $table->longText('logbook_uraian_kegiatan');
            $table->unsignedFloat('logbook_presentase');

            $table->timestamps();

            $table->foreign('logbook_pengabdian_id')->references('usulan_pengabdian_id')->on('usulan_pengabdian')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logbook', function (Blueprint $table) {
            $table->dropForeign('logbook_logbook_pengabdian_id_foreign');
        });
        Schema::dropIfExists('logbook');
    }
}
