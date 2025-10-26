<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('populations', function (Blueprint $table) {
            // First check if user_login_id exists, then rename it
            if (Schema::hasColumn('populations', 'user_login_id')) {
                // Rename the existing column
                $table->renameColumn('user_login_id', 'user_id');
            } else {
                // Or create new user_id column if it doesn't exist
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
            
            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('populations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            
            if (Schema::hasColumn('populations', 'user_id')) {
                $table->renameColumn('user_id', 'user_login_id');
            }
        });
    }
};