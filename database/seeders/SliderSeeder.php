<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'judul' => 'Marhaban Ya Ramadan',
            'subjudul' => 'PEMERINTAH DESA TANALUM MENGUCAPKAN',
            'deskripsi' => '"Ramadan adalah bulan penuh berkah, selamat menjalankan ibadah puasa 1446 H / 2025 M"',
            'gambar' => 'slider/Marhaban2026.png',
            'posisi_text' => 'center',
            'urutan' => 1,
            'is_active' => true,
        ]);

        Slider::create([
            'judul' => 'Selamat Datang di Desa Tanalum',
            'subjudul' => 'Desa Wisata yang Asri dan Sejahtera',
            'deskripsi' => 'Nikmati keindahan Curug Pada Desa Tanalum dan keramahan masyarakat desa kami',
            'gambar' => 'slider/kknTanalum.jpeg',
            'link_url' => '/profil',
            'link_text' => 'Pelajari Lebih Lanjut',
            'posisi_text' => 'left',
            'urutan' => 2,
            'is_active' => true,
        ]);

        Slider::create([
            'judul' => 'Curug Karang Desa Tanalum',
            'subjudul' => 'Destinasi Wisata Unggulan',
            'deskripsi' => 'Curug Karang menawarkan pemandangan alam yang memukau dan udara segar pegunungan',
            'gambar' => 'slider/CurugKarang.jpeg',
            'link_url' => '/wisata/curug-karang-tanalum',
            'link_text' => 'Kunjungi Sekarang',
            'posisi_text' => 'right',
            'urutan' => 3,
            'is_active' => true,
        ]);
    }
}
