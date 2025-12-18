<?php
// database/migrations/[timestamp]_create_loans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id'); // Primary key
            $table->string('loan_name', 100); // Loan name
            $table->enum('role', ['borrower', 'lender']); // Borrower or Lender
            
            // Person's name column (ADDED)
            $table->string('person_name', 100); // Name of person borrowing/lending
            
            $table->decimal('amount', 10, 2); // Loan amount with 2 decimal places
            $table->date('due_date'); // When the loan is due
            $table->decimal('paid', 10, 2)->default(0.00); // Amount paid so far
            $table->string('short_description', 255); // Short description
            $table->timestamps(); // created_at and updated_at
            
            // Foreign key to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Indexes for performance
            $table->index('loan_name');
            $table->index('role');
            $table->index('person_name'); // Index for person name (ADDED)
            $table->index('due_date');
            $table->index(['user_id', 'role']);
            $table->index('short_description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('loans');
    }
};