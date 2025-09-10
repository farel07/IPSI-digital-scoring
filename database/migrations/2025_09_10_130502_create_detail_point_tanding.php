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
        Schema::create('detail_point_tanding', function (Blueprint $table) {
            $table->id();

            // Foreign key yang berelasi ke tabel 'pertandingan'.
            // onDelete('cascade') berarti jika sebuah pertandingan dihapus,
            // detail poinnya juga akan ikut terhapus.
            $table->foreignId('pertandingan_id')
                ->constrained('pertandingan')
                ->onDelete('cascade');

            $table->integer('round')->comment('Babak ke-, misal: 1, 2, 3');

            // Kolom Poin untuk Pemain 1
            $table->integer('punch_point_1')->default(0);
            $table->integer('kick_point_1')->default(0);
            $table->integer('fall_point_1')->default(0);
            $table->integer('binaan_point_1')->default(0);
            $table->integer('teguran_1')->default(0);
            $table->integer('peringatan_1')->default(0);

            // Kolom Poin untuk Pemain 2
            $table->integer('punch_point_2')->default(0);
            $table->integer('kick_point_2')->default(0);
            $table->integer('fall_point_2')->default(0);
            $table->integer('binaan_point_2')->default(0);
            $table->integer('teguran_2')->default(0);
            $table->integer('peringatan_2')->default(0);

            // Total Poin
            $table->integer('total_point_1')->default(0);
            $table->integer('total_point_2')->default(0);

            $table->timestamps();

            // Menambahkan constraint UNIQUE untuk memastikan
            // satu pertandingan hanya punya satu detail poin per babak.
            $table->unique(['pertandingan_id', 'round']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_point_tanding');
    }
};
