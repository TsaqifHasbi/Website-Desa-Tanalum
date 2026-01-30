<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = KategoriGaleri::all();

        $galeris = [
            [
                'judul' => 'Kegiatan Gotong Royong Desa',
                'deskripsi' => 'Dokumentasi kegiatan gotong royong warga desa',
                'kategori' => 'kegiatan-desa',
                'tanggal' => '2025-12-15',
            ],
            [
                'judul' => 'Pembangunan Jalan Desa',
                'deskripsi' => 'Proses pembangunan jalan desa tahun 2025',
                'kategori' => 'infrastruktur',
                'tanggal' => '2025-11-20',
            ],
            [
                'judul' => 'Pantai Biru Tanalum',
                'deskripsi' => 'Keindahan Pantai Biru Tanalum',
                'kategori' => 'wisata',
                'tanggal' => '2025-10-10',
            ],
            [
                'judul' => 'Musyawarah Desa',
                'deskripsi' => 'Pelaksanaan Musyawarah Desa tahun 2025',
                'kategori' => 'pemerintahan',
                'tanggal' => '2025-09-05',
            ],
            [
                'judul' => 'Festival Budaya Desa',
                'deskripsi' => 'Festival budaya tahunan Desa Tanalum',
                'kategori' => 'budaya',
                'tanggal' => '2025-08-17',
            ],
        ];

        foreach ($galeris as $index => $galeri) {
            $kategori = $kategoris->where('slug', $galeri['kategori'])->first();

            Galeri::create([
                'kategori_id' => $kategori?->id,
                'judul' => $galeri['judul'],
                'deskripsi' => $galeri['deskripsi'],
                'tipe' => 'foto',
                'file_path' => 'galeri/default-' . ($index + 1) . '.jpg',
                'tanggal' => $galeri['tanggal'],
                'urutan' => $index + 1,
                'is_featured' => $index < 3,
                'is_active' => true,
            ]);
        }
    }
}
