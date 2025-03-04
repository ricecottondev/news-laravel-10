<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('log_login', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iduser'); // Mengacu ke user yang login
            $table->string('type'); // Tipe login (misalnya: "Google", "Manual", "Apple")
            $table->text('note')->nullable(); // Catatan tambahan
            $table->enum('status', ['success', 'failed'])->default('success'); // Status login
            $table->boolean('deleted')->default(false); // Soft delete manual
            $table->timestamps(); // created_at & updated_at

            // Foreign key ke tabel users (opsional, jika user ada di tabel users)
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_login');
    }
};

