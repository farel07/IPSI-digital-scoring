<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('skor_juri_tandings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertandingan_id')->constrained('pertandingan')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID Juri
            $table->integer('round');

            // Skor untuk masing-masing sudut
            $table->integer('skor_biru')->default(0);
            $table->integer('skor_merah')->default(0);

            $table->timestamps();

            // Pastikan setiap juri hanya punya satu baris skor per ronde
            $table->unique(['pertandingan_id', 'user_id', 'round']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('skor_juri_tandings');
    }
};
