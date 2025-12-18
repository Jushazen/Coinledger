<?php
// database/migrations/[timestamp]_create_funds_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funds', function (Blueprint $table) {
            $table->id('fund_id'); // Primary key
            $table->string('fund_name', 100); // Fund name (already exists)
            $table->decimal('your_contribution', 10, 2); // Your contribution amount
            $table->date('contributed_on'); // Date of contribution
            $table->decimal('collected', 10, 2)->default(0.00); // Total collected amount
            $table->string('short_description', 255); // Short description
            $table->timestamps(); // created_at and updated_at
            
            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Optional: Status field
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
            
            // Indexes
            $table->index('fund_name'); // Index for fund name
            $table->index('contributed_on');
            $table->index('status');
            $table->index(['user_id', 'status']);
            $table->index('short_description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('funds');
    }
};