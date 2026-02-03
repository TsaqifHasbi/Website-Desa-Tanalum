<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wisata_desa', function (Blueprint $table) {
            $table->string('jam_buka')->nullable()->change();
            $table->string('jam_tutup')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wisata_desa', function (Blueprint $table) {
            $table->time('jam_buka')->nullable()->change();
            $table->time('jam_tutup')->nullable()->change();
        });
    }
};
