@extends('layouts.guru')

@section('title', 'Kalender Akademik - Portal Guru')

@section('content')

  <!-- Judul Halaman -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Kalender Akademik</h1>
      <p class="page-header-sub mb-0">Daftar agenda kegiatan belajar mengajar, peringatan hari besar, dan jadwal evaluasi semester di TK Harapan Bunda.</p>
    </div>
    <span class="badge-pill badge-green" style="font-size: 12px; padding: 6px 14px;">{{ $kalenderList->count() }} Agenda Terdaftar</span>
  </div>

  <div class="admin-card">
    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableGuruKalender" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th style="width: 190px;">Tanggal / Periode</th>
            <th>Nama Kegiatan</th>
            <th style="width: 120px;">Tahun Ajaran</th>
            <th style="width: 130px;">Kategori</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kalenderList as $index => $item)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td style="font-weight: 600; color: #1e293b;">
              @if($item->tanggal_mulai == $item->tanggal_selesai)
                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
              @else
                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M') }} – {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') }}
              @endif
            </td>
            <td style="font-weight: 700; color: #1e293b;">{{ $item->judul_kegiatan }}</td>
            <td><span class="badge-pill badge-blue">{{ $item->tahun_ajaran }}</span></td>
            <td>
              <span class="badge-pill {{ str_contains(strtolower($item->kategori ?? ''), 'libur') ? 'badge-yellow' : 'badge-green' }}">
                {{ $item->kategori ?? 'Kegiatan' }}
              </span>
            </td>
            <td class="text-muted">{{ $item->keterangan ?? '-' }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-4 text-muted">Belum ada agenda kegiatan kalender akademik terdaftar.</td>
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
    $('#tableGuruKalender').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ agenda',
        infoEmpty: 'Tidak ada data yang tersedia',
        infoFiltered: '(difilter dari _MAX_ total agenda)',
        paginate: {
          first: 'Pertama',
          last: 'Terakhir',
          next: 'Berikutnya',
          previous: 'Sebelumnya'
        },
        zeroRecords: 'Tidak ada agenda yang cocok dengan pencarian',
        emptyTable: 'Belum ada agenda kegiatan kalender akademik.'
      },
      pageLength: 10,
      order: [[0, 'asc']]
    });
  });
</script>
@endsection
