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
        Schema::table('kepala_desa', function (Blueprint $table) {
            // Change from YEAR type to INTEGER to support years before 1901
            $table->integer('tahun_mulai')->nullable()->change();
            $table->integer('tahun_selesai')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kepala_desa', function (Blueprint $table) {
            $table->year('tahun_mulai')->nullable()->change();
            $table->year('tahun_selesai')->nullable()->change();
        });
    }
};
