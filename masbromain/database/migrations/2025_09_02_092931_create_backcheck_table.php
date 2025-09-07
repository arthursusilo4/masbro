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
        Schema::create('backcheck', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('jabatan_id')->nullable()->constrained('jabatan')->nullOnDelete();
            $table->foreignId('branch_id')->constrained('branch')->cascadeOnDelete();
            $table->foreignId('cluster_id')->constrained('cluster')->cascadeOnDelete();
            $table->foreignId('kota_kabupaten_id')->constrained('kota_kabupaten')->cascadeOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();
            $table->unsignedBigInteger('outlet_id');
            $table->string('outlet_name');
            $table->string('owner_phone');

            $table->json('display_share'); // [competitor_id : value, ...]
            $table->json('sales_share_perdana');  // [competitor_id : value, ...]
            $table->json('sales_share_renewal');  // [competitor_id : value, ...]

            $table->string('laporan_path')->nullable();
            $table->json('display_paths')->nullable(); // [path : string, path : string, ...]
            $table->string('branding_path')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backcheck');
    }
};
