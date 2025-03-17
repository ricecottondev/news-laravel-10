<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Cek apakah foreign key ada sebelum menghapusnya
            $foreignKeys = DB::select("SELECT CONSTRAINT_NAME
                                       FROM information_schema.KEY_COLUMN_USAGE
                                       WHERE TABLE_NAME = 'news'
                                       AND COLUMN_NAME = 'category_id'
                                       AND CONSTRAINT_SCHEMA = DATABASE()");

            if (!empty($foreignKeys)) {
                $table->dropForeign('news_category_id_foreign'); // Hapus foreign key
            }

            $table->dropColumn('category_id'); // Hapus kolom setelah foreign key dihapus
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();

            // Tambahkan kembali foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
