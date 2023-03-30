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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->unsignedBigInteger('univ_id')->nullable();
            $table->unsignedBigInteger('jurusan_id')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('kkm')->nullable();
            $table->string('nilai')->nullable();
            $table->string('ranking')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('linjur')->nullable();
            $table->string('domisili')->nullable();
            $table->string('alumni')->nullable();
            $table->string('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
