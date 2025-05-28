<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->enum('status', ['draft', 'published'])->default('draft')->after('comment');
        });
    }

    public function down()
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
