<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('populations', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->string('name');
            $table->string('sex');
            $table->string('occupation')->nullable();
            $table->string('college_university')->nullable();
            $table->string('subject_department')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('district');
            $table->string('upazila');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('populations');
    }
};
