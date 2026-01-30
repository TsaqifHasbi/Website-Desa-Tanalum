<?php

namespace Database\Seeders;

use App\Models\ProfilDesa;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilDesa::create([
            'nama_desa' => 'Tanalum',
            'kode_desa' => '6402172005',
            'kecamatan' => 'Rembang',
            'kabupaten' => 'Purbalingga',
            'provinsi' => 'Jawa Tengah',
            'kode_pos' => '75385',
            'alamat_kantor' => 'Jalan Langaseng Dusun Empang RT.003',
            'telepon' => '082150208664',
            'email' => 'tanalum@desa.com',
            'website' => 'https://tanalum.desa.id',
            'visi' => '"Desa Tanalum sebagai Desa Wisata yang mampu mengelolah potensi Desa dan pembangunan berkelanjutan untuk mewujudkan masyarakat yang sejahtera"',
            'misi' => ' 1. Mewujudkan tata kelola pemerintahan yang baik
                        2. Mengembangkan kegiatan keagamaan
                        3. Meningkatkan kualitas pendidikan dan sumber daya manusia
                        4. Mengembangkan teknologi informasi
                        5. Pembangunan infrastruktur, sarana dan prasarana',
            'sejarah' => 'Desa Tanalum merupakan salah satu desa yang terletak di Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur. Desa ini memiliki sejarah panjang yang dimulai dari pemukiman masyarakat pesisir yang mengandalkan hasil laut dan pertanian sebagai mata pencaharian utama. Seiring berjalannya waktu, Desa Tanalum berkembang menjadi desa yang memiliki potensi wisata pantai yang menarik.',
            'luas_wilayah' => 3880000, // dalam m2
            'jumlah_penduduk' => 1162,
            'jumlah_kk' => 310,
            'batas_utara' => 'Desa Santan Ulu dan Desa Santan Ilir',
            'batas_selatan' => 'Selat Makassar dan Desa Semangko',
            'batas_timur' => 'Selat Makassar',
            'batas_barat' => 'Desa Santan Ulu',
            'latitude' => -0.3750,
            'longitude' => 117.2500,
            'kode_wilayah' => '64.02.17.2005',
            'sosial_media' => [
                'instagram' => 'https://instagram.com/desatanalum',
                'facebook' => 'https://facebook.com/desatanalum',
                'twitter' => 'https://twitter.com/desatanalum',
                'youtube' => 'https://youtube.com/@desatanalum',
                'tiktok' => 'https://tiktok.com/@desatanalum',
            ],
        ]);
    }
}
