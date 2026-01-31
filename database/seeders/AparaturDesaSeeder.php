<?php

namespace Database\Seeders;

use App\Models\AparaturDesa;
use Illuminate\Database\Seeder;

class AparaturDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Struktur Pemerintah Desa
        $pemerintahDesa = [
            [
                'nama' => 'Ujang Jatmiko',
                'jabatan' => 'Kepala Desa',
                'jenis' => 'pemerintah_desa',
                'urutan' => 1,
            ],
            [
                'nama' => 'Taat Priyanto',
                'jabatan' => 'Sekretaris Desa',
                'jenis' => 'pemerintah_desa',
                'urutan' => 2,
            ],
            [
                'nama' => 'Kukuh Gilang R.',
                'jabatan' => 'Kasi Pemerintahan',
                'jenis' => 'pemerintah_desa',
                'urutan' => 3,
            ],
            [
                'nama' => 'Suseno',
                'jabatan' => 'Kasi Pelayanan',
                'jenis' => 'pemerintah_desa',
                'urutan' => 4,
            ],
            [
                'nama' => 'Sutanto',
                'jabatan' => 'Kasi Kesejahteraan',
                'jenis' => 'pemerintah_desa',
                'urutan' => 5,
            ],
            [
                'nama' => 'Imam',
                'jabatan' => '',
                'jenis' => 'pemerintah_desa',
                'urutan' => 6,
            ],
            // [
            //     'nama' => 'Riyadi Ratim',
            //     'jabatan' => 'Kaur Perencanaan',
            //     'jenis' => 'pemerintah_desa',
            //     'urutan' => 7,
            // ],
            // [
            //     'nama' => 'Mujil Amin M',
            //     'jabatan' => 'Kepala Dusun Empang',
            //     'jenis' => 'pemerintah_desa',
            //     'urutan' => 8,
            // ],
        ];

        foreach ($pemerintahDesa as $aparatur) {
            AparaturDesa::create(array_merge($aparatur, [
                'is_active' => true,
            ]));
        }

        // Struktur BPD
        $bpd = [
            [
                'nama' => 'Sutarno',
                'jabatan' => 'Ketua BPD',
                'jenis' => 'bpd',
                'urutan' => 1,
            ],
            // [
            //     'nama' => 'Sukarno',
            //     'jabatan' => 'Wakil Ketua BPD',
            //     'jenis' => 'bpd',
            //     'urutan' => 2,
            // ],
            // [
            //     'nama' => 'Dahlia',
            //     'jabatan' => 'Sekretaris BPD',
            //     'jenis' => 'bpd',
            //     'urutan' => 3,
            // ],
            // [
            //     'nama' => 'Ahmad Yani',
            //     'jabatan' => 'Anggota BPD',
            //     'jenis' => 'bpd',
            //     'urutan' => 4,
            // ],
            // [
            //     'nama' => 'Siti Aminah',
            //     'jabatan' => 'Anggota BPD',
            //     'jenis' => 'bpd',
            //     'urutan' => 5,
            // ],
        ];

        foreach ($bpd as $aparatur) {
            AparaturDesa::create(array_merge($aparatur, [
                'is_active' => true,
            ]));
        }
    }
}
