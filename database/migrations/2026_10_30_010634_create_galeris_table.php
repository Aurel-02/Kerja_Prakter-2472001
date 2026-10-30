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
        Schema::create('galeri', function (Blueprint $table) {
            $table->increments('id_galeri');
            $table->unsignedInteger('id_profil');
            $table->string('judul');
            $table->string('kategori')->nullable();
            $table->string('link_foto');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_profil')
                ->references('id_profil')
                ->on('sekolah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};
