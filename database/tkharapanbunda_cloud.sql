-- ========================================================
-- DATABASE SETUP TK HARAPAN BUNDA (CLOUD & LOCAL)
-- ========================================================

-- 1. Tabel Sekolah
CREATE TABLE IF NOT EXISTS sekolah (
    id_profil INT AUTO_INCREMENT PRIMARY KEY,
    deskripsi_profil TEXT NULL,
    visi TEXT NOT NULL,
    misi TEXT NOT NULL,
    link_maps TEXT NULL,
    kontak VARCHAR(255) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Tabel Galeri
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Tabel Struktur Sekolah
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Tabel Kalender Akademik
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Tabel Kurikulum
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================================
-- DATA AWAL (SEED DATA)
-- ========================================================

-- Isi Data Sekolah
INSERT INTO sekolah (id_profil, deskripsi_profil, visi, misi, link_maps, kontak) VALUES
(1, 
'TK Harapan Bunda melayani pendidikan anak usia dini dalam rentang usia 4–6 tahun. Jumlah peserta didik pada tahun ajaran ini sebanyak 34 anak. Anak-anak berasal dari latar belakang keluarga dengan kondisi sosial ekonomi dan budaya yang beragam, mencerminkan karakter masyarakat kota Bandung.\n\nSebagian besar orang tua peserta didik bekerja di sektor formal dan informal, sehingga waktu pendampingan di rumah tidak merata. Hal ini menyebabkan variasi dalam kemampuan awal peserta didik saat memasuki sekolah, baik dari aspek kognitif, sosial emosional, maupun kesiapan literasi dan motorik.',
'Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.',
'1. Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.\n2. Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.\n3. Membiasakan sikap mandiri pada anak.\n4. Membiasakan hidup sehat.',
'https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed',
'Jl. Babakan Ciparay No.251, Bandung | Telp: (022) 1234567 | info@tkharapanbunda.sch.id'
) ON DUPLICATE KEY UPDATE id_profil=id_profil;

-- Isi Data Galeri Kegiatan & Fasilitas
INSERT INTO galeri (id_galeri, id_profil, judul, kategori, link_foto, deskripsi) VALUES
(1, 1, 'Pentas Seni', 'Pentas Seni', 'adward/images/kids.jpg', 'Penampilan bakat anak di panggung pertunjukan seni.'),
(2, 1, 'Lomba Agustusan', 'Lomba', 'adward/images/kidss.jpg', 'Lomba ceria dan seru dalam menyambut hari kemerdekaan Republik Indonesia.'),
(3, 1, 'Kegiatan Belajar', 'Kegiatan Belajar', 'adward/images/harbun.png', 'Suasana pembelajaran tematik berbasis bermain aktif di ruang kelas.'),
(4, 1, 'Wisuda Kelulusan', 'Wisuda', 'adward/images/kids.jpg', 'Momen pelepasan dan wisuda kelulusan siswa kelompok B.'),
(5, 1, 'Cooking Class', 'Kegiatan Belajar', 'adward/images/kidss.jpg', 'Praktik membuat camilan sehat bersama untuk melatih kemandirian dan motorik halus.'),
(6, 1, 'Market Day & Profesi', 'Lomba', 'adward/images/harbun.png', 'Bazaar cilik dan pengenalan cita-cita serta profesi kepada anak didik.'),
(7, 1, 'Pentas Seni TVRI', 'Pentas Seni', 'adward/images/kids.jpg', 'Penampilan tari dan gerak lagu anak yang diliput secara khusus oleh stasiun TVRI.'),
(8, 1, 'Manasik Haji Kecil', 'Kegiatan Belajar', 'adward/images/kidss.jpg', 'Simulasi peragaan ibadah haji untuk menanamkan nilai agama dan ketakwaan sejak dini.'),
(9, 1, 'Peringatan Hari Kartini', 'Kegiatan Belajar', 'adward/images/harbun.png', 'Karnaval pakaian adat daerah nusantara menumbuhkan rasa cinta budaya tanah air.'),
(10, 1, 'Ruang Kepala Sekolah', 'Fasilitas', 'adward/images/ruang kepala sekolah.jpeg', 'Ruang kerja, koordinasi dewan guru, dan pelayanan administrasi orang tua murid.'),
(11, 1, 'Area Bermain Luar 1', 'Fasilitas', 'adward/images/area bermain - 1.jpeg', 'Wahana outdoor ayunan dan perosotan aman untuk melatih motorik kasar anak.'),
(12, 1, 'Area Bermain Luar 2', 'Fasilitas', 'adward/images/area bermain -2.jpeg', 'Halaman terbuka hijau untuk senam pagi, upacara, dan kegiatan bermain bersama.'),
(13, 1, 'Area Bermain Edukasi', 'Fasilitas', 'adward/images/area bermain - 3.jpeg', 'Fasilitas ketangkasan sensori dan keseimbangan tubuh anak usia dini.'),
(14, 1, 'Media Pembelajaran', 'Fasilitas', 'adward/images/media pembelajaran.jpeg', 'Alat peraga edukatif (APE), puzzle, balok rancang bangun, dan buku cerita bergambar.'),
(15, 1, 'Loker Murid', 'Fasilitas', 'adward/images/loker murid.jpeg', 'Loker pribadi masing-masing siswa untuk melatih kerapian dan tanggung jawab barang sendiri.')
ON DUPLICATE KEY UPDATE id_galeri=id_galeri;

-- Isi Data Guru
INSERT INTO struktur_sekolah (nip, id_profil, id_galeri, nama, jabatan, pendidikan, foto) VALUES
('19780512 200501 2 003', 1, NULL, 'Neneng Nurmayanti, S.Pd', 'Kepala Sekolah', 'S1 PGPAUD', 'adward/images/kepala sekolah.jpeg'),
('19850614 201001 2 015', 1, NULL, 'Nita Yulianti, S.Pd', 'Guru Kelas', 'S1 PGPAUD', 'adward/images/guru-1.jpeg'),
('19900320 201502 2 008', 1, NULL, 'Nia Herlina, S.Pd', 'Guru Kelas', 'S1 PGPAUD', 'adward/images/guru-2.jpeg')
ON DUPLICATE KEY UPDATE nip=nip;

-- Isi Data Kalender Akademik
INSERT INTO kalender_akademik (id_kalender, id_profil, judul_kegiatan, tahun_ajaran, kategori, icon, tanggal_mulai, tanggal_selesai, keterangan) VALUES
(1, 1, 'MPLS Siswa Baru', '2025/2026', 'Semester 1 (Ganjil)', 'fa-star', '2025-07-14', '2025-07-18', 'Masa Pengenalan Lingkungan Sekolah bagi siswa baru.'),
(2, 1, 'Lomba Agustusan', '2025/2026', 'Semester 1 (Ganjil)', 'fa-trophy', '2025-08-16', '2025-08-17', 'Lomba seru menyambut HUT Kemerdekaan RI.'),
(3, 1, 'Parenting Class', '2025/2026', 'Semester 1 (Ganjil)', 'fa-users', '2025-09-20', '2025-09-20', 'Pertemuan kerja sama orang tua dan guru.'),
(4, 1, 'Manasik Haji Kecil', '2025/2026', 'Semester 1 (Ganjil)', 'fa-book', '2025-10-25', '2025-10-25', 'Peragaan ibadah haji untuk mengenalkan nilai agama.'),
(5, 1, 'Market Day & Profesi', '2025/2026', 'Semester 1 (Ganjil)', 'fa-briefcase', '2025-11-20', '2025-11-20', 'Bazaar cilik dan peragaan kostum cita-cita anak.'),
(6, 1, 'Pentas Seni & Rapot', '2025/2026', 'Semester 1 (Ganjil)', 'fa-music', '2025-12-18', '2025-12-19', 'Panggung bakat anak dan penerimaan rapot semester 1.'),
(7, 1, 'Pentas Seni TVRI', '2025/2026', 'Semester 2 (Genap)', 'fa-television', '2026-01-20', '2026-01-20', 'Penampilan kreatif anak yang diliput oleh TVRI.'),
(8, 1, 'Cek Kesehatan Anak', '2025/2026', 'Semester 2 (Genap)', 'fa-user-md', '2026-02-15', '2026-02-15', 'Pemeriksaan kesehatan oleh tenaga medis Puskesmas.'),
(9, 1, 'Cooking Class', '2025/2026', 'Semester 2 (Genap)', 'fa-cutlery', '2026-03-18', '2026-03-18', 'Belajar membuat camilan sehat untuk melatih kemandirian.'),
(10, 1, 'Peringatan Hari Kartini', '2025/2026', 'Semester 2 (Genap)', 'fa-female', '2026-04-21', '2026-04-21', 'Pawai pakaian adat Nusantara.'),
(11, 1, 'Kunjungan Edukasi', '2025/2026', 'Semester 2 (Genap)', 'fa-bus', '2026-05-12', '2026-05-12', 'Outing class belajar mengenal profesi di luar kelas.'),
(12, 1, 'Wisuda & Rapot Sem 2', '2025/2026', 'Semester 2 (Genap)', 'fa-graduation-cap', '2026-06-20', '2026-06-21', 'Pelepasan siswa kelompok B dan penerimaan rapot.')
ON DUPLICATE KEY UPDATE id_kalender=id_kalender;

-- Isi Data Kurikulum
INSERT INTO kurikulum (id_kurikulum, id_profil, kategori, judul, deskripsi) VALUES
(1, 1, 'Nilai CERDAS - C', 'Cinta', 'Pembelajaran dengan kasih sayang dan kehangatan.'),
(2, 1, 'Nilai CERDAS - E', 'Eksplorasi', 'Memberi kesempatan mencoba dan menemukan hal baru.'),
(3, 1, 'Nilai CERDAS - R', 'Religius', 'Membiasakan nilai iman dan akhlak mulia sejak dini.'),
(4, 1, 'Nilai CERDAS - D', 'Disiplin', 'Melatih rasa tanggung jawab dan ketertiban sejak dini.'),
(5, 1, 'Nilai CERDAS - A', 'Aktif', 'Mendorong keaktifan fisik, mental, dan sosial anak.'),
(6, 1, 'Nilai CERDAS - S', 'Santun', 'Menanamkan tutur kata yang baik dan sikap saling menghormati.')
ON DUPLICATE KEY UPDATE id_kurikulum=id_kurikulum;

