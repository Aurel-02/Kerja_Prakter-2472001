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
    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableOrangTua" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th>Nama Orang Tua / Wali</th>
            <th style="width: 150px;">No. Telepon</th>
            <th style="width: 220px;">Gambar &amp; Kode QR</th>
            <th>Siswa Terdaftar</th>
            <th style="width: 110px; text-align: center;">Aksi</th>
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
                <div>
                  <div style="font-family: monospace; font-size: 12.5px; font-weight: 700; color: #0f172a; margin-bottom: 3px;">
                    {{ $ortu->qr_code_penjemput }}
                  </div>
                  <button type="button" class="btn btn-sm btn-link p-0 btn-view-qr"
                    onclick="openQrModal('{{ addslashes($ortu->nama) }}', '{{ addslashes($ortu->no_telp) }}', '{{ addslashes($ortu->qr_code_penjemput) }}', '{{ addslashes($ortu->siswa->pluck('nama')->implode(', ') ?: '-') }}')"
                    data-nama="{{ $ortu->nama }}"
                    data-telp="{{ $ortu->no_telp }}"
                    data-qr="{{ $ortu->qr_code_penjemput }}"
                    data-siswa="{{ $ortu->siswa->pluck('nama')->implode(', ') ?: '-' }}"
                    style="font-size: 12px; color: #16a34a; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; cursor: pointer;">
                    <i class="fa-solid fa-qrcode"></i> Lihat QR
                  </button>
                </div>
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
                    style="border-radius: 8px; width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                    onclick="event.stopPropagation();">
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
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kode QR Penjemput <span class="text-danger">*</span></label>
              <input type="text" name="qr_code_penjemput" class="form-control" placeholder="Contoh: ORTU-TK-004" required style="border-radius: 8px; font-family: monospace;">
              <small class="text-muted">Ketik manual kode unik penjemput untuk orang tua/wali ini.</small>
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
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Kode QR Penjemput <span class="text-danger">*</span></label>
              <input type="text" id="edit_ortu_qr" name="qr_code_penjemput" class="form-control" required style="border-radius: 8px; font-family: monospace;">
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


  <!-- ============ Modal Lihat & Cetak QR Code Penjemput ============ -->
  <div class="modal fade" id="modalQrCode" tabindex="-1" role="dialog" aria-labelledby="modalQrCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 400px;">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2); overflow: hidden;">
        
        <div class="modal-header" style="background: #16a34a; color: #ffffff; padding: 16px 20px; border: none;">
          <div>
            <h5 class="modal-title" id="modalQrCodeLabel" style="font-weight: 800; font-size: 15.5px; margin: 0; color: #ffffff;">
              Kartu QR Code Penjemput
            </h5>
            <small style="color: #dcfce7; font-size: 11.5px;">TK Harapan Bunda &bull; <span id="modalQrNamaHeader">Penjemput Murid</span></small>
          </div>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none; background: none; border: none; font-size: 20px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body text-center" style="padding: 22px 20px;">
          <!-- Printable Card Container -->
          <div id="printableQrCard" style="background: #ffffff; border: 2px dashed #86efac; border-radius: 12px; padding: 18px 14px;">
            <div style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #16a34a; margin-bottom: 2px;">
              Kartu Penjemput Resmi
            </div>
            <div style="font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">
              TK Harapan Bunda
            </div>

            <!-- Gambar Target untuk QR Code -->
            <div style="display: flex; justify-content: center; align-items: center; margin: 0 auto 12px auto; min-height: 200px;">
              <img id="modalQrImage" src="" alt="QR Code Penjemput" style="width: 200px; height: 200px; object-fit: contain; border-radius: 8px; border: 1px solid #e2e8f0; padding: 6px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.06); display: block;">
            </div>

            <!-- String QR Code -->
            <div id="modalQrCodeText" style="font-family: monospace; font-size: 13.5px; font-weight: 800; color: #0f172a; background: #f1f5f9; padding: 4px 12px; border-radius: 6px; display: inline-block; letter-spacing: 0.5px;"></div>
          </div>
        </div>

        <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #f1f5f9; padding: 12px 18px; display: flex; gap: 8px; justify-content: flex-end;">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 12px;">Tutup</button>
          <a id="btnDownloadQr" href="#" download="QR_Penjemput.png" class="btn btn-success btn-sm font-weight-bold" style="border-radius: 8px; font-size: 12px; background: #16a34a; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-solid fa-download"></i> Unduh Gambar
          </a>
        </div>

      </div>
    </div>
  </div>

@endsection

@section('scripts')
<!-- Library QR Code Generator (Lokal) -->
<script src="{{ asset('adward/js/qrcode.min.js') }}"></script>

<script>
  // Fungsi Buka Modal & Generate Gambar QR
  function openQrModal(nama, telp, qr, siswa) {
    $('#modalQrNamaHeader').text(nama || 'Penjemput Murid');
    $('#modalQrCodeText').text(qr || '-');

    let imgUrl = '';

    // 1. Prioritas Utama: Generate gambar Base64 via qrcode.min.js (Offline)
    if (typeof qrcode !== 'undefined' && qr) {
      try {
        const qrObj = qrcode(0, 'H');
        qrObj.addData(String(qr));
        qrObj.make();
        imgUrl = qrObj.createDataURL(8, 2);
      } catch (err) {
        console.warn('QR generator lokal error:', err);
      }
    }

    // 2. Fallback jika library belum siap (Online Generator API)
    if (!imgUrl && qr) {
      imgUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(qr);
    }

    // Pasang ke tag <img>
    const qrImg = document.getElementById('modalQrImage');
    if (qrImg) {
      qrImg.onerror = function() {
        this.src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(qr);
      };
      qrImg.src = imgUrl;
    }

    // Atur tombol download
    const downloadBtn = document.getElementById('btnDownloadQr');
    if (downloadBtn) {
      downloadBtn.href = imgUrl;
      downloadBtn.download = 'QR-' + String(nama || 'Penjemput').replace(/[^a-zA-Z0-9]/g, '_') + '.png';
    }

    // Buka modal secara langsung
    $('#modalQrCode').modal('show');
  }

  $(document).ready(function() {
    // Inisialisasi DataTable
    const table = $('#tableOrangTua').DataTable({
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
        { orderable: false, targets: [0, 3, 5] }
      ],
      pageLength: 10,
      order: [[1, 'asc']]
    });

    // Delegasi klik tombol Lihat QR
    $(document).on('click', '.btn-view-qr', function(e) {
      e.preventDefault();
      const nama = $(this).data('nama');
      const telp = $(this).data('telp');
      const qr = $(this).data('qr');
      const siswa = $(this).data('siswa');
      openQrModal(nama, telp, qr, siswa);
    });

    // Handle unduh jika gambar dari URL eksternal
    $(document).on('click', '#btnDownloadQr', function(e) {
      const href = $(this).attr('href');
      const filename = $(this).attr('download') || 'QR_Code.png';
      if (href && href.startsWith('http')) {
        e.preventDefault();
        fetch(href)
          .then(res => res.blob())
          .then(blob => {
            const blobUrl = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = blobUrl;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(blobUrl);
          })
          .catch(() => {
            window.open(href, '_blank');
          });
      }
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
