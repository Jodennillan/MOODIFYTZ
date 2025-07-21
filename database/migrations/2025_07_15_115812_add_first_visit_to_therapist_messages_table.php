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
        Schema::table('therapist_messages', function (Blueprint $table) {
        $table->enum('first_visit', ['voice', 'video', 'physical'])->nullable()->after('message');
        $table->boolean('is_conclusion')->default(false)->after('from_therapist');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('therapist_messages', function (Blueprint $table) {
        $table->dropColumn(['first_visit', 'is_conclusion']);
    });
    }
};
