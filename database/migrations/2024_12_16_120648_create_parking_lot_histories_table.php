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
            $table->id(); // Identificativo univoco del record
            $table->unsignedBigInteger('user_id'); // Riferimento all'utente
            $table->unsignedInteger('lot_number'); // Numero del posto auto
            $table->dateTime('start_parking'); // Data e ora di inizio parcheggio
            $table->dateTime('end_parking'); // Data e ora di fine parcheggio
            $table->boolean('processed')->default(false); // Flag per indicare se il record è stato processato
            $table->dateTime('processed_at')->nullable(); // Data e ora del processamento, se applicabile
            $table->timestamps(); // Campi standard created_at e updated_at

            // Vincoli di chiave esterna
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lot_number')->references('lot_number')->on('parking_lots')->onDelete('cascade');
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
