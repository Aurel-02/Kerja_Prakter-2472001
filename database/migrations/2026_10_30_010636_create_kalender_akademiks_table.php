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
        Schema::create('kalender_akademik', function (Blueprint $table) {
            $table->increments('id_kalender');
            $table->unsignedInteger('id_profil');
            $table->string('judul_kegiatan');
            $table->string('tahun_ajaran', 50);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('kalender_akademik');
    }
};
