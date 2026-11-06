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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->unsignedBigInteger('id_ortu_wali')->nullable();
            $table->string('nis', 50)->nullable();
            $table->string('nama', 255);
            $table->string('tahun_ajaran', 50)->nullable();
            $table->string('status', 50)->default('aktif');
            $table->string('jenis_kelamin', 20)->nullable();
            $table->string('qr_code_siswa', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_ortu_wali')
                ->references('id_ortu_wali')
                ->on('orang_tua_wali')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};

