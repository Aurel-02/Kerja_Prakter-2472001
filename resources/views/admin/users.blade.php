@extends('layouts.admin')

@section('title', 'Kelola Akun Pengguna - Admin TK Harapan Bunda')

@section('content')

  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 600; border: none; background: #dcfce7; color: #15803d; box-shadow: 0 4px 12px rgba(22,163,74,0.08);">
      <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="opacity: 0.8; outline: none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 600; border: none; background: #fee2e2; color: #b91c1c; box-shadow: 0 4px 12px rgba(185,28,28,0.08);">
      <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="opacity: 0.8; outline: none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 600; border: none; background: #fee2e2; color: #b91c1c; box-shadow: 0 4px 12px rgba(185,28,28,0.08);">
      <i class="fa-solid fa-triangle-exclamation mr-2"></i> Mohon periksa kembali form:
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

  <!-- Header Halaman -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Kelola Akun Pengguna</h1>
      <p class="page-header-sub mb-0">Kelola akun akses sistem login untuk Administrator dan Dewan Guru.</p>
    </div>
    <button type="button" class="btn-brand-primary" data-toggle="modal" data-target="#modalTambahUser">
      <i class="fa-solid fa-user-plus"></i> Tambah Pengguna Baru
    </button>
  </div>

  <!-- Tabel Akun Pengguna -->
  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Daftar Akun Pengguna</h2>
        <div class="card-subtitle-small">Total {{ $users->count() }} akun terdaftar ({{ $totalAdmin }} Administrator, {{ $totalGuru }} Guru)</div>
      </div>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableUsers" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th>Nama Lengkap</th>
            <th style="width: 150px;">Username</th>
            <th style="width: 140px; text-align: center;">Role Akses</th>
            <th style="width: 110px; text-align: center;">Status</th>
            <th style="width: 140px;">Terdaftar Sejak</th>
            <th style="width: 110px; text-align: center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $index => $u)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td>
              <div class="d-flex align-items-center" style="gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $u->role === 'admin' ? '#dcfce7' : '#e0f2fe' }}; color: {{ $u->role === 'admin' ? '#15803d' : '#0369a1' }}; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; flex-shrink: 0;">
                  {{ strtoupper(substr($u->nama, 0, 1)) }}
                </div>
                <div>
                  <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">
                    {{ $u->nama }}
                    @if(Auth::id() == $u->id_user)
                      <span class="badge-pill badge-green" style="font-size: 10px; padding: 1px 7px; margin-left: 4px;">Akun Anda</span>
                    @endif
                  </div>
                  <div style="font-size: 11.5px; color: #64748b;">ID Pengguna: #{{ $u->id_user }}</div>
                </div>
              </div>
            </td>
            <td>
              <span style="font-family: monospace; font-size: 13px; font-weight: 700; color: #0f172a;">
                {{ $u->username }}
              </span>
            </td>
            <td style="text-align: center;">
              @if($u->role === 'admin')
                <span class="badge-pill badge-green">
                  <i class="fa-solid fa-user-shield"></i> Administrator
                </span>
              @else
                <span class="badge-pill badge-blue">
                  <i class="fa-solid fa-chalkboard-user"></i> Guru
                </span>
              @endif
            </td>
            <td style="text-align: center;">
              @if($u->status === 'aktif')
                <span class="badge-pill badge-green">Aktif</span>
              @else
                <span class="badge-pill badge-red">Nonaktif</span>
              @endif
            </td>
            <td class="text-muted" style="font-size: 12px;">
              {{ $u->created_at ? $u->created_at->format('d M Y') : '-' }}
            </td>
            <td style="text-align: center;">
              <div class="d-flex justify-content-center" style="gap: 6px;">
                <!-- Tombol Ubah Data -->
                <button type="button" class="btn btn-sm btn-outline-primary btn-edit-user"
                  title="Ubah Data Akun"
                  style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                  data-id="{{ $u->id_user }}"
                  data-nama="{{ $u->nama }}"
                  data-username="{{ $u->username }}"
                  data-role="{{ $u->role }}"
                  data-status="{{ $u->status }}"
                  data-is-self="{{ Auth::id() == $u->id_user ? '1' : '0' }}"
                  data-toggle="modal"
                  data-target="#modalEditUser">
                  <i class="fa-solid fa-pencil"></i>
                </button>

                <!-- Tombol Hapus -->
                @if(Auth::id() != $u->id_user)
                  <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun pengguna {{ $u->nama }} ({{ $u->username }})?');" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger"
                      title="Hapus Akun"
                      style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                      <i class="fa-solid fa-trash-can"></i>
                    </button>
                  </form>
                @else
                  <button type="button" class="btn btn-sm btn-outline-secondary"
                    title="Tidak dapat menghapus akun sendiri yang sedang aktif"
                    disabled
                    style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; opacity: 0.4; cursor: not-allowed;">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                @endif
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4 text-muted">Belum ada akun pengguna terdaftar.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah Pengguna Baru -->
  <div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form action="{{ route('admin.users.store') }}" method="POST">
          @csrf
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalTambahUserLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-user-plus text-success mr-2"></i> Tambah Akun Pengguna
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control" placeholder="Contoh: Budi Santoso, S.Pd" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Username <span class="text-danger">*</span></label>
              <input type="text" name="username" class="form-control" placeholder="Contoh: budi_guru" required style="border-radius: 8px; font-family: monospace;">
              <small class="text-muted">Gunakan huruf kecil, angka, atau underscore tanpa spasi.</small>
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required minlength="6" style="border-radius: 8px;">
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Role Akses <span class="text-danger">*</span></label>
                <select name="role" class="form-control" required style="border-radius: 8px;">
                  <option value="guru" selected>Guru / Pendidik</option>
                  <option value="admin">Administrator</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Status Akun <span class="text-danger">*</span></label>
                <select name="status" class="form-control" required style="border-radius: 8px;">
                  <option value="aktif" selected>Aktif (Dapat Login)</option>
                  <option value="nonaktif">Nonaktif (Diblokir)</option>
                </select>
              </div>
            </div>

          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn-brand-primary">
              <i class="fa-solid fa-save mr-1"></i> Simpan Akun
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Pengguna -->
  <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        <form id="formEditUser" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 18px 24px;">
            <h5 class="modal-title" id="modalEditUserLabel" style="font-weight: 700; color: #1e293b;">
              <i class="fa-solid fa-user-pen text-primary mr-2"></i> Ubah Akun Pengguna
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 24px;">
            
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" id="edit_nama" name="nama" class="form-control" required style="border-radius: 8px;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Username <span class="text-danger">*</span></label>
              <input type="text" id="edit_username" name="username" class="form-control" required style="border-radius: 8px; font-family: monospace;">
            </div>

            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Password Baru</label>
              <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password" minlength="6" style="border-radius: 8px;">
              <small class="text-muted">Biarkan kosong bila pengguna tetap menggunakan password lama.</small>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Role Akses <span class="text-danger">*</span></label>
                <select id="edit_role" name="role" class="form-control" required style="border-radius: 8px;">
                  <option value="guru">Guru / Pendidik</option>
                  <option value="admin">Administrator</option>
                </select>
                <small id="roleWarning" class="text-warning font-weight-bold" style="display: none; font-size: 11px;">
                  Akun Anda sendiri harus tetap berstatus Administrator.
                </small>
              </div>

              <div class="col-md-6 mb-3">
                <label style="font-weight: 600; color: #475569; font-size: 13px;">Status Akun <span class="text-danger">*</span></label>
                <select id="edit_status" name="status" class="form-control" required style="border-radius: 8px;">
                  <option value="aktif">Aktif (Dapat Login)</option>
                  <option value="nonaktif">Nonaktif (Diblokir)</option>
                </select>
                <small id="statusWarning" class="text-warning font-weight-bold" style="display: none; font-size: 11px;">
                  Akun Anda sendiri tidak dapat dinonaktifkan.
                </small>
              </div>
            </div>

          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 24px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn-brand-primary">
              <i class="fa-solid fa-save mr-1"></i> Perbarui Akun
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    // Inisialisasi DataTable untuk tabel Akun Pengguna
    $('#tableUsers').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
        infoEmpty: 'Tidak ada data yang tersedia',
        infoFiltered: '(difilter dari _MAX_ total data)',
        paginate: {
          first: 'Pertama',
          last: 'Terakhir',
          next: 'Berikutnya',
          previous: 'Sebelumnya'
        },
        zeroRecords: 'Tidak ada data pengguna yang cocok dengan pencarian',
        emptyTable: 'Belum ada data akun pengguna.'
      },
      columnDefs: [
        { orderable: false, targets: [6] } // Kolom Aksi tidak bisa diurutkan
      ],
      pageLength: 10,
      order: [[0, 'asc']]
    });

    // Handle Modal Edit User
    $(document).on('click', '.btn-edit-user', function() {
      const id       = $(this).data('id');
      const nama     = $(this).data('nama');
      const username = $(this).data('username');
      const role     = $(this).data('role');
      const status   = $(this).data('status');
      const isSelf   = $(this).data('is-self') == '1';

      $('#edit_nama').val(nama);
      $('#edit_username').val(username);
      $('#edit_role').val(role);
      $('#edit_status').val(status);

      // Jika mengedit akun sendiri, beri proteksi visual
      if (isSelf) {
        $('#edit_role').find('option[value="guru"]').attr('disabled', true);
        $('#edit_status').find('option[value="nonaktif"]').attr('disabled', true);
        $('#roleWarning').show();
        $('#statusWarning').show();
      } else {
        $('#edit_role').find('option[value="guru"]').removeAttr('disabled');
        $('#edit_status').find('option[value="nonaktif"]').removeAttr('disabled');
        $('#roleWarning').hide();
        $('#statusWarning').hide();
      }

      const updateUrl = "{{ url('/admin/users') }}/" + id;
      $('#formEditUser').attr('action', updateUrl);
    });
  });
</script>
@endsection
