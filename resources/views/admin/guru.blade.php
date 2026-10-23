@extends('layouts.admin')

@section('title', 'Data Struktur Sekolah - Admin TK Harapan Bunda')

@section('content')

  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Data Struktur Sekolah</h1>
    <p class="page-header-sub">Daftar seluruh dewan guru, kepala sekolah, dan staf pengajar di TK Harapan Bunda.</p>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Struktur Organisasi &amp; Tenaga Pengajar</h2>
        <div class="card-subtitle-small">Total 3 pengajar dan staf aktif terdaftar</div>
      </div>
      <button class="btn-more-icon" title="Opsi"><i class="fa-solid fa-ellipsis-vertical"></i></button>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th style="width: 220px;">NIP</th>
            <th>Nama Lengkap</th>
            <th>Jabatan</th>
            <th>Pendidikan</th>
            <th style="text-align: center;">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-muted" style="text-align: center;">1</td>
            <td>
              <span style="font-family: monospace; font-size: 13px; font-weight: 600; color: #334155; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">19780512 200501 2 003</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">Neneng Nurmayanti, S.Pd</div>
            </td>
            <td style="font-weight: 600; color: #334155;">Kepala Sekolah</td>
            <td class="text-muted">S1 PGPAUD</td>
            <td style="text-align: center;"><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted" style="text-align: center;">2</td>
            <td>
              <span class="text-muted" style="font-weight: 600; padding-left: 8px;">-</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">Nita Yulianti, S.Pd</div>
            </td>
            <td style="font-weight: 600; color: #334155;">Guru Kelas</td>
            <td class="text-muted">S1 PGPAUD</td>
            <td style="text-align: center;"><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted" style="text-align: center;">3</td>
            <td>
              <span class="text-muted" style="font-weight: 600; padding-left: 8px;">-</span>
            </td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">Nia Herlina</div>
            </td>
            <td style="font-weight: 600; color: #334155;">Guru Kelas</td>
            <td class="text-muted">D3 Kependidikan</td>
            <td style="text-align: center;"><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@endsection
