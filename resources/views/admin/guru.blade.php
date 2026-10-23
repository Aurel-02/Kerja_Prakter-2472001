@extends('layouts.admin')

@section('title', 'Data Guru - Admin TK Harapan Bunda')

@section('content')

  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Data Tenaga Pengajar</h1>
    <p class="page-header-sub">Daftar seluruh dewan guru dan kepala sekolah di TK Harapan Bunda.</p>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Daftar Guru & Staf</h2>
        <div class="card-subtitle-small">Total 3 pengajar terdaftar dan aktif</div>
      </div>
      <button class="btn-more-icon"><i class="fa-solid fa-ellipsis-vertical"></i></button>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px;">No</th>
            <th>Foto &amp; Nama</th>
            <th>Jabatan</th>
            <th>Pendidikan</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-muted">1</td>
            <td>
              <div style="display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('adward/images/kepala sekolah.jpeg') }}" alt="Kepala Sekolah"
                  style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; object-position: top; border: 2px solid #e2e8f0;">
                <div>
                  <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">Neneng Nurmayanti, S.Pd</div>
                  <div style="font-size: 11.5px; color: #64748b;">NIP. 19780512 200501 2 003</div>
                </div>
              </div>
            </td>
            <td style="font-weight: 600; color: #334155;">Kepala Sekolah</td>
            <td class="text-muted">S1 PGPAUD</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted">2</td>
            <td>
              <div style="display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('adward/images/guru-1.jpeg') }}" alt="Nita Yulianti"
                  style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; object-position: top; border: 2px solid #e2e8f0;">
                <div>
                  <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">Nita Yulianti, S.Pd</div>
                  <div style="font-size: 11.5px; color: #64748b;">Wali Kelas TK-A</div>
                </div>
              </div>
            </td>
            <td style="font-weight: 600; color: #334155;">Guru Kelas</td>
            <td class="text-muted">S1 PGPAUD</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
          <tr>
            <td class="text-muted">3</td>
            <td>
              <div style="display: flex; align-items: center; gap: 12px;">
                <img src="{{ asset('adward/images/guru-2.jpeg') }}" alt="Nia Herlina"
                  style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; object-position: top; border: 2px solid #e2e8f0;">
                <div>
                  <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">Nia Herlina</div>
                  <div style="font-size: 11.5px; color: #64748b;">Wali Kelas TK-B</div>
                </div>
              </div>
            </td>
            <td style="font-weight: 600; color: #334155;">Guru Kelas</td>
            <td class="text-muted">D3 Kependidikan</td>
            <td><span class="badge-pill badge-green"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

@endsection
