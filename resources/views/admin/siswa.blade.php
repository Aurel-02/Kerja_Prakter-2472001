@extends('layouts.admin')

@section('title', 'Data Siswa - Admin TK Harapan Bunda')

@section('content')

  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Data Siswa-Siswi</h1>
      <p class="page-header-sub mb-0">Daftar seluruh peserta didik aktif di TK Harapan Bunda beserta relasi orang tua/wali dan kode QR.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahSiswa">
      <i class="fa-solid fa-plus"></i> Tambah Siswa
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
        <h2 class="card-title-main">Daftar Peserta Didik</h2>
        <div class="card-subtitle-small">Total {{ $siswaList->count() }} siswa terdaftar di database</div>
      </div>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableSiswa" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th>Nama Siswa</th>
            <th style="width: 120px;">NIS</th>
            <th>Kode QR Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Orang Tua / Wali</th>
            <th>Status</th>
            <th style="width: 110px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($siswaList as $index => $s)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $s->nama }}</div>
              <div style="font-size: 11px; color: #64748b;">Tahun Ajaran: {{ $s->tahun_ajaran ?? '2026/2027' }}</div>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 12.5px; font-weight: 600; color: #334155; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">
                {{ $s->nis }}
              </span>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 12px; font-weight: 600; color: #166534; background: #dcfce7; padding: 3px 8px; border-radius: 6px;">
                {{ $s->qr_code_siswa ?? '-' }}
              </span>
            </td>
            <td>
              <span style="font-size: 12.5px; color: #334155;">{{ $s->jenis_kelamin ?? '-' }}</span>
            </td>
            <td>
              @if($s->orangTua)
                <div style="font-weight: 600; color: #1e293b;">{{ $s->orangTua->nama }}</div>
                <div style="font-size: 11px; color: #64748b;">Telp: {{ $s->orangTua->no_telp ?? '-' }}</div>
              @else
                <span class="text-muted" style="font-size: 12px;">Belum dihubungkan</span>
              @endif
            </td>
            <td>
              <span class="badge-pill badge-green">{{ ucfirst($s->status ?? 'Aktif') }}</span>
            </td>
            <td style="text-align: center;">
              <div class="d-flex justify-content-center" style="gap: 6px;">
                <!-- Tombol Edit -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-edit-siswa"
                  title="Ubah Data"
                  style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                  data-id="{{ $s->id_siswa }}"
                  data-nama="{{ $s->nama }}"
                  data-nis="{{ $s->nis }}"
                  data-jk="{{ $s->jenis_kelamin }}"
                  data-ta="{{ $s->tahun_ajaran }}"
                  data-ortu="{{ $s->id_ortu_wali }}"
                  data-qr="{{ $s->qr_code_siswa }}"
                  data-toggle="modal"
                  data-target="#modalEditSiswa">
                  <i class="fa-solid fa-pencil"></i>
                </button>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.siswa.destroy', $s->id_siswa) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa {{ $s->nama }}?');"
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
            <td colspan="8" class="text-center py-4 text-muted">
              Belum ada data siswa terdaftar. Silakan klik tombol "Tambah Siswa".
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah Siswa -->
  <div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.siswa.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahSiswaLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-user-plus text-success mr-2"></i> Tambah Siswa Baru
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap Siswa <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control" placeholder="Contoh: Aisyah Putri Ramadhani" required style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">NIS <span class="text-danger">*</span></label>
                <input type="text" name="nis" class="form-control" placeholder="Contoh: TK-2401" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-control" required style="border-radius: 8px;">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" class="form-control" value="2026/2027" style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Kode QR Siswa</label>
                <input type="text" name="qr_code_siswa" class="form-control" placeholder="Otomatis jika kosong" style="border-radius: 8px; font-family: monospace;">
              </div>
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Orang Tua / Wali Terdaftar</label>
              <select name="id_ortu_wali" class="form-control" style="border-radius: 8px;">
                <option value="">-- Pilih Orang Tua / Wali --</option>
                @foreach($orangTuaList as $ortu)
                  <option value="{{ $ortu->id_ortu_wali }}">{{ $ortu->nama }} (Telp: {{ $ortu->no_telp }})</option>
                @endforeach
              </select>
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

  <!-- Modal Edit Siswa -->
  <div class="modal fade" id="modalEditSiswa" tabindex="-1" role="dialog" aria-labelledby="modalEditSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditSiswa" action="" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditSiswaLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-pencil text-primary mr-2"></i> Ubah Data Siswa
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap Siswa <span class="text-danger">*</span></label>
              <input type="text" id="edit_siswa_nama" name="nama" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">NIS <span class="text-danger">*</span></label>
                <input type="text" id="edit_siswa_nis" name="nis" class="form-control" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Jenis Kelamin <span class="text-danger">*</span></label>
                <select id="edit_siswa_jk" name="jenis_kelamin" class="form-control" required style="border-radius: 8px;">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Tahun Ajaran</label>
                <input type="text" id="edit_siswa_ta" name="tahun_ajaran" class="form-control" style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Kode QR Siswa</label>
                <input type="text" id="edit_siswa_qr" name="qr_code_siswa" class="form-control" style="border-radius: 8px; font-family: monospace;">
              </div>
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Orang Tua / Wali Terdaftar</label>
              <select id="edit_siswa_ortu" name="id_ortu_wali" class="form-control" style="border-radius: 8px;">
                <option value="">-- Tidak Terhubung --</option>
                @foreach($orangTuaList as $ortu)
                  <option value="{{ $ortu->id_ortu_wali }}">{{ $ortu->nama }} (Telp: {{ $ortu->no_telp }})</option>
                @endforeach
              </select>
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
    $('#tableSiswa').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_–_END_ dari _TOTAL_ data',
        infoEmpty: 'Tidak ada data',
        infoFiltered: '(difilter dari _MAX_ total data)',
        paginate: { first: '«', last: '»', next: '›', previous: '‹' },
        zeroRecords: 'Tidak ada siswa yang cocok',
        emptyTable: 'Belum ada data siswa.'
      },
      columnDefs: [
        { orderable: false, targets: [0, 7] }
      ],
      pageLength: 10,
      order: [[1, 'asc']]
    });

    // Modal Edit Siswa
    $('.btn-edit-siswa').on('click', function() {
      const id   = $(this).data('id');
      const nama = $(this).data('nama');
      const nis  = $(this).data('nis');
      const jk   = $(this).data('jk');
      const ta   = $(this).data('ta');
      const ortu = $(this).data('ortu');
      const qr   = $(this).data('qr');

      $('#edit_siswa_nama').val(nama);
      $('#edit_siswa_nis').val(nis);
      $('#edit_siswa_jk').val(jk);
      $('#edit_siswa_ta').val(ta);
      $('#edit_siswa_ortu').val(ortu || '');
      $('#edit_siswa_qr').val(qr);

      const updateUrl = "{{ url('/admin/siswa') }}/" + id;
      $('#formEditSiswa').attr('action', updateUrl);
    });
  });
</script>
@endsection
