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
        Schema::table('mood_entries', function (Blueprint $table) {
            $table->string('mood_value')->after('mood');
            $table->string('triggers')->nullable()->after('intensity');
            $table->string('emoji')->after('mood_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mood_entries', function (Blueprint $table) {
            $table->dropColumn(['mood_value', 'triggers', 'emoji']);
        });
    }
};
