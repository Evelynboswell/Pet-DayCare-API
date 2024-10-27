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
        Schema::create('booking', function (Blueprint $table) {
            $table->string('booking_id')->primary();
            $table->string('dog_id');
            $table->foreign('dog_id')->references('dog_id')->on('dog')->onDelete('cascade');
            $table->string('boarding_id');
            $table->foreign('boarding_id')->references('boarding_id')->on('daycare')->onDelete('cascade');
            $table->date('booking_date');
            $table->integer('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
