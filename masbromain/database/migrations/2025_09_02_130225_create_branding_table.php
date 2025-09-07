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
        Schema::create('branding', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatan')->nullOnDelete();
            $table->foreignId('branch_id')->constrained('branch')->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('cluster')->cascadeOnDelete();
            $table->foreignId('kota_kabupaten_id')->constrained('kota_kabupaten')->cascadeOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();
            $table->unsignedBigInteger('outlet_id');
            $table->string('outlet_name');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });

        Schema::create('branding_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branding_id')->constrained('branding')->cascadeOnDelete();
            $table->foreignId('jenis_branding_id')->constrained('jenis_branding')->cascadeOnDelete();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branding');
        Schema::dropIfExists('branding_detail');
    }
};
