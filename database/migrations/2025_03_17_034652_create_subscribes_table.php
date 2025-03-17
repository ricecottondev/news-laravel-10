<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke users
            $table->string('stripe_subscription_id')->unique(); // ID subscription dari Stripe
            $table->string('plan'); // Plan yang dipilih (weekly, monthly, yearly)
            $table->decimal('amount', 10, 2); // Jumlah pembayaran
            $table->date('start_date'); // Tanggal mulai langganan
            $table->date('end_date'); // Tanggal akhir langganan
            $table->string('status')->default('active'); // Status (active, canceled, expired)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribes');
    }
};
