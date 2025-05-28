<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIpToTestimonialsTable extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->ipAddress('ip_address')->nullable()->after('message');
            $table->string('user_agent')->nullable()->after('ip_address');
            $table->boolean('is_bot')->default(false)->after('user_agent');
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['ip_address', 'user_agent', 'is_bot']);
        });
    }
}
