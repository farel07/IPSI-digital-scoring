<?php
// 2. events table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            // $table->string('penyelenggara');
            $table->string('image')->nullable();
            $table->text('desc')->nullable();
            // $table->text('kategori')->nullable();
            // $table->text('berkas')->nullable();
            // $table->text('kegiatan')->nullable();
            $table->string('type')->nullable();
            $table->string('month');
            $table->integer('harga_contingent');
            $table->integer('harga_peserta')->nullable();
            $table->string('kotaOrKabupaten');
            $table->string('lokasi');
            $table->date('tgl_mulai_tanding');
            $table->date('tgl_selesai_tanding');
            $table->date('tgl_batas_pendaftaran');
            $table->integer('status'); // 0 belum dibuka, 1 sudah dibuka, 2 ditutup
            $table->text('cp');
            $table->string('juknis');
            $table->integer('total_hadiah');
            $table->string('surat_rekom');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
