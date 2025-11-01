<?php
// database/migrations/2024_01_01_create_help_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('help_reviews', function (Blueprint $table) {
            $table->id();
            
            // Reference to the help request
            $table->foreignId('help_request_id')->constrained()->onDelete('cascade');
            
            // Users involved
            $table->foreignId('helper_id')->constrained('users')->onDelete('cascade'); // Person who helped
            $table->foreignId('helpee_id')->constrained('users')->onDelete('cascade'); // Person who received help
            
            // Review details
            $table->integer('rating'); // 1-5 stars
            $table->text('review')->nullable(); // Optional detailed review
            
            // Timestamps
            $table->timestamps();
            
            // Ensure one review per help request
            $table->unique(['help_request_id']);
            
            // Indexes for performance
            $table->index(['helper_id', 'created_at']);
            $table->index(['helpee_id', 'created_at']);
            $table->index(['rating', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('help_reviews');
    }
};