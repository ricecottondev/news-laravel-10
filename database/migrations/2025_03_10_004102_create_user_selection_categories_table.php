<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_selection_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke users
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke categories
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_selection_categories');
    }
};
