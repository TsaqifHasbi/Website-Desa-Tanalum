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
        Schema::create('produk_umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_produk')->nullOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 15, 2);
            $table->decimal('harga_diskon', 15, 2)->nullable();
            $table->string('satuan')->default('pcs');
            $table->integer('stok')->nullable();
            $table->string('gambar_utama')->nullable();
            $table->json('galeri')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('kontak_pemilik')->nullable();
            $table->text('alamat_pemilik')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('jumlah_rating')->default(0);
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_featured');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_umkm');
    }
};
