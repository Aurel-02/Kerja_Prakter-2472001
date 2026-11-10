@extends('layouts.guru')

@section('title', 'Scan QR Penjemputan - Portal Guru')

@section('content')

  <!-- Judul Halaman -->
  <div style="margin-bottom: 22px;">
    <h1 class="page-header-title">Scan QR Penjemputan Siswa</h1>
    <p class="page-header-sub">Sistem verifikasi dua tahap: pindai QR Code Siswa terlebih dahulu, kemudian pindai QR Code Orang Tua / Wali penjemput.</p>
  </div>

  <!-- Indikator 2 Tahap Verifikasi -->
  <div class="admin-card mb-4" style="padding: 16px 20px;">
    <div class="row align-items-center">
      
      <!-- Langkah 1 -->
      <div class="col-md-5 mb-2 mb-md-0">
        <div id="stepIndicator1" class="step-card active">
          <div class="step-badge">1</div>
          <div class="step-info">
            <div class="step-title">Langkah 1: Scan QR Siswa</div>
            <div id="stepSub1" class="step-sub">Pindai kode QR / NIS siswa</div>
          </div>
        </div>
      </div>

      <!-- Arrow separator -->
      <div class="col-md-2 text-center d-none d-md-block text-muted" style="font-size: 18px; font-weight: 700;">
        &rarr;
      </div>

      <!-- Langkah 2 -->
      <div class="col-md-5">
        <div id="stepIndicator2" class="step-card disabled">
          <div class="step-badge">2</div>
          <div class="step-info">
            <div class="step-title">Langkah 2: Scan QR Orang Tua</div>
            <div id="stepSub2" class="step-sub">Menunggu kode siswa terverifikasi</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="row">
    
    <!-- Kolom Kiri: Area Kamera Pemindai QR & Input Manual -->
    <div class="col-lg-6 mb-4">
      <div class="admin-card">
        <div class="card-header-flex">
          <div>
            <h2 class="card-title-main" id="scannerStepTitle">Kamera Pemindai (Siswa)</h2>
            <div class="card-subtitle-small" id="scannerStepHint">Arahkan kamera ke QR Code milik Siswa</div>
          </div>
          <span id="scannerStatusBadge" class="badge-pill badge-yellow">Kamera Siap</span>
        </div>

        <!-- Wadah Scanner Video -->
        <div style="position: relative; background: #0f172a; border-radius: 12px; overflow: hidden; min-height: 300px; display: flex; align-items: center; justify-content: center;">
          <div id="reader" style="width: 100%; max-width: 440px; margin: 0 auto;"></div>

          <!-- Overlay animasi garis pemindai saat kamera aktif -->
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

        <!-- Pilihan Ganti Sumber Kamera -->
        <div id="cameraSelectGroup" class="form-group mt-3 mb-0" style="display: none;">
          <label style="font-size: 11.5px; font-weight: 600; color: #64748b; margin-bottom: 4px;">Pilih Sumber Kamera:</label>
          <select id="cameraSelection" class="form-control" style="border-radius: 8px; font-size: 12.5px;"></select>
        </div>

        <!-- Alternatif: Input Manual Kode QR -->
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px dashed var(--border-color);">
          <div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Input Kode Manual / Scanner Barcode</div>
          <p id="manualInputHint" style="font-size: 11.5px; color: #64748b; margin-bottom: 8px;">Ketik QR Code atau NIS siswa lalu tekan Periksa.</p>
          
          <div class="input-group">
            <input type="text" id="manualQrInput" class="form-control" placeholder="Contoh: SISWA-001 atau NIS..." style="border-radius: 8px 0 0 8px; font-size: 13px;">
            <div class="input-group-append">
              <button class="btn btn-primary font-weight-bold px-3" type="button" id="btnSubmitManual" style="border-radius: 0 8px 8px 0; font-size: 13px;">
                Periksa
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Kolom Kanan: Hasil Verifikasi & Riwayat -->
    <div class="col-lg-6 mb-4">
      
      <!-- Kartu Status Proses Verifikasi -->
      <div class="admin-card mb-4">
        <div class="card-header-flex">
          <div>
            <h2 class="card-title-main">Proses Verifikasi Penjemputan</h2>
            <div class="card-subtitle-small">Kesesuaian data siswa dan penjemput</div>
          </div>
          <button type="button" id="btnResetAll" class="btn btn-sm btn-outline-danger" style="display: none; border-radius: 6px; font-size: 11.5px; font-weight: 600;">
            Batal / Ulangi
          </button>
        </div>

        <!-- Area Pesan Alert Dinamis -->
        <div id="alertFeedback" style="display: none; margin-bottom: 14px; padding: 12px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 600;"></div>

        <!-- State 0: Belum ada scan -->
        <div id="stateInitial" style="text-align: center; padding: 36px 16px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px;">
          <div style="font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 6px;">Menunggu Scan Siswa</div>
          <p style="font-size: 12px; color: #94a3b8; margin: 0 auto; max-width: 320px;">
            Silakan buka kamera atau ketik kode manual di samping untuk memindai data siswa terlebih dahulu.
          </p>
        </div>

        <!-- State 1: Siswa Terdeteksi -->
        <div id="stateSiswaFound" style="display: none;">
          <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px; margin-bottom: 14px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
              <span class="badge-pill badge-green">Langkah 1 Selesai: Data Siswa Ditemukan</span>
              <span id="badgeAlreadyPickedUp" class="badge-pill badge-yellow" style="display: none;">Sudah Dijemput Hari Ini</span>
            </div>

            <div class="row" style="font-size: 12.5px; color: #334155;">
              <div class="col-6 mb-1"><strong>Nama Siswa:</strong> <span id="viewSiswaNama" style="color: #0f172a; font-weight: 700;">-</span></div>
              <div class="col-6 mb-1"><strong>NIS:</strong> <span id="viewSiswaNis">-</span></div>
              <div class="col-6 mb-1"><strong>Jenis Kelamin:</strong> <span id="viewSiswaJk">-</span></div>
              <div class="col-6 mb-1"><strong>Tahun Ajaran:</strong> <span id="viewSiswaTa">-</span></div>
              <div class="col-12 mt-1 pt-1" style="border-top: 1px dashed #dcfce7;">
                <strong>Orang Tua Terdaftar:</strong> <span id="viewSiswaOrtu" style="font-weight: 700; color: #166534;">-</span>
                <span id="viewSiswaOrtuTelp" style="color: #64748b; font-size: 11.5px; margin-left: 4px;"></span>
              </div>
            </div>
          </div>

          <!-- Prompt untuk Langkah 2 -->
          <div id="promptScanOrtu" style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 10px; padding: 14px; text-align: center;">
            <div style="font-size: 13.5px; font-weight: 700; color: #b45309; margin-bottom: 4px;">
              Sekarang Silakan Pindai QR Code Orang Tua / Penjemput
            </div>
            <p style="font-size: 12px; color: #78350f; margin: 0;">
              Sistem akan memverifikasi apakah penjemput sesuai dengan orang tua sah dari siswa di atas.
            </p>
          </div>
        </div>

        <!-- State 2A: Verifikasi Cocok -->
        <div id="stateOrtuMatched" style="display: none; margin-top: 14px;">
          <div style="background: #ecfdf5; border: 2px solid #10b981; border-radius: 10px; padding: 16px;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
              <span class="badge-pill badge-green" style="font-size: 12px;">Verifikasi Berhasil: Penjemput Cocok</span>
            </div>

            <div style="font-size: 12.5px; color: #1e293b; margin-bottom: 12px;">
              <div><strong>Nama Penjemput:</strong> <span id="viewOrtuNama" style="font-weight: 700;">-</span></div>
              <div><strong>No. Telepon:</strong> <span id="viewOrtuTelp">-</span></div>
            </div>

            <!-- Form Catatan & Konfirmasi Penjemputan -->
            <form id="formSimpanPenjemputan">
              @csrf
              <input type="hidden" id="inputSiswaId" name="id_siswa" value="">
              <input type="hidden" id="inputOrtuId" name="id_ortu_wali" value="">

              <div class="form-group mb-3">
                <label for="inputKeterangan" style="font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 4px;">
                  Catatan / Keterangan (Opsional):
                </label>
                <input type="text" id="inputKeterangan" name="keterangan" class="form-control" placeholder="Contoh: Dijemput Ibu / pulang tepat waktu" style="border-radius: 8px; font-size: 12.5px;">
              </div>

              <button type="submit" id="btnKonfirmasiPenjemputan" class="btn btn-success btn-block py-2 font-weight-bold" style="border-radius: 8px; font-size: 13.5px;">
                Konfirmasi & Simpan Penjemputan
              </button>
            </form>
          </div>
        </div>

        <!-- State 2B: Verifikasi Tidak Cocok -->
        <div id="stateOrtuMismatch" style="display: none; margin-top: 14px;">
          <div style="background: #fef2f2; border: 2px solid #ef4444; border-radius: 10px; padding: 16px;">
            <div class="badge-pill badge-red mb-2" style="font-size: 12px;">Peringatan: Penjemput Tidak Cocok!</div>
            <p id="mismatchMessage" style="font-size: 12.5px; color: #991b1b; margin-bottom: 12px; line-height: 1.4;">
              Kode QR penjemput tidak cocok dengan data orang tua / wali siswa ini.
            </p>
            <div class="row" style="gap: 8px 0;">
              <div class="col-sm-6">
                <button type="button" id="btnRetryOrtu" class="btn btn-sm btn-outline-danger btn-block font-weight-bold py-2" style="border-radius: 6px; font-size: 12px;">
                  Scan Ulang Penjemput
                </button>
              </div>
              <div class="col-sm-6">
                <button type="button" id="btnCancelToStart" class="btn btn-sm btn-outline-secondary btn-block font-weight-bold py-2" style="border-radius: 6px; font-size: 12px;">
                  Batal Dari Awal
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Riwayat Terakhir Hari Ini -->
      <div class="admin-card">
        <div class="card-header-flex">
          <div>
            <h2 class="card-title-main">Riwayat Penjemputan Hari Ini</h2>
            <div class="card-subtitle-small">Daftar siswa yang telah berhasil dijemput</div>
          </div>
          <span class="badge-pill badge-green" id="todayCountBadge">{{ isset($riwayatHariIni) ? $riwayatHariIni->count() : 0 }} Tercatat</span>
        </div>

        <div id="riwayatListContainer" style="display: flex; flex-direction: column; gap: 8px; max-height: 280px; overflow-y: auto;">
          @if(isset($riwayatHariIni) && $riwayatHariIni->count() > 0)
            @foreach($riwayatHariIni as $r)
              <div class="riwayat-item" style="background: #f8fafc; border: 1px solid var(--border-color); border-radius: 8px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between;">
                <div>
                  <div style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $r->siswa->nama ?? 'Siswa' }}</div>
                  <div style="font-size: 11px; color: #64748b;">Penjemput: {{ $r->orangTua->nama ?? '-' }} &bull; {{ $r->keterangan ?? '-' }}</div>
                </div>
                <div style="text-align: right;">
                  <span class="badge-pill badge-green" style="font-size: 10.5px;">{{ \Carbon\Carbon::parse($r->waktu)->format('H:i') }} WIB</span>
                </div>
              </div>
            @endforeach
          @else
            <div id="emptyRiwayatMessage" style="text-align: center; padding: 24px 10px; color: #94a3b8; font-size: 12px;">
              Belum ada data penjemputan yang tercatat hari ini.
            </div>
          @endif
        </div>
      </div>

    </div>

  </div>

