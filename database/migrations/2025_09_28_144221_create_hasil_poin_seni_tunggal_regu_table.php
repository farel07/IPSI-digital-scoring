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
        Schema::create('hasil_poin_seni_tunggal_regu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pertandingan_id')->constrained('pertandingan')->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
            $table->decimal('poin_final_median', 8, 2)->nullable();
            $table->decimal('poin_std', 8, 2)->nullable();

            // --- Kolom Hukuman Diubah Menjadi Decimal ---
            $table->decimal('waktu_terlampaui', 8, 2)->default(0);
            $table->decimal('keluar_garis', 8, 2)->default(0);
            $table->decimal('pakaian', 8, 2)->default(0);
            $table->decimal('senjata_jatuh', 8, 2)->default(0);
            $table->decimal('stop', 8, 2)->default(0);
            
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
        Schema::dropIfExists('hasil_poin_seni_tunggal_regu');
    }
};