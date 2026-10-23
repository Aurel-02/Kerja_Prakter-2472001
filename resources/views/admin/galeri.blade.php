@extends('layouts.admin')

@section('title', 'Galeri - Admin TK Harapan Bunda')

@section('content')

  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Galeri & Fasilitas Sekolah</h1>
    <p class="page-header-sub">Dokumentasi sarana prasarana, ruang kelas, dan area bermain anak di TK Harapan Bunda.</p>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Dokumentasi Fasilitas & Kegiatan</h2>
        <div class="card-subtitle-small">Total 6 dokumentasi unggulan terpasang</div>
      </div>
      <button class="btn-more-icon"><i class="fa-solid fa-ellipsis-vertical"></i></button>
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap:18px;">
      @foreach([
        ['ruang kepala sekolah.jpeg', 'Ruang Kepala Sekolah', 'Fasilitas Kantor'],
        ['area bermain - 1.jpeg',     'Area Bermain Luar 1',   'Fasilitas Bermain'],
        ['area bermain -2.jpeg',      'Area Bermain Luar 2',   'Fasilitas Bermain'],
        ['area bermain - 3.jpeg',     'Area Bermain Edukasi',  'Fasilitas Bermain'],
        ['media pembelajaran.jpeg',   'Media Pembelajaran',    'Alat Peraga Edukatif'],
        ['loker murid.jpeg',          'Loker Siswa',           'Fasilitas Kelas'],
      ] as [$img, $label, $category])
      <div style="background:#ffffff; border:1px solid #edf2f7; border-radius:14px; overflow:hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.02); transition: transform 0.2s ease;">
        <img src="{{ asset('adward/images/' . $img) }}" alt="{{ $label }}"
          style="width:100%; height:135px; object-fit:cover; display:block;">
        <div style="padding:12px 14px;">
          <span class="badge-pill badge-green" style="font-size:10.5px; padding:2px 8px; margin-bottom:6px;">{{ $category }}</span>
          <div style="font-size:13px; font-weight:700; color:#1e293b;">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

@endsection