@endsection

@section('styles')
<style>
  /* Step Cards */
  .step-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid var(--border-color);
    background: #f8fafc;
    transition: all 0.2s ease;
  }

  .step-card.active {
    background: #f0fdf4;
    border-color: #86efac;
  }

  .step-card.disabled {
    opacity: 0.55;
    background: #f8fafc;
  }

  .step-badge {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 800;
    background: #cbd5e1;
    color: #475569;
  }

  .step-card.active .step-badge {
    background: #16a34a;
    color: #ffffff;
  }

  .step-title {
    font-size: 12.5px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.2;
  }

  .step-sub {
    font-size: 11px;
    color: #64748b;
  }

  /* Badge Pill */
  .badge-pill {
    padding: 3px 9px;
    border-radius: 9999px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3px;
    white-space: nowrap;
    display: inline-block;
  }

  .badge-yellow {
    background: #fef3c7;
    color: #b45309;
  }

  .badge-green {
    background: #dcfce7;
    color: #15803d;
  }

  .badge-red {
    background: #fee2e2;
    color: #b91c1c;
  }

  /* Laser line effect */
  .scan-laser {
    position: absolute;
    top: 20%;
    left: 10%;
    width: 80%;
    height: 3px;
    background: #22c55e;
    box-shadow: 0 0 12px 3px rgba(34, 197, 94, 0.7);
    animation: scanningLaser 2.2s infinite ease-in-out alternate;
    pointer-events: none;
    z-index: 10;
  }

  @keyframes scanningLaser {
    0% {
      top: 20%;
    }
    100% {
      top: 80%;
    }
  }

  #reader video {
    border-radius: 10px !important;
    object-fit: cover;
  }

  #reader__scan_region {
    background: transparent !important;
  }

  #reader__dashboard {
    display: none !important;
  }
