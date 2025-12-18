<?php
// database/migrations/[timestamp]_add_person_name_to_loans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->string('person_name', 100)->after('role');
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropColumn('person_name');
        });
    }
};