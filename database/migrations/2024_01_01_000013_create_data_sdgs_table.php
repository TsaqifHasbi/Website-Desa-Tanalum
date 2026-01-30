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
        Schema::create('data_sdgs', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->decimal('skor_total', 6, 2)->default(0);

            // 18 Tujuan SDGs Desa
            $table->decimal('sdg_1', 6, 2)->default(0)->comment('Desa Tanpa Kemiskinan');
            $table->decimal('sdg_2', 6, 2)->default(0)->comment('Desa Tanpa Kelaparan');
            $table->decimal('sdg_3', 6, 2)->default(0)->comment('Desa Sehat dan Sejahtera');
            $table->decimal('sdg_4', 6, 2)->default(0)->comment('Pendidikan Desa Berkualitas');
            $table->decimal('sdg_5', 6, 2)->default(0)->comment('Keterlibatan Perempuan Desa');
            $table->decimal('sdg_6', 6, 2)->default(0)->comment('Desa Layak Air Bersih dan Sanitasi');
            $table->decimal('sdg_7', 6, 2)->default(0)->comment('Desa Berenergi Bersih dan Terbarukan');
            $table->decimal('sdg_8', 6, 2)->default(0)->comment('Pertumbuhan Ekonomi Desa Merata');
            $table->decimal('sdg_9', 6, 2)->default(0)->comment('Infrastruktur dan Inovasi Desa Sesuai Kebutuhan');
            $table->decimal('sdg_10', 6, 2)->default(0)->comment('Desa Tanpa Kesenjangan');
            $table->decimal('sdg_11', 6, 2)->default(0)->comment('Kawasan Pemukiman Desa Aman dan Nyaman');
            $table->decimal('sdg_12', 6, 2)->default(0)->comment('Konsumsi dan Produksi Desa Sadar Lingkungan');
            $table->decimal('sdg_13', 6, 2)->default(0)->comment('Desa Tanggap Perubahan Iklim');
            $table->decimal('sdg_14', 6, 2)->default(0)->comment('Desa Peduli Lingkungan Laut');
            $table->decimal('sdg_15', 6, 2)->default(0)->comment('Desa Peduli Lingkungan Darat');
            $table->decimal('sdg_16', 6, 2)->default(0)->comment('Desa Damai Berkeadilan');
            $table->decimal('sdg_17', 6, 2)->default(0)->comment('Kemitraan Untuk Pembangunan Desa');
            $table->decimal('sdg_18', 6, 2)->default(0)->comment('Kelembagaan Desa Dinamis dan Budaya Desa Adaptif');

            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sdgs');
    }
};
