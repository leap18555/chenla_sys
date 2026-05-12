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
        // Add currency if it doesn't exist
        if (!Schema::hasColumn('loans', 'currency')) {
            $table->string('currency', 3)->default('USD')->after('amount');
        }
        // Change duration to decimal to support 0.5 (2 weeks)
        $table->decimal('duration', 8, 2)->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            //
        });
    }
};
