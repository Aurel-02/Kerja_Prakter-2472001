@extends('layouts.admin')

@section('title', 'Kalender Akademik - Admin TK Harapan Bunda')

@section('content')

  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Kalender Akademik</h1>
    <p class="page-header-sub">Agenda kegiatan belajar mengajar, peringatan hari besar, dan jadwal evaluasi semester.</p>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Jadwal Agenda & Hari Libur</h2>
        <div class="card-subtitle-small">Semester Ganjil Tahun Ajaran 2026/2027</div>
      </div>
      <button class="btn-more-icon"><i class="fa-solid fa-ellipsis-vertical"></i></button>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px;">No</th>
            <th>Tanggal / Periode</th>
            <th>Nama Kegiatan</th>
            <th>Kategori</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-muted">1</td>
            <td style="font-weight: 600; color: #1e293b;">25 Oktober 2026</td>
            <td style="font-weight: 700; color: #1e293b;">Hari Sumpah Pemuda</td>
            <td><span class="badge-pill badge-yellow"><i class="fa-solid fa-flag"></i> Libur Nasional</span></td>
            <td class="text-muted">Seluruh KBM ditiadakan</td>
          </tr>
          <tr>
            <td class="text-muted">2</td>
            <td style="font-weight: 600; color: #1e293b;">10 November 2026</td>
            <td style="font-weight: 700; color: #1e293b;">Hari Pahlawan</td>
            <td><span class="badge-pill badge-yellow"><i class="fa-solid fa-flag"></i> Libur Nasional</span></td>
            <td class="text-muted">Peringatan hari pahlawan</td>
          </tr>
          <tr>
            <td class="text-muted">3</td>
            <td style="font-weight: 600; color: #1e293b;">25 November 2026</td>
            <td style="font-weight: 700; color: #1e293b;">Hari Guru Nasional</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-cake-candles"></i> Kegiatan Sekolah</span></td>
            <td class="text-muted">Pentas kreativitas siswa untuk guru</td>
          </tr>
          <tr>
            <td class="text-muted">4</td>
            <td style="font-weight: 600; color: #1e293b;">1 – 5 Desember 2026</td>
            <td style="font-weight: 700; color: #1e293b;">Penilaian Akhir Semester Ganjil</td>
            <td><span class="badge-pill badge-red"><i class="fa-solid fa-pencil"></i> Evaluasi</span></td>
            <td class="text-muted">Observasi capaian tumbuh kembang anak</td>
          </tr>
          <tr>
            <td class="text-muted">5</td>
            <td style="font-weight: 600; color: #1e293b;">20 Desember 2026</td>
            <td style="font-weight: 700; color: #1e293b;">Penerimaan Raport Semester Ganjil</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-file-lines"></i> Kegiatan Sekolah</span></td>
            <td class="text-muted">Pertemuan tatap muka orang tua murid</td>
          </tr>
          <tr>
            <td class="text-muted">6</td>
            <td style="font-weight: 600; color: #1e293b;">22 Des – 2 Jan 2027</td>
            <td style="font-weight: 700; color: #1e293b;">Libur Semester Ganjil</td>
            <td><span class="badge-pill badge-yellow"><i class="fa-solid fa-sun"></i> Libur Semester</span></td>
            <td class="text-muted">KBM kembali aktif 5 Januari 2027</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@endsection
