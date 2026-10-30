<?php

namespace Database\Seeders;

use App\Models\Galeri;
use App\Models\KalenderAkademik;
use App\Models\Kurikulum;
use App\Models\Sekolah;
use App\Models\StrukturSekolah;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Profil Sekolah (Visi & Misi)
        $sekolah = Sekolah::create([
            'deskripsi_profil' => "TK Harapan Bunda melayani pendidikan anak usia dini dalam rentang usia 4–6 tahun. Jumlah peserta didik pada tahun ajaran ini sebanyak 34 anak. Anak-anak berasal dari latar belakang keluarga dengan kondisi sosial ekonomi dan budaya yang beragam, mencerminkan karakter masyarakat kota Bandung.\n\nSebagian besar orang tua peserta didik bekerja di sektor formal dan informal, sehingga waktu pendampingan di rumah tidak merata. Hal ini menyebabkan variasi dalam kemampuan awal peserta didik saat memasuki sekolah, baik dari aspek kognitif, sosial emosional, maupun kesiapan literasi dan motorik.",
            'visi' => 'Terwujudnya murid yang membentuk anak yang berahlak mulia, cerdas, kreatif, mandiri, sehat dan kuat.',
            'misi' => "1. Menanamkan nilai-nilai keimanan dan ketaqwaan sejak dini.\n2. Mengembangkan kreatifitas dalam setiap kegiatan pembelajaran dan mengembangkan bakat dan minat anak.\n3. Membiasakan sikap mandiri pada anak.\n4. Membiasakan hidup sehat.",
            'link_maps' => 'https://maps.google.com/maps?q=Jl.+Babakan+Ciparay+No.251,+Sukahaji,+Kec.+Babakan+Ciparay,+Kota+Bandung,+Jawa+Barat+40242&output=embed',
            'kontak' => 'Jl. Babakan Ciparay No.251, Bandung | Telp: (022) 1234567 | info@tkharapanbunda.sch.id',
        ]);

        // 2. Galeri Foto & Fasilitas (Seluruh gambar yang bisa diubah dimasukkan ke database)
        $galeriList = [
            // Foto Kegiatan
            [
                'judul' => 'Pentas Seni',
                'kategori' => 'Pentas Seni',
                'link_foto' => 'adward/images/kids.jpg',
                'deskripsi' => 'Penampilan bakat anak di panggung pertunjukan seni.',
            ],
            [
                'judul' => 'Lomba Agustusan',
                'kategori' => 'Lomba',
                'link_foto' => 'adward/images/kidss.jpg',
                'deskripsi' => 'Lomba ceria dan seru dalam menyambut hari kemerdekaan Republik Indonesia.',
            ],
            [
                'judul' => 'Kegiatan Belajar',
                'kategori' => 'Kegiatan Belajar',
                'link_foto' => 'adward/images/harbun.png',
                'deskripsi' => 'Suasana pembelajaran tematik berbasis bermain aktif di ruang kelas.',
            ],
            [
                'judul' => 'Wisuda Kelulusan',
                'kategori' => 'Wisuda',
                'link_foto' => 'adward/images/kids.jpg',
                'deskripsi' => 'Momen pelepasan dan wisuda kelulusan siswa kelompok B.',
            ],
            [
                'judul' => 'Cooking Class',
                'kategori' => 'Kegiatan Belajar',
                'link_foto' => 'adward/images/kidss.jpg',
                'deskripsi' => 'Praktik membuat camilan sehat bersama untuk melatih kemandirian dan motorik halus.',
            ],
            [
                'judul' => 'Market Day & Profesi',
                'kategori' => 'Lomba',
                'link_foto' => 'adward/images/harbun.png',
                'deskripsi' => 'Bazaar cilik dan pengenalan cita-cita serta profesi kepada anak didik.',
            ],
            [
                'judul' => 'Pentas Seni TVRI',
                'kategori' => 'Pentas Seni',
                'link_foto' => 'adward/images/kids.jpg',
                'deskripsi' => 'Penampilan tari dan gerak lagu anak yang diliput secara khusus oleh stasiun TVRI.',
            ],
            [
                'judul' => 'Manasik Haji Kecil',
                'kategori' => 'Kegiatan Belajar',
                'link_foto' => 'adward/images/kidss.jpg',
                'deskripsi' => 'Simulasi peragaan ibadah haji untuk menanamkan nilai agama dan ketakwaan sejak dini.',
            ],
            [
                'judul' => 'Peringatan Hari Kartini',
                'kategori' => 'Kegiatan Belajar',
                'link_foto' => 'adward/images/harbun.png',
                'deskripsi' => 'Karnaval pakaian adat daerah nusantara menumbuhkan rasa cinta budaya tanah air.',
            ],

            // Foto Fasilitas & Sarana Prasarana
            [
                'judul' => 'Ruang Kepala Sekolah',
                'kategori' => 'Fasilitas',
                'link_foto' => 'adward/images/ruang kepala sekolah.jpeg',
                'deskripsi' => 'Ruang kerja, koordinasi dewan guru, dan pelayanan administrasi orang tua murid.',
            ],
            [
                'judul' => 'Area Bermain Luar 1',
                'kategori' => 'Fasilitas',
                'link_foto' => 'adward/images/area bermain - 1.jpeg',
                'deskripsi' => 'Wahana outdoor ayunan dan perosotan aman untuk melatih motorik kasar anak.',
            ],
            [
                'judul' => 'Area Bermain Luar 2',
                'kategori' => 'Fasilitas',
                'link_foto' => 'adward/images/area bermain -2.jpeg',
                'deskripsi' => 'Halaman terbuka hijau untuk senam pagi, upacara, dan kegiatan bermain bersama.',
            ],
            [
                'judul' => 'Area Bermain Edukasi',
                'kategori' => 'Fasilitas',
                'link_foto' => 'adward/images/area bermain - 3.jpeg',
                'deskripsi' => 'Fasilitas ketangkasan sensori dan keseimbangan tubuh anak usia dini.',
            ],
            [
                'judul' => 'Media Pembelajaran',
                'kategori' => 'Fasilitas',
                'link_foto' => 'adward/images/media pembelajaran.jpeg',
                'deskripsi' => 'Alat peraga edukatif (APE), puzzle, balok rancang bangun, dan buku cerita bergambar.',
            ],
            [
                'judul' => 'Loker Murid',
                'kategori' => 'Fasilitas',
                'link_foto' => 'adward/images/loker murid.jpeg',
                'deskripsi' => 'Loker pribadi masing-masing siswa untuk melatih kerapian dan tanggung jawab barang sendiri.',
            ],
        ];

        foreach ($galeriList as $g) {
            Galeri::create([
                'id_profil' => $sekolah->id_profil,
                'judul' => $g['judul'],
                'kategori' => $g['kategori'],
                'link_foto' => $g['link_foto'],
                'deskripsi' => $g['deskripsi'],
            ]);
        }

        // 3. Struktur Sekolah (Guru & Kepala Sekolah)
        StrukturSekolah::create([
            'nip' => '19780512 200501 2 003',
            'id_profil' => $sekolah->id_profil,
            'nama' => 'Neneng Nurmayanti, S.Pd',
            'jabatan' => 'Kepala Sekolah',
            'pendidikan' => 'S1 PGPAUD',
            'foto' => 'adward/images/kepala sekolah.jpeg',
        ]);

        StrukturSekolah::create([
            'nip' => '19850614 201001 2 015',
            'id_profil' => $sekolah->id_profil,
            'nama' => 'Nita Yulianti, S.Pd',
            'jabatan' => 'Guru Kelas',
            'pendidikan' => 'S1 PGPAUD',
            'foto' => 'adward/images/guru-1.jpeg',
        ]);

        StrukturSekolah::create([
            'nip' => '19900320 201502 2 008',
            'id_profil' => $sekolah->id_profil,
            'nama' => 'Nia Herlina, S.Pd',
            'jabatan' => 'Guru Kelas',
            'pendidikan' => 'S1 PGPAUD',
            'foto' => 'adward/images/guru-2.jpeg',
        ]);

        // 4. Seluruh Kalender Akademik (12 Bulan Semester 1 & 2 dari Tampilan Website)
        $kalenderLengkap = [
            // Semester 1 (Ganjil)
            [
                'judul_kegiatan' => 'MPLS Siswa Baru',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 1 (Ganjil)',
                'icon' => 'fa-star',
                'tanggal_mulai' => '2025-07-14',
                'tanggal_selesai' => '2025-07-18',
                'keterangan' => 'Masa Pengenalan Lingkungan Sekolah bagi siswa baru.',
            ],
            [
                'judul_kegiatan' => 'Lomba Agustusan',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 1 (Ganjil)',
                'icon' => 'fa-trophy',
                'tanggal_mulai' => '2025-08-16',
                'tanggal_selesai' => '2025-08-17',
                'keterangan' => 'Lomba seru menyambut HUT Kemerdekaan RI.',
            ],
            [
                'judul_kegiatan' => 'Parenting Class',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 1 (Ganjil)',
                'icon' => 'fa-users',
                'tanggal_mulai' => '2025-09-20',
                'tanggal_selesai' => '2025-09-20',
                'keterangan' => 'Pertemuan kerja sama orang tua dan guru.',
            ],
            [
                'judul_kegiatan' => 'Manasik Haji Kecil',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 1 (Ganjil)',
                'icon' => 'fa-book',
                'tanggal_mulai' => '2025-10-25',
                'tanggal_selesai' => '2025-10-25',
                'keterangan' => 'Peragaan ibadah haji untuk mengenalkan nilai agama.',
            ],
            [
                'judul_kegiatan' => 'Market Day & Profesi',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 1 (Ganjil)',
                'icon' => 'fa-briefcase',
                'tanggal_mulai' => '2025-11-20',
                'tanggal_selesai' => '2025-11-20',
                'keterangan' => 'Bazaar cilik dan peragaan kostum cita-cita anak.',
            ],
            [
                'judul_kegiatan' => 'Pentas Seni & Rapot',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 1 (Ganjil)',
                'icon' => 'fa-music',
                'tanggal_mulai' => '2025-12-18',
                'tanggal_selesai' => '2025-12-19',
                'keterangan' => 'Panggung bakat anak dan penerimaan rapot semester 1.',
            ],

            // Semester 2 (Genap)
            [
                'judul_kegiatan' => 'Pentas Seni TVRI',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 2 (Genap)',
                'icon' => 'fa-television',
                'tanggal_mulai' => '2026-01-20',
                'tanggal_selesai' => '2026-01-20',
                'keterangan' => 'Penampilan kreatif anak yang diliput oleh TVRI.',
            ],
            [
                'judul_kegiatan' => 'Cek Kesehatan Anak',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 2 (Genap)',
                'icon' => 'fa-user-md',
                'tanggal_mulai' => '2026-02-15',
                'tanggal_selesai' => '2026-02-15',
                'keterangan' => 'Pemeriksaan kesehatan oleh tenaga medis Puskesmas.',
            ],
            [
                'judul_kegiatan' => 'Cooking Class',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 2 (Genap)',
                'icon' => 'fa-cutlery',
                'tanggal_mulai' => '2026-03-18',
                'tanggal_selesai' => '2026-03-18',
                'keterangan' => 'Belajar membuat camilan sehat untuk melatih kemandirian.',
            ],
            [
                'judul_kegiatan' => 'Peringatan Hari Kartini',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 2 (Genap)',
                'icon' => 'fa-female',
                'tanggal_mulai' => '2026-04-21',
                'tanggal_selesai' => '2026-04-21',
                'keterangan' => 'Pawai pakaian adat Nusantara.',
            ],
            [
                'judul_kegiatan' => 'Kunjungan Edukasi',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 2 (Genap)',
                'icon' => 'fa-bus',
                'tanggal_mulai' => '2026-05-12',
                'tanggal_selesai' => '2026-05-12',
                'keterangan' => 'Outing class belajar mengenal profesi di luar kelas.',
            ],
            [
                'judul_kegiatan' => 'Wisuda & Rapot Sem 2',
                'tahun_ajaran' => '2025/2026',
                'kategori' => 'Semester 2 (Genap)',
                'icon' => 'fa-graduation-cap',
                'tanggal_mulai' => '2026-06-20',
                'tanggal_selesai' => '2026-06-21',
                'keterangan' => 'Pelepasan siswa kelompok B dan penerimaan rapot.',
            ],
        ];

        foreach ($kalenderLengkap as $agenda) {
            KalenderAkademik::create(array_merge($agenda, ['id_profil' => $sekolah->id_profil]));
        }

        // 5. Kurikulum (Nilai C.E.R.D.A.S)
        $kurikulumList = [
            ['kategori' => 'Nilai CERDAS - C', 'judul' => 'Cinta', 'deskripsi' => 'Pembelajaran dengan kasih sayang dan kehangatan.'],
            ['kategori' => 'Nilai CERDAS - E', 'judul' => 'Eksplorasi', 'deskripsi' => 'Memberi kesempatan mencoba dan menemukan hal baru.'],
            ['kategori' => 'Nilai CERDAS - R', 'judul' => 'Religius', 'deskripsi' => 'Membiasakan nilai iman dan akhlak mulia sejak dini.'],
            ['kategori' => 'Nilai CERDAS - D', 'judul' => 'Disiplin', 'deskripsi' => 'Melatih rasa tanggung jawab dan ketertiban sejak dini.'],
            ['kategori' => 'Nilai CERDAS - A', 'judul' => 'Aktif', 'deskripsi' => 'Mendorong keaktifan fisik, mental, dan sosial anak.'],
            ['kategori' => 'Nilai CERDAS - S', 'judul' => 'Santun', 'deskripsi' => 'Menanamkan tutur kata yang baik dan sikap saling menghormati.'],
        ];

        foreach ($kurikulumList as $kuri) {
            Kurikulum::create(array_merge($kuri, ['id_profil' => $sekolah->id_profil]));
        }
    }
}
