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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city_latitude')->nullable();
            $table->string('city_longitude')->nullable();
            $table->string('state')->nullable();
            $table->string('state_latitude')->nullable();
            $table->string('state_longitude')->nullable();
            $table->string('country')->nullable();
            $table->string('country_latitude')->nullable();
            $table->string('country_longitude')->nullable();
            $table->string('pincode')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
