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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('angkatan_id')->nullable();
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->unsignedBigInteger('tipekelas_id')->nullable();
            $table->unsignedBigInteger('kota_id')->nullable();
            $table->string('siswa_name')->nullable();
            $table->string('siswa_nisn')->nullable();
            $table->string('siswa_ranking')->nullable();
            $table->string('siswa_sertifikat')->nullable();
            $table->string('siswa_nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
