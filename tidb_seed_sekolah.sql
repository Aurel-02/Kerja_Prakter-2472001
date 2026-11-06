USE test;

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE IF NOT EXISTS `sekolah` (
  `id_profil` int unsigned NOT NULL AUTO_INCREMENT,
  `deskripsi_profil` text DEFAULT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `link_maps` text DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
);

CREATE TABLE IF NOT EXISTS `galeri` (
  `id_galeri` int unsigned NOT NULL AUTO_INCREMENT,
  `id_profil` int unsigned NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `link_foto` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_galeri`),
  KEY `galeri_id_profil_foreign` (`id_profil`),
  CONSTRAINT `galeri_id_profil_foreign` FOREIGN KEY (`id_profil`) REFERENCES `sekolah` (`id_profil`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `struktur_sekolah` (
  `nip` varchar(50) NOT NULL,
  `id_profil` int unsigned NOT NULL,
  `id_galeri` int unsigned DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `struktur_sekolah_id_profil_foreign` (`id_profil`),
  KEY `struktur_sekolah_id_galeri_foreign` (`id_galeri`),
  CONSTRAINT `struktur_sekolah_id_profil_foreign` FOREIGN KEY (`id_profil`) REFERENCES `sekolah` (`id_profil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `struktur_sekolah_id_galeri_foreign` FOREIGN KEY (`id_galeri`) REFERENCES `galeri` (`id_galeri`) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `kalender_akademik` (
  `id_kalender` int unsigned NOT NULL AUTO_INCREMENT,
  `id_profil` int unsigned NOT NULL,
  `judul_kegiatan` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(50) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'fa-calendar-check-o',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kalender`),
  KEY `kalender_akademik_id_profil_foreign` (`id_profil`),
  CONSTRAINT `kalender_akademik_id_profil_foreign` FOREIGN KEY (`id_profil`) REFERENCES `sekolah` (`id_profil`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `kurikulum` (
  `id_kurikulum` int unsigned NOT NULL AUTO_INCREMENT,
  `id_profil` int unsigned NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kurikulum`),
  KEY `kurikulum_id_profil_foreign` (`id_profil`),
  CONSTRAINT `kurikulum_id_profil_foreign` FOREIGN KEY (`id_profil`) REFERENCES `sekolah` (`id_profil`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Data untuk tabel user
INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES ('1', 'admin1', '$2y$12$fkcrHvly36VLKSsbpYTXw.ojYkqOCAAc5IEA5qxvmMFQ0OMPWE31G', 'Administrator', 'admin', 'aktif', NULL, '2026-11-06 11:33:33', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);

-- Data untuk tabel sekolah
INSERT INTO `sekolah` (`id_profil`, `deskripsi_profil`, `visi`, `misi`, `link_maps`, `kontak`, `created_at`, `updated_at`) VALUES ('1', 'TK Harapan Bunda melayani pendidikan anak usia dini dalam rentang usia 4–6 tahun. Jumlah peserta didik pada tahun ajaran ini sebanyak 34 anak. Anak-anak berasal dari latar belakang keluarga dengan kondisi sosial ekonomi dan budaya yang beragam, mencerminkan karakter masyarakat kota Bandung.

Sebagian besar orang tua peserta didik bekerja di sektor formal dan informal, sehingga waktu pendampingan di rumah tidak merata. Hal ini menyebabkan variasi dalam kemampuan awal peserta didik saat memasuki sekolah, baik dari aspek kognitif, sosial emosional, maupun kesiapan literasi dan motorik.', 'Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.', '1. Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.
2. Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.
3. Membiasakan sikap mandiri pada anak.
4. Membiasakan hidup sehat.', 'https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed', 'Jl. Babakan Ciparay No.251, Bandung | Telp: (022) 1234567 | info@tkharapanbunda.sch.id', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `sekolah` (`id_profil`, `deskripsi_profil`, `visi`, `misi`, `link_maps`, `kontak`, `created_at`, `updated_at`) VALUES ('2', 'TK Harapan Bunda melayani pendidikan anak usia dini dalam rentang usia 4–6 tahun. Jumlah peserta didik pada tahun ajaran ini sebanyak 34 anak. Anak-anak berasal dari latar belakang keluarga dengan kondisi sosial ekonomi dan budaya yang beragam, mencerminkan karakter masyarakat kota Bandung.

Sebagian besar orang tua peserta didik bekerja di sektor formal dan informal, sehingga waktu pendampingan di rumah tidak merata. Hal ini menyebabkan variasi dalam kemampuan awal peserta didik saat memasuki sekolah, baik dari aspek kognitif, sosial emosional, maupun kesiapan literasi dan motorik.', 'Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.', '1. Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.
2. Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.
3. Membiasakan sikap mandiri pada anak.
4. Membiasakan hidup sehat.', 'https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed', 'Jl. Babakan Ciparay No.251, Bandung | Telp: (022) 1234567 | info@tkharapanbunda.sch.id', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);

-- Data untuk tabel galeri
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('1', '1', 'Pentas Seni', 'Pentas Seni', 'adward/images/kids.jpg', 'Penampilan bakat anak di panggung pertunjukan seni.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('2', '1', 'Lomba Agustusan', 'Lomba', 'adward/images/kidss.jpg', 'Lomba ceria dan seru dalam menyambut hari kemerdekaan Republik Indonesia.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('3', '1', 'Kegiatan Belajar', 'Kegiatan Belajar', 'adward/images/harbun.png', 'Suasana pembelajaran tematik berbasis bermain aktif di ruang kelas.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('4', '1', 'Wisuda Kelulusan', 'Wisuda', 'adward/images/kids.jpg', 'Momen pelepasan dan wisuda kelulusan siswa kelompok B.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('5', '1', 'Cooking Class', 'Kegiatan Belajar', 'adward/images/kidss.jpg', 'Praktik membuat camilan sehat bersama untuk melatih kemandirian dan motorik halus.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('6', '1', 'Market Day & Profesi', 'Lomba', 'adward/images/harbun.png', 'Bazaar cilik dan pengenalan cita-cita serta profesi kepada anak didik.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('7', '1', 'Pentas Seni TVRI', 'Pentas Seni', 'adward/images/kids.jpg', 'Penampilan tari dan gerak lagu anak yang diliput secara khusus oleh stasiun TVRI.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('8', '1', 'Manasik Haji Kecil', 'Kegiatan Belajar', 'adward/images/kidss.jpg', 'Simulasi peragaan ibadah haji untuk menanamkan nilai agama dan ketakwaan sejak dini.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('9', '1', 'Peringatan Hari Kartini', 'Kegiatan Belajar', 'adward/images/harbun.png', 'Karnaval pakaian adat daerah nusantara menumbuhkan rasa cinta budaya tanah air.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('10', '1', 'Ruang Kepala Sekolah', 'Fasilitas', 'adward/images/ruang kepala sekolah.jpeg', 'Ruang kerja, koordinasi dewan guru, dan pelayanan administrasi orang tua murid.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('11', '1', 'Area Bermain Luar 1', 'Fasilitas', 'adward/images/area bermain - 1.jpeg', 'Wahana outdoor ayunan dan perosotan aman untuk melatih motorik kasar anak.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('12', '1', 'Area Bermain Luar 2', 'Fasilitas', 'adward/images/area bermain -2.jpeg', 'Halaman terbuka hijau untuk senam pagi, upacara, dan kegiatan bermain bersama.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('13', '1', 'Area Bermain Edukasi', 'Fasilitas', 'adward/images/area bermain - 3.jpeg', 'Fasilitas ketangkasan sensori dan keseimbangan tubuh anak usia dini.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('14', '1', 'Media Pembelajaran', 'Fasilitas', 'adward/images/media pembelajaran.jpeg', 'Alat peraga edukatif (APE), puzzle, balok rancang bangun, dan buku cerita bergambar.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('15', '1', 'Loker Murid', 'Fasilitas', 'adward/images/loker murid.jpeg', 'Loker pribadi masing-masing siswa untuk melatih kerapian dan tanggung jawab barang sendiri.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('16', '2', 'Pentas Seni', 'Pentas Seni', 'adward/images/kids.jpg', 'Penampilan bakat anak di panggung pertunjukan seni.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('17', '2', 'Lomba Agustusan', 'Lomba', 'adward/images/kidss.jpg', 'Lomba ceria dan seru dalam menyambut hari kemerdekaan Republik Indonesia.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('18', '2', 'Kegiatan Belajar', 'Kegiatan Belajar', 'adward/images/harbun.png', 'Suasana pembelajaran tematik berbasis bermain aktif di ruang kelas.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('19', '2', 'Wisuda Kelulusan', 'Wisuda', 'adward/images/kids.jpg', 'Momen pelepasan dan wisuda kelulusan siswa kelompok B.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('20', '2', 'Cooking Class', 'Kegiatan Belajar', 'adward/images/kidss.jpg', 'Praktik membuat camilan sehat bersama untuk melatih kemandirian dan motorik halus.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('21', '2', 'Market Day & Profesi', 'Lomba', 'adward/images/harbun.png', 'Bazaar cilik dan pengenalan cita-cita serta profesi kepada anak didik.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('22', '2', 'Pentas Seni TVRI', 'Pentas Seni', 'adward/images/kids.jpg', 'Penampilan tari dan gerak lagu anak yang diliput secara khusus oleh stasiun TVRI.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('23', '2', 'Manasik Haji Kecil', 'Kegiatan Belajar', 'adward/images/kidss.jpg', 'Simulasi peragaan ibadah haji untuk menanamkan nilai agama dan ketakwaan sejak dini.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('24', '2', 'Peringatan Hari Kartini', 'Kegiatan Belajar', 'adward/images/harbun.png', 'Karnaval pakaian adat daerah nusantara menumbuhkan rasa cinta budaya tanah air.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('25', '2', 'Ruang Kepala Sekolah', 'Fasilitas', 'adward/images/ruang kepala sekolah.jpeg', 'Ruang kerja, koordinasi dewan guru, dan pelayanan administrasi orang tua murid.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('26', '2', 'Area Bermain Luar 1', 'Fasilitas', 'adward/images/area bermain - 1.jpeg', 'Wahana outdoor ayunan dan perosotan aman untuk melatih motorik kasar anak.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('27', '2', 'Area Bermain Luar 2', 'Fasilitas', 'adward/images/area bermain -2.jpeg', 'Halaman terbuka hijau untuk senam pagi, upacara, dan kegiatan bermain bersama.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('28', '2', 'Area Bermain Edukasi', 'Fasilitas', 'adward/images/area bermain - 3.jpeg', 'Fasilitas ketangkasan sensori dan keseimbangan tubuh anak usia dini.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('29', '2', 'Media Pembelajaran', 'Fasilitas', 'adward/images/media pembelajaran.jpeg', 'Alat peraga edukatif (APE), puzzle, balok rancang bangun, dan buku cerita bergambar.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `galeri` (`id_galeri`, `id_profil`, `judul`, `kategori`, `link_foto`, `deskripsi`, `created_at`, `updated_at`) VALUES ('30', '2', 'Loker Murid', 'Fasilitas', 'adward/images/loker murid.jpeg', 'Loker pribadi masing-masing siswa untuk melatih kerapian dan tanggung jawab barang sendiri.', '2026-11-06 12:09:16', '2026-11-06 12:09:16') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);

-- Data untuk tabel struktur_sekolah
INSERT INTO `struktur_sekolah` (`nip`, `id_profil`, `id_galeri`, `nama`, `jabatan`, `pendidikan`, `foto`, `created_at`, `updated_at`) VALUES ('19780512 200501 2 003', '1', NULL, 'Neneng Nurmayanti, S.Pd', 'Kepala Sekolah', 'S1 PGPAUD', 'adward/images/kepala sekolah.jpeg', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `struktur_sekolah` (`nip`, `id_profil`, `id_galeri`, `nama`, `jabatan`, `pendidikan`, `foto`, `created_at`, `updated_at`) VALUES ('19850614 201001 2 015', '1', NULL, 'Nita Yulianti, S.Pd', 'Guru Kelas', 'S1 PGPAUD', 'adward/images/guru-1.jpeg', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `struktur_sekolah` (`nip`, `id_profil`, `id_galeri`, `nama`, `jabatan`, `pendidikan`, `foto`, `created_at`, `updated_at`) VALUES ('19900320 201502 2 008', '1', NULL, 'Nia Herlina, S.Pd', 'Guru Kelas', 'S1 PGPAUD', 'adward/images/guru-2.jpeg', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);

-- Data untuk tabel kalender_akademik
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('1', '1', 'MPLS Siswa Baru', '2025/2026', 'Semester 1 (Ganjil)', 'fa-star', '2025-07-14 00:00:00', '2025-07-18 00:00:00', 'Masa Pengenalan Lingkungan Sekolah bagi siswa baru.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('2', '1', 'Lomba Agustusan', '2025/2026', 'Semester 1 (Ganjil)', 'fa-trophy', '2025-08-16 00:00:00', '2025-08-17 00:00:00', 'Lomba seru menyambut HUT Kemerdekaan RI.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('3', '1', 'Parenting Class', '2025/2026', 'Semester 1 (Ganjil)', 'fa-users', '2025-09-20 00:00:00', '2025-09-20 00:00:00', 'Pertemuan kerja sama orang tua dan guru.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('4', '1', 'Manasik Haji Kecil', '2025/2026', 'Semester 1 (Ganjil)', 'fa-book', '2025-10-25 00:00:00', '2025-10-25 00:00:00', 'Peragaan ibadah haji untuk mengenalkan nilai agama.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('5', '1', 'Market Day & Profesi', '2025/2026', 'Semester 1 (Ganjil)', 'fa-briefcase', '2025-11-20 00:00:00', '2025-11-20 00:00:00', 'Bazaar cilik dan peragaan kostum cita-cita anak.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('6', '1', 'Pentas Seni & Rapot', '2025/2026', 'Semester 1 (Ganjil)', 'fa-music', '2025-12-18 00:00:00', '2025-12-19 00:00:00', 'Panggung bakat anak dan penerimaan rapot semester 1.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('7', '1', 'Pentas Seni TVRI', '2025/2026', 'Semester 2 (Genap)', 'fa-television', '2026-01-20 00:00:00', '2026-01-20 00:00:00', 'Penampilan kreatif anak yang diliput oleh TVRI.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('8', '1', 'Cek Kesehatan Anak', '2025/2026', 'Semester 2 (Genap)', 'fa-user-md', '2026-02-15 00:00:00', '2026-02-15 00:00:00', 'Pemeriksaan kesehatan oleh tenaga medis Puskesmas.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('9', '1', 'Cooking Class', '2025/2026', 'Semester 2 (Genap)', 'fa-cutlery', '2026-03-18 00:00:00', '2026-03-18 00:00:00', 'Belajar membuat camilan sehat untuk melatih kemandirian.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('10', '1', 'Peringatan Hari Kartini', '2025/2026', 'Semester 2 (Genap)', 'fa-female', '2026-04-21 00:00:00', '2026-04-21 00:00:00', 'Pawai pakaian adat Nusantara.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('11', '1', 'Kunjungan Edukasi', '2025/2026', 'Semester 2 (Genap)', 'fa-bus', '2026-05-12 00:00:00', '2026-05-12 00:00:00', 'Outing class belajar mengenal profesi di luar kelas.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kalender_akademik` (`id_kalender`, `id_profil`, `judul_kegiatan`, `tahun_ajaran`, `kategori`, `icon`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `created_at`, `updated_at`) VALUES ('12', '1', 'Wisuda & Rapot Sem 2', '2025/2026', 'Semester 2 (Genap)', 'fa-graduation-cap', '2026-06-20 00:00:00', '2026-06-21 00:00:00', 'Pelepasan siswa kelompok B dan penerimaan rapot.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);

-- Data untuk tabel kurikulum
INSERT INTO `kurikulum` (`id_kurikulum`, `id_profil`, `kategori`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES ('1', '1', 'Nilai CERDAS - C', 'Cinta', 'Pembelajaran dengan kasih sayang dan kehangatan.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kurikulum` (`id_kurikulum`, `id_profil`, `kategori`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES ('2', '1', 'Nilai CERDAS - E', 'Eksplorasi', 'Memberi kesempatan mencoba dan menemukan hal baru.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kurikulum` (`id_kurikulum`, `id_profil`, `kategori`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES ('3', '1', 'Nilai CERDAS - R', 'Religius', 'Membiasakan nilai iman dan akhlak mulia sejak dini.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kurikulum` (`id_kurikulum`, `id_profil`, `kategori`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES ('4', '1', 'Nilai CERDAS - D', 'Disiplin', 'Melatih rasa tanggung jawab dan ketertiban sejak dini.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kurikulum` (`id_kurikulum`, `id_profil`, `kategori`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES ('5', '1', 'Nilai CERDAS - A', 'Aktif', 'Mendorong keaktifan fisik, mental, dan sosial anak.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);
INSERT INTO `kurikulum` (`id_kurikulum`, `id_profil`, `kategori`, `judul`, `deskripsi`, `created_at`, `updated_at`) VALUES ('6', '1', 'Nilai CERDAS - S', 'Santun', 'Menanamkan tutur kata yang baik dan sikap saling menghormati.', '2026-11-06 12:05:50', '2026-11-06 12:05:50') ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);

SET FOREIGN_KEY_CHECKS = 1;
