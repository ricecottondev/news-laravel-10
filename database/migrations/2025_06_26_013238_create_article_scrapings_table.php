<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_scrapings', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul artikel
            $table->text('summary'); // Ringkasan artikel
            $table->string('source'); // Sumber artikel (misalnya, Heywire, ABC News)
            $table->string('topic'); // Topik artikel (misalnya, Regional Communities)
            $table->date('date'); // Tanggal artikel
            $table->string('url')->unique(); // URL artikel, unik untuk mencegah duplikasi
            $table->text('content'); // Konten tambahan dari sublink
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_scrapings');
    }
};
