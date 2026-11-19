@extends('layouts.guru')

@section('title', 'Data Siswa - Portal Guru')

@section('content')

  <!-- Judul Halaman -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Data Siswa-Siswi</h1>
    <p class="page-header-sub">Daftar seluruh murid / peserta didik aktif di TK Harapan Bunda beserta informasi orang tua/wali dan kode QR siswa.</p>
  </div>

  <div class="admin-card">
    <div class="card-header-flex">
      <div>
        <h2 class="card-title-main">Daftar Peserta Didik</h2>
        <div class="card-subtitle-small">Total {{ $siswaList->count() }} siswa terdaftar di database</div>
      </div>
      <span class="badge-pill badge-green" style="font-size: 11.5px; padding: 5px 12px;">{{ $siswaList->count() }} Siswa Aktif</span>
    </div>

    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableGuruSiswa" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th>Nama Siswa</th>
            <th style="width: 110px;">NIS</th>
            <th style="width: 120px;">Tahun Ajaran</th>
            <th>Kode QR Siswa</th>
            <th>Jenis Kelamin</th>
            <th>Orang Tua / Wali</th>
            <th>Kontak Ortu</th>
            <th style="text-align: center;">Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse($siswaList as $index => $s)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $s->nama }}</div>
            </td>
            <td>
              <span style="font-weight: 600; color: #334155; font-size: 13px;">
                {{ $s->nis }}
              </span>
            </td>
            <td>
              <span style="font-size: 12.5px; font-weight: 600; color: #475569;">
                {{ $s->tahun_ajaran ?? '2026/2027' }}
              </span>
            </td>
            <td>
              @if($s->qr_code_siswa)
                <div>
                  <div style="font-family: monospace; font-size: 12.5px; font-weight: 700; color: #0f172a; margin-bottom: 3px;">
                    {{ $s->qr_code_siswa }}
                  </div>
                  <div>
                    <button type="button" class="btn btn-sm btn-link p-0 btn-view-qr"
                      onclick="openQrModalSiswa('{{ addslashes($s->nama) }}', '{{ addslashes($s->nis) }}', '{{ addslashes($s->qr_code_siswa) }}', '{{ addslashes($s->orangTua ? $s->orangTua->nama : '-') }}')"
                      data-nama="{{ $s->nama }}"
                      data-nis="{{ $s->nis }}"
                      data-qr="{{ $s->qr_code_siswa }}"
                      data-ortu="{{ $s->orangTua ? $s->orangTua->nama : '-' }}"
                      style="font-size: 12px; color: #16a34a; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; cursor: pointer;">
                      <i class="fa-solid fa-qrcode"></i> Lihat QR
                    </button>
                  </div>
                </div>
              @else
                <span class="text-muted" style="font-size: 12px;">-</span>
              @endif
            </td>
            <td>
              <span style="font-size: 12.5px; color: #334155;">{{ $s->jenis_kelamin ?? '-' }}</span>
            </td>
            <td>
              @if($s->orangTua)
                <div style="font-weight: 700; color: #1e293b;">{{ $s->orangTua->nama }}</div>
              @else
                <span class="text-muted" style="font-size: 12px;">Belum terhubung</span>
              @endif
            </td>
            <td>
              @if($s->orangTua && $s->orangTua->no_telp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $s->orangTua->no_telp) }}" target="_blank" style="text-decoration: none; color: #15803d; font-weight: 600; font-size: 12px;">
                  {{ $s->orangTua->no_telp }}
                </a>
              @else
                <span class="text-muted" style="font-size: 12px;">-</span>
              @endif
            </td>
            <td style="text-align: center;">
              <span class="badge-pill badge-green">{{ ucfirst($s->status ?? 'Aktif') }}</span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="text-center py-4 text-muted">
              Belum ada data siswa terdaftar di database.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tampilan QR Code Siswa -->
  <div class="modal fade" id="modalQrCode" tabindex="-1" role="dialog" aria-labelledby="modalQrCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 420px;">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
        
        <div class="modal-header" style="background: #16a34a; color: #ffffff; padding: 16px 20px; border: none;">
          <div>
            <h5 class="modal-title" id="modalQrCodeLabel" style="font-weight: 800; font-size: 15.5px; margin: 0; color: #ffffff;">
              Kartu QR Code Siswa
            </h5>
            <small style="color: #dcfce7; font-size: 11.5px;">TK Harapan Bunda &bull; <span id="modalQrNamaHeader">Murid</span></small>
          </div>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; outline: none; background: none; border: none; font-size: 20px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body text-center" style="padding: 22px 20px;">
          <!-- Printable Card Container -->
          <div id="printableQrCard" style="background: #ffffff; border: 2px dashed #86efac; border-radius: 12px; padding: 18px 14px;">
            <div style="font-size: 10.5px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #16a34a; margin-bottom: 2px;">
              Kartu Identitas Siswa
            </div>
            <div style="font-size: 15px; font-weight: 800; color: #0f172a; margin-bottom: 12px;">
              TK Harapan Bunda
            </div>

            <!-- Gambar Target untuk QR Code -->
            <div style="display: flex; justify-content: center; align-items: center; margin: 0 auto 12px auto; min-height: 200px;">
              <img id="modalQrImage" src="" alt="QR Code Siswa" style="width: 200px; height: 200px; object-fit: contain; border-radius: 8px; border: 1px solid #e2e8f0; padding: 6px; background: #ffffff; box-shadow: 0 2px 6px rgba(0,0,0,0.06); display: block;">
            </div>

            <!-- String QR Code -->
            <div id="modalQrCodeText" style="font-family: monospace; font-size: 13.5px; font-weight: 800; color: #0f172a; background: #f1f5f9; padding: 4px 12px; border-radius: 6px; display: inline-block; letter-spacing: 0.5px;"></div>
          </div>
        </div>

        <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #f1f5f9; padding: 12px 18px; display: flex; gap: 8px; justify-content: flex-end;">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; font-size: 12px;">Tutup</button>
          <a id="btnDownloadQr" href="#" download="QR_Siswa.png" class="btn btn-success btn-sm font-weight-bold" style="border-radius: 8px; font-size: 12px; background: #16a34a; display: inline-flex; align-items: center; gap: 6px;">
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
  // Fungsi Buka Modal & Generate Gambar QR Siswa
  function openQrModalSiswa(nama, nis, qr, ortu) {
    $('#modalQrNamaHeader').text(nama || 'Murid');
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
      downloadBtn.download = 'QR-Siswa-' + String(nama || 'Siswa').replace(/[^a-zA-Z0-9]/g, '_') + '.png';
    }

    // Buka modal secara langsung
    $('#modalQrCode').modal('show');
  }

  $(document).ready(function() {
    const table = $('#tableGuruSiswa').DataTable({
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
        { orderable: false, targets: [0, 4, 8] }
      ],
      pageLength: 10,
      order: [[1, 'asc']]
    });

    // Delegasi klik tombol Lihat QR Siswa
    $(document).on('click', '.btn-view-qr', function(e) {
      e.preventDefault();
      const nama = $(this).data('nama');
      const nis  = $(this).data('nis');
      const qr   = $(this).data('qr');
      const ortu = $(this).data('ortu');
      openQrModalSiswa(nama, nis, qr, ortu);
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
</script>
@endsection

