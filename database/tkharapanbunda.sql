-- ========================================================
-- Database: tkharapanbunda
-- Berdasarkan Diagram Relasi Entitas (ERD) & Penyesuaian Website
-- ========================================================

CREATE DATABASE IF NOT EXISTS tkharapanbunda 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE tkharapanbunda;

-- 1. Tabel Sekolah (Pusat Relasi Profil, Visi, Misi)
CREATE TABLE IF NOT EXISTS sekolah (
    id_profil INT AUTO_INCREMENT PRIMARY KEY,
    deskripsi_profil TEXT NULL,
    visi TEXT NOT NULL,
    misi TEXT NOT NULL,
    link_maps TEXT NULL,
    kontak VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 2. Tabel Galeri (1 Sekolah mempunyai N Galeri)
CREATE TABLE IF NOT EXISTS galeri (
    id_galeri INT AUTO_INCREMENT PRIMARY KEY,
    id_profil INT NOT NULL,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(100) NULL,
    link_foto VARCHAR(255) NOT NULL,
    deskripsi TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_galeri_sekolah FOREIGN KEY (id_profil) 
        REFERENCES sekolah(id_profil) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 3. Tabel Struktur Sekolah (1 Sekolah mempunyai N Struktur_sekolah, dan relasi N ke 1 Galeri)
CREATE TABLE IF NOT EXISTS struktur_sekolah (
    nip VARCHAR(50) PRIMARY KEY,
    id_profil INT NOT NULL,
    id_galeri INT NULL,
    nama VARCHAR(255) NOT NULL,
    jabatan VARCHAR(100) NOT NULL,
    pendidikan VARCHAR(100) NULL,
    foto VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_struktur_sekolah FOREIGN KEY (id_profil) 
        REFERENCES sekolah(id_profil) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE,
    CONSTRAINT fk_struktur_galeri FOREIGN KEY (id_galeri) 
        REFERENCES galeri(id_galeri) 
        ON DELETE SET NULL 
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 4. Tabel Kalender Akademik (1 Sekolah mempunyai N Kalender Akademik)
CREATE TABLE IF NOT EXISTS kalender_akademik (
    id_kalender INT AUTO_INCREMENT PRIMARY KEY,
    id_profil INT NOT NULL,
    judul_kegiatan VARCHAR(255) NOT NULL,
    tahun_ajaran VARCHAR(50) NOT NULL,
    kategori VARCHAR(100) NULL,
    icon VARCHAR(50) NULL DEFAULT 'fa-calendar-check-o',
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    keterangan TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_kalender_sekolah FOREIGN KEY (id_profil) 
        REFERENCES sekolah(id_profil) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- 5. Tabel Kurikulum (1 Sekolah mempunyai N Kurikulum)
CREATE TABLE IF NOT EXISTS kurikulum (
    id_kurikulum INT AUTO_INCREMENT PRIMARY KEY,
    id_profil INT NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_kurikulum_sekolah FOREIGN KEY (id_profil) 
        REFERENCES sekolah(id_profil) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB;
