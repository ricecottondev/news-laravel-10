<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Jika ada foreign key
            $table->dropColumn('category_id');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();

            // Jika sebelumnya ada foreign key, tambahkan kembali
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
