<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('populations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_login_id')->nullable()->after('id'); // or after any column you want
        });
    }

    public function down()
    {
        Schema::table('populations', function (Blueprint $table) {
            $table->dropColumn('user_login_id');
        });
    }
};
