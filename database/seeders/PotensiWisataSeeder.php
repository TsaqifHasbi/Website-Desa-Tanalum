<?php

namespace Database\Seeders;

use App\Models\KategoriPotensi;
use App\Models\PotensiDesa;
use App\Models\WisataDesa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PotensiWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = KategoriPotensi::all();

        // Potensi Desa
        $potensis = [
            [
                'nama' => 'Potensi Pariwisata',
                'deskripsi' => 'Desa Tanalum memiliki potensi pariwisata yang sangat besar dengan Pantai Biru yang indah dan masih alami.',
                'kategori' => 'pariwisata',
            ],
            [
                'nama' => 'Potensi Perikanan',
                'deskripsi' => 'Sebagai desa pesisir, Tanalum memiliki potensi perikanan yang melimpah dengan hasil tangkapan laut yang beragam.',
                'kategori' => 'perikanan',
            ],
        ];

        foreach ($potensis as $potensi) {
            $kategori = $kategoris->where('slug', $potensi['kategori'])->first();

            PotensiDesa::create([
                'kategori_id' => $kategori?->id,
                'nama' => $potensi['nama'],
                'slug' => Str::slug($potensi['nama']) . '-' . Str::random(5),
                'deskripsi' => $potensi['deskripsi'],
                'is_featured' => true,
                'is_active' => true,
            ]);
        }

        // Wisata Desa
        WisataDesa::create([
            'nama' => 'Pantai Biru Tanalum',
            'slug' => 'pantai-biru-tanalum',
            'deskripsi' => 'Pantai Biru Tanalum adalah destinasi wisata pantai yang terletak di Desa Tanalum. Pantai ini terkenal dengan pasir putihnya yang bersih dan air laut yang jernih berwarna biru.',
            'konten' => '<p>Pantai Biru Tanalum merupakan salah satu destinasi wisata unggulan di Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara. Pantai ini menawarkan keindahan alam pesisir yang masih alami dengan pasir putih yang lembut dan air laut yang jernih.</p>
            <p>Pengunjung dapat menikmati berbagai aktivitas seperti berenang, bermain pasir, menikmati sunset, hingga kuliner seafood segar dari nelayan lokal. Pantai ini dikelola oleh Kelompok Sadar Wisata (POKDARWIS) Pantai Biru Tanalum.</p>
            <p>Fasilitas yang tersedia antara lain gazebo, area parkir, warung makan, dan kamar mandi. Pantai ini menjadi tempat favorit warga sekitar dan wisatawan untuk berwisata bersama keluarga.</p>',
            'lokasi' => 'Desa Tanalum, Kecamatan Marang Kayu',
            'latitude' => -0.3750,
            'longitude' => 117.2500,
            'jam_buka' => '08:00',
            'jam_tutup' => '18:00',
            'hari_operasional' => 'Setiap Hari',
            'harga_tiket' => 0,
            'fasilitas' => ['Gazebo', 'Area Parkir', 'Warung Makan', 'Kamar Mandi', 'Musholla'],
            'kontak' => '082150208664',
            'views' => 1500,
            'is_featured' => true,
            'is_active' => true,
        ]);
    }
}
