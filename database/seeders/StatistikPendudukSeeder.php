<?php

namespace Database\Seeders;

use App\Models\StatistikPenduduk;
use Illuminate\Database\Seeder;

class StatistikPendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatistikPenduduk::create([
            'tahun' => 2025,
            'bulan' => null,
            'total_penduduk' => 1162,
            'total_kk' => 310,
            'laki_laki' => 608,
            'perempuan' => 554,
            'kelompok_umur' => [
                '0-4' => ['laki_laki' => 45, 'perempuan' => 42],
                '5-9' => ['laki_laki' => 52, 'perempuan' => 48],
                '10-14' => ['laki_laki' => 74, 'perempuan' => 57],
                '15-19' => ['laki_laki' => 58, 'perempuan' => 57],
                '20-24' => ['laki_laki' => 55, 'perempuan' => 57],
                '25-29' => ['laki_laki' => 48, 'perempuan' => 45],
                '30-34' => ['laki_laki' => 42, 'perempuan' => 40],
                '35-39' => ['laki_laki' => 38, 'perempuan' => 36],
                '40-44' => ['laki_laki' => 35, 'perempuan' => 33],
                '45-49' => ['laki_laki' => 30, 'perempuan' => 28],
                '50-54' => ['laki_laki' => 28, 'perempuan' => 26],
                '55-59' => ['laki_laki' => 25, 'perempuan' => 23],
                '60-64' => ['laki_laki' => 30, 'perempuan' => 27],
                '65-69' => ['laki_laki' => 20, 'perempuan' => 18],
                '70-74' => ['laki_laki' => 15, 'perempuan' => 12],
                '75+' => ['laki_laki' => 13, 'perempuan' => 5],
            ],
            'pendidikan' => [
                'tidak_sekolah' => 85,
                'belum_tamat_sd' => 120,
                'tamat_sd' => 280,
                'sltp' => 220,
                'slta' => 350,
                'diploma' => 45,
                's1' => 55,
                's2' => 5,
                's3' => 2,
            ],
            'pekerjaan' => [
                'pelajar_mahasiswa' => 327,
                'belum_tidak_bekerja' => 274,
                'mengurus_rumah_tangga' => 272,
                'karyawan_swasta' => 117,
                'nelayan_perikanan' => 50,
                'petani_pekebun' => 39,
                'wiraswasta' => 37,
                'pns' => 20,
                'lainnya' => 26,
            ],
            'agama' => [
                'islam' => 1162,
                'kristen' => 0,
                'katolik' => 0,
                'hindu' => 0,
                'buddha' => 0,
                'konghucu' => 0,
                'kepercayaan_lainnya' => 0,
            ],
            'status_perkawinan' => [
                'belum_kawin' => 624,
                'kawin' => 459,
                'kawin_tercatat' => 5,
                'cerai_hidup' => 4,
                'cerai_mati' => 69,
                'kawin_tidak_tercatat' => 1,
            ],
            'per_dusun' => [
                'Padang' => 762,
                'Empang' => 400,
            ],
            'wajib_pilih' => [
                '2024' => 850,
                '2025' => 874,
                '2026' => 900,
            ],
            'kelahiran' => 15,
            'kematian' => 8,
            'pindah_masuk' => 12,
            'pindah_keluar' => 10,
        ]);
    }
}
