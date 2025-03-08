<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('is_breaking_news')->default(false)->after('content');
            // Sesuaikan posisi `after('content')` sesuai kebutuhan
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('is_breaking_news');
        });
    }
};
