<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private Array $coordsPrecision = ['total' => 17, 'places' => 15]; // places indica quante cifre dopo la virgola

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->id();
            $table->decimal('lat', $this->coordsPrecision['total'], $this->coordsPrecision['places'])->unique();
            $table->decimal('lng', $this->coordsPrecision['total'], $this->coordsPrecision['places'])->unique();
            $table->integer('lot_number')->unique();
            $table->string('zone')->unique()->nullable();
            $table->boolean('curr_status')->default(false);
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_lots');
    }
};
