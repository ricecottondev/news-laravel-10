<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('password');
            $table->string('apple_id')->nullable()->after('google_id');
            $table->string('token_firebase')->nullable()->after('apple_id');
            $table->uuid('uuid')->unique()->nullable()->after('token_firebase');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'apple_id', 'token_firebase', 'uuid']);
        });
    }
};
