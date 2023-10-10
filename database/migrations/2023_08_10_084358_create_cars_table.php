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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number_plate');
            $table->foreignId('brand_id')->constrained();
            $table->year('launch_year');
            $table->bigInteger('mileage');
            $table->enum('transmission', ['Manual', 'Automatic']);
            $table->enum('fuel_type', ['Petrol', 'Electric']);
            $table->integer('number_of_seat');
            $table->double('price_per_day');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
