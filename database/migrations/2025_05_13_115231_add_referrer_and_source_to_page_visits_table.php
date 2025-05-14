<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            $table->text('referrer')->nullable()->after('url');
            $table->string('source')->nullable()->after('referrer'); // contoh: facebook, twitter, etc.
        });
    }

    public function down(): void
    {
        Schema::table('page_visits', function (Blueprint $table) {
            $table->dropColumn(['referrer', 'source']);
        });
    }
};
