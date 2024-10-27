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
        Schema::create('dog', function (Blueprint $table) {
            $table->string('dog_id')->primary();
            $table->string('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
            $table->string('name');
            $table->string('breed');
            $table->string('gender');
            $table->string('color');
            $table->string('age');
            $table->string('weight');
            $table->string('medical_condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog');
    }
};
