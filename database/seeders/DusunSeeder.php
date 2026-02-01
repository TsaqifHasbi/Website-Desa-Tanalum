<?php

namespace Database\Seeders;

use App\Models\Dusun;
use Illuminate\Database\Seeder;

class DusunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dusun::create([
            'nama' => 'Kadus I (Tanalum)',
            'kepala_dusun' => 'Alfatah',
            'jumlah_rt' => 5,
            'jumlah_rw' => 1,
            'keterangan' => 'Dusun I terletak di bagian selatan desa, merupakan pusat kegiatan pemerintahan desa',
            'is_active' => true,
        ]);

        Dusun::create([
            'nama' => 'Kadus II (Datar)',
            'kepala_dusun' => '',
            'jumlah_rt' => 4,
            'jumlah_rw' => 1,
            'keterangan' => 'Dusun II terletak di bagian tengah desa',
            'is_active' => true,
        ]);

        Dusun::create([
            'nama' => 'Kadus III (Buret)',
            'kepala_dusun' => '',
            'jumlah_rt' => 6,
            'jumlah_rw' => 1,
            'keterangan' => 'Dusun III terletak di bagian utara desa',
            'is_active' => true,
        ]);

        Dusun::create([
            'nama' => 'Kadus IV (Pucung Rumbak)',
            'kepala_dusun' => 'Mujil Amin M',
            'jumlah_rt' => 5,
            'jumlah_rw' => 1,
            'keterangan' => 'Dusun IV terletak di bagian timur desa',
            'is_active' => true,
        ]);
    }
}
