<?php

namespace Database\Seeders;

use App\Models\DataIdm;
use App\Models\IndikatorIdm;
use Illuminate\Database\Seeder;

class DataIdmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data IDM per tahun
        $dataIdms = [
            [
                'tahun' => 2021,
                'skor_idm' => 0.7200,
                'status' => 'berkembang',
                'skor_iks' => 0.7500,
                'skor_ike' => 0.6000,
                'skor_ikl' => 0.8100,
            ],
            [
                'tahun' => 2022,
                'skor_idm' => 0.7500,
                'status' => 'berkembang',
                'skor_iks' => 0.7800,
                'skor_ike' => 0.6200,
                'skor_ikl' => 0.8500,
            ],
            [
                'tahun' => 2023,
                'skor_idm' => 0.7800,
                'status' => 'maju',
                'skor_iks' => 0.8100,
                'skor_ike' => 0.6500,
                'skor_ikl' => 0.8800,
            ],
            [
                'tahun' => 2024,
                'skor_idm' => 0.8152,
                'status' => 'maju',
                'target_status' => 'mandiri',
                'skor_iks' => 0.8457,
                'skor_ike' => 0.6667,
                'skor_ikl' => 0.9333,
                'skor_minimal' => 0.8156,
                'penambahan' => 0.0004,
            ],
        ];

        foreach ($dataIdms as $data) {
            $idm = DataIdm::create($data);

            // Tambahkan indikator untuk tahun 2024
            if ($data['tahun'] == 2024) {
                $this->seedIndikator($idm);
            }
        }
    }

    private function seedIndikator(DataIdm $idm): void
    {
        $indikators = [
            // IKS - Indeks Ketahanan Sosial
            ['nomor' => 1, 'nama_indikator' => 'Akses Aman Air Minum', 'skor' => 0.0000, 'kategori' => 'iks'],
            ['nomor' => 2, 'nama_indikator' => 'Jumlah Dokter', 'skor' => 0.0095, 'kategori' => 'iks'],
            ['nomor' => 3, 'nama_indikator' => 'Jumlah Bidan', 'skor' => 0.0000, 'kategori' => 'iks'],
            ['nomor' => 4, 'nama_indikator' => 'Akses Puskesmas/Poliklinik terdekat < 3 Km', 'skor' => 0.0000, 'kategori' => 'iks'],
            ['nomor' => 5, 'nama_indikator' => 'Akses ke Poskesdes/Polindes < 3 Km', 'skor' => 0.0095, 'kategori' => 'iks'],
            ['nomor' => 6, 'nama_indikator' => 'Ketersediaan tenaga Kesehatan (Bidan/Nakes)', 'skor' => 0.0000, 'kategori' => 'iks'],
            ['nomor' => 7, 'nama_indikator' => 'Tingkat kepesertaan BPJS', 'skor' => 0.0076, 'kategori' => 'iks'],
            ['nomor' => 8, 'nama_indikator' => 'Akses SD/MI <= 3 Km', 'skor' => 0.0000, 'kategori' => 'iks'],
            ['nomor' => 9, 'nama_indikator' => 'Akses SMP/MTS < 6 Km', 'skor' => 0.0000, 'kategori' => 'iks'],
            ['nomor' => 10, 'nama_indikator' => 'Akses SMA/MA/SMK < 6 Km', 'skor' => 0.0000, 'kategori' => 'iks'],

            // IKE - Indeks Ketahanan Ekonomi
            ['nomor' => 11, 'nama_indikator' => 'Keragaman produksi masyarakat desa', 'skor' => 0.0095, 'kategori' => 'ike'],
            ['nomor' => 12, 'nama_indikator' => 'Tersedia satu atau lebih pertokoan atau warung', 'skor' => 0.0095, 'kategori' => 'ike'],
            ['nomor' => 13, 'nama_indikator' => 'Akses Kredit', 'skor' => 0.0000, 'kategori' => 'ike'],
            ['nomor' => 14, 'nama_indikator' => 'Terdapat Lembaga ekonomi BUMDes', 'skor' => 0.0095, 'kategori' => 'ike'],
            ['nomor' => 15, 'nama_indikator' => 'Keterbukaan wilayah', 'skor' => 0.0095, 'kategori' => 'ike'],

            // IKL - Indeks Ketahanan Lingkungan
            ['nomor' => 16, 'nama_indikator' => 'Kualitas lingkungan', 'skor' => 0.0095, 'kategori' => 'ikl'],
            ['nomor' => 17, 'nama_indikator' => 'Potensi rawan bencana dan tanggap bencana', 'skor' => 0.0048, 'kategori' => 'ikl'],
        ];

        foreach ($indikators as $indikator) {
            IndikatorIdm::create(array_merge($indikator, [
                'data_idm_id' => $idm->id,
            ]));
        }
    }
}
