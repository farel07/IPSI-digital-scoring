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
        Schema::table('pertandingan', function (Blueprint $table) {
            //  $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('arena_id')->nullable()->constrained('arena')->onDelete('cascade');
             // Status pertandingan
            $table->enum('status', ['menunggu_peserta', 'siap_dimulai', 'berlangsung', 'selesai', 'ditunda'])
                  ->default('menunggu_peserta');
            // $table->enum('status', ['0', '1', '2'])->default('0')->comment('0 = belum mulai, 1 = sudah mulai, 2 = selesai');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('pertandingan', function (Blueprint $table) {
            $table->dropForeign(['arena_id']);
            $table->dropColumn('arena_id');
            $table->dropColumn('status');
            // $table->dropForeign(['user_id']);
            // $table->dropColumn('user_id');
        });
    }
};
