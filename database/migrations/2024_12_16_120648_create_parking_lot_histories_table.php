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
        Schema::create('parking_lot_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('lot_number');
            $table->timestamp('occuped_at');
            $table->timestamp('freed_at');

            $table->unsignedBigInteger('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_lot_histories');
    }
};
