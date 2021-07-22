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
            $table->dateTime('logbook_date');
            $table->string('logbook_original_name', 255);
            $table->string('logbook_hash_name', 255);
            $table->string('logbook_base_name', 255);
            $table->string('logbook_file_size', 255);
            $table->string('logbook_extension', 50);

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
