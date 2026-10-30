@extends('layouts.admin')

@section('title', 'Data Struktur Sekolah - Admin TK Harapan Bunda')

@section('content')

  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Data Struktur Sekolah</h1>
      <p class="page-header-sub mb-0">Daftar dewan guru, kepala sekolah, dan staf pengajar di TK Harapan Bunda.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahGuru">
      <i class="fa-solid fa-plus"></i> Tambah Tenaga Pengajar
    </button>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Struktur Organisasi &amp; Tenaga Pengajar</h2>
        <div class="card-subtitle-small">Total {{ $guruList->count() }} tenaga pengajar & staf terdaftar</div>
      </div>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table class="custom-table">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th style="width: 80px; text-align: center;">Foto</th>
            <th style="width: 180px;">NIP</th>
            <th>Nama Lengkap</th>
            <th>Jabatan</th>
            <th>Pendidikan</th>
            <th style="width: 130px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($guruList as $index => $guru)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td style="text-align: center;">
              @if($guru->foto)
                <img src="{{ asset($guru->foto) }}" alt="{{ $guru->nama }}" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
              @else
                <div style="width: 42px; height: 42px; border-radius: 50%; background: #e2e8f0; display: inline-flex; align-items: center; justify-content: center; color: #64748b;">
                  <i class="fa-solid fa-user"></i>
                </div>
              @endif
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; font-weight: 600; color: #334155; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">
                {{ $guru->nip }}
              </span>
            </td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $guru->nama }}</div>
            </td>
            <td style="font-weight: 600; color: #334155;">{{ $guru->jabatan }}</td>
            <td class="text-muted">{{ $guru->pendidikan ?? '-' }}</td>
            <td style="text-align: center;">
              <div class="d-flex justify-content-center" style="gap: 6px;">
                <!-- Tombol Edit (Ikon Pensil) -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-edit-guru" 
                  title="Ubah Data"
                  style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                  data-nip="{{ $guru->nip }}"
                  data-nama="{{ $guru->nama }}"
                  data-jabatan="{{ $guru->jabatan }}"
                  data-pendidikan="{{ $guru->pendidikan }}"
                  data-toggle="modal" 
                  data-target="#modalEditGuru">
                  <i class="fa-solid fa-pencil"></i>
                </button>

                <!-- Tombol Hapus (Ikon Sampah) -->
                <form action="{{ route('admin.guru.destroy', $guru->nip) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajar {{ $guru->nama }}?');" style="display: inline;">
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
            <td colspan="7" class="text-center py-4 text-muted">
              Belum ada data guru atau tenaga pengajar. Silakan klik tombol "Tambah Tenaga Pengajar".
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah Guru -->
  <div class="modal fade" id="modalTambahGuru" tabindex="-1" role="dialog" aria-labelledby="modalTambahGuruLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahGuruLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-user-plus text-success mr-2"></i> Tambah Tenaga Pengajar
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">NIP / Nomor Identitas <span class="text-danger">*</span></label>
              <input type="text" name="nip" class="form-control" placeholder="Contoh: 19780512 200501 2 003" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control" placeholder="Contoh: Neneng Nurmayanti, S.Pd" required style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Jabatan <span class="text-danger">*</span></label>
                <input type="text" name="jabatan" class="form-control" placeholder="Kepala Sekolah / Guru Kelas" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Pendidikan Terakhir</label>
                <input type="text" name="pendidikan" class="form-control" placeholder="Contoh: S1 PGPAUD" style="border-radius: 8px;">
              </div>
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Foto Profil Guru</label>
              <input type="file" name="foto" class="form-control-file" accept="image/*" style="font-size: 13px;">
              <small class="text-muted">Format: JPG, PNG, WEBP (Maksimal 2MB)</small>
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

  <!-- Modal Edit Guru -->
  <div class="modal fade" id="modalEditGuru" tabindex="-1" role="dialog" aria-labelledby="modalEditGuruLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditGuru" action="" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditGuruLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-pencil text-primary mr-2"></i> Ubah Data Tenaga Pengajar
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">NIP / Nomor Identitas <span class="text-danger">*</span></label>
              <input type="text" id="edit_nip" name="nip" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
              <input type="text" id="edit_nama" name="nama" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Jabatan <span class="text-danger">*</span></label>
                <input type="text" id="edit_jabatan" name="jabatan" class="form-control" required style="border-radius: 8px;">
              </div>
              <div class="col-md-6 form-group mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Pendidikan Terakhir</label>
                <input type="text" id="edit_pendidikan" name="pendidikan" class="form-control" style="border-radius: 8px;">
              </div>
            </div>

            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Ubah Foto Profil (Opsional)</label>
              <input type="file" name="foto" class="form-control-file" accept="image/*" style="font-size: 13px;">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
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
    $('.btn-edit-guru').on('click', function() {
      const nip = $(this).data('nip');
      const nama = $(this).data('nama');
      const jabatan = $(this).data('jabatan');
      const pendidikan = $(this).data('pendidikan');

      $('#edit_nip').val(nip);
      $('#edit_nama').val(nama);
      $('#edit_jabatan').val(jabatan);
      $('#edit_pendidikan').val(pendidikan);

      // Set action form
      const updateUrl = "{{ url('/admin/guru') }}/" + encodeURIComponent(nip);
      $('#formEditGuru').attr('action', updateUrl);
    });
  });
</script>
@endsection
