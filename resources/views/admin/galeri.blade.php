@extends('layouts.admin')

@section('title', 'Galeri - Admin TK Harapan Bunda')

@section('content')

  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Galeri &amp; Fasilitas Sekolah</h1>
      <p class="page-header-sub mb-0">Dokumentasi sarana prasarana, ruang kelas, dan area bermain anak di TK Harapan Bunda.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahGaleri">
      <i class="fa-solid fa-plus"></i> Tambah Foto Galeri
    </button>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Dokumentasi Fasilitas &amp; Kegiatan</h2>
        <div class="card-subtitle-small">Total {{ $galeriList->count() }} foto dokumentasi terpasang</div>
      </div>
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap:20px;">
      @forelse($galeriList as $item)
      <div style="background:#ffffff; border:1px solid #edf2f7; border-radius:14px; overflow:hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.02); display: flex; flex-direction: column;">
        <div style="position: relative;">
          <img src="{{ asset($item->link_foto) }}" alt="{{ $item->judul }}"
            style="width:100%; height:150px; object-fit:cover; display:block;">
          <span class="badge-pill badge-green" style="position: absolute; top: 10px; left: 10px; font-size:10.5px; padding:3px 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.15);">
            {{ $item->kategori ?? 'Umum' }}
          </span>
        </div>

        <div style="padding:14px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
          <div>
            <div style="font-size:14px; font-weight:700; color:#1e293b; margin-bottom: 4px;">{{ $item->judul }}</div>
            <p style="font-size: 12px; color: #64748b; line-height: 1.5; margin-bottom: 12px;">
              {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
            </p>
          </div>

          <div class="d-flex justify-content-end" style="gap: 6px; border-top: 1px solid #f1f5f9; padding-top: 10px;">
            <!-- Tombol Edit (Ikon Pensil) -->
            <button type="button" class="btn btn-sm btn-outline-primary btn-edit-galeri"
              title="Ubah Foto"
              style="border-radius: 8px; font-size: 12px; padding: 4px 10px;"
              data-id="{{ $item->id_galeri }}"
              data-judul="{{ $item->judul }}"
              data-kategori="{{ $item->kategori }}"
              data-link="{{ $item->link_foto }}"
              data-deskripsi="{{ $item->deskripsi }}"
              data-toggle="modal"
              data-target="#modalEditGaleri">
              <i class="fa-solid fa-pencil"></i> Ubah
            </button>

            <!-- Tombol Hapus -->
            <form action="{{ route('admin.galeri.destroy', $item->id_galeri) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto {{ $item->judul }}?');" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Foto" style="border-radius: 8px; font-size: 12px; padding: 4px 10px;">
                <i class="fa-solid fa-trash"></i> Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
      @empty
      <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0; color: #94a3b8;">
        Belum ada dokumentasi galeri foto. Silakan klik tombol "Tambah Foto Galeri".
      </div>
      @endforelse
    </div>
  </div>

  <!-- Modal Tambah Galeri -->
  <div class="modal fade" id="modalTambahGaleri" tabindex="-1" role="dialog" aria-labelledby="modalTambahGaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahGaleriLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-camera text-success mr-2"></i> Tambah Foto Galeri
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Judul Foto / Dokumentasi <span class="text-danger">*</span></label>
              <input type="text" name="judul" class="form-control" placeholder="Contoh: Area Bermain Luar" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kategori</label>
              <input type="text" name="kategori" class="form-control" placeholder="Fasilitas / Kegiatan / Pentas Seni" style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Upload Foto File</label>
              <input type="file" name="foto_file" class="form-control-file" accept="image/*" style="font-size: 13px;">
              <small class="text-muted">Pilih file gambar dari komputer (JPG, PNG, WEBP)</small>
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Atau Path/URL Foto</label>
              <input type="text" name="link_foto" class="form-control" placeholder="Contoh: adward/images/kids.jpg" style="border-radius: 8px;">
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Deskripsi Singkat</label>
              <textarea name="deskripsi" class="form-control" rows="2" placeholder="Keterangan singkat mengenai fasilitas atau kegiatan" style="border-radius: 8px;"></textarea>
            </div>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: var(--primary);">Simpan Foto</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Galeri -->
  <div class="modal fade" id="modalEditGaleri" tabindex="-1" role="dialog" aria-labelledby="modalEditGaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditGaleri" action="" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditGaleriLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-pencil text-primary mr-2"></i> Ubah Foto Galeri
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Judul Foto / Dokumentasi <span class="text-danger">*</span></label>
              <input type="text" id="edit_galeri_judul" name="judul" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kategori</label>
              <input type="text" id="edit_galeri_kategori" name="kategori" class="form-control" style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Ganti Foto (Upload File Baru)</label>
              <input type="file" name="foto_file" class="form-control-file" accept="image/*" style="font-size: 13px;">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengganti file gambar</small>
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Atau Ubah Path/URL Foto</label>
              <input type="text" id="edit_galeri_link" name="link_foto" class="form-control" style="border-radius: 8px;">
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Deskripsi Singkat</label>
              <textarea id="edit_galeri_deskripsi" name="deskripsi" class="form-control" rows="2" style="border-radius: 8px;"></textarea>
            </div>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn btn-primary" style="border-radius: 8px; font-weight: 600;">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('.btn-edit-galeri').on('click', function() {
      const id = $(this).data('id');
      const judul = $(this).data('judul');
      const kategori = $(this).data('kategori');
      const link = $(this).data('link');
      const deskripsi = $(this).data('deskripsi');

      $('#edit_galeri_judul').val(judul);
      $('#edit_galeri_kategori').val(kategori);
      $('#edit_galeri_link').val(link);
      $('#edit_galeri_deskripsi').val(deskripsi);

      const updateUrl = "{{ url('/admin/galeri') }}/" + id;
      $('#formEditGaleri').attr('action', updateUrl);
    });
  });
</script>
@endsection
