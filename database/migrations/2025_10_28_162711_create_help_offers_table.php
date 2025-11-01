<?php
// database/migrations/2024_01_01_create_help_offers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('help_offers', function (Blueprint $table) {
            $table->id();
            
            // Reference to the help request
            $table->foreignId('help_request_id')->constrained()->onDelete('cascade');
            
            // User who is offering help
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Offer details
            $table->text('message');
            
            // Offer status
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            
            // Timestamps
            $table->timestamps();
            
            // Unique constraint to prevent duplicate offers
            $table->unique(['help_request_id', 'user_id']);
            
            // Indexes for performance
            $table->index(['help_request_id', 'status']);
            $table->index(['user_id', 'created_at']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('help_offers');
    }
};