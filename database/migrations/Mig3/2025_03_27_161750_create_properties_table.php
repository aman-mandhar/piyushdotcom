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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable(); // Thumbnail
            $table->text('description')->nullable();
            
            $table->unsignedBigInteger('city_id');
            $table->string('area'); // in sq ft or sq yard
            $table->string('location');
        
            $table->decimal('price', 12, 2)->nullable(); // Optional for Collaborate
            $table->enum('listing_type', ['Sale', 'Rent', 'Lease', 'Collaborate']);
            $table->enum('property_type', [
                'Residential Plot',
                'House',
                'Apartment',
                'Villa',
                'Office',
                'Shop',
                'Commercial Plot',
                'Industrial Land',
                'Agriculture Land',
            ]);
        
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedTinyInteger('balconies')->nullable();
        
            $table->string('hospital_distance')->nullable();
            $table->string('railway_distance')->nullable();
            $table->string('transport_distance')->nullable();
        
            $table->unsignedBigInteger('user_id'); // seller or broker
        
            $table->string('status')->default('active'); // pending, active, sold, etc.
            $table->timestamps();
        
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
