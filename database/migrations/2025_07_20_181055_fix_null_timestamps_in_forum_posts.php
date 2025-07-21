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
         DB::table('forum_posts')
        ->whereNull('created_at')
        ->update(['created_at' => now()]);

    // Fix null updated_at
    DB::table('forum_posts')
        ->whereNull('updated_at')
        ->update(['updated_at' => now()]);
    
    // Repeat for forum_replies table if needed
    DB::table('forum_replies')
        ->whereNull('created_at')
        ->update(['created_at' => now()]);

    DB::table('forum_replies')
        ->whereNull('updated_at')
        ->update(['updated_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_posts', function (Blueprint $table) {
            //
        });
    }
};
