<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPollsTable extends Migration
{
    public function up()
    {
        Schema::create('news_polls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');

            $table->enum('poll_result', ['totally', 'mid', 'frozen_peas']);
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_polls');
    }
}
