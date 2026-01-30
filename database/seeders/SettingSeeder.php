<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Website Desa Tanalum', 'type' => 'text', 'group' => 'general', 'label' => 'Nama Website'],
            ['key' => 'site_tagline', 'value' => 'Desa Wisata yang Asri dan Sejahtera', 'type' => 'text', 'group' => 'general', 'label' => 'Tagline'],
            ['key' => 'site_description', 'value' => 'Website resmi Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Kalimantan Timur', 'type' => 'textarea', 'group' => 'general', 'label' => 'Deskripsi'],
            ['key' => 'site_logo', 'value' => 'logo/logo-desa.png', 'type' => 'image', 'group' => 'general', 'label' => 'Logo Website'],
            ['key' => 'site_favicon', 'value' => 'logo/favicon.ico', 'type' => 'image', 'group' => 'general', 'label' => 'Favicon'],

            // Contact Settings
            ['key' => 'contact_address', 'value' => 'Jalan Langaseng Dusun Empang RT.003, Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur, 75385', 'type' => 'textarea', 'group' => 'contact', 'label' => 'Alamat'],
            ['key' => 'contact_phone', 'value' => '082150208664', 'type' => 'text', 'group' => 'contact', 'label' => 'Telepon'],
            ['key' => 'contact_email', 'value' => 'tanalum.marangkayu@kukarkab.go.id', 'type' => 'text', 'group' => 'contact', 'label' => 'Email'],
            ['key' => 'contact_whatsapp', 'value' => '082150208664', 'type' => 'text', 'group' => 'contact', 'label' => 'WhatsApp'],

            // Social Media
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/desatanalum', 'type' => 'text', 'group' => 'social', 'label' => 'Instagram'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/desatanalum', 'type' => 'text', 'group' => 'social', 'label' => 'Facebook'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/desatanalum', 'type' => 'text', 'group' => 'social', 'label' => 'Twitter/X'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/@desatanalum', 'type' => 'text', 'group' => 'social', 'label' => 'YouTube'],
            ['key' => 'social_tiktok', 'value' => 'https://tiktok.com/@desatanalum', 'type' => 'text', 'group' => 'social', 'label' => 'TikTok'],

            // SEO Settings
            ['key' => 'seo_meta_title', 'value' => 'Desa Tanalum - Desa Wisata Kabupaten Kutai Kartanegara', 'type' => 'text', 'group' => 'seo', 'label' => 'Meta Title'],
            ['key' => 'seo_meta_description', 'value' => 'Website resmi Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara. Informasi desa, berita, layanan, dan wisata Pantai Biru Tanalum.', 'type' => 'textarea', 'group' => 'seo', 'label' => 'Meta Description'],
            ['key' => 'seo_meta_keywords', 'value' => 'desa tanalum, kutai kartanegara, marang kayu, pantai biru, wisata kaltim, desa wisata', 'type' => 'text', 'group' => 'seo', 'label' => 'Meta Keywords'],

            // Feature Toggles
            ['key' => 'feature_ppid', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Aktifkan PPID'],
            ['key' => 'feature_umkm', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Aktifkan UMKM'],
            ['key' => 'feature_pengaduan', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Aktifkan Pengaduan'],
            ['key' => 'feature_cek_bansos', 'value' => '1', 'type' => 'boolean', 'group' => 'features', 'label' => 'Aktifkan Cek Bansos'],

            // Appearance
            ['key' => 'appearance_primary_color', 'value' => '#16a34a', 'type' => 'text', 'group' => 'appearance', 'label' => 'Warna Utama'],
            ['key' => 'appearance_secondary_color', 'value' => '#15803d', 'type' => 'text', 'group' => 'appearance', 'label' => 'Warna Sekunder'],

            // Footer
            ['key' => 'footer_copyright', 'value' => '© 2026 Powered by PT Digital Desa Indonesia', 'type' => 'text', 'group' => 'footer', 'label' => 'Copyright Text'],

            // External Links
            ['key' => 'link_kemendesa', 'value' => 'https://kemendesa.go.id', 'type' => 'text', 'group' => 'links', 'label' => 'Website Kemendesa'],
            ['key' => 'link_kemendagri', 'value' => 'https://kemendagri.go.id', 'type' => 'text', 'group' => 'links', 'label' => 'Website Kemendagri'],
            ['key' => 'link_kabupaten', 'value' => 'https://kukarkab.go.id', 'type' => 'text', 'group' => 'links', 'label' => 'Website Kabupaten'],
            ['key' => 'link_cek_dpt', 'value' => 'https://cekdptonline.kpu.go.id', 'type' => 'text', 'group' => 'links', 'label' => 'Cek DPT Online'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
