@extends(auth()->check() && auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.guru')

@section('title', 'Catat Presensi - ' . (auth()->check() && auth()->user()->role === 'admin' ? 'Portal Admin' : 'Portal Guru'))

@section('content')

  @php
    $routePrefix = request()->routeIs('admin.*') ? 'admin' : 'guru';
    $isPenjemputanTab = ($activeTab ?? 'absensi') === 'penjemputan';
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

  <!-- Header & Tab Switcher -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 20px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Catat Presensi</h1>
      <p class="page-header-sub mb-0">Kelola absensi kehadiran harian siswa dan verifikasi QR penjemputan orang tua dalam satu halaman.</p>
    </div>

    <!-- Tab Pills -->
    <ul class="nav nav-pills" id="qrMainTabs" role="tablist" style="background: #ffffff; padding: 5px; border-radius: 12px; border: 1px solid #e2e8f0; gap: 4px;">
      <li class="nav-item" role="presentation">
        <a class="nav-link {{ !$isPenjemputanTab ? 'active' : '' }}" id="tab-absensi-link" data-toggle="pill" href="#paneAbsensi" role="tab" aria-controls="paneAbsensi" aria-selected="{{ !$isPenjemputanTab ? 'true' : 'false' }}" style="border-radius: 8px; font-size: 13px; font-weight: 700; padding: 8px 16px;">
          <i class="fa-solid fa-user-check mr-1"></i> Absensi Hadir
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link {{ $isPenjemputanTab ? 'active' : '' }}" id="tab-penjemputan-link" data-toggle="pill" href="#panePenjemputan" role="tab" aria-controls="panePenjemputan" aria-selected="{{ $isPenjemputanTab ? 'true' : 'false' }}" style="border-radius: 8px; font-size: 13px; font-weight: 700; padding: 8px 16px;">
          <i class="fa-solid fa-qrcode mr-1"></i> Penjemputan Pulang
          <span class="badge badge-light ml-1" id="tabWaitingBadge" style="font-size: 11px;">{{ isset($menungguPenjemputan) ? $menungguPenjemputan->count() : 0 }}</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="tab-content" id="qrMainTabsContent">

    <!-- ==================== TAB 1: ABSENSI HADIR (QR) ==================== -->
    <div class="tab-pane fade {{ !$isPenjemputanTab ? 'show active' : '' }}" id="paneAbsensi" role="tabpanel" aria-labelledby="tab-absensi-link">

      <div class="d-flex justify-content-between align-items-center flex-wrap mb-3" style="gap: 10px;">
        <div style="font-size: 13px; font-weight: 600; color: #475569;">
          Menampilkan absensi tanggal: <strong style="color: #0f172a;">{{ $tanggalFormatted }}</strong>
        </div>
        <form action="{{ route($routePrefix . '.absensi') }}" method="GET" class="d-flex align-items-center" style="gap: 8px;">
          <label for="filterTanggal" class="mb-0" style="font-size: 12.5px; font-weight: 700; color: #475569;">Tanggal:</label>
          <input type="date" id="filterTanggal" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="form-control" style="border-radius: 8px; font-size: 13px; width: auto; font-weight: 600;">
        </form>
      </div>

      <div class="row">
        <!-- Kolom Kiri: Kamera Scanner Absensi -->
        <div class="col-lg-5 mb-4">
          <div class="admin-card">
            <div class="card-header-flex">
              <div>
                <h2 class="card-title-main">Kamera Pemindai Absensi</h2>
                <div class="card-subtitle-small">Arahkan kamera ke QR Code milik Siswa</div>
              </div>
              <span id="absenStatusBadge" class="badge-pill badge-yellow">Kamera Siap</span>
            </div>

            <div id="absenAlertFeedback" style="display: none; margin-bottom: 14px; padding: 12px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 600;"></div>

            <div style="position: relative; background: #0f172a; border-radius: 12px; overflow: hidden; min-height: 270px; display: flex; align-items: center; justify-content: center;">
              <div id="readerAbsen" style="width: 100%; max-width: 400px; margin: 0 auto;"></div>
              <div id="absenLaserLine" class="scan-laser" style="display: none;"></div>
            </div>

            <div class="row mt-3" style="gap: 8px 0;">
              <div class="col-sm-6">
                <button type="button" id="btnStartAbsen" class="btn btn-block btn-success font-weight-bold py-2" style="border-radius: 8px; font-size: 13px;">
                  Buka Kamera
                </button>
              </div>
              <div class="col-sm-6">
                <button type="button" id="btnStopAbsen" class="btn btn-block btn-outline-secondary font-weight-bold py-2" style="border-radius: 8px; font-size: 13px;" disabled>
                  Hentikan Kamera
                </button>
              </div>
            </div>

            <div class="form-group mt-3 mb-0">
              <label style="font-size: 11.5px; font-weight: 600; color: #64748b; margin-bottom: 4px;">Pilihan Kamera:</label>
              <select id="cameraSelectionAbsen" class="form-control" style="border-radius: 8px; font-size: 12.5px;">
                <option value="environment" selected>Kamera Belakang (Utama)</option>
                <option value="user">Kamera Depan</option>
              </select>
            </div>

            <div style="margin-top: 20px; padding-top: 16px; border-top: 1px dashed var(--border-color);">
              <div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Input Kode Manual / Barcode</div>
              <p style="font-size: 11.5px; color: #64748b; margin-bottom: 8px;">Ketik QR Code atau NIS siswa lalu tekan Catat Hadir.</p>
              
              <div class="input-group">
                <input type="text" id="manualQrAbsen" class="form-control" placeholder="Contoh: SISWA-TK-001 atau NIS..." style="border-radius: 8px 0 0 8px; font-size: 13px;">
                <div class="input-group-append">
                  <button class="btn btn-success font-weight-bold px-3" type="button" id="btnSubmitManualAbsen" style="border-radius: 0 8px 8px 0; font-size: 13px;">
                    Catat Hadir
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolom Kanan: Rekap Daftar Absensi -->
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

    </div>

    <!-- ==================== TAB 2: PENJEMPUTAN PULANG (QR) ==================== -->
    <div class="tab-pane fade {{ $isPenjemputanTab ? 'show active' : '' }}" id="panePenjemputan" role="tabpanel" aria-labelledby="tab-penjemputan-link">

      <div class="row">
        <!-- Kolom Kiri: Kamera Pemindai Penjemputan -->
        <div class="col-lg-5 mb-4">
          <div class="admin-card">
            <div class="card-header-flex">
              <div>
                <h2 class="card-title-main" id="jemputScannerTitle">Kamera Pemindai (Siswa)</h2>
                <div class="card-subtitle-small" id="jemputScannerHint">Klik "Absen Pulang" pada daftar siswa atau pindai QR Siswa</div>
              </div>
              <span id="jemputStatusBadge" class="badge-pill badge-yellow">Kamera Siap</span>
            </div>

            <div style="position: relative; background: #0f172a; border-radius: 12px; overflow: hidden; min-height: 270px; display: flex; align-items: center; justify-content: center;">
              <div id="readerJemput" style="width: 100%; max-width: 400px; margin: 0 auto;"></div>
              <div id="jemputLaserLine" class="scan-laser" style="display: none;"></div>
            </div>

            <div class="row mt-3" style="gap: 8px 0;">
              <div class="col-sm-6">
                <button type="button" id="btnStartJemput" class="btn btn-block btn-success font-weight-bold py-2" style="border-radius: 8px; font-size: 13px;">
                  Buka Kamera
                </button>
              </div>
              <div class="col-sm-6">
                <button type="button" id="btnStopJemput" class="btn btn-block btn-outline-secondary font-weight-bold py-2" style="border-radius: 8px; font-size: 13px;" disabled>
                  Hentikan Kamera
                </button>
              </div>
            </div>

            <div class="form-group mt-3 mb-0">
              <label style="font-size: 11.5px; font-weight: 600; color: #64748b; margin-bottom: 4px;">Pilihan Kamera:</label>
              <select id="cameraSelectionJemput" class="form-control" style="border-radius: 8px; font-size: 12.5px;">
                <option value="environment" selected>Kamera Belakang (Utama)</option>
                <option value="user">Kamera Depan</option>
              </select>
            </div>

            <div style="margin-top: 20px; padding-top: 16px; border-top: 1px dashed var(--border-color);">
              <div style="font-size: 13px; font-weight: 700; color: #1e293b; margin-bottom: 4px;">Input Kode Manual / Scanner Barcode</div>
              <p id="jemputManualHint" style="font-size: 11.5px; color: #64748b; margin-bottom: 8px;">Ketik QR Code atau NIS siswa lalu tekan Periksa.</p>
              
              <div class="input-group">
                <input type="text" id="manualQrJemput" class="form-control" placeholder="Contoh: SISWA-TK-001 atau ORTU-TK-001..." style="border-radius: 8px 0 0 8px; font-size: 13px;">
                <div class="input-group-append">
                  <button class="btn btn-primary font-weight-bold px-3" type="button" id="btnSubmitManualJemput" style="border-radius: 0 8px 8px 0; font-size: 13px;">
                    Periksa
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolom Kanan: Verifikasi, Siswa Siap Dijemput & Rekap Pulang -->
        <div class="col-lg-7 mb-4">

          <!-- Proses Verifikasi Penjemputan -->
          <div class="admin-card mb-4">
            <div class="card-header-flex">
              <div>
                <h2 class="card-title-main">Proses Verifikasi Penjemputan</h2>
                <div class="card-subtitle-small">Kesesuaian data siswa dan penjemput</div>
              </div>
              <button type="button" id="btnResetJemput" class="btn btn-sm btn-outline-danger" style="display: none; border-radius: 6px; font-size: 11.5px; font-weight: 600;">
                Batal / Ulangi
              </button>
            </div>

            <div id="jemputAlertFeedback" style="display: none; margin-bottom: 14px; padding: 12px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 600;"></div>

            <!-- State 0 -->
            <div id="stateJemputInitial" style="text-align: center; padding: 28px 16px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px;">
              <div style="font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 6px;">Siap Memverifikasi Penjemputan</div>
              <p style="font-size: 12px; color: #94a3b8; margin: 0 auto; max-width: 360px;">
                Klik tombol <strong>Absen Pulang</strong> pada daftar siswa di bawah, atau pindai QR Code siswa terlebih dahulu.
              </p>
            </div>

            <!-- State 1: Siswa Dipilih -> Scan Ortu -->
            <div id="stateJemputSiswa" style="display: none;">
              <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px; margin-bottom: 14px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                  <span class="badge-pill badge-green">Siswa Dipilih untuk Dijemput</span>
                </div>
                <div class="row" style="font-size: 12.5px; color: #334155;">
                  <div class="col-6 mb-1"><strong>Nama Siswa:</strong> <span id="viewJemputSiswaNama" style="color: #0f172a; font-weight: 700;">-</span></div>
                  <div class="col-6 mb-1"><strong>NIS:</strong> <span id="viewJemputSiswaNis">-</span></div>
                  <div class="col-12 mt-1 pt-1" style="border-top: 1px dashed #dcfce7;">
                    <strong>Orang Tua Terdaftar:</strong> <span id="viewJemputSiswaOrtu" style="font-weight: 700; color: #166534;">-</span>
                    <span id="viewJemputSiswaOrtuTelp" style="color: #64748b; font-size: 11.5px; margin-left: 4px;"></span>
                  </div>
                </div>
              </div>

              <div id="promptScanOrtu" style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 10px; padding: 14px; text-align: center;">
                <div style="font-size: 13.5px; font-weight: 700; color: #b45309; margin-bottom: 4px;">
                  Sekarang Silakan Pindai QR Code Orang Tua / Penjemput
                </div>
                <p style="font-size: 12px; color: #78350f; margin: 0;">
                  Sistem akan memverifikasi kesesuaian penjemput dengan orang tua sah siswa di atas.
                </p>
              </div>
            </div>

            <!-- State 2A: Ortu Cocok -->
            <div id="stateOrtuMatched" style="display: none; margin-top: 14px;">
              <div style="background: #ecfdf5; border: 2px solid #10b981; border-radius: 10px; padding: 16px;">
                <div class="mb-2">
                  <span class="badge-pill badge-green" style="font-size: 12px;">Verifikasi Berhasil: Penjemput Cocok</span>
                </div>
                <div style="font-size: 12.5px; color: #1e293b; margin-bottom: 12px;">
                  <div><strong>Nama Penjemput:</strong> <span id="viewOrtuNama" style="font-weight: 700;">-</span></div>
                  <div><strong>No. Telepon:</strong> <span id="viewOrtuTelp">-</span></div>
                </div>

                <form id="formSimpanPenjemputan">
                  @csrf
                  <input type="hidden" id="inputJemputSiswaId" name="id_siswa" value="">
                  <input type="hidden" id="inputJemputOrtuId" name="id_ortu_wali" value="">
                  <div class="form-group mb-3">
                    <label for="inputJemputKet" style="font-size: 12px; font-weight: 600; color: #475569; margin-bottom: 4px;">Catatan / Keterangan (Opsional):</label>
                    <input type="text" id="inputJemputKet" name="keterangan" class="form-control" placeholder="Contoh: Dijemput Ibu" style="border-radius: 8px; font-size: 12.5px;">
                  </div>
                  <button type="submit" id="btnKonfirmasiPenjemputan" class="btn btn-success btn-block py-2 font-weight-bold" style="border-radius: 8px; font-size: 13.5px;">
                    Konfirmasi &amp; Simpan Penjemputan
                  </button>
                </form>
              </div>
            </div>

            <!-- State 2B: Ortu Tidak Cocok -->
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

          <!-- Daftar Siswa Hadir / Siap Absen Pulang -->
          <div class="admin-card mb-4">
            <div class="card-header-flex">
              <div>
                <h2 class="card-title-main">Siswa Hadir / Siap Dijemput</h2>
                <div class="card-subtitle-small">Otomatis terisi dari Absensi Hadir ({{ $tanggalTodayFormatted }})</div>
              </div>
              <span class="badge-pill badge-yellow" id="waitingCountBadge">{{ isset($menungguPenjemputan) ? $menungguPenjemputan->count() : 0 }} Menunggu</span>
            </div>

            <div id="waitingListContainer" style="display: flex; flex-direction: column; gap: 8px; max-height: 240px; overflow-y: auto;">
              @if(isset($menungguPenjemputan) && $menungguPenjemputan->count() > 0)
                @foreach($menungguPenjemputan as $w)
                  <div class="waiting-item" data-id-siswa="{{ $w->id_siswa }}" style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                    <div>
                      <div style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $w->siswa->nama ?? 'Siswa' }}</div>
                      <div style="font-size: 11px; color: #64748b;">
                        NIS: {{ $w->siswa->nis ?? '-' }} &bull; Ortu: {{ $w->orangTua->nama ?? '-' }} &bull; Hadir: {{ \Carbon\Carbon::parse($w->waktu)->format('H:i') }} WIB
                      </div>
                    </div>
                    <div style="flex-shrink: 0;">
                      <button type="button" class="btn btn-sm btn-success font-weight-bold btn-scan-ortu-waiting"
                        style="border-radius: 7px; font-size: 11.5px; padding: 5px 12px;"
                        data-id="{{ $w->id_siswa }}"
                        data-nama="{{ $w->siswa->nama ?? 'Siswa' }}"
                        data-nis="{{ $w->siswa->nis ?? '-' }}"
                        data-jk="{{ $w->siswa->jenis_kelamin ?? '-' }}"
                        data-ta="{{ $w->siswa->tahun_ajaran ?? '-' }}"
                        data-id-ortu="{{ $w->id_ortu_wali }}"
                        data-nama-ortu="{{ $w->orangTua->nama ?? '-' }}"
                        data-telp-ortu="{{ $w->orangTua->no_telp ?? '-' }}">
                        <i class="fa-solid fa-qrcode mr-1"></i> Absen Pulang
                      </button>
                    </div>
                  </div>
                @endforeach
              @else
                <div id="emptyWaitingMessage" style="text-align: center; padding: 20px 10px; color: #94a3b8; font-size: 12px;">
                  Belum ada siswa yang menunggu penjemputan pada {{ $tanggalTodayFormatted }}.
                </div>
              @endif
            </div>
          </div>

          <!-- Rekap Penjemputan Selesai -->
          <div class="admin-card">
            <div class="card-header-flex">
              <div>
                <h2 class="card-title-main">Rekap Penjemputan ({{ $tanggalTodayFormatted }})</h2>
                <div class="card-subtitle-small">Daftar siswa yang telah selesai dijemput</div>
              </div>
              <span class="badge-pill badge-green" id="todayCountBadge">{{ isset($riwayatHariIni) ? $riwayatHariIni->count() : 0 }} Tercatat</span>
            </div>

            <div id="riwayatListContainer" style="display: flex; flex-direction: column; gap: 8px; max-height: 240px; overflow-y: auto;">
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
                <div id="emptyRiwayatMessage" style="text-align: center; padding: 20px 10px; color: #94a3b8; font-size: 12px;">
                  Belum ada data penjemputan yang tercatat pada {{ $tanggalTodayFormatted }}.
                </div>
              @endif
            </div>
          </div>

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
            Kehadiran siswa berhasil dicatat &amp; otomatis masuk ke tab Penjemputan Pulang.
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

  <!-- Popup Berhasil Scan QR Siswa (Mode Penjemputan) -->
  <div class="modal fade" id="modalScanSiswaBerhasil" tabindex="-1" role="dialog" aria-labelledby="modalScanSiswaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 12px 32px rgba(0,0,0,0.16); overflow: hidden;">
        <div class="modal-header" style="background: #16a34a; color: #ffffff; padding: 14px 20px; border: none;">
          <h5 class="modal-title" id="modalScanSiswaLabel" style="font-weight: 700; font-size: 15.5px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-circle-check"></i> Berhasil Scan QR Siswa
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.95; outline: none; background: none; border: none; font-size: 22px; cursor: pointer;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center" style="padding: 24px 22px 18px;">
          <div style="width: 58px; height: 58px; border-radius: 50%; background: #dcfce7; color: #16a34a; display: inline-flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 12px;">
            <i class="fa-solid fa-check"></i>
          </div>

          <h4 id="popupSiswaNama" style="font-weight: 800; color: #0f172a; margin-bottom: 4px; font-size: 19px;">-</h4>
          <div style="font-size: 12.5px; color: #64748b; margin-bottom: 14px;">
            NIS: <strong id="popupSiswaNis" style="color: #334155;">-</strong> &bull; Orang Tua: <strong id="popupSiswaOrtu" style="color: #166534;">-</strong>
          </div>

          <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 10px 14px; font-size: 12.5px; color: #166534; font-weight: 600;">
            Data siswa telah dicatat ke daftar <strong>Siswa Hadir / Siap Dijemput</strong>.
          </div>

          <div id="popupAlreadyNote" style="display: none; margin-top: 10px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 8px 12px; font-size: 11.5px; color: #92400e; font-weight: 600;"></div>
        </div>
        <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #f1f5f9; padding: 12px 20px; display: flex; justify-content: space-between; gap: 8px;">
          <button type="button" class="btn btn-outline-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px; font-size: 12.5px; padding: 7px 16px;">
            Tutup
          </button>
          <button type="button" id="btnPopupScanOrtu" class="btn btn-success font-weight-bold" style="border-radius: 8px; font-size: 12.5px; padding: 7px 16px; background: #16a34a;">
            <i class="fa-solid fa-qrcode mr-1"></i> Absen Pulang Sekarang
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
  #qrMainTabs .nav-link {
    color: #64748b;
    transition: all 0.2s ease;
  }
  #qrMainTabs .nav-link.active {
    background-color: #16a34a;
    color: #ffffff;
  }
  #qrMainTabs .nav-link.active .badge {
    background-color: #ffffff;
    color: #16a34a;
  }
  #qrMainTabs .nav-link:not(.active) .badge {
    background-color: #f1f5f9;
    color: #475569;
  }

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
  #readerAbsen__scan_region, #readerJemput__scan_region { min-height: 240px !important; }
  #readerAbsen video, #readerJemput video { border-radius: 10px !important; object-fit: cover !important; }
  #readerAbsen__dashboard_section_csr, #readerAbsen__dashboard_section_swaplink,
  #readerJemput__dashboard_section_csr, #readerJemput__dashboard_section_swaplink { display: none !important; }
  #readerAbsen__dashboard, #readerJemput__dashboard { padding: 0 !important; background: transparent !important; }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
  const csrfToken = '{{ csrf_token() }}';
  const activeTanggal = "{{ $tanggal }}";

  // Routes
  const routeScanAbsensi = "{{ route($routePrefix . '.absensi.scan') }}";
  const routeCekSiswa    = "{{ route($routePrefix . '.scan-qr.cek-siswa') }}";
  const routeAbsenSiswa  = "{{ route($routePrefix . '.scan-qr.absen-siswa') }}";
  const routeCekOrtu     = "{{ route($routePrefix . '.scan-qr.cek-ortu') }}";
  const routeSimpan      = "{{ route($routePrefix . '.scan-qr.simpan') }}";

  // Helper Alert
  function setAlertBox(el, message, type = 'error') {
    el.style.display = 'block';
    el.innerHTML = message;
    if (type === 'error') {
      el.style.background = '#fef2f2';
      el.style.border = '1px solid #fecaca';
      el.style.color = '#991b1b';
    } else if (type === 'success') {
      el.style.background = '#f0fdf4';
      el.style.border = '1px solid #bbf7d0';
      el.style.color = '#166534';
    } else {
      el.style.background = '#fffbeb';
      el.style.border = '1px solid #fef3c7';
      el.style.color = '#92400e';
    }
  }

  // ==================== LOGIC TAB 1: ABSENSI HADIR ====================
  let html5QrAbsen = null;
  let isScanningAbsen = false;
  let absenCooldown = false;

  const absenStatusBadge = document.getElementById('absenStatusBadge');
  const btnStartAbsen = document.getElementById('btnStartAbsen');
  const btnStopAbsen = document.getElementById('btnStopAbsen');
  const cameraSelectionAbsen = document.getElementById('cameraSelectionAbsen');
  const absenLaserLine = document.getElementById('absenLaserLine');
  const absenAlertFeedback = document.getElementById('absenAlertFeedback');
  const manualQrAbsen = document.getElementById('manualQrAbsen');
  const btnSubmitManualAbsen = document.getElementById('btnSubmitManualAbsen');

  function handleAbsenCode(code) {
    if (absenCooldown) return;
    absenCooldown = true;
    setTimeout(() => { absenCooldown = false; }, 1800);

    absenAlertFeedback.style.display = 'none';
    absenStatusBadge.textContent = 'Mencatat Absen...';

    fetch(routeScanAbsensi, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ kode: code, tanggal: activeTanggal })
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
          msgBox.innerHTML = 'Kehadiran siswa berhasil dicatat &amp; otomatis masuk ke tab Penjemputan Pulang.';

          updateAbsenTableRowLive(s.id_siswa, s.waktu_masuk);

          // Sinkronkan langsung ke daftar Tab 2 (Siswa Hadir / Siap Dijemput) jika ada ortu
          if (s.id_ortu_wali) {
            addWaitingItemToDom({
              id_siswa: s.id_siswa,
              nama: s.nama,
              nis: s.nis,
              jenis_kelamin: s.jenis_kelamin,
              tahun_ajaran: s.tahun_ajaran,
              id_ortu_wali: s.id_ortu_wali,
              nama_ortu: s.nama_ortu,
              no_telp_ortu: s.no_telp_ortu,
              waktu: s.waktu_masuk
            });
          }
        }

        $('#modalAbsenBerhasil').modal('show');
        absenStatusBadge.textContent = isScanningAbsen ? 'Memindai Siswa...' : 'Kamera Siap';
        absenStatusBadge.className = isScanningAbsen ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
      } else {
        setAlertBox(absenAlertFeedback, data.message || 'Data siswa tidak ditemukan.', 'error');
        absenStatusBadge.textContent = 'Tidak Ditemukan';
        absenStatusBadge.className = 'badge-pill badge-red';
      }
    })
    .catch(err => {
      console.error(err);
      setAlertBox(absenAlertFeedback, 'Gagal menghubungi server absensi.', 'error');
    });
  }

  function updateAbsenTableRowLive(idSiswa, waktuMasuk) {
    const row = document.getElementById('row-siswa-' + idSiswa);
    if (!row) return;
    const jamCell = row.querySelector('.col-jam-masuk');
    const statusCell = row.querySelector('.col-status-absen');
    const wasBelum = statusCell && statusCell.textContent.trim() === 'Belum Absen';

    if (jamCell) jamCell.textContent = waktuMasuk;
    if (statusCell) statusCell.innerHTML = '<span class="badge-pill badge-green">Hadir</span>';

    const hadirBadge = document.getElementById('countHadirBadge');
    const belumBadge = document.getElementById('countBelumBadge');
    if (hadirBadge) {
      const curr = parseInt(hadirBadge.textContent.replace(/\D/g, '')) || 0;
      hadirBadge.textContent = 'Hadir: ' + (curr + 1);
    }
    if (belumBadge && wasBelum) {
      const currB = Math.max(0, (parseInt(belumBadge.textContent.replace(/\D/g, '')) || 1) - 1);
      belumBadge.textContent = 'Belum: ' + currB;
    }
  }

  btnSubmitManualAbsen.addEventListener('click', function () {
    const val = manualQrAbsen.value.trim();
    if (val) {
      handleAbsenCode(val);
      manualQrAbsen.value = '';
    }
  });
  manualQrAbsen.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') btnSubmitManualAbsen.click();
  });

  function startAbsenCamera() {
    stopJemputCamera().then(() => {
      html5QrAbsen.start(
        { facingMode: cameraSelectionAbsen.value || "environment" },
        { fps: 10, qrbox: { width: 220, height: 220 }, aspectRatio: 1.0 },
        (decodedText) => handleAbsenCode(decodedText),
        () => {}
      ).then(() => {
        isScanningAbsen = true;
        btnStartAbsen.disabled = true;
        btnStopAbsen.disabled = false;
        absenLaserLine.style.display = 'block';
        absenStatusBadge.textContent = 'Memindai Siswa...';
        absenStatusBadge.className = 'badge-pill badge-green';
      }).catch((err) => {
        console.error(err);
        absenStatusBadge.textContent = 'Kamera Ditolak';
        absenStatusBadge.className = 'badge-pill badge-red';
        setAlertBox(absenAlertFeedback, 'Tidak dapat mengakses kamera. Pastikan izin kamera diberikan di browser.', 'error');
      });
    });
  }

  function stopAbsenCamera() {
    if (html5QrAbsen && isScanningAbsen) {
      return html5QrAbsen.stop().then(() => {
        isScanningAbsen = false;
        btnStartAbsen.disabled = false;
        btnStopAbsen.disabled = true;
        absenLaserLine.style.display = 'none';
        absenStatusBadge.textContent = 'Kamera Berhenti';
        absenStatusBadge.className = 'badge-pill badge-yellow';
      }).catch(() => {});
    }
    return Promise.resolve();
  }

  // ==================== LOGIC TAB 2: PENJEMPUTAN PULANG ====================
  let html5QrJemput = null;
  let isScanningJemput = false;
  let jemputStep = 1; // 1 = Scan Siswa, 2 = Scan Ortu
  let activeSiswa = null;
  let lastScannedSiswa = null;
  let jemputCooldown = false;

  const jemputStatusBadge = document.getElementById('jemputStatusBadge');
  const btnStartJemput = document.getElementById('btnStartJemput');
  const btnStopJemput = document.getElementById('btnStopJemput');
  const cameraSelectionJemput = document.getElementById('cameraSelectionJemput');
  const jemputLaserLine = document.getElementById('jemputLaserLine');
  const jemputScannerTitle = document.getElementById('jemputScannerTitle');
  const jemputScannerHint = document.getElementById('jemputScannerHint');
  const jemputManualHint = document.getElementById('jemputManualHint');
  const manualQrJemput = document.getElementById('manualQrJemput');
  const btnSubmitManualJemput = document.getElementById('btnSubmitManualJemput');

  const btnResetJemput = document.getElementById('btnResetJemput');
  const jemputAlertFeedback = document.getElementById('jemputAlertFeedback');
  const stateJemputInitial = document.getElementById('stateJemputInitial');
  const stateJemputSiswa = document.getElementById('stateJemputSiswa');
  const promptScanOrtu = document.getElementById('promptScanOrtu');
  const stateOrtuMatched = document.getElementById('stateOrtuMatched');
  const stateOrtuMismatch = document.getElementById('stateOrtuMismatch');

  const waitingListContainer = document.getElementById('waitingListContainer');
  const emptyWaitingMessage = document.getElementById('emptyWaitingMessage');
  const waitingCountBadge = document.getElementById('waitingCountBadge');
  const tabWaitingBadge = document.getElementById('tabWaitingBadge');

  const riwayatListContainer = document.getElementById('riwayatListContainer');
  const emptyRiwayatMessage = document.getElementById('emptyRiwayatMessage');
  const todayCountBadge = document.getElementById('todayCountBadge');

  function setJemputStep1(keepAlert = false) {
    jemputStep = 1;
    activeSiswa = null;
    jemputScannerTitle.textContent = 'Kamera Pemindai (Siswa)';
    jemputScannerHint.textContent = 'Klik "Absen Pulang" pada daftar siswa atau pindai QR Siswa';
    manualQrJemput.placeholder = 'Contoh: SISWA-TK-001 atau NIS...';
    jemputManualHint.textContent = 'Ketik QR Code atau NIS siswa lalu tekan Periksa.';

    stateJemputInitial.style.display = 'block';
    stateJemputSiswa.style.display = 'none';
    promptScanOrtu.style.display = 'none';
    stateOrtuMatched.style.display = 'none';
    stateOrtuMismatch.style.display = 'none';
    btnResetJemput.style.display = 'none';
    if (!keepAlert) jemputAlertFeedback.style.display = 'none';

    jemputStatusBadge.textContent = isScanningJemput ? 'Memindai Siswa...' : 'Kamera Siap';
    jemputStatusBadge.className = isScanningJemput ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
  }

  function setJemputStep2(siswa) {
    jemputStep = 2;
    activeSiswa = siswa;
    jemputScannerTitle.textContent = 'Kamera Pemindai (Orang Tua)';
    jemputScannerHint.textContent = 'Arahkan kamera ke QR Penjemput untuk ' + siswa.nama;
    manualQrJemput.placeholder = 'Ketik QR Code / ID Orang Tua...';
    jemputManualHint.textContent = 'Ketik kode QR penjemput lalu tekan Periksa.';

    stateJemputInitial.style.display = 'none';
    stateJemputSiswa.style.display = 'block';
    promptScanOrtu.style.display = 'block';
    stateOrtuMatched.style.display = 'none';
    stateOrtuMismatch.style.display = 'none';
    btnResetJemput.style.display = 'inline-block';

    document.getElementById('viewJemputSiswaNama').textContent = siswa.nama;
    document.getElementById('viewJemputSiswaNis').textContent = siswa.nis || '-';
    document.getElementById('viewJemputSiswaOrtu').textContent = siswa.nama_ortu || '-';
    document.getElementById('viewJemputSiswaOrtuTelp').textContent = siswa.no_telp_ortu ? '(' + siswa.no_telp_ortu + ')' : '';

    jemputStatusBadge.textContent = isScanningJemput ? 'Memindai Ortu...' : 'Siap Scan Ortu';
    jemputStatusBadge.className = isScanningJemput ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
  }

  function handleJemputCode(code) {
    if (jemputCooldown) return;
    jemputCooldown = true;
    setTimeout(() => { jemputCooldown = false; }, 1800);

    if (jemputStep === 1) {
      processJemputStep1Siswa(code);
    } else if (jemputStep === 2) {
      processJemputStep2Ortu(code);
    }
  }

  function processJemputStep1Siswa(kode) {
    jemputAlertFeedback.style.display = 'none';
    jemputStatusBadge.textContent = 'Memeriksa Siswa...';

    fetch(routeCekSiswa, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ kode: kode })
    })
    .then(res => res.json())
    .then(data => {
      if (data.success && data.siswa) {
        lastScannedSiswa = data.siswa;

        fetch(routeAbsenSiswa, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({ id_siswa: data.siswa.id_siswa })
        })
        .then(r => r.json())
        .then(resAbsen => {
          if (resAbsen.success && resAbsen.data && !resAbsen.already_exists) {
            addWaitingItemToDom(resAbsen.data);
          }
        })
        .catch(() => {});

        document.getElementById('popupSiswaNama').textContent = data.siswa.nama;
        document.getElementById('popupSiswaNis').textContent = data.siswa.nis || '-';
        document.getElementById('popupSiswaOrtu').textContent = data.siswa.nama_ortu || '-';

        const noteEl = document.getElementById('popupAlreadyNote');
        if (data.sudah_dijemput) {
          noteEl.style.display = 'block';
          noteEl.innerHTML = 'Catatan: Siswa ini sudah selesai dijemput sebelumnya pada pukul ' + data.sudah_dijemput.waktu + '.';
        } else {
          noteEl.style.display = 'none';
        }

        $('#modalScanSiswaBerhasil').modal('show');
        setJemputStep1(false);
      } else {
        setAlertBox(jemputAlertFeedback, data.message || 'Data siswa tidak ditemukan.', 'error');
        jemputStatusBadge.textContent = 'Tidak Ditemukan';
        jemputStatusBadge.className = 'badge-pill badge-red';
      }
    })
    .catch(() => setAlertBox(jemputAlertFeedback, 'Gagal menghubungi server.', 'error'));
  }

  document.getElementById('btnPopupScanOrtu').addEventListener('click', function () {
    if (!lastScannedSiswa) return;
    $('#modalScanSiswaBerhasil').modal('hide');
    setJemputStep2(lastScannedSiswa);
    setAlertBox(jemputAlertFeedback, 'Siap memindai QR Orang Tua untuk menjemput <strong>' + lastScannedSiswa.nama + '</strong>.', 'success');
  });

  $(document).on('click', '.btn-scan-ortu-waiting', function () {
    const siswaObj = {
      id_siswa: $(this).data('id'),
      nama: $(this).data('nama'),
      nis: $(this).data('nis'),
      jenis_kelamin: $(this).data('jk'),
      tahun_ajaran: $(this).data('ta'),
      id_ortu_wali: $(this).data('id-ortu'),
      nama_ortu: $(this).data('nama-ortu'),
      no_telp_ortu: $(this).data('telp-ortu')
    };

    setJemputStep2(siswaObj);
    setAlertBox(jemputAlertFeedback, 'Siap memindai QR Orang Tua untuk menjemput <strong>' + siswaObj.nama + '</strong>.', 'success');
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  function processJemputStep2Ortu(kodeOrtu) {
    if (!activeSiswa) return;
    jemputAlertFeedback.style.display = 'none';
    jemputStatusBadge.textContent = 'Memverifikasi Penjemput...';

    fetch(routeCekOrtu, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ id_siswa: activeSiswa.id_siswa, kode_ortu: kodeOrtu })
    })
    .then(res => res.json())
    .then(data => {
      promptScanOrtu.style.display = 'none';

      if (data.success && data.matched) {
        stateOrtuMatched.style.display = 'block';
        stateOrtuMismatch.style.display = 'none';
        document.getElementById('viewOrtuNama').textContent = data.penjemput.nama;
        document.getElementById('viewOrtuTelp').textContent = data.penjemput.no_telp || '-';
        document.getElementById('inputJemputSiswaId').value = activeSiswa.id_siswa;
        document.getElementById('inputJemputOrtuId').value = data.penjemput.id_ortu_wali;
        document.getElementById('inputJemputKet').value = 'Dijemput oleh ' + data.penjemput.nama;

        jemputStatusBadge.textContent = 'Penjemput Cocok!';
        jemputStatusBadge.className = 'badge-pill badge-green';
      } else {
        stateOrtuMatched.style.display = 'none';
        stateOrtuMismatch.style.display = 'block';

        const mismatchEl = document.getElementById('mismatchMessage');
        if (data.penjemput) {
          mismatchEl.innerHTML = 'QR Code terdeteksi atas nama <strong>' + data.penjemput.nama + '</strong>, namun orang tua terdaftar dari <strong>' + (data.siswa ? data.siswa.nama : 'siswa') + '</strong> adalah <strong>' + (data.siswa ? data.siswa.nama_ortu_sah : '-') + '</strong>.';
        } else {
          mismatchEl.textContent = data.message || 'QR Code penjemput tidak terdaftar atau tidak cocok.';
        }
        jemputStatusBadge.textContent = 'Penjemput Tidak Cocok';
        jemputStatusBadge.className = 'badge-pill badge-red';
      }
    })
    .catch(() => setAlertBox(jemputAlertFeedback, 'Gagal memverifikasi data penjemput.', 'error'));
  }

  document.getElementById('formSimpanPenjemputan').addEventListener('submit', function (e) {
    e.preventDefault();
    const btn = document.getElementById('btnKonfirmasiPenjemputan');
    btn.disabled = true;
    btn.textContent = 'Menyimpan...';

    fetch(routeSimpan, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
      body: new FormData(this)
    })
    .then(res => res.json())
    .then(data => {
      btn.disabled = false;
      btn.textContent = 'Konfirmasi & Simpan Penjemputan';

      if (data.success && data.data) {
        setAlertBox(jemputAlertFeedback, '<i class="fa-solid fa-circle-check mr-1"></i> ' + data.message, 'success');
        removeWaitingItemFromDom(data.data.id_siswa);
        addRiwayatItemToDom(data.data);
        setTimeout(() => setJemputStep1(), 2000);
      } else {
        setAlertBox(jemputAlertFeedback, data.message || 'Gagal menyimpan penjemputan.', 'error');
      }
    })
    .catch(() => {
      btn.disabled = false;
      btn.textContent = 'Konfirmasi & Simpan Penjemputan';
      setAlertBox(jemputAlertFeedback, 'Terjadi kesalahan koneksi saat menyimpan.', 'error');
    });
  });

  function addWaitingItemToDom(item) {
    if (emptyWaitingMessage) emptyWaitingMessage.style.display = 'none';
    if (waitingListContainer.querySelector(`.waiting-item[data-id-siswa="${item.id_siswa}"]`)) return;

    const div = document.createElement('div');
    div.className = 'waiting-item';
    div.setAttribute('data-id-siswa', item.id_siswa);
    div.style.cssText = 'background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 10px 12px; display: flex; align-items: center; justify-content: space-between; gap: 10px;';
    div.innerHTML = `
      <div>
        <div style="font-size: 13px; font-weight: 700; color: #1e293b;">${item.nama}</div>
        <div style="font-size: 11px; color: #64748b;">
          NIS: ${item.nis || '-'} &bull; Ortu: ${item.nama_ortu || '-'} &bull; Hadir: ${item.waktu}
        </div>
      </div>
      <div style="flex-shrink: 0;">
        <button type="button" class="btn btn-sm btn-success font-weight-bold btn-scan-ortu-waiting"
          style="border-radius: 7px; font-size: 11.5px; padding: 5px 12px;"
          data-id="${item.id_siswa}"
          data-nama="${item.nama}"
          data-nis="${item.nis || '-'}"
          data-jk="${item.jenis_kelamin || '-'}"
          data-ta="${item.tahun_ajaran || '-'}"
          data-id-ortu="${item.id_ortu_wali}"
          data-nama-ortu="${item.nama_ortu || '-'}"
          data-telp-ortu="${item.no_telp_ortu || '-'}">
          <i class="fa-solid fa-qrcode mr-1"></i> Absen Pulang
        </button>
      </div>
    `;
    waitingListContainer.prepend(div);

    const curr = parseInt(waitingCountBadge.textContent) || 0;
    waitingCountBadge.textContent = (curr + 1) + ' Menunggu';
    if (tabWaitingBadge) tabWaitingBadge.textContent = (curr + 1);
  }

  function removeWaitingItemFromDom(idSiswa) {
    const el = waitingListContainer.querySelector(`.waiting-item[data-id-siswa="${idSiswa}"]`);
    if (el) {
      el.remove();
      const curr = Math.max(0, (parseInt(waitingCountBadge.textContent) || 1) - 1);
      waitingCountBadge.textContent = curr + ' Menunggu';
      if (tabWaitingBadge) tabWaitingBadge.textContent = curr;
      if (curr === 0 && emptyWaitingMessage) emptyWaitingMessage.style.display = 'block';
    }
  }

  function addRiwayatItemToDom(item) {
    if (emptyRiwayatMessage) emptyRiwayatMessage.style.display = 'none';
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
    const curr = parseInt(todayCountBadge.textContent) || 0;
    todayCountBadge.textContent = (curr + 1) + ' Tercatat';
  }

  document.getElementById('btnRetryOrtu').addEventListener('click', function () {
    stateOrtuMismatch.style.display = 'none';
    promptScanOrtu.style.display = 'block';
    jemputStatusBadge.textContent = isScanningJemput ? 'Memindai Ortu...' : 'Kamera Siap';
    jemputStatusBadge.className = isScanningJemput ? 'badge-pill badge-green' : 'badge-pill badge-yellow';
  });

  btnResetJemput.addEventListener('click', () => setJemputStep1(false));
  document.getElementById('btnCancelToStart').addEventListener('click', () => setJemputStep1(false));

  btnSubmitManualJemput.addEventListener('click', function () {
    const val = manualQrJemput.value.trim();
    if (val) {
      handleJemputCode(val);
      manualQrJemput.value = '';
    }
  });
  manualQrJemput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') btnSubmitManualJemput.click();
  });

  function startJemputCamera() {
    stopAbsenCamera().then(() => {
      html5QrJemput.start(
        { facingMode: cameraSelectionJemput.value || "environment" },
        { fps: 10, qrbox: { width: 220, height: 220 }, aspectRatio: 1.0 },
        (decodedText) => handleJemputCode(decodedText),
        () => {}
      ).then(() => {
        isScanningJemput = true;
        btnStartJemput.disabled = true;
        btnStopJemput.disabled = false;
        jemputLaserLine.style.display = 'block';
        jemputStatusBadge.textContent = jemputStep === 1 ? 'Memindai Siswa...' : 'Memindai Ortu...';
        jemputStatusBadge.className = 'badge-pill badge-green';
      }).catch((err) => {
        console.error(err);
        jemputStatusBadge.textContent = 'Kamera Ditolak';
        jemputStatusBadge.className = 'badge-pill badge-red';
        setAlertBox(jemputAlertFeedback, 'Tidak dapat mengakses kamera. Pastikan izin kamera diberikan di browser.', 'error');
      });
    });
  }

  function stopJemputCamera() {
    if (html5QrJemput && isScanningJemput) {
      return html5QrJemput.stop().then(() => {
        isScanningJemput = false;
        btnStartJemput.disabled = false;
        btnStopJemput.disabled = true;
        jemputLaserLine.style.display = 'none';
        jemputStatusBadge.textContent = 'Kamera Berhenti';
        jemputStatusBadge.className = 'badge-pill badge-yellow';
      }).catch(() => {});
    }
    return Promise.resolve();
  }

  // ==================== INISIALISASI HALAMAN ====================
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

    // Init both scanner instances
    html5QrAbsen = new Html5Qrcode("readerAbsen");
    html5QrJemput = new Html5Qrcode("readerJemput");

    btnStartAbsen.addEventListener('click', startAbsenCamera);
    btnStopAbsen.addEventListener('click', stopAbsenCamera);
    cameraSelectionAbsen.addEventListener('change', () => {
      if (isScanningAbsen) stopAbsenCamera().then(() => startAbsenCamera());
    });

    btnStartJemput.addEventListener('click', startJemputCamera);
    btnStopJemput.addEventListener('click', stopJemputCamera);
    cameraSelectionJemput.addEventListener('change', () => {
      if (isScanningJemput) stopJemputCamera().then(() => startJemputCamera());
    });

    // Stop camera cleanly saat pindah tab
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
      if (e.target.id === 'tab-penjemputan-link') {
        stopAbsenCamera();
      } else {
        stopJemputCamera();
      }
    });

    setJemputStep1();
  });
</script>
@endsection
