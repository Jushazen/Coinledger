<?php
// database/migrations/[timestamp]_replace_name_with_first_last_name_in_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the existing name column
            $table->dropColumn('name');
            
            // Add first_name and last_name columns
            $table->string('first_name', 50)->after('id');
            $table->string('last_name', 50)->after('first_name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes
            $table->dropColumn(['first_name', 'last_name']);
            $table->string('name')->after('id');
        });
    }
};