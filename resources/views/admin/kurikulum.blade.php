@extends('layouts.admin')

@section('title', 'Kurikulum - Admin TK Harapan Bunda')

@section('content')

  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Kurikulum Pembelajaran</h1>
      <p class="page-header-sub mb-0">Kelola pilar nilai pembelajaran, karakter unggulan, dan kurikulum merdeka PAUD.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahKurikulum">
      <i class="fa-solid fa-plus"></i> Tambah Kurikulum
    </button>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Daftar Nilai &amp; Pilar Kurikulum</h2>
        <div class="card-subtitle-small">Total {{ $kurikulumList->count() }} pilar kurikulum terdaftar</div>
      </div>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th style="width: 180px;">Kategori</th>
            <th style="width: 200px;">Judul / Karakter</th>
            <th>Deskripsi Pembelajaran</th>
            <th style="width: 120px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kurikulumList as $index => $item)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td><span class="badge-pill badge-green">{{ $item->kategori }}</span></td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $item->judul }}</div>
            </td>
            <td class="text-muted" style="line-height: 1.5;">{{ $item->deskripsi }}</td>
            <td style="text-align: center;">
              <div class="d-flex justify-content-center" style="gap: 6px;">
                <!-- Tombol Edit (Ikon Pensil) -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-edit-kurikulum" 
                  title="Ubah Kurikulum"
                  style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                  data-id="{{ $item->id_kurikulum }}"
                  data-kategori="{{ $item->kategori }}"
                  data-judul="{{ $item->judul }}"
                  data-deskripsi="{{ $item->deskripsi }}"
                  data-toggle="modal" 
                  data-target="#modalEditKurikulum">
                  <i class="fa-solid fa-pencil"></i>
                </button>

                <!-- Tombol Hapus (Ikon Sampah) -->
                <form action="{{ route('admin.kurikulum.destroy', $item->id_kurikulum) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kurikulum {{ $item->judul }}?');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" 
                    title="Hapus Kurikulum"
                    style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-muted">
              Belum ada data kurikulum. Silakan klik tombol "Tambah Kurikulum".
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah Kurikulum -->
  <div class="modal fade" id="modalTambahKurikulum" tabindex="-1" role="dialog" aria-labelledby="modalTambahKurikulumLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.kurikulum.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahKurikulumLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-book text-success mr-2"></i> Tambah Pilar Kurikulum
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kategori <span class="text-danger">*</span></label>
              <input type="text" name="kategori" class="form-control" placeholder="Contoh: Nilai CERDAS / Kurikulum Merdeka" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Judul / Karakter <span class="text-danger">*</span></label>
              <input type="text" name="judul" class="form-control" placeholder="Contoh: Cinta / Eksplorasi / Religius" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Deskripsi Pembelajaran <span class="text-danger">*</span></label>
              <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan tujuan dan penerapan nilai ini" required style="border-radius: 8px;"></textarea>
            </div>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: var(--primary);">Simpan Kurikulum</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Kurikulum -->
  <div class="modal fade" id="modalEditKurikulum" tabindex="-1" role="dialog" aria-labelledby="modalEditKurikulumLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditKurikulum" action="" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditKurikulumLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-pencil text-primary mr-2"></i> Ubah Pilar Kurikulum
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kategori <span class="text-danger">*</span></label>
              <input type="text" id="edit_kuri_kategori" name="kategori" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Judul / Karakter <span class="text-danger">*</span></label>
              <input type="text" id="edit_kuri_judul" name="judul" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Deskripsi Pembelajaran <span class="text-danger">*</span></label>
              <textarea id="edit_kuri_deskripsi" name="deskripsi" class="form-control" rows="3" required style="border-radius: 8px;"></textarea>
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
    $('.btn-edit-kurikulum').on('click', function() {
      const id = $(this).data('id');
      const kategori = $(this).data('kategori');
      const judul = $(this).data('judul');
      const deskripsi = $(this).data('deskripsi');

      $('#edit_kuri_kategori').val(kategori);
      $('#edit_kuri_judul').val(judul);
      $('#edit_kuri_deskripsi').val(deskripsi);

      const updateUrl = "{{ url('/admin/kurikulum') }}/" + id;
      $('#formEditKurikulum').attr('action', updateUrl);
    });
  });
</script>
@endsection

