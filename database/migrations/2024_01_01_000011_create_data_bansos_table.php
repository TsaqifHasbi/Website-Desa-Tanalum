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
        // Jenis bantuan sosial
        Schema::create('jenis_bansos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('singkatan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('icon')->nullable();
            $table->string('warna')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Statistik penerima bansos per tahun
        Schema::create('statistik_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_bansos_id')->constrained('jenis_bansos')->onDelete('cascade');
            $table->year('tahun');
            $table->integer('jumlah_penerima')->default(0);
            $table->decimal('total_anggaran', 20, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['jenis_bansos_id', 'tahun']);
        });

        // Data penerima bansos (untuk fitur cek penerima)
        Schema::create('penerima_bansos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_bansos_id')->constrained('jenis_bansos')->onDelete('cascade');
            $table->string('nik', 16);
            $table->string('nama');
            $table->string('no_kk', 16)->nullable();
            $table->text('alamat')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->year('tahun_penerima');
            $table->enum('status', ['aktif', 'tidak_aktif', 'selesai'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index('nik');
            $table->index(['jenis_bansos_id', 'tahun_penerima']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_bansos');
        Schema::dropIfExists('statistik_bansos');
        Schema::dropIfExists('jenis_bansos');
    }
};
