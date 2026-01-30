<?php

namespace Database\Seeders;

use App\Models\ProdukUmkm;
use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProdukUmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = KategoriProduk::all();

        $produks = [
            [
                'nama' => 'Cookies',
                'deskripsi' => 'Roti tawar segar buatan rumahan dengan bahan berkualitas',
                'harga' => 10000,
                'kategori' => 'makanan',
                'pemilik' => 'Ibu Siti',
                'kontak_pemilik' => '081234567890',
            ],
            [
                'nama' => 'Galon',
                'deskripsi' => 'Konektor masker handmade untuk kenyamanan penggunaan masker',
                'harga' => 10000,
                'kategori' => 'kerajinan',
                'pemilik' => 'Bu Ani',
                'kontak_pemilik' => '081234567891',
            ],
            [
                'nama' => 'Toko Klontong',
                'deskripsi' => 'Paket snack box untuk acara dan kegiatan',
                'harga' => 123,
                'kategori' => 'makanan',
                'pemilik' => 'Pak Ahmad',
                'kontak_pemilik' => '081234567892',
            ],
            [
                'nama' => 'Kopi Lutang',
                'deskripsi' => 'Kue talam susu tradisional yang lembut dan manis',
                'harga' => 123,
                'kategori' => 'makanan',
                'pemilik' => 'Ibu Rina',
                'kontak_pemilik' => '081234567893',
            ],
            [
                'nama' => 'Catering',
                'deskripsi' => 'Souvenir khas Desa Tanalum untuk oleh-oleh',
                'harga' => 150000,
                'kategori' => 'kerajinan',
                'pemilik' => 'Pak Budi',
                'kontak_pemilik' => '081234567894',
            ],
            // [
            //     'nama' => 'MICROPAY',
            //     'deskripsi' => 'Layanan pembayaran digital untuk kemudahan transaksi',
            //     'harga' => 123,
            //     'kategori' => 'lainnya',
            //     'pemilik' => 'CV Micropay',
            //     'kontak_pemilik' => '081234567895',
            // ],
            // [
            //     'nama' => 'Ikan Asin',
            //     'deskripsi' => 'Ikan asin hasil laut segar dari nelayan lokal',
            //     'harga' => 50000,
            //     'kategori' => 'perikanan',
            //     'pemilik' => 'Pak Nelayan',
            //     'kontak_pemilik' => '081234567896',
            // ],
            // [
            //     'nama' => 'Kerupuk Ikan',
            //     'deskripsi' => 'Kerupuk ikan homemade renyah dan gurih',
            //     'harga' => 25000,
            //     'kategori' => 'makanan',
            //     'pemilik' => 'Ibu Wati',
            //     'kontak_pemilik' => '081234567897',
            // ],
            // [
            //     'nama' => 'Anyaman Bambu',
            //     'deskripsi' => 'Kerajinan anyaman bambu berkualitas tinggi',
            //     'harga' => 75000,
            //     'kategori' => 'kerajinan',
            //     'pemilik' => 'Pak Karman',
            //     'kontak_pemilik' => '081234567898',
            // ],
        ];

        foreach ($produks as $produk) {
            $kategori = $kategoris->where('slug', $produk['kategori'])->first();

            ProdukUmkm::create([
                'kategori_id' => $kategori?->id,
                'nama' => $produk['nama'],
                'slug' => Str::slug($produk['nama']) . '-' . Str::random(5),
                'deskripsi' => $produk['deskripsi'],
                'harga' => $produk['harga'],
                'satuan' => 'pcs',
                'pemilik' => $produk['pemilik'],
                'kontak_pemilik' => $produk['kontak_pemilik'],
                'rating' => rand(35, 50) / 10,
                'jumlah_rating' => rand(5, 50),
                'views' => rand(10, 100),
                'is_featured' => rand(0, 1),
                'is_active' => true,
            ]);
        }
    }
}
