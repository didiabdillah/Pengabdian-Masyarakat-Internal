<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->bigIncrements('biodata_id');
            $table->string('biodata_user_id', 64)->unique();
            $table->boolean('biodata_sex');
            $table->string('biodata_college')->nullable();
            $table->string('biodata_study_program')->nullable();
            $table->string('biodata_position')->nullable();
            $table->string('biodata_birthplace');
            $table->date('biodata_birthdate');
            $table->string('biodata_ktp_number');
            $table->string('biodata_hp_number')->nullable();
            $table->string('biodata_telephone_number')->nullable();
            $table->string('biodata_address')->nullable();
            $table->string('biodata_personal_web')->nullable();
            $table->string('biodata_image');
            $table->timestamps();

            $table->foreign('biodata_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biodata', function (Blueprint $table) {
            $table->dropForeign('biodata_biodata_user_id_foreign');
        });
        Schema::dropIfExists('biodata');
    }
}
