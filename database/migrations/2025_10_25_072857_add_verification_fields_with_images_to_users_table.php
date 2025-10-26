<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id')->nullable()->after('email');
            $table->string('national_id')->nullable()->after('student_id');
            $table->string('id_card_front')->nullable()->after('national_id');
            $table->string('id_card_back')->nullable()->after('id_card_front');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('role');
            $table->text('rejection_reason')->nullable()->after('status');
            $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'student_id', 
                'national_id', 
                'id_card_front',
                'id_card_back',
                'status', 
                'rejection_reason', 
                'approved_at', 
                'approved_by'
            ]);
        });
    }
};