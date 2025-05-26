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
            $table->string('property_title');
            $table->string('slug')->unique();

            // Owner Details
            $table->string('owner_name');
            $table->string('owner_contact');
            $table->string('owner_email')->nullable();
            $table->string('owner_address')->nullable();
            $table->enum('owner_nationality', ['Indian', 'NRI', 'Other'])->nullable();
            $table->enum('owner_type', ['Individual', 'Broker', 'Investor', 'Builder'])->nullable();
            $table->enum('owner_document_type', ['Registry', 'Kabza', 'Power of Attorney', 'By Parent', 'Other'])->nullable();

            // Property Details
            $table->string('property_address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('court_case', ['Yes', 'No']);
            $table->string('court_case_details')->nullable();
            $table->enum('current_status', ['Occupied', 'Vacant', 'Under Construction', 'Under Renovation', 'Under Dispute', 'Rented', 'Other']);
            $table->enum('listing_type', ['Sale', 'Rent', 'Lease', 'Collaborate']);
            $table->enum('property_type', ['Plot', 'House', 'Apartment', 'Villa', 'Office', 'Shop', 'Agriculture Land']);
            $table->enum('plot_category', ['Residential', 'Commercial', 'Industrial'])->nullable();
            
            // Plot Details
            $table->enum('measurement_unit', ['Sq. Feet', 'Sq. Yard', 'Sq. Meter', 'Sq. Acre', 'Sq. Marla', 'Sq. Bigha', 'Sq. Kanal'])->nullable()->default('Sq. Feet');
            $table->enum('plot_type', ['Corner', 'On Road', 'Park Facing', 'Normal'])->nullable();
            $table->string('plot_number')->nullable(); // Changed from decimal to string
            $table->decimal('plot_front', 12, 2)->nullable();
            $table->decimal('plot_side_1', 12, 2)->nullable();
            $table->decimal('plot_side_2', 12, 2)->nullable();
            $table->decimal('plot_back', 12, 2)->nullable();
            $table->decimal('plot_size', 12, 2)->nullable();
            $table->decimal('price_per_sqft', 12, 2)->nullable();

            // House / Apartment / Villa
            $table->string('floor_number')->nullable(); // Changed from integer to string
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('balconies')->nullable();
            $table->integer('total_floors')->nullable();
            $table->enum('furnishing_status', ['Furnished', 'Semi-Furnished', 'Unfurnished'])->nullable();

            // Office
            $table->integer('office_floor')->nullable();
            $table->integer('office_bathrooms')->nullable();
            $table->integer('office_balconies')->nullable();
            $table->enum('office_area_size_unit', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards'])->nullable();
            $table->decimal('office_area_size', 12, 2)->nullable();
            $table->enum('office_furnishing_status', ['Furnished', 'Semi-Furnished', 'Unfurnished'])->nullable();

            // Shop
            $table->enum('shop_type', ['In Market', 'In Mall', 'Standalone', 'Other'])->nullable();
            $table->enum('shop_area_size_unit', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards'])->nullable();
            $table->decimal('shop_front', 12, 2)->nullable();
            $table->decimal('shop_side_1', 12, 2)->nullable();
            $table->decimal('shop_side_2', 12, 2)->nullable();
            $table->decimal('shop_back', 12, 2)->nullable();
            $table->decimal('shop_area_size', 12, 2)->nullable();
            $table->integer('shop_floor')->nullable();
            $table->enum('shop_with_water_connection', ['Yes', 'No'])->nullable();

            // Agriculture Land
            $table->enum('land_type', ['Agriculture', 'Farm House', 'Other'])->nullable();
            $table->enum('land_area_size_unit', ['Feet', 'Meters', 'Yards', 'Marla', 'Kanal', 'Kila', 'Bigha', 'Acre'])->nullable();
            $table->decimal('land_area_size', 12, 2)->nullable();
            $table->enum('current_status_of_land', ['Cultivated', 'Vacant', 'Under Dispute', 'Other'])->nullable();

            // Common Fields
            $table->enum('price_in_unit', ['Lakh', 'Crore', 'Thousand', 'Millon', 'Billon', 'Trillion']);
            $table->decimal('price', 15, 2);
            $table->enum('negotiable_price', ['Yes', 'No'])->nullable()->default('No');
            $table->decimal('market_price', 15, 2)->nullable(); // Average price in the area
            $table->string('hospital_distance')->nullable();
            $table->string('railway_distance')->nullable();
            $table->string('transport_distance')->nullable();

            $table->string('image')->nullable(); // Thumbnail
            $table->text('description')->nullable();

            $table->unsignedBigInteger('city_id');
            $table->string('area')->nullable();
            $table->string('area_unit')->nullable();
            $table->string('location');
            $table->enum('facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default-('N/A');
            $table->string('status')->default('active'); // pending, active, sold, etc.
            $table->unsignedBigInteger('user_id'); // seller, broker, Employee, etc.
            // youtube video link
            $table->string('video_link')->nullable();

            $table->timestamps();
            $table->softDeletes(); // optional but useful for recovery

            // Foreign Keys
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes for faster filtering
            $table->index(['city_id', 'user_id', 'status', 'listing_type', 'property_type'], 'prop_search_index');
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
