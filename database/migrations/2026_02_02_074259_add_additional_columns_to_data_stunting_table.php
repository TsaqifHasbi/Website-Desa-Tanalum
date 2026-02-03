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
        Schema::table('data_stunting', function (Blueprint $table) {
            $table->unsignedTinyInteger('bulan')->nullable()->after('tahun');
            $table->integer('jumlah_gizi_buruk')->default(0)->after('jumlah_stunting');
            $table->integer('jumlah_gizi_kurang')->default(0)->after('jumlah_gizi_buruk');
            $table->text('catatan')->nullable()->after('keterangan');
        });
        
        // Remove unique constraint on tahun to allow multiple records per year (different months)
        Schema::table('data_stunting', function (Blueprint $table) {
            $table->dropUnique(['tahun']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_stunting', function (Blueprint $table) {
            $table->dropColumn(['bulan', 'jumlah_gizi_buruk', 'jumlah_gizi_kurang', 'catatan']);
        });
        
        Schema::table('data_stunting', function (Blueprint $table) {
            $table->unique('tahun');
        });
    }
};
