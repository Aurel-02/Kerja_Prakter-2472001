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
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->increments('id_kurikulum');
            $table->unsignedInteger('id_profil');
            $table->string('kategori', 100);
            $table->string('judul');
            $table->text('deskripsi');
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
        Schema::dropIfExists('kurikulum');
    }
};
