<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collaterals', function (Blueprint $table) {
            $table->id();
            // Assuming related tables exist for customers and loans
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('loan_id')->constrained()->onDelete('cascade');
            
            $table->string('type'); // e.g., Land Title (ប័ណ្ណកម្មសិទ្ធិដី), Vehicle (យានយន្ត)
            $table->text('description')->nullable();
            $table->string('document_number')->nullable();
            $table->decimal('value', 15, 2)->default(0.00);
            $table->date('received_date');
            $table->string('status')->default('in_storage'); // កំពុងរក្សាទុក
            $table->string('reference_document')->nullable(); // Path to PDF/Image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaterals');
    }
};