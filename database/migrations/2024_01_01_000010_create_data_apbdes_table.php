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
        Schema::create('apbdes', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');

            // Pendapatan
            $table->decimal('pendapatan_asli_desa', 20, 2)->default(0);
            $table->decimal('pendapatan_transfer', 20, 2)->default(0);
            $table->decimal('pendapatan_lain', 20, 2)->default(0);
            $table->decimal('total_pendapatan', 20, 2)->default(0);

            // Belanja
            $table->decimal('belanja_pegawai', 20, 2)->default(0);
            $table->decimal('belanja_barang_jasa', 20, 2)->default(0);
            $table->decimal('belanja_modal', 20, 2)->default(0);
            $table->decimal('belanja_tidak_terduga', 20, 2)->default(0);
            $table->decimal('total_belanja', 20, 2)->default(0);

            // Pembiayaan
            $table->decimal('penerimaan_pembiayaan', 20, 2)->default(0);
            $table->decimal('pengeluaran_pembiayaan', 20, 2)->default(0);

            // Surplus/Defisit
            $table->decimal('surplus_defisit', 20, 2)->default(0);

            // Detail dalam bentuk JSON untuk fleksibilitas
            $table->json('detail_pendapatan')->nullable();
            $table->json('detail_belanja')->nullable();
            $table->json('detail_pembiayaan')->nullable();

            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique('tahun');
        });

        // Tabel untuk detail belanja per bidang
        Schema::create('apbdes_bidang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apbdes_id')->constrained('apbdes')->onDelete('cascade');
            $table->string('nama_bidang');
            $table->string('kode_bidang')->nullable();
            $table->decimal('anggaran', 20, 2)->default(0);
            $table->decimal('realisasi', 20, 2)->default(0);
            $table->decimal('persentase', 5, 2)->default(0);
            $table->json('detail_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbdes_bidang');
        Schema::dropIfExists('apbdes');
    }
};
