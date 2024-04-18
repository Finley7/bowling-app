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
        Schema::table('player_scores', function (Blueprint $table) {
            $table->integer('total_score')->nullable();
            $table->integer('score_1')->nullable()->change();
            $table->integer('score_2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('player_scores', function (Blueprint $table) {
            //
        });
    }
};
