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
            'kode_pos' => '53356',
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
            'sejarah' => 'Desa Tanalum merupakan salah satu desa yang terletak di Kecamatan Rembang, Kabupaten Purbalingga, Provinsi Jawa Tengah. Desa ini memiliki sejarah panjang yang dimulai dari pemukiman masyarakat pesisir yang mengandalkan hasil perkebunan dan pertanian sebagai mata pencaharian utama. Seiring berjalannya waktu, Desa Tanalum berkembang menjadi desa yang memiliki potensi wisata curug yang menarik.',
            'luas_wilayah' => 485, // dalam km2
            'jumlah_penduduk' => 1162,
            'jumlah_kk' => 310,
            'batas_utara' => 'Kabupaten Pekalongan dan Kabupaten Banjarnegara',
            'batas_selatan' => 'Desa Losari dan Desa Sumampir',
            'batas_timur' => 'Desa Losari dan Desa Gunungwuled',
            'batas_barat' => 'Desa Sumampir dan Desa Panusupan',
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
