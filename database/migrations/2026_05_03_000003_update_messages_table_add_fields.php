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
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('student_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sender')->nullable()->after('student_id');
            $table->enum('type', ['message', 'announcement'])->default('message')->after('sender');
            $table->text('content')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->dropColumn(['student_id', 'sender', 'type', 'content']);
        });
    }
};
