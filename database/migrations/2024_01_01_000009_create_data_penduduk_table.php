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
        // Tabel dusun/lingkungan
        Schema::create('dusun', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kepala_dusun')->nullable();
            $table->integer('jumlah_rt')->default(0);
            $table->integer('jumlah_rw')->default(0);
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabel statistik penduduk per tahun
        Schema::create('statistik_penduduk', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('bulan', 2)->nullable();
            $table->integer('total_penduduk')->default(0);
            $table->integer('total_kk')->default(0);
            $table->integer('laki_laki')->default(0);
            $table->integer('perempuan')->default(0);

            // Data berdasarkan kelompok umur
            $table->json('kelompok_umur')->nullable();

            // Data berdasarkan pendidikan
            $table->json('pendidikan')->nullable();

            // Data berdasarkan pekerjaan
            $table->json('pekerjaan')->nullable();

            // Data berdasarkan agama
            $table->json('agama')->nullable();

            // Data berdasarkan status perkawinan
            $table->json('status_perkawinan')->nullable();

            // Data berdasarkan dusun
            $table->json('per_dusun')->nullable();

            // Data wajib pilih
            $table->json('wajib_pilih')->nullable();

            // Mutasi penduduk
            $table->integer('kelahiran')->default(0);
            $table->integer('kematian')->default(0);
            $table->integer('pindah_masuk')->default(0);
            $table->integer('pindah_keluar')->default(0);

            $table->timestamps();

            $table->unique(['tahun', 'bulan']);
            $table->index('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_penduduk');
        Schema::dropIfExists('dusun');
    }
};
