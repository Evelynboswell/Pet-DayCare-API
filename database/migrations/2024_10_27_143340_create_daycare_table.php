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
        Schema::create('daycare', function (Blueprint $table) {
            $table->string('boarding_id')->primary();
            $table->string('boarding_name');
            $table->string('boarding_type');
            $table->string('boarding_description');
            $table->integer('price');
            $table->integer('current_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daycare');
    }
};
