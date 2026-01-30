<?php

namespace Database\Seeders;

use App\Models\Apbdes;
use App\Models\ApbdesBidang;
use Illuminate\Database\Seeder;

class ApbdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data APBDes per tahun
        $dataApbdes = [
            [
                'tahun' => 2021,
                'pendapatan_asli_desa' => 0,
                'pendapatan_transfer' => 1164117158.75,
                'pendapatan_lain' => 0,
                'belanja_pegawai' => 280000000,
                'belanja_barang_jasa' => 450000000,
                'belanja_modal' => 350000000,
                'belanja_tidak_terduga' => 84117158.75,
            ],
            [
                'tahun' => 2022,
                'pendapatan_asli_desa' => 0,
                'pendapatan_transfer' => 1326738158.75,
                'pendapatan_lain' => 0,
                'belanja_pegawai' => 300000000,
                'belanja_barang_jasa' => 500000000,
                'belanja_modal' => 400000000,
                'belanja_tidak_terduga' => 126738158.75,
            ],
            [
                'tahun' => 2023,
                'pendapatan_asli_desa' => 0,
                'pendapatan_transfer' => 4796209086.75,
                'pendapatan_lain' => 0,
                'belanja_pegawai' => 500000000,
                'belanja_barang_jasa' => 2000000000,
                'belanja_modal' => 1800000000,
                'belanja_tidak_terduga' => 496209086.75,
            ],
            [
                'tahun' => 2024,
                'pendapatan_asli_desa' => 0,
                'pendapatan_transfer' => 4802205800,
                'pendapatan_lain' => 0,
                'belanja_pegawai' => 550000000,
                'belanja_barang_jasa' => 2100000000,
                'belanja_modal' => 1900000000,
                'belanja_tidak_terduga' => 252205800,
            ],
            [
                'tahun' => 2025,
                'pendapatan_asli_desa' => 0,
                'pendapatan_transfer' => 4254715300,
                'pendapatan_lain' => 0,
                'belanja_pegawai' => 1933401412,
                'belanja_barang_jasa' => 1425101190.75,
                'belanja_modal' => 800000000,
                'belanja_tidak_terduga' => 77151786,
                'penerimaan_pembiayaan' => 125939088.75,
                'pengeluaran_pembiayaan' => 145000000,
            ],
        ];

        foreach ($dataApbdes as $data) {
            $totalPendapatan = $data['pendapatan_asli_desa'] + $data['pendapatan_transfer'] + $data['pendapatan_lain'];
            $totalBelanja = $data['belanja_pegawai'] + $data['belanja_barang_jasa'] + $data['belanja_modal'] + $data['belanja_tidak_terduga'];

            $apbdes = Apbdes::create([
                'tahun' => $data['tahun'],
                'pendapatan_asli_desa' => $data['pendapatan_asli_desa'],
                'pendapatan_transfer' => $data['pendapatan_transfer'],
                'pendapatan_lain' => $data['pendapatan_lain'],
                'total_pendapatan' => $totalPendapatan,
                'belanja_pegawai' => $data['belanja_pegawai'],
                'belanja_barang_jasa' => $data['belanja_barang_jasa'],
                'belanja_modal' => $data['belanja_modal'],
                'belanja_tidak_terduga' => $data['belanja_tidak_terduga'],
                'total_belanja' => $totalBelanja,
                'penerimaan_pembiayaan' => $data['penerimaan_pembiayaan'] ?? 0,
                'pengeluaran_pembiayaan' => $data['pengeluaran_pembiayaan'] ?? 0,
                'surplus_defisit' => $totalPendapatan - $totalBelanja,
            ]);

            // Tambahkan detail bidang untuk tahun 2025
            if ($data['tahun'] == 2025) {
                $bidangs = [
                    ['nama_bidang' => 'Penyelenggaraan Pemerintahan Desa', 'anggaran' => 1000000000, 'realisasi' => 800000000],
                    ['nama_bidang' => 'Pelaksanaan Pembangunan Desa', 'anggaran' => 1500000000, 'realisasi' => 1200000000],
                    ['nama_bidang' => 'Pembinaan Kemasyarakatan Desa', 'anggaran' => 500000000, 'realisasi' => 400000000],
                    ['nama_bidang' => 'Pemberdayaan Masyarakat Desa', 'anggaran' => 800000000, 'realisasi' => 600000000],
                    ['nama_bidang' => 'Penanggulangan Bencana, Darurat dan Mendesak Desa', 'anggaran' => 435654388.75, 'realisasi' => 235654388.75],
                ];

                foreach ($bidangs as $bidang) {
                    ApbdesBidang::create([
                        'apbdes_id' => $apbdes->id,
                        'nama_bidang' => $bidang['nama_bidang'],
                        'anggaran' => $bidang['anggaran'],
                        'realisasi' => $bidang['realisasi'],
                        'persentase' => ($bidang['realisasi'] / $bidang['anggaran']) * 100,
                    ]);
                }
            }
        }
    }
}
