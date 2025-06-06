<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {       
        Schema::create('listing_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. 'Sale', 'Rent', 'Lease', 'Collaborate'
            $table->timestamps();
        });
        DB::table('listing_types')->insert([
            ['name' => 'Sale', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rent', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lease', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Collaborate', 'created_at' => now(), 'updated_at' => now()],
        ]);
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. Plot', 'House', 'Apartment', 'Flat', 'Villa', 'Office', 'Shop', 'Agriculture Land, 'Industrial Land'
            $table->timestamps();
        });
        DB::table('property_types')->insert([
            ['name' => 'Plot', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'House', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apartment', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Flat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Villa', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Office', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Shop', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Agriculture Land', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Industrial Land', 'created_at' => now(), 'updated_at' => now()],
        ]);
        if (!Schema::hasTable('plots')) {
            Schema::create('plots', function (Blueprint $table) {
                $table->id();
                $table->decimal('plot_front', 12, 2)->nullable();
                $table->decimal('plot_side_1', 12, 2)->nullable();
                $table->decimal('plot_side_2', 12, 2)->nullable();
                $table->decimal('plot_back', 12, 2)->nullable();
                $table->decimal('plot_size', 12, 2)->nullable();
                $table->enum('plot_area_units', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards', 'Marla','Kanal'])->nullable()->default('Sq. Feet');
                $table->enum('use_as', ['Residential', 'Commercial', 'Industrial', 'Mix'])->nullable();
                $table->timestamps();
            });
        }
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('house_type')->nullable(); // e.g. 'Independent', 'Duplex', 'Triplex'
            $table->string('house_area_size')->nullable();
            $table->enum('house_area_units', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards', 'Marla','Kanal'])->nullable();
            $table->enum('house_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('apartment_type')->nullable(); // e.g. '1BHK', '2BHK', '3BHK', '4BHK'
            $table->string('apartment_area_size')->nullable();
            $table->enum('apartment_area_units', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards', 'Marla','Kanal'])->nullable();
            $table->enum('apartment_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });
        Schema::create('villas', function (Blueprint $table) {
            $table->id();
            $table->string('villa_type')->nullable(); // e.g. 'Luxury', 'Standard'
            $table->string('villa_area_size')->nullable();
            $table->enum('villa_area_units', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards', 'Marla','Kanal'])->nullable();
            $table->enum('villa_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_type')->nullable(); // e.g. 'Co-working', 'Private', 'Shared'
            $table->string('office_area_size')->nullable();
            $table->enum('office_area_units', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards'])->nullable();
            $table->string('floor_number')->nullable(); // Changed from integer to string
            $table->enum('office_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_type')->nullable(); // e.g. 'In Market', 'In Mall', 'Standalone', 'Other'
            $table->string('shop_area_size')->nullable();
            $table->enum('shop_area_units', ['Sq. Feet', 'Sq. Meters', 'Sq. Yards'])->nullable()->default('Sq. Feet');
            $table->decimal('shop_front', 12, 2)->nullable();
            $table->decimal('shop_side_1', 12, 2)->nullable();
            $table->decimal('shop_side_2', 12, 2)->nullable();
            $table->decimal('shop_back', 12, 2)->nullable();
            $table->integer('shop_floor')->nullable();
            $table->enum('shop_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });
        Schema::create('agriculture_lands', function (Blueprint $table) {
            $table->id();
            $table->string('land_type')->nullable(); // e.g. 'Agriculture', 'Farm House', 'Other'
            $table->string('land_area_size')->nullable();
            $table->enum('land_area_units', ['Feet', 'Meters', 'Yards', 'Marla', 'Kanal', 'Kila', 'Bigha', 'Acre'])->nullable();
            $table->enum('land_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });
        Schema::create('industrial_lands', function (Blueprint $table) {
            $table->id();
            $table->string('land_type')->nullable(); // e.g. 'Industrial', 'Warehouse', 'Factory'
            $table->string('land_area_size')->nullable();
            $table->enum('land_area_units', ['Feet', 'Meters', 'Yards', 'Marla', 'Kanal', 'Kila', 'Bigha', 'Acre'])->nullable();
            $table->enum('land_facing', ['North', 'North-East', 'North-West', 'South', 'South-East', 'South-West', 'East', 'West', 'N/A'])->nullable()->default('N/A');
            $table->timestamps();
        });    
        
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('owner_document_type', ['Registry', 'Kabza', 'Power of Attorney', 'By Parent', 'Other'])->nullable();
            $table->enum('current_status', ['Occupied', 'Vacant', 'Under Construction', 'Under Renovation', 'Under Dispute', 'Rented', 'Other']);
            $table->string('property_address');
            $table->string('location');
            $table->enum('price_in', ['Lakh', 'Crore', 'Thousand', 'Million', 'Billion', 'Trillion']);
            $table->decimal('price', 15, 2);
            $table->string('status')->default('active'); // pending, active, sold, etc.
                
            
            // Non Mandatory fields
            $table->enum('advantage', ['Corner', 'On Road', 'Park Facing', 'Normal'])->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('hospital_distance')->nullable();
            $table->string('railway_distance')->nullable();
            $table->string('transport_distance')->nullable();
            $table->string('image')->nullable(); // Thumbnail
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('balconies')->nullable();
            $table->integer('total_floors')->nullable();
            $table->enum('furnishing_status', ['Furnished', 'Semi-Furnished', 'Unfurnished'])->nullable();
            // youtube video link
            $table->string('video_link')->nullable();
            // Court Case
            $table->enum('court_case', ['Yes', 'No'])->nullable()->default('No');
            $table->string('court_case_details')->nullable();
            // foreign keys
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('user_id'); // seller, broker, Employee, etc.
            $table->unsignedBigInteger('listing_type_id')->nullable();
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->unsignedBigInteger('plot_id')->nullable();
            $table->unsignedBigInteger('house_id')->nullable();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->unsignedBigInteger('villa_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('agriculture_land_id')->nullable();
            $table->unsignedBigInteger('industrial_land_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('listing_type_id')->references('id')->on('listing_types')->onDelete('set null');
            $table->foreign('property_type_id')->references('id')->on('property_types')->onDelete('set null');
            $table->foreign('plot_id')->references('id')->on('plots')->onDelete('set null');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('set null');
            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('set null');
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('set null');
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('set null');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('set null');
            $table->foreign('agriculture_land_id')->references('id')->on('agriculture_lands')->onDelete('set null');
            $table->foreign('industrial_land_id')->references('id')->on('industrial_lands')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes(); // optional but useful for recovery
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_types');
        Schema::dropIfExists('property_types');
        Schema::dropIfExists('plots');
        Schema::dropIfExists('houses');
        Schema::dropIfExists('apartments');
        Schema::dropIfExists('villas');
        Schema::dropIfExists('offices');
        Schema::dropIfExists('shops');
        Schema::dropIfExists('agriculture_lands');
        Schema::dropIfExists('industrial_lands');
        Schema::dropIfExists('properties');
    }
};
