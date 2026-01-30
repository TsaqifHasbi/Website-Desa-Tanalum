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
            'nama' => 'Padang',
            'kepala_dusun' => 'Alfatah',
            'jumlah_rt' => 9,
            'jumlah_rw' => 5,
            'keterangan' => 'Dusun 1 terletak di bagian selatan desa, merupakan pusat kegiatan pemerintahan desa',
            'is_active' => true,
        ]);

        Dusun::create([
            'nama' => 'Empang',
            'kepala_dusun' => 'Mujil Amin M',
            'jumlah_rt' => 4,
            'jumlah_rw' => 2,
            'keterangan' => 'Dusun Empang terletak di bagian selatan desa, dekat dengan pantai',
            'is_active' => true,
        ]);
    }
}