</style>
@endsection

@section('scripts')
<!-- Library Pemindai QR Code HTML5 -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
  // State Machine
  // step: 1 (Scan Siswa), 2 (Scan Ortu), 3 (Matched & Ready to Submit)
  let currentStep = 1;
  let activeSiswa = null;
  let activeOrtu = null;

  let html5QrCode = null;
  let isScanning = false;
  let scanCooldown = false;

  // Elements
  const btnStart = document.getElementById('btnStartScan');
  const btnStop = document.getElementById('btnStopScan');
  const statusBadge = document.getElementById('scannerStatusBadge');
  const laserLine = document.getElementById('scanLaserLine');
  const cameraSelectGroup = document.getElementById('cameraSelectGroup');
  const cameraSelection = document.getElementById('cameraSelection');

  const scannerStepTitle = document.getElementById('scannerStepTitle');
  const scannerStepHint = document.getElementById('scannerStepHint');
  const manualInput = document.getElementById('manualQrInput');
  const manualInputHint = document.getElementById('manualInputHint');
  const btnManual = document.getElementById('btnSubmitManual');
  const btnResetAll = document.getElementById('btnResetAll');

  const stepIndicator1 = document.getElementById('stepIndicator1');
  const stepIndicator2 = document.getElementById('stepIndicator2');
  const stepSub1 = document.getElementById('stepSub1');
  const stepSub2 = document.getElementById('stepSub2');

  const alertFeedback = document.getElementById('alertFeedback');
  const stateInitial = document.getElementById('stateInitial');
  const stateSiswaFound = document.getElementById('stateSiswaFound');
  const promptScanOrtu = document.getElementById('promptScanOrtu');
  const stateOrtuMatched = document.getElementById('stateOrtuMatched');
  const stateOrtuMismatch = document.getElementById('stateOrtuMismatch');

  const viewSiswaNama = document.getElementById('viewSiswaNama');
  const viewSiswaNis = document.getElementById('viewSiswaNis');
  const viewSiswaJk = document.getElementById('viewSiswaJk');
  const viewSiswaTa = document.getElementById('viewSiswaTa');
  const viewSiswaOrtu = document.getElementById('viewSiswaOrtu');
  const viewSiswaOrtuTelp = document.getElementById('viewSiswaOrtuTelp');
  const badgeAlreadyPickedUp = document.getElementById('badgeAlreadyPickedUp');

  const viewOrtuNama = document.getElementById('viewOrtuNama');
  const viewOrtuTelp = document.getElementById('viewOrtuTelp');
  const inputSiswaId = document.getElementById('inputSiswaId');
  const inputOrtuId = document.getElementById('inputOrtuId');
  const inputKeterangan = document.getElementById('inputKeterangan');
  const formSimpanPenjemputan = document.getElementById('formSimpanPenjemputan');

  const btnRetryOrtu = document.getElementById('btnRetryOrtu');
  const btnCancelToStart = document.getElementById('btnCancelToStart');
  const mismatchMessage = document.getElementById('mismatchMessage');

  const riwayatListContainer = document.getElementById('riwayatListContainer');
  const emptyRiwayatMessage = document.getElementById('emptyRiwayatMessage');
  const todayCountBadge = document.getElementById('todayCountBadge');

  // Helper Alert
  function showAlert(message, type = 'error') {
    alertFeedback.style.display = 'block';
    alertFeedback.textContent = message;
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

  // Set Step 1: Scan Siswa
  function setStep1() {
    currentStep = 1;
    activeSiswa = null;
    activeOrtu = null;

    stepIndicator1.className = 'step-card active';
    stepSub1.textContent = 'Pindai kode QR / NIS siswa';

    stepIndicator2.className = 'step-card disabled';
    stepSub2.textContent = 'Menunggu kode siswa terverifikasi';

    scannerStepTitle.textContent = 'Kamera Pemindai (Siswa)';
    scannerStepHint.textContent = 'Arahkan kamera ke QR Code milik Siswa';
    manualInput.placeholder = 'Contoh: SISWA-001 atau NIS...';
    manualInputHint.textContent = 'Ketik QR Code atau NIS siswa lalu tekan Periksa.';

    stateInitial.style.display = 'block';
    stateSiswaFound.style.display = 'none';
    stateOrtuMatched.style.display = 'none';
    stateOrtuMismatch.style.display = 'none';
    btnResetAll.style.display = 'none';
    hideAlert();

    statusBadge.textContent = isScanning ? 'Memindai Siswa...' : 'Kamera Siap';
    statusBadge.className = isScanning ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
  }

  // Set Step 2: Scan Ortu Penjemput
  function setStep2(siswa) {
    currentStep = 2;
    activeSiswa = siswa;
    activeOrtu = null;

    stepIndicator1.className = 'step-card';
    stepSub1.textContent = 'Siswa: ' + siswa.nama;

    stepIndicator2.className = 'step-card active';
    stepSub2.textContent = 'Pindai QR Orang Tua / Penjemput';

    scannerStepTitle.textContent = 'Kamera Pemindai (Orang Tua)';
    scannerStepHint.textContent = 'Arahkan kamera ke QR Code Penjemput untuk verifikasi ' + siswa.nama;
    manualInput.placeholder = 'Ketik QR Code / ID Orang Tua...';
    manualInputHint.textContent = 'Ketik kode QR penjemput lalu tekan Periksa.';

    stateInitial.style.display = 'none';
    stateSiswaFound.style.display = 'block';
    promptScanOrtu.style.display = 'block';
    stateOrtuMatched.style.display = 'none';
    stateOrtuMismatch.style.display = 'none';
    btnResetAll.style.display = 'inline-block';

    viewSiswaNama.textContent = siswa.nama;
    viewSiswaNis.textContent = siswa.nis;
    viewSiswaJk.textContent = siswa.jenis_kelamin;
    viewSiswaTa.textContent = siswa.tahun_ajaran;
    viewSiswaOrtu.textContent = siswa.nama_ortu;
    viewSiswaOrtuTelp.textContent = siswa.no_telp_ortu ? '(' + siswa.no_telp_ortu + ')' : '';

    statusBadge.textContent = isScanning ? 'Memindai Ortu...' : 'Kamera Siap';
    statusBadge.className = isScanning ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
  }

  // Handle Scanning input (from camera or manual text)
  function handleScannedCode(code) {
    if (scanCooldown) return;
    scanCooldown = true;

    setTimeout(() => {
      scanCooldown = false;
    }, 1800);

    if (currentStep === 1) {
      processStep1Siswa(code);
    } else if (currentStep === 2) {
      processStep2Ortu(code);
    }
  }

  // Step 1: Request cek siswa ke backend
  function processStep1Siswa(kode) {
    hideAlert();
    statusBadge.textContent = 'Memeriksa Siswa...';

    fetch("{{ route('guru.scan-qr.cek-siswa') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ kode: kode })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success && data.siswa) {
        setStep2(data.siswa);
        if (data.sudah_dijemput) {
          badgeAlreadyPickedUp.style.display = 'inline-block';
          showAlert('Perhatian: Siswa ini sudah pernah dijemput hari ini pada pukul ' + data.sudah_dijemput.waktu, 'warning');
        } else {
          badgeAlreadyPickedUp.style.display = 'none';
        }
      } else {
        showAlert(data.message || 'Data siswa tidak ditemukan. Silakan scan ulang.', 'error');
        statusBadge.textContent = 'Siswa Tidak Ditemukan';
        statusBadge.className = 'badge-pill badge-red';
      }
    })
    .catch(err => {
      console.error(err);
      showAlert('Gagal menghubungi server untuk verifikasi siswa.', 'error');
    });
  }

  // Step 2: Request cek ortu ke backend
  function processStep2Ortu(kodeOrtu) {
    if (!activeSiswa) return;
    hideAlert();
    statusBadge.textContent = 'Memverifikasi Penjemput...';

    fetch("{{ route('guru.scan-qr.cek-ortu') }}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        id_siswa: activeSiswa.id_siswa,
        kode_ortu: kodeOrtu
      })
    })
    .then(res => res.json())
    .then(data => {
      promptScanOrtu.style.display = 'none';

      if (data.success && data.matched) {
        // MATCHED
        activeOrtu = data.penjemput;
        stateOrtuMatched.style.display = 'block';
        stateOrtuMismatch.style.display = 'none';

        viewOrtuNama.textContent = data.penjemput.nama;
        viewOrtuTelp.textContent = data.penjemput.no_telp || '-';
        inputSiswaId.value = activeSiswa.id_siswa;
        inputOrtuId.value = data.penjemput.id_ortu_wali;
        inputKeterangan.value = 'Dijemput oleh ' + data.penjemput.nama;

        statusBadge.textContent = 'Penjemput Cocok!';
        statusBadge.className = 'badge-pill badge-green';
      } else {
        // MISMATCH
        stateOrtuMatched.style.display = 'none';
        stateOrtuMismatch.style.display = 'block';

        if (data.penjemput) {
          mismatchMessage.innerHTML = 'QR Code terdeteksi atas nama <strong>' + data.penjemput.nama + '</strong>, namun orang tua terdaftar dari <strong>' + (data.siswa ? data.siswa.nama : 'siswa') + '</strong> adalah <strong>' + (data.siswa ? data.siswa.nama_ortu_sah : '-') + '</strong>.';
        } else {
          mismatchMessage.textContent = data.message || 'QR Code penjemput tidak terdaftar atau tidak cocok dengan data siswa.';
        }

        statusBadge.textContent = 'Penjemput Tidak Cocok';
        statusBadge.className = 'badge-pill badge-red';
      }
    })
    .catch(err => {
      console.error(err);
      showAlert('Gagal memverifikasi data penjemput ke server.', 'error');
    });
  }

  // Handle Form Submit Simpan Penjemputan
  formSimpanPenjemputan.addEventListener('submit', function (e) {
    e.preventDefault();
    const btnSubmit = document.getElementById('btnKonfirmasiPenjemputan');
    btnSubmit.disabled = true;
    btnSubmit.textContent = 'Menyimpan...';

    const formData = new FormData(formSimpanPenjemputan);

    fetch("{{ route('guru.scan-qr.simpan') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      btnSubmit.disabled = false;
      btnSubmit.textContent = 'Konfirmasi & Simpan Penjemputan';

      if (data.success && data.data) {
        showAlert(data.message, 'success');

        // Tambahkan ke riwayat tampilan secara instan
        addRiwayatItemToDom(data.data);

        // Reset ke Step 1 setelah 2.5 detik agar siap menyambut siswa berikutnya
        setTimeout(() => {
          setStep1();
        }, 2500);
      } else {
        showAlert(data.message || 'Gagal menyimpan penjemputan.', 'error');
      }
    })
    .catch(err => {
      btnSubmit.disabled = false;
      btnSubmit.textContent = 'Konfirmasi & Simpan Penjemputan';
      console.error(err);
      showAlert('Terjadi kesalahan koneksi saat menyimpan.', 'error');
    });
  });

  // Tambahkan item riwayat baru ke daftar DOM
  function addRiwayatItemToDom(item) {
    if (emptyRiwayatMessage) {
      emptyRiwayatMessage.style.display = 'none';
    }

    const div = document.createElement('div');
    div.className = 'riwayat-item';
    div.style.cssText = 'background: #f8fafc; border: 1px solid var(--border-color); border-radius: 8px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between;';
    div.innerHTML = `
      <div>
        <div style="font-size: 13px; font-weight: 700; color: #1e293b;">${item.nama_siswa}</div>
        <div style="font-size: 11px; color: #64748b;">Penjemput: ${item.nama_ortu} &bull; ${item.keterangan || '-'}</div>
      </div>
      <div style="text-align: right;">
        <span class="badge-pill badge-green" style="font-size: 10.5px;">${item.waktu}</span>
      </div>
    `;

    riwayatListContainer.prepend(div);

    // Update count badge
    const currentCount = parseInt(todayCountBadge.textContent) || 0;
    todayCountBadge.textContent = (currentCount + 1) + ' Tercatat';
  }

  // Tombol Scan Ulang Ortu
  btnRetryOrtu.addEventListener('click', function () {
    stateOrtuMismatch.style.display = 'none';
    promptScanOrtu.style.display = 'block';
    statusBadge.textContent = isScanning ? 'Memindai Ortu...' : 'Kamera Siap';
    statusBadge.className = isScanning ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
  });

  // Tombol Batal & Ulangi Dari Awal
  btnResetAll.addEventListener('click', setStep1);
  btnCancelToStart.addEventListener('click', setStep1);

  // Input Manual Submission
  btnManual.addEventListener('click', function () {
    const val = manualInput.value.trim();
    if (val) {
      handleScannedCode(val);
      manualInput.value = '';
    }
  });

  manualInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      btnManual.click();
    }
  });

  // Inisialisasi Scanner Kamera
  document.addEventListener('DOMContentLoaded', function () {
    html5QrCode = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(devices => {
      if (devices && devices.length) {
        cameraSelectGroup.style.display = 'block';
        cameraSelection.innerHTML = '';
        devices.forEach(device => {
          const option = document.createElement('option');
          option.value = device.id;
          option.text = device.label || `Kamera ${cameraSelection.length + 1}`;
          cameraSelection.appendChild(option);
        });
      }
    }).catch(err => {
      console.log('Tidak dapat mendeteksi daftar kamera:', err);
    });

    btnStart.addEventListener('click', startScanning);
    btnStop.addEventListener('click', stopScanning);

    setStep1();
  });

  function startScanning() {
    const cameraId = cameraSelection.value;
    const config = {
      fps: 10,
      qrbox: { width: 240, height: 240 },
      aspectRatio: 1.0
    };

    const cameraSource = cameraId ? cameraId : { facingMode: "environment" };

    html5QrCode.start(
      cameraSource,
      config,
      (decodedText) => {
        handleScannedCode(decodedText);
      },
      () => {}
    ).then(() => {
      isScanning = true;
      btnStart.disabled = true;
      btnStop.disabled = false;
      laserLine.style.display = 'block';

      statusBadge.textContent = (currentStep === 1) ? 'Memindai Siswa...' : 'Memindai Ortu...';
      statusBadge.className = 'badge-pill badge-green';
    }).catch((err) => {
      console.error('Gagal membuka kamera:', err);
      statusBadge.textContent = 'Kamera Ditolak';
      statusBadge.className = 'badge-pill badge-red';
      showAlert('Tidak dapat mengakses kamera. Pastikan izin akses kamera sudah diberikan di peramban web.', 'error');
    });
  }

  function stopScanning() {
    if (html5QrCode && isScanning) {
      html5QrCode.stop().then(() => {
        isScanning = false;
        btnStart.disabled = false;
        btnStop.disabled = true;
        laserLine.style.display = 'none';

        statusBadge.textContent = 'Kamera Berhenti';
        statusBadge.className = 'badge-pill badge-yellow';
      }).catch(err => {
        console.error('Gagal menghentikan kamera:', err);
      });
    }
  }
</script>
@endsection
