<?php

// database/migrations/[timestamp]_update_role_enum_in_loans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up()
    {
        // First, we need to modify the column type
        Schema::table('loans', function (Blueprint $table) {
            // Change role column to have correct enum values
            $table->enum('role', ['borrower', 'lender'])
                  ->default('borrower')
                  ->change();
        });
    }

    public function down()
    {
        // Revert if needed (you might need to adjust this based on your original)
        Schema::table('loans', function (Blueprint $table) {
            $table->string('role')->change();
        });
    }
};
