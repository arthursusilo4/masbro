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
        Schema::create('cluster', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branch')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('kota_kabupaten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cluster_id')->constrained('cluster')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kota_kabupaten_id')->constrained('kota_kabupaten')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cluster');
        Schema::dropIfExists('kota_kabupaten');
        Schema::dropIfExists('kecamatan');
    }
};
