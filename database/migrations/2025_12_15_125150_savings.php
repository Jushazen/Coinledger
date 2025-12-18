<?php
// database/migrations/[timestamp]_create_savings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id('saving_id'); // Primary key
            $table->string('saving_name', 100); // Saving name (added)
            $table->decimal('saved', 10, 2)->default(0.00); // Total saved amount
            $table->decimal('monthly', 10, 2); // Monthly savings target
            $table->date('target_date'); // When to reach the target
            $table->string('short_description', 255); // Short description
            $table->timestamps(); // created_at and updated_at
            
            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Indexes
            $table->index('saving_name'); // Index for saving name
            $table->index('target_date');
            $table->index(['user_id', 'target_date']);
            $table->index('short_description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('savings');
    }
};