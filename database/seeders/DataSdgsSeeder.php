<?php

namespace Database\Seeders;

use App\Models\DataSdgs;
use Illuminate\Database\Seeder;

class DataSdgsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataSdgs::create([
            'tahun' => 2025,
            'skor_total' => 44.63,
            'sdg_1' => 38.47,  // Desa Tanpa Kemiskinan
            'sdg_2' => 33.07,  // Desa Tanpa Kelaparan
            'sdg_3' => 82.05,  // Desa Sehat dan Sejahtera
            'sdg_4' => 14.73,  // Pendidikan Desa Berkualitas
            'sdg_5' => 28.57,  // Keterlibatan Perempuan Desa
            'sdg_6' => 63.33,  // Desa Layak Air Bersih dan Sanitasi
            'sdg_7' => 99.8,   // Desa Berenergi Bersih dan Terbarukan
            'sdg_8' => 26.85,  // Pertumbuhan Ekonomi Desa Merata
            'sdg_9' => 52.33,  // Infrastruktur dan Inovasi Desa Sesuai Kebutuhan
            'sdg_10' => 40.82, // Desa Tanpa Kesenjangan
            'sdg_11' => 53.01, // Kawasan Pemukiman Desa Aman dan Nyaman
            'sdg_12' => 50,    // Konsumsi dan Produksi Desa Sadar Lingkungan
            'sdg_13' => 0,     // Desa Tanggap Perubahan Iklim
            'sdg_14' => 0,     // Desa Peduli Lingkungan Laut
            'sdg_15' => 33.33, // Desa Peduli Lingkungan Darat
            'sdg_16' => 60.99, // Desa Damai Berkeadilan
            'sdg_17' => 81.02, // Kemitraan Untuk Pembangunan Desa
            'sdg_18' => 44.95, // Kelembagaan Desa Dinamis dan Budaya Desa Adaptif
        ]);
    }
}
