<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            
            // Relational Foreign Keys
            $table->unsignedBigInteger('user_id');
            
            
            // Loan Identifiers & Info
            $table->string('loan_number')->unique();
            $table->string('purpose')->nullable();
            $table->string('type')->default('Personal');
            $table->string('currency')->default('USD');
            
            // Financial Terms
            $table->decimal('amount', 15, 2);
            $table->decimal('interest_rate', 5, 2); // interest rate %
            $table->integer('duration'); // duration count
            $table->string('frequency')->default('Monthly'); // Monthly, Weekly
            $table->date('start_date');
            $table->string('method')->default('Fixed'); // Declining, Fixed
            
            // Calculations (Populated via Controller)
            $table->decimal('total_interest', 15, 2);
            $table->decimal('total_payable', 15, 2);
            $table->decimal('monthly_payment', 15, 2);
            
            // Statuses (Matching your Controller validation rules)
            $table->enum('status', ['Active', 'Pending', 'Paid'])->default('Pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};