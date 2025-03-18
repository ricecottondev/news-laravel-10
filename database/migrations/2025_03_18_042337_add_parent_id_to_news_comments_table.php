<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('news_id');
            $table->foreign('parent_id')->references('id')->on('news_comments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }
};
