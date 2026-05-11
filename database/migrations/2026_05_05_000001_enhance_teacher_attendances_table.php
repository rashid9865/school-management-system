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
        Schema::table('teacher_attendances', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('teacher_attendances', 'approval_status')) {
                $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending')->after('status');
            }
            if (!Schema::hasColumn('teacher_attendances', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null')->after('approval_status');
            }
            if (!Schema::hasColumn('teacher_attendances', 'remarks')) {
                $table->text('remarks')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('teacher_attendances', 'duration_minutes')) {
                $table->integer('duration_minutes')->nullable()->after('time_out');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_attendances', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn([
                'approval_status',
                'approved_by',
                'remarks',
                'duration_minutes'
            ]);
        });
    }
};
