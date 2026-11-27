@extends(auth()->check() && auth()->user()->role === 'admin' ? 'layouts.admin' : 'layouts.guru')

@section('title', 'Riwayat Presensi - ' . (auth()->check() && auth()->user()->role === 'admin' ? 'Portal Admin' : 'Portal Guru'))

@section('content')

  @php
    $routePrefix = request()->routeIs('admin.*') ? 'admin' : 'guru';
  @endphp

  <!-- Judul Halaman -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 20px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Riwayat Presensi &amp; Penjemputan</h1>
      <p class="page-header-sub mb-0">Catatan lengkap kehadiran harian serta status kepulangan / penjemputan siswa.</p>
    </div>

    <div class="d-flex flex-wrap" style="gap: 6px;">
      <span class="badge-pill badge-green">Hadir: {{ $totalHadir }}</span>
      <span class="badge-pill badge-blue">Izin: {{ $totalIzin }}</span>
      <span class="badge-pill badge-yellow">Sakit: {{ $totalSakit }}</span>
      <span class="badge-pill badge-red">Alpha: {{ $totalAlpha }}</span>
    </div>
  </div>

  <!-- Filter Tanggal & Status -->
  <div class="admin-card mb-4" style="padding: 16px 20px;">
    <form action="{{ route($routePrefix . '.riwayat-presensi') }}" method="GET" class="row align-items-end" style="gap: 10px 0;">
      <div class="col-md-3 col-sm-6">
        <label style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Dari Tanggal</label>
        <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="form-control" style="border-radius: 8px; font-size: 13px;">
      </div>
      <div class="col-md-3 col-sm-6">
        <label style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Sampai Tanggal</label>
        <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}" class="form-control" style="border-radius: 8px; font-size: 13px;">
      </div>
      <div class="col-md-3 col-sm-6">
        <label style="font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 4px;">Status Kehadiran</label>
        <select name="status" class="form-control" style="border-radius: 8px; font-size: 13px;">
          <option value="all" {{ $statusFilter === 'all' ? 'selected' : '' }}>Semua Status</option>
          <option value="hadir" {{ $statusFilter === 'hadir' ? 'selected' : '' }}>Hadir</option>
          <option value="izin" {{ $statusFilter === 'izin' ? 'selected' : '' }}>Izin</option>
          <option value="sakit" {{ $statusFilter === 'sakit' ? 'selected' : '' }}>Sakit</option>
          <option value="alpha" {{ $statusFilter === 'alpha' ? 'selected' : '' }}>Alpha</option>
        </select>
      </div>
      <div class="col-md-3 col-sm-6 d-flex" style="gap: 8px;">
        <button type="submit" class="btn-brand-primary flex-fill justify-content-center" style="padding: 8px 14px; font-size: 13px;">
          <i class="fa-solid fa-filter"></i> Filter
        </button>
        <a href="{{ route($routePrefix . '.riwayat-presensi') }}" class="btn btn-outline-secondary font-weight-bold" style="border-radius: 10px; font-size: 13px; padding: 8px 14px;">
          Reset
        </a>
      </div>
    </form>
  </div>

  <!-- Tabel Riwayat Presensi -->
  <div class="admin-card">
    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableRiwayatPresensi" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 45px; text-align: center;">No</th>
            <th style="width: 115px;">Tanggal</th>
            <th>Nama Siswa</th>
            <th style="width: 100px; text-align: center;">Status</th>
            <th style="width: 100px; text-align: center;">Jam Masuk</th>
            <th style="width: 165px; text-align: center;">Status Pulang</th>
            <th>Penjemput / Keterangan</th>
            <th style="width: 130px;">Petugas</th>
          </tr>
        </thead>
        <tbody>
          @forelse($riwayatList as $index => $item)
            @php
              $tglKey = $item->id_siswa . '_' . \Carbon\Carbon::parse($item->tanggal)->toDateString();
              $jemput = $penjemputanMap->get($tglKey);
            @endphp
            <tr>
              <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
              <td style="font-weight: 600; color: #334155; font-size: 12.5px;">
                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
              </td>
              <td>
                <div style="font-weight: 700; color: #1e293b; font-size: 13px;">{{ $item->siswa->nama ?? '-' }}</div>
                <div style="font-size: 11px; color: #64748b;">NIS: {{ $item->siswa->nis ?? '-' }}</div>
              </td>
              <td style="text-align: center;">
                @if($item->status === 'hadir')
                  <span class="badge-pill badge-green">Hadir</span>
                @elseif($item->status === 'izin')
                  <span class="badge-pill badge-blue">Izin</span>
                @elseif($item->status === 'sakit')
                  <span class="badge-pill badge-yellow">Sakit</span>
                @else
                  <span class="badge-pill badge-red">Alpha</span>
                @endif
              </td>
              <td style="text-align: center; font-size: 12.5px; font-weight: 600; color: #334155;">
                {{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i') . ' WIB' : '-' }}
              </td>
              <td style="text-align: center;">
                @if($jemput && $jemput->status === 'selesai')
                  <span class="badge-pill badge-green" style="font-size: 11px;">
                    Pulang ({{ \Carbon\Carbon::parse($jemput->waktu)->format('H:i') }} WIB)
                  </span>
                @elseif($jemput && $jemput->status === 'menunggu')
                  <span class="badge-pill badge-yellow" style="font-size: 11px;">Menunggu Jemput</span>
                @else
                  <span class="text-muted" style="font-size: 12px;">-</span>
                @endif
              </td>
              <td class="text-muted" style="font-size: 12px;">
                @if($jemput && $jemput->status === 'selesai')
                  <strong style="color: #1e293b;">{{ $jemput->orangTua->nama ?? '-' }}</strong>
                  @if($jemput->keterangan)
                    <div>{{ $jemput->keterangan }}</div>
                  @endif
                @else
                  {{ $item->keterangan ?? '-' }}
                @endif
              </td>
              <td class="text-muted" style="font-size: 12px;">
                {{ $item->user->nama ?? '-' }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center py-4 text-muted">Belum ada catatan riwayat presensi pada rentang tanggal ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    $('#tableRiwayatPresensi').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ catatan',
        infoEmpty: 'Tidak ada catatan',
        infoFiltered: '(difilter dari _MAX_ total catatan)',
        paginate: {
          first: 'Pertama',
          last: 'Terakhir',
          next: 'Berikutnya',
          previous: 'Sebelumnya'
        },
        zeroRecords: 'Tidak ada catatan presensi yang cocok',
        emptyTable: 'Belum ada catatan presensi.'
      },
      pageLength: 15,
      order: [[0, 'asc']]
    });
  });
</script>
@endsection
