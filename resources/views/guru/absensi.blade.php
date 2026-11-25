@extends(auth()->check() && auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.guru')

@section('title', 'Absensi Siswa QR - ' . (auth()->check() && auth()->user()->role === 'admin' ? 'Portal Admin' : 'Portal Guru'))

@section('content')

  @php
    $routePrefix = request()->routeIs('admin.*') ? 'admin' : 'guru';
  @endphp

  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 600; border: none; background: #dcfce7; color: #15803d;">
      <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="opacity: 0.8; outline: none;">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <!-- Judul Halaman & Filter Tanggal -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Absensi Harian Siswa (QR Code)</h1>
      <p class="page-header-sub mb-0">Pindai QR Code siswa untuk mencatat kehadiran harian pada <strong>{{ $tanggalFormatted }}</strong>.</p>
    </div>

    <form action="{{ route($routePrefix . '.absensi') }}" method="GET" class="d-flex align-items-center" style="gap: 8px;">
      <label for="filterTanggal" class="mb-0" style="font-size: 12.5px; font-weight: 700; color: #475569;">Tanggal:</label>
      <input type="date" id="filterTanggal" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="form-control" style="border-radius: 8px; font-size: 13px; width: auto; font-weight: 600;">
    </form>
  </div>

  <div class="row">

    <!-- Kolom Kiri: Kamera Scanner QR Absensi -->
    <div class="col-lg-5 mb-4">
      <div class="admin-card">
        <div class="card-header-flex">
          <div>
            <h2 class="card-title-main">Kamera Pemindai Absensi</h2>
            <div class="card-subtitle-small">Arahkan kamera ke QR Code milik Siswa</div>
          </div>
          <span id="scannerStatusBadge" class="badge-pill badge-yellow">Kamera Siap</span>
        </div>

        <!-- Area Pesan Alert Dinamis -->
        <div id="alertFeedback" style="display: none; margin-bottom: 14px; padding: 12px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 600;"></div>

        <!-- Wadah Scanner Video -->
        <div style="position: relative; background: #0f172a; border-radius: 12px; overflow: hidden; min-height: 280px; display: flex; align-items: center; justify-content: center;">
          <div id="reader" style="width: 100%; max-width: 400px; margin: 0 auto;"></div>
          <div id="scanLaserLine" class="scan-laser" style="display: none;"></div>
        </div>

        <!-- Kontrol Tombol Kamera -->
        <div class="row mt-3" style="gap: 8px 0;">
          <div class="col-sm-6">
            <button type="button" id="btnStartScan" class="btn btn-block btn-success font-weight-bold py-2" style="border-radius: 8px; font-size: 13px;">
              Buka Kamera
            </button>
          </div>
          <div class="col-sm-6">
            <button type="button" id="btnStopScan" class="btn btn-block btn-outline-secondary font-weight-bold py-2" style="border-radius: 8px; font-size: 13px;" disabled>
              Hentikan Kamera
            </button>
          </div>
        </div>

        <!-- Pilihan Kamera -->
        <div class="form-group mt-3 mb-0">
          <label style="font-size: 11.5px; font-weight: 600; color: #64748b; margin-bottom: 4px;">Pilihan Kamera:</label>
          <select id="cameraSelection" class="form-control" style="border-radius: 8px; font-size: 12.5px;">
            <option value="environment" selected>Kamera Belakang (Utama)</option>
            <option value="user">Kamera Depan</option>
          </select>
        </div>

        <!-- Alternatif: Input Manual Kode QR -->
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px dashed var(--border-color);">
          <div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Input Kode Manual / Barcode</div>
          <p style="font-size: 11.5px; color: #64748b; margin-bottom: 8px;">Ketik QR Code atau NIS siswa lalu tekan Catat Hadir.</p>
          
          <div class="input-group">
            <input type="text" id="manualQrInput" class="form-control" placeholder="Contoh: SISWA-TK-001 atau NIS..." style="border-radius: 8px 0 0 8px; font-size: 13px;">
            <div class="input-group-append">
              <button class="btn btn-success font-weight-bold px-3" type="button" id="btnSubmitManual" style="border-radius: 0 8px 8px 0; font-size: 13px;">
                Catat Hadir
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Rekap Daftar Absensi Siswa -->
    <div class="col-lg-7 mb-4">
      <div class="admin-card">
        <div class="card-header-flex flex-wrap" style="gap: 10px;">
          <div>
            <h2 class="card-title-main">Rekap Absensi ({{ $tanggalFormatted }})</h2>
            <div class="card-subtitle-small">Total {{ $totalSiswa }} siswa terdaftar</div>
          </div>
          <div class="d-flex flex-wrap" style="gap: 6px;">
            <span class="badge-pill badge-green" id="countHadirBadge">Hadir: {{ $totalHadir }}</span>
            <span class="badge-pill badge-blue" id="countIzinSakitBadge">Izin/Sakit: {{ $totalIzin + $totalSakit }}</span>
            <span class="badge-pill badge-yellow" id="countBelumBadge">Belum: {{ $totalBelumAbsen }}</span>
          </div>
        </div>

        <div class="table-responsive" style="margin: 0 -8px;">
          <table id="tableAbsensi" class="custom-table" style="width: 100%;">
            <thead>
              <tr>
                <th style="width: 42px; text-align: center;">No</th>
                <th>Nama Siswa</th>
                <th style="width: 100px; text-align: center;">Jam Masuk</th>
                <th style="width: 115px; text-align: center;">Status</th>
                <th style="width: 90px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($siswaList as $index => $s)
                @php
                  $absen = $absensiMap->get($s->id_siswa);
                  $status = $absen ? $absen->status : 'belum';
                  $jamMasuk = ($absen && $absen->waktu_masuk) ? \Carbon\Carbon::parse($absen->waktu_masuk)->format('H:i') . ' WIB' : '-';
                @endphp
                <tr id="row-siswa-{{ $s->id_siswa }}">
                  <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
                  <td>
                    <div style="font-weight: 700; color: #1e293b; font-size: 13px;">{{ $s->nama }}</div>
                    <div style="font-size: 11px; color: #64748b;">NIS: {{ $s->nis ?? '-' }}</div>
                  </td>
                  <td style="text-align: center; font-size: 12px; font-weight: 600; color: #334155;" class="col-jam-masuk">
                    {{ $jamMasuk }}
                  </td>
                  <td style="text-align: center;" class="col-status-absen">
                    @if($status === 'hadir')
                      <span class="badge-pill badge-green">Hadir</span>
                    @elseif($status === 'izin')
                      <span class="badge-pill badge-blue">Izin</span>
                    @elseif($status === 'sakit')
                      <span class="badge-pill badge-yellow">Sakit</span>
                    @elseif($status === 'alpha')
                      <span class="badge-pill badge-red">Alpha</span>
                    @else
                      <span class="badge-pill" style="background: #f1f5f9; color: #64748b;">Belum Absen</span>
                    @endif
                  </td>
                  <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-edit-absen"
                      title="Ubah Status Absensi"
                      style="border-radius: 7px; font-size: 11.5px; padding: 4px 10px; font-weight: 600;"
                      data-id="{{ $s->id_siswa }}"
                      data-nama="{{ $s->nama }}"
                      data-status="{{ $status === 'belum' ? 'hadir' : $status }}"
                      data-ket="{{ $absen ? $absen->keterangan : '' }}"
                      data-toggle="modal"
                      data-target="#modalUbahAbsen">
                      Ubah
                    </button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4 text-muted">Belum ada data siswa terdaftar.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- Popup Modal Berhasil Scan QR Absensi -->
  <div class="modal fade" id="modalAbsenBerhasil" tabindex="-1" role="dialog" aria-labelledby="modalAbsenBerhasilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 12px 32px rgba(0,0,0,0.16); overflow: hidden;">
        <div class="modal-header" style="background: #16a34a; color: #ffffff; padding: 14px 20px; border: none;">
          <h5 class="modal-title" id="modalAbsenBerhasilLabel" style="font-weight: 700; font-size: 15.5px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-circle-check"></i> Absensi Berhasil!
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.95; outline: none; background: none; border: none; font-size: 22px; cursor: pointer;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center" style="padding: 24px 22px 18px;">
          <div style="width: 58px; height: 58px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: inline-flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 12px;">
            <i class="fa-solid fa-user-check"></i>
          </div>

          <h4 id="popupAbsenNama" style="font-weight: 800; color: #0f172a; margin-bottom: 4px; font-size: 19px;">-</h4>
          <div style="font-size: 12.5px; color: #64748b; margin-bottom: 14px;">
            NIS: <strong id="popupAbsenNis" style="color: #334155;">-</strong> &bull; Jam Masuk: <strong id="popupAbsenJam" style="color: #16a34a;">-</strong>
          </div>

          <div id="popupAbsenMsg" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 10px 14px; font-size: 12.5px; color: #166534; font-weight: 600;">
            Kehadiran siswa pada {{ $tanggalFormatted }} berhasil dicatat.
          </div>
        </div>
        <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #f1f5f9; padding: 12px 20px; justify-content: center;">
          <button type="button" class="btn btn-success font-weight-bold px-4" data-dismiss="modal" style="border-radius: 8px; font-size: 13px; background: #16a34a;">
            Tutup &amp; Lanjut Scan
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ubah Status Absensi Manual -->
  <div class="modal fade" id="modalUbahAbsen" tabindex="-1" role="dialog" aria-labelledby="modalUbahAbsenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.12);">
        <form action="{{ route($routePrefix . '.absensi.status') }}" method="POST">
          @csrf
          <input type="hidden" name="id_siswa" id="editAbsenSiswaId">
          <input type="hidden" name="tanggal" value="{{ $tanggal }}">

          <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 16px 22px;">
            <h5 class="modal-title" id="modalUbahAbsenLabel" style="font-weight: 700; color: #1e293b;">
              Ubah Status Absensi: <span id="editAbsenSiswaNama" class="text-success"></span>
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="padding: 20px 22px;">
            <div class="form-group mb-3">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Status Kehadiran <span class="text-danger">*</span></label>
              <select name="status" id="editAbsenStatus" class="form-control" required style="border-radius: 8px;">
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha (Tanpa Keterangan)</option>
              </select>
            </div>
            <div class="form-group mb-0">
              <label style="font-weight: 600; color: #475569; font-size: 13px;">Keterangan (Opsional)</label>
              <input type="text" name="keterangan" id="editAbsenKet" class="form-control" placeholder="Contoh: Izin acara keluarga / Demam" style="border-radius: 8px;">
            </div>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 12px 22px;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Batal</button>
            <button type="submit" class="btn-brand-primary">Simpan Status</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('styles')
<style>
  .scan-laser {
    position: absolute;
    left: 10%;
    right: 10%;
    height: 2px;
    background: #22c55e;
    box-shadow: 0 0 10px #22c55e, 0 0 20px #22c55e;
    animation: scanMove 2.2s infinite ease-in-out;
    pointer-events: none;
    z-index: 10;
  }
  @keyframes scanMove {
    0% { top: 20%; }
    50% { top: 80%; }
    100% { top: 20%; }
  }
  #reader__scan_region { min-height: 240px !important; }
  #reader video { border-radius: 10px !important; object-fit: cover !important; }
  #reader__dashboard_section_csr, #reader__dashboard_section_swaplink { display: none !important; }
  #reader__dashboard { padding: 0 !important; background: transparent !important; }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
  let html5QrCode = null;
  let isScanning = false;
  let scanCooldown = false;

  const statusBadge = document.getElementById('scannerStatusBadge');
  const btnStart = document.getElementById('btnStartScan');
  const btnStop = document.getElementById('btnStopScan');
  const cameraSelection = document.getElementById('cameraSelection');
  const laserLine = document.getElementById('scanLaserLine');
  const manualInput = document.getElementById('manualQrInput');
  const btnManual = document.getElementById('btnSubmitManual');
  const alertFeedback = document.getElementById('alertFeedback');

  const routeScanAbsensi = "{{ route($routePrefix . '.absensi.scan') }}";
  const activeTanggal = "{{ $tanggal }}";

  function showAlert(message, type = 'error') {
    alertFeedback.style.display = 'block';
    alertFeedback.innerHTML = message;
    if (type === 'error') {
      alertFeedback.style.background = '#fef2f2';
      alertFeedback.style.border = '1px solid #fecaca';
      alertFeedback.style.color = '#991b1b';
    } else if (type === 'success') {
      alertFeedback.style.background = '#f0fdf4';
      alertFeedback.style.border = '1px solid #bbf7d0';
      alertFeedback.style.color = '#166534';
    } else {
      alertFeedback.style.background = '#fffbeb';
      alertFeedback.style.border = '1px solid #fef3c7';
      alertFeedback.style.color = '#92400e';
    }
  }

  function hideAlert() {
    alertFeedback.style.display = 'none';
  }

  function handleScannedCode(code) {
    if (scanCooldown) return;
    scanCooldown = true;
    setTimeout(() => { scanCooldown = false; }, 1800);

    hideAlert();
    statusBadge.textContent = 'Mencatat Absen...';

    fetch(routeScanAbsensi, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        kode: code,
        tanggal: activeTanggal
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success && data.data) {
        const s = data.data;
        document.getElementById('popupAbsenNama').textContent = s.nama;
        document.getElementById('popupAbsenNis').textContent = s.nis || '-';
        document.getElementById('popupAbsenJam').textContent = s.waktu_masuk || '-';

        const msgBox = document.getElementById('popupAbsenMsg');
        if (data.already_exists) {
          msgBox.style.background = '#fffbeb';
          msgBox.style.borderColor = '#fde68a';
          msgBox.style.color = '#92400e';
          msgBox.innerHTML = data.message;
        } else {
          msgBox.style.background = '#f0fdf4';
          msgBox.style.borderColor = '#bbf7d0';
          msgBox.style.color = '#166534';
          msgBox.innerHTML = 'Kehadiran siswa pada {{ $tanggalFormatted }} berhasil dicatat.';

          // Update baris tabel secara langsung
          updateTableRowLive(s.id_siswa, s.waktu_masuk);
        }

        $('#modalAbsenBerhasil').modal('show');
        statusBadge.textContent = isScanning ? 'Memindai Siswa...' : 'Kamera Siap';
        statusBadge.className = isScanning ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
      } else {
        showAlert(data.message || 'Data siswa tidak ditemukan.', 'error');
        statusBadge.textContent = 'Tidak Ditemukan';
        statusBadge.className = 'badge-pill badge-red';
      }
    })
    .catch(err => {
      console.error(err);
      showAlert('Gagal menghubungi server absensi.', 'error');
    });
  }

  function updateTableRowLive(idSiswa, waktuMasuk) {
    const row = document.getElementById('row-siswa-' + idSiswa);
    if (!row) return;

    const jamCell = row.querySelector('.col-jam-masuk');
    const statusCell = row.querySelector('.col-status-absen');

    const wasBelum = statusCell.textContent.trim() === 'Belum Absen';

    if (jamCell) jamCell.textContent = waktuMasuk;
    if (statusCell) statusCell.innerHTML = '<span class="badge-pill badge-green">Hadir</span>';

    // Update badge counter di header
    const hadirBadge = document.getElementById('countHadirBadge');
    const belumBadge = document.getElementById('countBelumBadge');

    if (hadirBadge) {
      const currHadir = parseInt(hadirBadge.textContent.replace(/\D/g, '')) || 0;
      hadirBadge.textContent = 'Hadir: ' + (currHadir + 1);
    }
    if (belumBadge && wasBelum) {
      const currBelum = Math.max(0, (parseInt(belumBadge.textContent.replace(/\D/g, '')) || 1) - 1);
      belumBadge.textContent = 'Belum: ' + currBelum;
    }
  }

  // Manual Submit
  btnManual.addEventListener('click', function () {
    const val = manualInput.value.trim();
    if (val) {
      handleScannedCode(val);
      manualInput.value = '';
    }
  });
  manualInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') btnManual.click();
  });

  // DataTable & Modal Ubah Status
  $(document).ready(function () {
    $('#tableAbsensi').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_ - _END_ dari _TOTAL_ siswa',
        infoEmpty: 'Tidak ada data',
        paginate: { first: 'Pertama', last: 'Terakhir', next: 'Berikutnya', previous: 'Sebelumnya' },
        zeroRecords: 'Siswa tidak ditemukan'
      },
      columnDefs: [{ orderable: false, targets: [4] }],
      pageLength: 10
    });

    $(document).on('click', '.btn-edit-absen', function () {
      $('#editAbsenSiswaId').val($(this).data('id'));
      $('#editAbsenSiswaNama').text($(this).data('nama'));
      $('#editAbsenStatus').val($(this).data('status'));
      $('#editAbsenKet').val($(this).data('ket') || '');
    });

    // Scanner Camera Init
    html5QrCode = new Html5Qrcode("reader");
    btnStart.addEventListener('click', startScanning);
    btnStop.addEventListener('click', stopScanning);
    cameraSelection.addEventListener('change', function () {
      if (isScanning) stopScanning().then(() => startScanning());
    });
  });

  function startScanning() {
    const selectedMode = cameraSelection.value || "environment";
    html5QrCode.start(
      { facingMode: selectedMode },
      { fps: 10, qrbox: { width: 220, height: 220 }, aspectRatio: 1.0 },
      (decodedText) => handleScannedCode(decodedText),
      () => {}
    ).then(() => {
      isScanning = true;
      btnStart.disabled = true;
      btnStop.disabled = false;
      laserLine.style.display = 'block';
      statusBadge.textContent = 'Memindai Siswa...';
      statusBadge.className = 'badge-pill badge-green';
    }).catch((err) => {
      console.error(err);
      statusBadge.textContent = 'Kamera Ditolak';
      statusBadge.className = 'badge-pill badge-red';
      showAlert('Tidak dapat mengakses kamera. Pastikan izin kamera diberikan di browser.', 'error');
    });
  }

  function stopScanning() {
    if (html5QrCode && isScanning) {
      return html5QrCode.stop().then(() => {
        isScanning = false;
        btnStart.disabled = false;
        btnStop.disabled = true;
        laserLine.style.display = 'none';
        statusBadge.textContent = 'Kamera Berhenti';
        statusBadge.className = 'badge-pill badge-yellow';
      }).catch(err => console.error(err));
    }
    return Promise.resolve();
  }
</script>
@endsection
