@extends('layouts.admin')

@section('title', 'Profil Sekolah - Admin TK Harapan Bunda')

@section('content')

  <!-- Header Halaman -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Profil Sekolah</h1>
    <p class="page-header-sub mb-0">Kelola visi, misi, deskripsi profil sekolah, kontak, dan tautan Google Maps yang tampil pada website utama.</p>
  </div>

  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 600; border: none; background: #dcfce7; color: #15803d;">
      <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="opacity: 0.8; outline: none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 600; border: none; background: #fee2e2; color: #b91c1c;">
      <i class="fa-solid fa-triangle-exclamation mr-2"></i> Mohon periksa kembali isian Anda:
      <ul class="mb-0 mt-2 pl-3" style="font-weight: 500; font-size: 13px;">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="opacity: 0.8; outline: none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <!-- Form Kelola Profil Sekolah -->
  <div class="admin-card">
    <form action="{{ route('admin.sekolah.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="form-group mb-4">
        <label style="font-weight: 700; color: #1e293b; font-size: 13.5px; margin-bottom: 6px;">
          Deskripsi Profil Sekolah <span class="text-muted font-weight-normal">(Tampil di Beranda &amp; Halaman Profil Sekolah)</span>
        </label>
        <textarea name="deskripsi_profil" class="form-control" rows="5" placeholder="Masukkan deskripsi singkat dan profil lengkap sekolah..." style="border-radius: 10px; font-size: 13.5px; line-height: 1.6;">{{ old('deskripsi_profil', $sekolah->deskripsi_profil ?? '') }}</textarea>
        <small class="text-muted">Paragraf pertama akan otomatis ditampilkan sebagai rangkuman pada banner Beranda website utama.</small>
      </div>

      <div class="row">
        <div class="col-md-6 form-group mb-4">
          <label style="font-weight: 700; color: #1e293b; font-size: 13.5px; margin-bottom: 6px;">
            Visi Sekolah <span class="text-danger">*</span>
          </label>
          <textarea name="visi" class="form-control" rows="5" required placeholder="Masukkan visi sekolah..." style="border-radius: 10px; font-size: 13.5px; line-height: 1.6;">{{ old('visi', $sekolah->visi ?? '') }}</textarea>
        </div>

        <div class="col-md-6 form-group mb-4">
          <label style="font-weight: 700; color: #1e293b; font-size: 13.5px; margin-bottom: 6px;">
            Misi Sekolah <span class="text-danger">*</span>
          </label>
          <textarea name="misi" class="form-control" rows="5" required placeholder="Masukkan poin-poin misi sekolah..." style="border-radius: 10px; font-size: 13.5px; line-height: 1.6;">{{ old('misi', $sekolah->misi ?? '') }}</textarea>
          <small class="text-muted">Gunakan baris baru atau penomoran (1, 2, 3...) untuk memisahkan setiap poin misi.</small>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 form-group mb-4">
          <label style="font-weight: 700; color: #1e293b; font-size: 13.5px; margin-bottom: 6px;">
            Kontak Telepon / Email
          </label>
          <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $sekolah->kontak ?? '') }}" placeholder="Contoh: (022) 1234567 / tkharapanbunda@gmail.com" style="border-radius: 10px; font-size: 13.5px;">
        </div>

        <div class="col-md-6 form-group mb-4">
          <label style="font-weight: 700; color: #1e293b; font-size: 13.5px; margin-bottom: 6px;">
            Link Google Maps (Embed URL)
          </label>
          <input type="text" name="link_maps" class="form-control" value="{{ old('link_maps', $sekolah->link_maps ?? '') }}" placeholder="https://maps.google.com/maps?q=...&output=embed" style="border-radius: 10px; font-size: 13.5px;">
        </div>
      </div>

      <div class="d-flex justify-content-end pt-2" style="border-top: 1px solid #f1f5f9;">
        <button type="submit" class="btn-brand-primary" style="padding: 10px 24px; font-size: 13.5px;">
          <i class="fa-solid fa-save mr-1"></i> Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

@endsection
