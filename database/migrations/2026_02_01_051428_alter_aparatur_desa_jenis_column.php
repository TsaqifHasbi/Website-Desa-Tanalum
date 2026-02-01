<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change ENUM column to allow more values
        DB::statement("ALTER TABLE aparatur_desa MODIFY COLUMN jenis ENUM('pemerintah_desa', 'perangkat', 'bpd', 'lpm', 'pkk', 'karang_taruna', 'lembaga_lain') DEFAULT 'perangkat'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE aparatur_desa MODIFY COLUMN jenis ENUM('pemerintah_desa', 'bpd') DEFAULT 'pemerintah_desa'");
    }
};
