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
        Schema::table('loans', function (Blueprint $table) {
            // Adds customer_id as a foreign key column positioned right at the beginning
            $table->foreignId('customer_id')->after('id')->constrained('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            // Drops the foreign key and the column if we roll back
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
};