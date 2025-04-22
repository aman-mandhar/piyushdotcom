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
        Schema::create('call_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('call_id')->unique();
            $table->string('call_details');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('call_id')->references('id')->on('calls')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['call_id', 'created_at']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_progress');
    }
};
