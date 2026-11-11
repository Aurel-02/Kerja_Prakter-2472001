@extends('layouts.admin')

@section('title', 'Data Orang Tua / Wali - Admin TK Harapan Bunda')

@section('content')

  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Data Orang Tua / Wali</h1>
      <p class="page-header-sub mb-0">Daftar orang tua dan wali siswa beserta kode QR penjemputan yang terdaftar di sistem.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahOrtu">
      <i class="fa-solid fa-plus"></i> Tambah Orang Tua / Wali
    </button>
  </div>

  {{-- Alert Sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px; font-size: 13px; font-weight: 600; border: none; background: #f0fdf4; color: #166534; border-left: 4px solid #16a34a;">
      <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background: none; border: none; font-size: 18px; color: #166534;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Daftar Orang Tua &amp; Wali Siswa</h2>
        <div class="card-subtitle-small">Total {{ $orangTuaList->count() }} orang tua / wali terdaftar</div>
      </div>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableOrangTua" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th>Nama Orang Tua / Wali</th>
            <th style="width: 160px;">No. Telepon</th>
            <th>Kode QR Penjemput</th>
            <th>Siswa Terdaftar</th>
            <th style="width: 120px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orangTuaList as $index => $ortu)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $ortu->nama }}</div>
            </td>
            <td>
              <span style="font-size: 13px; color: #334155;">{{ $ortu->no_telp }}</span>
            </td>
            <td>
              @if($ortu->qr_code_penjemput)
                <span style="font-family: monospace; font-size: 12px; font-weight: 600; color: #334155; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">
                  {{ $ortu->qr_code_penjemput }}
                </span>
              @else
                <span class="text-muted" style="font-size: 12px;">Belum ada kode QR</span>
              @endif
            </td>
            <td>
              @if($ortu->siswa && $ortu->siswa->count() > 0)
                @foreach($ortu->siswa as $s)
                  <span class="badge-pill badge-green" style="font-size: 11px; margin: 2px 2px 2px 0; display: inline-block;">{{ $s->nama }}</span>
                @endforeach
              @else
                <span class="text-muted" style="font-size: 12px;">-</span>
              @endif
            </td>
            <td style="text-align: center;">
              <div class="d-flex justify-content-center" style="gap: 6px;">
                <!-- Tombol Edit -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-edit-ortu"
                  title="Ubah Data"
                  style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                  data-id="{{ $ortu->id_ortu_wali }}"
                  data-nama="{{ $ortu->nama }}"
                  data-telp="{{ $ortu->no_telp }}"
                  data-qr="{{ $ortu->qr_code_penjemput }}"
                  data-toggle="modal"
                  data-target="#modalEditOrtu">
                  <i class="fa-solid fa-pencil"></i>
                </button>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.orang-tua.destroy', $ortu->id_ortu_wali) }}" method="POST"
                  onsubmit="return confirm('Hapus data orang tua {{ $ortu->nama }}? Data penjemputan terkait juga akan terhapus.');"
                  style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    title="Hapus Data"
                    style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">
              Belum ada data orang tua / wali. Silakan klik tombol "Tambah Orang Tua / Wali".
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>


  <!-- ============ Modal Tambah Orang Tua ============ -->
  <div class="modal fade" id="modalTambahOrtu" tabindex="-1" role="dialog" aria-labelledby="modalTambahOrtuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.orang-tua.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahOrtuLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-user-plus text-success mr-2"></i> Tambah Orang Tua / Wali
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control" placeholder="Contoh: Bapak Hendra Kusuma" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nomor Telepon <span class="text-danger">*</span></label>
              <input type="text" name="no_telp" class="form-control" placeholder="Contoh: 08123456789" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kode QR Penjemput</label>
              <input type="text" name="qr_code_penjemput" class="form-control" placeholder="Kosongkan untuk generate otomatis" style="border-radius: 8px; font-family: monospace;">
              <small class="text-muted">Kode ini akan digunakan saat scan penjemputan. Jika kosong, akan dibuat otomatis.</small>
            </div>

          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: var(--primary);">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- ============ Modal Edit Orang Tua ============ -->
  <div class="modal fade" id="modalEditOrtu" tabindex="-1" role="dialog" aria-labelledby="modalEditOrtuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditOrtu" action="" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditOrtuLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-pencil text-primary mr-2"></i> Ubah Data Orang Tua / Wali
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" id="edit_ortu_nama" name="nama" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nomor Telepon <span class="text-danger">*</span></label>
              <input type="text" id="edit_ortu_telp" name="no_telp" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kode QR Penjemput</label>
              <input type="text" id="edit_ortu_qr" name="qr_code_penjemput" class="form-control" style="border-radius: 8px; font-family: monospace;">
              <small class="text-muted">Kosongkan untuk mempertahankan kode QR yang ada.</small>
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
    // DataTable
    $('#tableOrangTua').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
        infoEmpty: 'Tidak ada data',
        infoFiltered: '(difilter dari _MAX_ total data)',
        paginate: { first: '«', last: '»', next: '›', previous: '‹' },
        zeroRecords: 'Tidak ada data orang tua yang cocok',
        emptyTable: 'Belum ada data orang tua / wali.'
      },
      columnDefs: [
        { orderable: false, targets: [0, 5] }
      ],
      pageLength: 10,
      order: [[1, 'asc']]
    });

    // Modal Edit Orang Tua
    $('.btn-edit-ortu').on('click', function() {
      const id    = $(this).data('id');
      const nama  = $(this).data('nama');
      const telp  = $(this).data('telp');
      const qr    = $(this).data('qr');

      $('#edit_ortu_nama').val(nama);
      $('#edit_ortu_telp').val(telp);
      $('#edit_ortu_qr').val(qr);

      const updateUrl = "{{ url('/admin/orang-tua') }}/" + id;
      $('#formEditOrtu').attr('action', updateUrl);
    });
  });
</script>
@endsection

