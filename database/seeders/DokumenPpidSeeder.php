<?php

namespace Database\Seeders;

use App\Models\DokumenPpid;
use App\Models\KategoriPpid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DokumenPpidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = KategoriPpid::all();

        $dokumens = [
            [
                'judul' => 'KEPUTUSAN BUPATI KUTAI KARTANEGARA NOMOR 77/SK-BUP/HK/2025 TENTANG PENETAPAN DESA WISATA',
                'nomor_dokumen' => '77/SK-BUP/HK/2025',
                'tanggal_dokumen' => '2025-11-13',
                'kategori' => 'informasi-peraturan',
                'tahun' => '2025',
            ],
            [
                'judul' => 'Peraturan Bupati Kutai Kartanegara Nomor 37 Tahun 2024 tentang Pengesahan Batas Desa Tanalum Kecamatan Marang Kayu',
                'nomor_dokumen' => '37/2024',
                'tanggal_dokumen' => '2025-11-13',
                'kategori' => 'informasi-peraturan',
                'tahun' => '2024',
            ],
            [
                'judul' => 'SK Desa ProKlim Utama Tahun 2022',
                'nomor_dokumen' => 'SK-PROKLIM-2022',
                'tanggal_dokumen' => '2023-11-09',
                'kategori' => 'daftar-informasi-publik',
                'tahun' => '2022',
            ],
            [
                'judul' => 'Peraturan Desa Tanalum Nomor 1 Tahun 2025 tentang APBDes',
                'nomor_dokumen' => '1/2025',
                'tanggal_dokumen' => '2025-01-15',
                'kategori' => 'peraturan-desa',
                'tahun' => '2025',
            ],
            [
                'judul' => 'Laporan Realisasi APBDes Semester 1 Tahun 2025',
                'nomor_dokumen' => 'LAP-APB-S1-2025',
                'tanggal_dokumen' => '2025-07-15',
                'kategori' => 'laporan-keuangan',
                'tahun' => '2025',
            ],
        ];

        foreach ($dokumens as $index => $dokumen) {
            $kategori = $kategoris->where('slug', $dokumen['kategori'])->first();

            DokumenPpid::create([
                'kategori_id' => $kategori?->id,
                'judul' => $dokumen['judul'],
                'slug' => Str::slug(Str::limit($dokumen['judul'], 50)) . '-' . Str::random(5),
                'nomor_dokumen' => $dokumen['nomor_dokumen'],
                'tanggal_dokumen' => $dokumen['tanggal_dokumen'],
                'file_path' => 'ppid/dokumen-' . ($index + 1) . '.pdf',
                'file_type' => 'application/pdf',
                'file_size' => rand(100000, 5000000),
                'download_count' => rand(10, 500),
                'view_count' => rand(20, 600),
                'tahun' => $dokumen['tahun'],
                'is_active' => true,
            ]);
        }
    }
}
