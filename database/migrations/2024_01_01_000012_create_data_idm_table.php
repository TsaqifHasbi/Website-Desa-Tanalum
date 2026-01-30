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
        Schema::create('data_idm', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->decimal('skor_idm', 6, 4)->default(0);
            $table->enum('status', ['sangat_tertinggal', 'tertinggal', 'berkembang', 'maju', 'mandiri'])->default('berkembang');
            $table->string('target_status')->nullable();

            // Skor per indeks
            $table->decimal('skor_iks', 6, 4)->default(0)->comment('Indeks Ketahanan Sosial');
            $table->decimal('skor_ike', 6, 4)->default(0)->comment('Indeks Ketahanan Ekonomi');
            $table->decimal('skor_ikl', 6, 4)->default(0)->comment('Indeks Ketahanan Lingkungan');

            // Skor minimal untuk naik status
            $table->decimal('skor_minimal', 6, 4)->nullable();
            $table->decimal('penambahan', 6, 4)->nullable();

            // Detail indikator dalam JSON
            $table->json('detail_indikator')->nullable();

            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique('tahun');
        });

        // Tabel untuk detail indikator IDM
        Schema::create('indikator_idm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_idm_id')->constrained('data_idm')->onDelete('cascade');
            $table->integer('nomor');
            $table->string('nama_indikator');
            $table->decimal('skor', 6, 4)->default(0);
            $table->text('keterangan')->nullable();
            $table->string('kegiatan_dapat_dilakukan')->nullable();
            $table->string('kantor_pelaksana')->nullable();
            $table->decimal('volume', 20, 2)->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('perkiraan_biaya', 20, 2)->nullable();
            $table->string('sumber_biaya')->nullable();
            $table->enum('kategori', ['iks', 'ike', 'ikl'])->default('iks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_idm');
        Schema::dropIfExists('data_idm');
    }
};
