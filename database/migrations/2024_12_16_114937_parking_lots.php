<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const COORDS_PRECISION_TOTAL = 17;

    private const COORDS_PRECISION_PLACES = 15;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parking_lots', function (Blueprint $table) {
            $table->increments('lot_number');
            $table->decimal('lat', self::COORDS_PRECISION_TOTAL, self::COORDS_PRECISION_PLACES);
            $table->decimal('lng', self::COORDS_PRECISION_TOTAL, self::COORDS_PRECISION_PLACES);
            $table->boolean('curr_status')->default(false);
            $table->unsignedBigInteger('zone_id')->default('1');
            $table->string('address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('zone_id')->references('id')->on('parking_lot_zones')->onDelete('cascade');
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
