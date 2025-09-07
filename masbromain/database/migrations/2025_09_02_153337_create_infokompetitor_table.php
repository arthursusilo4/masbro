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
        Schema::create('infokompetitor', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatan')->nullOnDelete();
            $table->foreignId('branch_id')->constrained('branch')->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('cluster')->cascadeOnDelete();
            $table->foreignId('kota_kabupaten_id')->constrained('kota_kabupaten')->cascadeOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();

            $table->enum('channel', ['outlet', 'non_outlet']);

            $table->unsignedBigInteger('outlet_id')->nullable();
            $table->string('outlet_name')->nullable();

            $table->foreignId('kompetitor_id')->constrained('kompetitor')->cascadeOnDelete();
            $table->foreignId('promotion_id')->constrained('jenis_promosi')->cascadeOnDelete();

            $table->string('photo')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infokompetitor');
    }
};
