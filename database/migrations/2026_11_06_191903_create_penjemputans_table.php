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
        Schema::create('penjemputan', function (Blueprint $table) {
            $table->id('id_penjemputan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_ortu_wali');
            $table->dateTime('waktu');
            $table->text('keterangan')->nullable();
            $table->string('status', 50)->default('menunggu');
            $table->timestamps();

            // Relasi One-to-Many dengan User
            $table->foreign('id_user')
                ->references('id_user')
                ->on('user')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Relasi Agregat dengan Siswa dan Orang Tua / Wali
            $table->foreign('id_siswa')
                ->references('id_siswa')
                ->on('siswa')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('penjemputan');
    }
};

