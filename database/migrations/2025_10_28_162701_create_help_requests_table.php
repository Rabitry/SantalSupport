<?php
// database/migrations/2024_01_01_create_help_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('help_requests', function (Blueprint $table) {
            $table->id();
            
            // User who created the help request
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Basic request info
            $table->string('title');
            $table->text('description');
            
            // Categorization
            $table->enum('category', ['education', 'health', 'skills', 'transportation', 'professional', 'other']);
            $table->enum('urgency', ['low', 'medium', 'high', 'critical']);
            $table->string('location')->nullable();
            
            // Status tracking
            $table->enum('status', ['active', 'in_progress', 'completed', 'resolved'])->default('active');
            
            // Resolution info (when help is received)
            $table->foreignId('resolved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('resolved_at')->nullable();
            $table->text('solution_notes')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['status', 'created_at']);
            $table->index(['category', 'status']);
            $table->index(['urgency', 'status']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('help_requests');
    }
};