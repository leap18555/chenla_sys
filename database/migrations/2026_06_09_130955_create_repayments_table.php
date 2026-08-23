<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repayments', function (Blueprint $table) {
            $table->id();
            // Connects directly to your existing loans.id
            $table->foreignId('loan_id')->constrained('loans')->onDelete('cascade'); 
            $table->string('receipt_code')->unique(); // e.g., Receipt RC-010
            $table->date('payment_date');
            $table->decimal('amount_paid', 15, 2);
            $table->decimal('penalty_amount', 15, 2)->default(0.00);
            $table->string('payment_method'); // សាច់ប្រាក់, ផ្ទេរតាមធនាគារ
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repayments');
    }
};