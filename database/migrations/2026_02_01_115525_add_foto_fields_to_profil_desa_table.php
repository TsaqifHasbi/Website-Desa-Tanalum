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
        Schema::table('profil_desa', function (Blueprint $table) {
            $table->string('foto_kantor')->nullable()->after('logo');
            $table->string('peta_desa')->nullable()->after('foto_kantor');
            $table->string('struktur_organisasi')->nullable()->after('peta_desa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_desa', function (Blueprint $table) {
            $table->dropColumn(['foto_kantor', 'peta_desa', 'struktur_organisasi']);
        });
    }
};
