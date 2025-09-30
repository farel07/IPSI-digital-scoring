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
        Schema::create('hasil_poin_seni_ganda', function (Blueprint $table) {
            $table->id();
            // Asumsi berelasi dengan tabel 'pertandingan'
            $table->foreignId('pertandingan_id')->constrained('pertandingan')->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            
            // Kolom untuk statistik skor juri
            $table->decimal('poin_final_median', 8, 2)->nullable();
            $table->decimal('poin_std', 8, 2)->nullable();

            // Kolom-kolom untuk hukuman (penalti)
            $table->decimal('waktu_terlampaui', 8, 2)->default(0);
            $table->decimal('keluar_garis', 8, 2)->default(0);
            $table->decimal('senjata_jatuh', 8, 2)->default(0);
            $table->decimal('senjata_tidak_jatuh', 8, 2)->default(0); // Sesuai diagram
            $table->decimal('tidak_ada_salam', 8, 2)->default(0);
            $table->decimal('baju_senjata', 8, 2)->default(0);

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
        Schema::dropIfExists('hasil_poin_seni_ganda');
    }
};