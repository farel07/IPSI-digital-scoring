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
        Schema::create('player_match', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->string('side'); // e.g., 'red' or 'blue'
            $table->integer('round');
            $table->integer('punch_point')->default(0);
            $table->integer('kick_point')->default(0);
            $table->integer('fall_point')->default(0);
            $table->integer('binaan_point')->default(0);
            $table->integer('teguran')->default(0);
            $table->integer('peringatan')->default(0);
            $table->integer('total_point')->default(0);
            $table->boolean('is_winner')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_match');
    }
};
