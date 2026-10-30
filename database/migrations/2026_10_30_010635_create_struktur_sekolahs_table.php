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
        Schema::create('struktur_sekolah', function (Blueprint $table) {
            $table->string('nip', 50)->primary();
            $table->unsignedInteger('id_profil');
            $table->unsignedInteger('id_galeri')->nullable();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('pendidikan')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('id_profil')
                ->references('id_profil')
                ->on('sekolah')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_galeri')
                ->references('id_galeri')
                ->on('galeri')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktur_sekolah');
    }
};
