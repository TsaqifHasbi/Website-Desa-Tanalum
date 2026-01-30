<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin_desa')->first();
        $kategoris = KategoriBerita::all();

        $beritas = [
            [
                'judul' => 'POKDARWIS Pantai Biru Tanalum Terima Bantuan Gazebo dari Bank Indonesia',
                'ringkasan' => 'Kelompok Sadar Wisata (POKDARWIS) Pantai Biru Tanalum menerima bantuan 10 (sepuluh) unit gazebo dari Bank Indonesia sebagai bagian dari program pemberdayaan masyarakat.',
                'konten' => '<p>Tanalum - Kelompok Sadar Wisata (POKDARWIS) Pantai Biru Tanalum menerima bantuan 10 (sepuluh) unit gazebo dari Bank Indonesia sebagai bagian dari program pemberdayaan masyarakat desa wisata.</p>
                <p>Bantuan ini diserahkan langsung oleh perwakilan Bank Indonesia kepada pengurus POKDARWIS Pantai Biru Tanalum dalam acara seremonial yang dihadiri oleh Kepala Desa, perangkat desa, dan masyarakat setempat.</p>
                <p>Kepala Desa Tanalum, Jumadi, menyampaikan rasa terima kasih atas bantuan yang diberikan. "Gazebo ini akan sangat bermanfaat untuk meningkatkan fasilitas wisata pantai kami. Pengunjung akan lebih nyaman menikmati keindahan Pantai Biru Tanalum," ujarnya.</p>
                <p>Bantuan gazebo ini diharapkan dapat meningkatkan kualitas layanan wisata dan menarik lebih banyak wisatawan untuk berkunjung ke Desa Tanalum.</p>',
                'kategori' => 'wisata',
                'is_featured' => true,
            ],
            [
                'judul' => 'Kegiatan Gotong Royong Warga RT.002 Desa Tanalum Melalui BKKD RT',
                'ringkasan' => 'Warga RT.002 Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, melaksanakan kegiatan gotong royong melalui bantuan Keuangan.',
                'konten' => '<p>Tanalum - Warga RT.002 Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, melaksanakan kegiatan gotong royong melalui bantuan Keuangan.</p>
                <p>Kegiatan ini merupakan wujud partisipasi masyarakat dalam menjaga kebersihan dan keindahan lingkungan desa. Warga secara bergotong royong membersihkan jalan, selokan, dan fasilitas umum di lingkungan RT.002.</p>
                <p>Ketua RT.002 menyampaikan apresiasi kepada seluruh warga yang telah berpartisipasi aktif dalam kegiatan ini. "Semangat gotong royong harus terus kita jaga sebagai tradisi masyarakat desa," katanya.</p>',
                'kategori' => 'kemasyarakatan',
                'is_featured' => true,
            ],
            [
                'judul' => 'RT Di Desa Tanalum Tingkatkan Penjagaan Keamanan Lingkungan',
                'ringkasan' => 'Dalam upaya menciptakan lingkungan yang aman, tertib, dan kondusif, Ketua RT bersama warga di Desa Tanalum, Kecamatan Marang Kayu melakukan peningkatan keamanan.',
                'konten' => '<p>Tanalum - Dalam upaya menciptakan lingkungan yang aman, tertib, dan kondusif, Ketua RT bersama warga di Desa Tanalum, Kecamatan Marang Kayu, melakukan peningkatan sistem keamanan lingkungan.</p>
                <p>Program ini meliputi pembentukan jadwal ronda malam, pemasangan lampu penerangan jalan, dan koordinasi rutin antar warga untuk menjaga keamanan bersama.</p>
                <p>Kepala Desa Tanalum mengapresiasi langkah proaktif warga dalam menjaga keamanan lingkungan. "Keamanan adalah tanggung jawab bersama. Dengan kerjasama yang baik, kita bisa menciptakan lingkungan yang aman dan nyaman," ujarnya.</p>',
                'kategori' => 'kemasyarakatan',
                'is_featured' => true,
            ],
            [
                'judul' => 'Gerakan Bersih Pantai di Desa Tanalum Wujud Kepedulian Lingkungan',
                'ringkasan' => 'Dalam rangka menjaga kelestarian ekosistem pesisir dan meningkatkan kesadaran masyarakat terhadap pentingnya kebersihan lingkungan laut.',
                'konten' => '<p>Tanalum - Dalam rangka menjaga kelestarian ekosistem pesisir dan meningkatkan kesadaran masyarakat terhadap pentingnya kebersihan lingkungan laut, Desa Tanalum menggelar Gerakan Bersih Pantai.</p>
                <p>Kegiatan ini diikuti oleh aparatur desa, karang taruna, POKDARWIS, dan masyarakat umum. Peserta secara bersama-sama mengumpulkan sampah plastik dan limbah lainnya yang berserakan di sepanjang pantai.</p>
                <p>"Pantai adalah aset wisata utama desa kami. Kita harus menjaga kebersihannya agar tetap menarik bagi wisatawan dan menjaga kelestarian ekosistem laut," kata Koordinator Kegiatan.</p>',
                'kategori' => 'lingkungan',
                'is_featured' => false,
            ],
            [
                'judul' => 'Pelatihan Tata Kelola Bisnis dan Pemasaran Destinasi Wisata',
                'ringkasan' => 'Dalam rangka meningkatkan kualitas sumber daya manusia (SDM) di bidang pariwisata, kegiatan Pelatihan Tata Kelola Bisnis dan Pemasaran dilaksanakan.',
                'konten' => '<p>Tanalum - Dalam rangka meningkatkan kualitas sumber daya manusia (SDM) di bidang pariwisata, kegiatan Pelatihan Tata Kelola Bisnis dan Pemasaran Destinasi Wisata dilaksanakan di Desa Tanalum.</p>
                <p>Pelatihan ini diikuti oleh pelaku wisata, pengurus POKDARWIS, dan UMKM desa. Materi yang disampaikan meliputi strategi pemasaran digital, pengelolaan keuangan usaha wisata, dan peningkatan kualitas layanan.</p>
                <p>Narasumber dari Dinas Pariwisata Kabupaten menyampaikan pentingnya pengelolaan bisnis wisata yang profesional. "Dengan tata kelola yang baik, destinasi wisata di Desa Tanalum dapat berkembang dan memberikan manfaat ekonomi bagi masyarakat," jelasnya.</p>',
                'kategori' => 'ekonomi',
                'is_featured' => false,
            ],
            [
                'judul' => 'Pendampingan Desa Wisata Tanalum: Perancangan Paket oleh Pokdarwis',
                'ringkasan' => 'Kelompok Sadar Wisata (Pokdarwis) Pantai Biru Tanalum kembali mendapatkan pendampingan dalam rangka pengembangan Desa Wisata.',
                'konten' => '<p>Tanalum - Kelompok Sadar Wisata (Pokdarwis) Pantai Biru Tanalum kembali mendapatkan pendampingan dalam rangka pengembangan Desa Wisata. Kali ini, pendampingan difokuskan pada perancangan paket wisata yang menarik.</p>
                <p>Tim pendamping membantu Pokdarwis dalam menyusun paket wisata yang mengintegrasikan berbagai atraksi wisata desa, mulai dari wisata pantai, kuliner lokal, hingga kerajinan masyarakat.</p>
                <p>"Paket wisata yang terstruktur akan memudahkan wisatawan dalam menikmati seluruh potensi desa kami," kata Ketua Pokdarwis.</p>',
                'kategori' => 'wisata',
                'is_featured' => false,
            ],
        ];

        foreach ($beritas as $index => $berita) {
            $kategori = $kategoris->where('slug', $berita['kategori'])->first();

            Berita::create([
                'kategori_id' => $kategori?->id,
                'user_id' => $admin->id,
                'judul' => $berita['judul'],
                'slug' => Str::slug($berita['judul']) . '-' . Str::random(5),
                'ringkasan' => $berita['ringkasan'],
                'konten' => $berita['konten'],
                'views' => rand(50, 300),
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
                'is_featured' => $berita['is_featured'],
            ]);
        }
    }
}
