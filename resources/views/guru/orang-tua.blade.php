@extends('layouts.guru')

@section('title', 'Data Orang Tua / Wali - Portal Guru')

@section('content')

  <!-- Judul Halaman -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Data Orang Tua / Wali</h1>
      <p class="page-header-sub mb-0">Daftar kontak orang tua dan wali murid untuk keperluan komunikasi sekolah dan verifikasi penjemputan.</p>
    </div>
    <span class="badge-pill badge-green" style="font-size: 12px; padding: 6px 14px;">{{ $orangTuaList->count() }} Terdaftar</span>
  </div>

  <div class="admin-card">
    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableGuruOrangTua" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th>Nama Orang Tua / Wali</th>
            <th style="width: 160px;">Nomor Telepon</th>
            <th style="width: 220px;">Gambar &amp; Kode QR</th>
            <th>Murid / Anak Terdaftar</th>
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
              @if($ortu->no_telp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ortu->no_telp) }}" target="_blank" style="text-decoration: none; color: #15803d; font-weight: 600; font-size: 12.5px;">
                  {{ $ortu->no_telp }}
                </a>
              @else
                <span class="text-muted" style="font-size: 12px;">-</span>
              @endif
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
                  <span class="badge-pill badge-green" style="font-size: 11px; margin: 2px 2px 2px 0; display: inline-block;">{{ $s->nama }} ({{ $s->nis }})</span>
                @endforeach
              @else
                <span class="text-muted" style="font-size: 12px;">-</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-4 text-muted">
              Belum ada data orang tua / wali terdaftar.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
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
    const table = $('#tableGuruOrangTua').DataTable({
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
        { orderable: false, targets: [0, 3] }
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
  });
</script>
  });
</script>
@endsection
