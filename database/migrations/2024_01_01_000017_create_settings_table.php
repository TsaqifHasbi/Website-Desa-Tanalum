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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, image, json, boolean
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Log aktivitas
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index(['model_type', 'model_id']);
        });

        // Statistik pengunjung
        Schema::create('visitor_statistics', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->integer('total_visits')->default(0);
            $table->integer('unique_visitors')->default(0);
            $table->json('page_views')->nullable();
            $table->json('referrers')->nullable();
            $table->json('browsers')->nullable();
            $table->json('devices')->nullable();
            $table->timestamps();

            $table->unique('tanggal');
        });

        // Data stunting
        Schema::create('data_stunting', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->integer('jumlah_balita')->default(0);
            $table->integer('jumlah_stunting')->default(0);
            $table->decimal('persentase', 5, 2)->default(0);
            $table->json('detail')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_stunting');
        Schema::dropIfExists('visitor_statistics');
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('settings');
    }
};
