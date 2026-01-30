<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfilDesaSeeder::class,
            AparaturDesaSeeder::class,
            DusunSeeder::class,
            KategoriSeeder::class,
            BeritaSeeder::class,
            ProdukUmkmSeeder::class,
            GaleriSeeder::class,
            DokumenPpidSeeder::class,
            StatistikPendudukSeeder::class,
            ApbdesSeeder::class,
            BansosSeeder::class,
            DataIdmSeeder::class,
            DataSdgsSeeder::class,
            PotensiWisataSeeder::class,
            SliderSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
