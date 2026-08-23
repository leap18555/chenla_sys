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
    Schema::table('staff', function (Blueprint $table) {
        // Add the email column. Adjust 'nullable()' or 'unique()' based on your needs.
        $table->string('email')->after('status')->nullable();
    });
}

public function down(): void
{
    Schema::table('staff', function (Blueprint $table) {
        $table->dropColumn('email');
    });
}
};
