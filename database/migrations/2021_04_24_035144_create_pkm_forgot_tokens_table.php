<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePkmForgotTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkm_forgot_tokens', function (Blueprint $table) {
            $table->bigIncrements('forgot_token_id');
            $table->string('forgot_token_user_id', 64);
            $table->string('forgot_token_user_email', 255);
            $table->string('forgot_token', 64);
            $table->string('forgot_token_due_time');

            $table->timestamps();

            $table->foreign('forgot_token_user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pkm_forgot_tokens', function (Blueprint $table) {
            $table->dropForeign('pkm_forgot_tokens_forgot_token_user_id_foreign');
        });
        Schema::dropIfExists('pkm_forgot_tokens');
    }
}
