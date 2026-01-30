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
            'kepala_dusun' => 'Sumarlin, A.Md',
            'jumlah_rt' => 5,
            'jumlah_rw' => 2,
            'keterangan' => 'Dusun Padang terletak di bagian utara desa',
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
