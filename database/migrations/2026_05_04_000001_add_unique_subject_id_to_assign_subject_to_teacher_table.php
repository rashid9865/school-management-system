<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove duplicate assignments, keeping the first one
        DB::statement('
            DELETE t1 FROM assign_subject_to_teacher t1
            INNER JOIN assign_subject_to_teacher t2
            WHERE t1.id > t2.id AND t1.subject_id = t2.subject_id
        ');

        Schema::table('assign_subject_to_teacher', function (Blueprint $table) {
            $table->unique('subject_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assign_subject_to_teacher', function (Blueprint $table) {
            $table->dropUnique(['subject_id']);
        });
    }
};
