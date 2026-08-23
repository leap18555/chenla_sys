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
            Schema::table('customers', function (Blueprint $table) {
                // ID Card Fields
                $table->string('id_number')->nullable()->after('id');
                $table->date('dob')->nullable(); // Date of Birth
                $table->string('pob')->nullable(); // Place of Birth
             
                
                // Image Fields
                $table->string('id_photo')->nullable(); // For the Blue ID Card
                $table->string('family_photo')->nullable(); // For the Pink Family Book
                
                // Family Book Address Fields
                $table->string('house_no')->nullable();
                $table->string('street')->nullable();
                $table->string('district')->nullable();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
