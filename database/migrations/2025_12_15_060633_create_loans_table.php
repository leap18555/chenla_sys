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
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name');  // make sure this exists
            $table->decimal('amount', 15, 2);
            $table->decimal('interest_rate', 5, 2); // interest rate %
            $table->integer('duration'); // in months
            $table->decimal('total_interest', 15, 2);
            $table->decimal('total_payable', 15, 2);
            $table->decimal('monthly_payment', 15, 2);
            $table->enum('status', ['active','closed'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
