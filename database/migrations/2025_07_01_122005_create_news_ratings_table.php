<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('news_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');

            $table->enum('spiciness', ['mild', 'medium', 'nuclear']);
            $table->enum('length', ['blink', 'scroll', 'scroll_of_destiny']);
            $table->enum('funny', ['chuckle', 'snort', 'spat']);
            $table->enum('topic', ['never_again', 'meh', 'banger']);

            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_ratings');
    }
}
