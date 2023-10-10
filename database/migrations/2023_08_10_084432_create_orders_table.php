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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('car_id')->constrained();
            $table->string('pickup_location')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('pickup_time');
            $table->enum('order_status', ['Waiting For Payment', 'Waiting for Pickup', 'On Going', 'Overdue', 'Finished', 'Canceled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
