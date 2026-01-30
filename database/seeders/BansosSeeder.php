<?php

namespace Database\Seeders;

use App\Models\JenisBansos;
use App\Models\StatistikBansos;
use App\Models\PenerimaBansos;
use Illuminate\Database\Seeder;

class BansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisBansos = JenisBansos::all();

        // Data statistik bansos
        $statistiks = [
            ['slug' => 'bpjs-pbi', 'jumlah' => 67],
            ['slug' => 'pkh', 'jumlah' => 41],
            ['slug' => 'bpnt', 'jumlah' => 35],
            ['slug' => 'blt', 'jumlah' => 0],
            ['slug' => 'pstn', 'jumlah' => 0],
        ];

        foreach ($statistiks as $stat) {
            $jenis = $jenisBansos->where('slug', $stat['slug'])->first();
            if ($jenis) {
                StatistikBansos::create([
                    'jenis_bansos_id' => $jenis->id,
                    'tahun' => 2025,
                    'jumlah_penerima' => $stat['jumlah'],
                ]);

                // Buat data penerima dummy
                for ($i = 0; $i < min($stat['jumlah'], 10); $i++) {
                    PenerimaBansos::create([
                        'jenis_bansos_id' => $jenis->id,
                        'nik' => '6402' . str_pad(rand(1, 999999999999), 12, '0', STR_PAD_LEFT),
                        'nama' => $this->generateRandomName(),
                        'no_kk' => '6402' . str_pad(rand(1, 999999999999), 12, '0', STR_PAD_LEFT),
                        'alamat' => 'Desa Tanalum',
                        'dusun' => rand(0, 1) ? 'Padang' : 'Empang',
                        'rt' => str_pad(rand(1, 5), 3, '0', STR_PAD_LEFT),
                        'rw' => str_pad(rand(1, 2), 3, '0', STR_PAD_LEFT),
                        'tahun_penerima' => 2025,
                        'status' => 'aktif',
                    ]);
                }
            }
        }
    }

    private function generateRandomName(): string
    {
        $firstNames = ['Ahmad', 'Muhammad', 'Abdul', 'Siti', 'Nur', 'Dewi', 'Sri', 'Andi', 'Budi', 'Agus', 'Wati', 'Rina', 'Yanti', 'Joko', 'Bambang'];
        $lastNames = ['Hidayat', 'Rahman', 'Wijaya', 'Susanto', 'Pratama', 'Sari', 'Lestari', 'Putri', 'Utami', 'Kurniawan', 'Santoso', 'Wibowo', 'Setiawan', 'Permana', 'Saputra'];

        return $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
    }
}
