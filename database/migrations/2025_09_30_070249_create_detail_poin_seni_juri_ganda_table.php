<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_poin_seni_juri_ganda', function (Blueprint $table) {
            $table->id();
            // Asumsi berelasi dengan tabel 'pertandingan'
            $table->foreignId('pertandingan_id')->constrained('pertandingan')->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            // Asumsi berelasi dengan tabel 'users' (untuk juri)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Kolom untuk komponen penilaian
            $table->decimal('teknik_dasar', 8, 2)->default(0);
            $table->decimal('kekuatan_kecepatan', 8, 2)->default(0);
            $table->decimal('penampilan_gaya', 8, 2)->default(0);
            $table->decimal('total_skor', 8, 2)->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_poin_seni_juri_ganda');
    }
};