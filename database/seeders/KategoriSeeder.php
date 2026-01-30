<?php

namespace Database\Seeders;

use App\Models\KategoriBerita;
use App\Models\KategoriProduk;
use App\Models\KategoriGaleri;
use App\Models\KategoriPpid;
use App\Models\KategoriPotensi;
use App\Models\JenisBansos;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategori Berita
        $kategoriBeritas = [
            ['nama' => 'Pemerintahan', 'slug' => 'pemerintahan', 'warna' => '#16a34a'],
            ['nama' => 'Pembangunan', 'slug' => 'pembangunan', 'warna' => '#2563eb'],
            ['nama' => 'Kemasyarakatan', 'slug' => 'kemasyarakatan', 'warna' => '#dc2626'],
            ['nama' => 'Ekonomi', 'slug' => 'ekonomi', 'warna' => '#ca8a04'],
            ['nama' => 'Kesehatan', 'slug' => 'kesehatan', 'warna' => '#16a34a'],
            ['nama' => 'Pendidikan', 'slug' => 'pendidikan', 'warna' => '#9333ea'],
            ['nama' => 'Lingkungan', 'slug' => 'lingkungan', 'warna' => '#059669'],
            ['nama' => 'Wisata', 'slug' => 'wisata', 'warna' => '#0891b2'],
        ];

        foreach ($kategoriBeritas as $kategori) {
            KategoriBerita::create(array_merge($kategori, ['is_active' => true]));
        }

        // Kategori Produk UMKM
        $kategoriProduks = [
            ['nama' => 'Makanan', 'slug' => 'makanan', 'icon' => 'utensils'],
            ['nama' => 'Minuman', 'slug' => 'minuman', 'icon' => 'coffee'],
            ['nama' => 'Kerajinan', 'slug' => 'kerajinan', 'icon' => 'palette'],
            ['nama' => 'Pertanian', 'slug' => 'pertanian', 'icon' => 'leaf'],
            ['nama' => 'Perikanan', 'slug' => 'perikanan', 'icon' => 'fish'],
            ['nama' => 'Fashion', 'slug' => 'fashion', 'icon' => 'shirt'],
            ['nama' => 'Lainnya', 'slug' => 'lainnya', 'icon' => 'box'],
        ];

        foreach ($kategoriProduks as $kategori) {
            KategoriProduk::create(array_merge($kategori, ['is_active' => true]));
        }

        // Kategori Galeri
        $kategoriGaleris = [
            ['nama' => 'Kegiatan Desa', 'slug' => 'kegiatan-desa'],
            ['nama' => 'Infrastruktur', 'slug' => 'infrastruktur'],
            ['nama' => 'Wisata', 'slug' => 'wisata'],
            ['nama' => 'Budaya', 'slug' => 'budaya'],
            ['nama' => 'Pemerintahan', 'slug' => 'pemerintahan'],
        ];

        foreach ($kategoriGaleris as $kategori) {
            KategoriGaleri::create(array_merge($kategori, ['is_active' => true]));
        }

        // Kategori PPID
        $kategoriPpids = [
            ['nama' => 'Peraturan Desa', 'slug' => 'peraturan-desa', 'jenis' => 'berkala', 'urutan' => 1],
            ['nama' => 'Keputusan Kepala Desa', 'slug' => 'keputusan-kepala-desa', 'jenis' => 'berkala', 'urutan' => 2],
            ['nama' => 'Anggaran Desa', 'slug' => 'anggaran-desa', 'jenis' => 'berkala', 'urutan' => 3],
            ['nama' => 'Laporan Keuangan', 'slug' => 'laporan-keuangan', 'jenis' => 'berkala', 'urutan' => 4],
            ['nama' => 'Informasi Tentang Peraturan, Keputusan, dan/atau Kebijakan', 'slug' => 'informasi-peraturan', 'jenis' => 'berkala', 'urutan' => 5],
            ['nama' => 'Daftar Informasi Publik', 'slug' => 'daftar-informasi-publik', 'jenis' => 'berkala', 'urutan' => 6],
            ['nama' => 'Pengumuman', 'slug' => 'pengumuman', 'jenis' => 'serta_merta', 'urutan' => 1],
            ['nama' => 'Informasi Bencana', 'slug' => 'informasi-bencana', 'jenis' => 'serta_merta', 'urutan' => 2],
            ['nama' => 'Profil Desa', 'slug' => 'profil-desa', 'jenis' => 'setiap_saat', 'urutan' => 1],
            ['nama' => 'Data Statistik', 'slug' => 'data-statistik', 'jenis' => 'setiap_saat', 'urutan' => 2],
        ];

        foreach ($kategoriPpids as $kategori) {
            KategoriPpid::create(array_merge($kategori, ['is_active' => true]));
        }

        // Kategori Potensi
        $kategoriPotensis = [
            ['nama' => 'Pariwisata', 'slug' => 'pariwisata', 'icon' => 'map-pin'],
            ['nama' => 'Perikanan', 'slug' => 'perikanan', 'icon' => 'fish'],
            ['nama' => 'Pertanian', 'slug' => 'pertanian', 'icon' => 'wheat'],
            ['nama' => 'Kerajinan', 'slug' => 'kerajinan', 'icon' => 'palette'],
            ['nama' => 'Kuliner', 'slug' => 'kuliner', 'icon' => 'utensils'],
        ];

        foreach ($kategoriPotensis as $kategori) {
            KategoriPotensi::create(array_merge($kategori, ['is_active' => true]));
        }

        // Jenis Bansos
        $jenisBansos = [
            ['nama' => 'BPJS PBI Ketenagakerjaan', 'slug' => 'bpjs-pbi', 'singkatan' => 'BPJS PBI', 'warna' => '#16a34a'],
            ['nama' => 'Program Keluarga Harapan', 'slug' => 'pkh', 'singkatan' => 'PKH', 'warna' => '#dc2626'],
            ['nama' => 'Bantuan Pangan Non Tunai', 'slug' => 'bpnt', 'singkatan' => 'BPNT', 'warna' => '#2563eb'],
            ['nama' => 'Bantuan Langsung Tunai', 'slug' => 'blt', 'singkatan' => 'BLT 2024', 'warna' => '#ca8a04'],
            ['nama' => 'Program Sembako Tahap Nasional', 'slug' => 'pstn', 'singkatan' => 'PSTN', 'warna' => '#9333ea'],
        ];

        foreach ($jenisBansos as $bansos) {
            JenisBansos::create(array_merge($bansos, ['is_active' => true]));
        }
    }
}
