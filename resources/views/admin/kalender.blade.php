@extends('layouts.admin')

@section('title', 'Kalender Akademik - Admin TK Harapan Bunda')

@section('content')

  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Kalender Akademik</h1>
      <p class="page-header-sub mb-0">Agenda kegiatan belajar mengajar, peringatan hari besar, dan jadwal evaluasi semester.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahKalender">
      <i class="fa-solid fa-plus"></i> Tambah Agenda
    </button>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Jadwal Agenda &amp; Kegiatan Sekolah</h2>
        <div class="card-subtitle-small">Total {{ $kalenderList->count() }} agenda terdaftar</div>
      </div>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th style="width: 170px;">Tanggal / Periode</th>
            <th>Nama Kegiatan</th>
            <th style="width: 120px;">Tahun Ajaran</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th style="width: 120px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kalenderList as $index => $item)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td style="font-weight: 600; color: #1e293b;">
              @if($item->tanggal_mulai == $item->tanggal_selesai)
                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
              @else
                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M') }} – {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') }}
              @endif
            </td>
            <td style="font-weight: 700; color: #1e293b;">{{ $item->judul_kegiatan }}</td>
            <td><span class="badge-pill badge-blue">{{ $item->tahun_ajaran }}</span></td>
            <td>
              <span class="badge-pill badge-green">{{ $item->kategori ?? 'Kegiatan' }}</span>
            </td>
            <td class="text-muted">{{ $item->keterangan ?? '-' }}</td>
            <td style="text-align: center;">
              <div class="d-flex justify-content-center" style="gap: 6px;">
                <!-- Tombol Edit (Ikon Pensil) -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-edit-kalender" 
                  title="Ubah Agenda"
                  style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                  data-id="{{ $item->id_kalender }}"
                  data-judul="{{ $item->judul_kegiatan }}"
                  data-tahun="{{ $item->tahun_ajaran }}"
                  data-kategori="{{ $item->kategori }}"
                  data-mulai="{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d') }}"
                  data-selesai="{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('Y-m-d') }}"
                  data-keterangan="{{ $item->keterangan }}"
                  data-toggle="modal" 
                  data-target="#modalEditKalender">
                  <i class="fa-solid fa-pencil"></i>
                </button>

                <!-- Tombol Hapus (Ikon Sampah) -->
                <form action="{{ route('admin.kalender.destroy', $item->id_kalender) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda {{ $item->judul_kegiatan }}?');" style="display: inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" 
                    title="Hapus Agenda"
                    style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">
              Belum ada agenda kalender. Silakan klik tombol "Tambah Agenda".
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah Kalender -->
  <div class="modal fade" id="modalTambahKalender" tabindex="-1" role="dialog" aria-labelledby="modalTambahKalenderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.kalender.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahKalenderLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-calendar-plus text-success mr-2"></i> Tambah Agenda Kalender
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Kegiatan / Agenda <span class="text-danger">*</span></label>
              <input type="text" name="judul_kegiatan" class="form-control" placeholder="Contoh: Hari Sumpah Pemuda / MPLS" required style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tahun Ajaran <span class="text-danger">*</span></label>
                <input type="text" name="tahun_ajaran" class="form-control" value="2026/2027" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Kategori</label>
                <input type="text" name="kategori" class="form-control" placeholder="Libur Nasional / Kegiatan Sekolah" style="border-radius: 8px;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tanggal Mulai <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_mulai" class="form-control" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tanggal Selesai <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_selesai" class="form-control" required style="border-radius: 8px;">
              </div>
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Keterangan Tambahan</label>
              <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Seluruh KBM ditiadakan" style="border-radius: 8px;"></textarea>
            </div>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn btn-success" style="border-radius: 8px; font-weight: 600; background: var(--primary);">Simpan Agenda</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Kalender -->
  <div class="modal fade" id="modalEditKalender" tabindex="-1" role="dialog" aria-labelledby="modalEditKalenderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditKalender" action="" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditKalenderLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-pencil text-primary mr-2"></i> Ubah Agenda Kalender
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Kegiatan / Agenda <span class="text-danger">*</span></label>
              <input type="text" id="edit_kalender_judul" name="judul_kegiatan" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tahun Ajaran <span class="text-danger">*</span></label>
                <input type="text" id="edit_kalender_tahun" name="tahun_ajaran" class="form-control" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Kategori</label>
                <input type="text" id="edit_kalender_kategori" name="kategori" class="form-control" style="border-radius: 8px;">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tanggal Mulai <span class="text-danger">*</span></label>
                <input type="date" id="edit_kalender_mulai" name="tanggal_mulai" class="form-control" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tanggal Selesai <span class="text-danger">*</span></label>
                <input type="date" id="edit_kalender_selesai" name="tanggal_selesai" class="form-control" required style="border-radius: 8px;">
              </div>
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Keterangan Tambahan</label>
              <textarea id="edit_kalender_keterangan" name="keterangan" class="form-control" rows="3" style="border-radius: 8px;"></textarea>
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
    $('.btn-edit-kalender').on('click', function() {
      const id = $(this).data('id');
      const judul = $(this).data('judul');
      const tahun = $(this).data('tahun');
      const kategori = $(this).data('kategori');
      const mulai = $(this).data('mulai');
      const selesai = $(this).data('selesai');
      const keterangan = $(this).data('keterangan');

      $('#edit_kalender_judul').val(judul);
      $('#edit_kalender_tahun').val(tahun);
      $('#edit_kalender_kategori').val(kategori);
      $('#edit_kalender_mulai').val(mulai);
      $('#edit_kalender_selesai').val(selesai);
      $('#edit_kalender_keterangan').val(keterangan);

      const updateUrl = "{{ url('/admin/kalender') }}/" + id;
      $('#formEditKalender').attr('action', updateUrl);
    });
  });
</script>
@endsection
