<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_selection_categories', function (Blueprint $table) {
            // Hapus foreign key constraint jika ada
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);

            // Ubah kolom menjadi unsigned tanpa foreign key constraint
            $table->unsignedBigInteger('category_id')->change();
            $table->unsignedBigInteger('user_id')->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_selection_categories', function (Blueprint $table) {
            // Jika ingin rollback, tambahkan foreign key kembali
            $table->foreign('category_id')->references('id')->on('categories_old')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
