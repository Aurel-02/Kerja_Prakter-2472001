@extends('layouts.admin')

@section('title', 'Data Siswa - Admin TK Harapan Bunda')

@section('content')

  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Data Siswa-Siswi</h1>
    <p class="page-header-sub">Daftar seluruh peserta didik aktif di TK Harapan Bunda tahun ajaran 2026/2027.</p>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Daftar Siswa</h2>
        <div class="card-subtitle-small">Total 42 siswa (Kelompok A: 20 anak, Kelompok B: 22 anak)</div>
      </div>
      <button class="btn-more-icon"><i class="fa-solid fa-ellipsis-vertical"></i></button>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px;">No</th>
            <th>Nama Siswa</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Jenis Kelamin</th>
            <th>Usia</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-muted">1</td>
            <td>
              <div style="font-weight: 700; color: #1e293b;">Aisyah Putri Ramadhani</div>
              <div style="font-size: 11px; color: #94a3b8;">Wali: Bpk. Hendra</div>
            </td>
            <td class="text-muted">TK-2401</td>
            <td><span class="badge-pill badge-blue">Kelompok A</span></td>
            <td>Perempuan</td>
            <td>4 tahun</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted">2</td>
            <td>
              <div style="font-weight: 700; color: #1e293b;">Muhammad Rizky Pratama</div>
              <div style="font-size: 11px; color: #94a3b8;">Wali: Ibu Dewi</div>
            </td>
            <td class="text-muted">TK-2402</td>
            <td><span class="badge-pill badge-blue">Kelompok A</span></td>
            <td>Laki-laki</td>
            <td>4 tahun</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted">3</td>
            <td>
              <div style="font-weight: 700; color: #1e293b;">Bilal Ramadhan</div>
              <div style="font-size: 11px; color: #94a3b8;">Wali: Bpk. Fajar</div>
            </td>
            <td class="text-muted">TK-2403</td>
            <td><span class="badge-pill badge-green">Kelompok B</span></td>
            <td>Laki-laki</td>
            <td>5 tahun</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted">4</td>
            <td>
              <div style="font-weight: 700; color: #1e293b;">Zahra Amelia</div>
              <div style="font-size: 11px; color: #94a3b8;">Wali: Ibu Fitri</div>
            </td>
            <td class="text-muted">TK-2404</td>
            <td><span class="badge-pill badge-green">Kelompok B</span></td>
            <td>Perempuan</td>
            <td>5 tahun</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted">5</td>
            <td>
              <div style="font-weight: 700; color: #1e293b;">Kenzo Alfarizi</div>
              <div style="font-size: 11px; color: #94a3b8;">Wali: Bpk. Danu</div>
            </td>
            <td class="text-muted">TK-2405</td>
            <td><span class="badge-pill badge-green">Kelompok B</span></td>
            <td>Laki-laki</td>
            <td>6 tahun</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@endsection
