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
        Schema::create('kategori_ppid', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->enum('jenis', ['berkala', 'serta_merta', 'setiap_saat'])->default('berkala');
            $table->text('deskripsi')->nullable();
            $table->string('icon')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('dokumen_ppid', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_ppid')->nullOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->string('nomor_dokumen')->nullable();
            $table->date('tanggal_dokumen')->nullable();
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->integer('download_count')->default(0);
            $table->integer('view_count')->default(0);
            $table->string('tahun')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('tahun');
        });

        Schema::create('permohonan_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_tiket')->unique();
            $table->string('nama_pemohon');
            $table->string('nik', 16)->nullable();
            $table->string('email');
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('informasi_diminta');
            $table->text('alasan_permohonan')->nullable();
            $table->enum('cara_memperoleh', ['melihat', 'membaca', 'mendengar', 'mencatat', 'mendapat_salinan'])->default('mendapat_salinan');
            $table->enum('cara_mendapat_salinan', ['email', 'fax', 'pos', 'ambil_langsung'])->default('email');
            $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->string('file_balasan')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('nomor_tiket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_informasi');
        Schema::dropIfExists('dokumen_ppid');
        Schema::dropIfExists('kategori_ppid');
    }
};
