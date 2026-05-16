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
        Schema::table('students', function (Blueprint $table) {
            $table->integer('father_age')->nullable();
            $table->string('father_address')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_email')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_last_name')->nullable();
            $table->string('mother_phone_no')->nullable();
            $table->integer('mother_age')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
