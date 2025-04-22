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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('owner_name');
            $table->string('owner_mobile');
            $table->string('owner_email')->nullable();
            $table->string('owner_address')->nullable();
            $table->unsignedBigInteger('city_id');

            // Vehicle Details
            $table->string('brand');
            $table->string('model');
            $table->string('slug')->unique();
            $table->string('variant')->nullable();
            $table->string('registration_number')->nullable();
            $table->year('registration_year')->nullable();
            $table->integer('km_driven')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->tinyInteger('no_of_owners')->nullable();
            $table->string('insurance_status')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);

            // Accident Information
            $table->boolean('any_accident')->default(false);
            $table->text('accident_detail')->nullable();

            // Loan Information
            $table->boolean('loan_running')->default(false);
            $table->string('loan_bank_name')->nullable();
            $table->integer('pending_emis')->nullable();
            $table->decimal('emi_amount', 10, 2)->nullable();

            // Images & Status
            $table->string('featured_image')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('approved');

            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
