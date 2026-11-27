@extends('layouts.guru')

@section('title', 'Kurikulum Belajar - Portal Guru')

@section('content')

  <!-- Judul Halaman -->
  <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin-bottom: 22px; gap: 12px;">
    <div>
      <h1 class="page-header-title">Kurikulum Belajar</h1>
      <p class="page-header-sub mb-0">Daftar pilar nilai pembelajaran, karakter unggulan, dan kurikulum merdeka PAUD di TK Harapan Bunda.</p>
    </div>
    <span class="badge-pill badge-green" style="font-size: 12px; padding: 6px 14px;">{{ $kurikulumList->count() }} Pilar Kurikulum</span>
  </div>

  <div class="admin-card">
    <div class="table-responsive" style="margin: 0 -8px;">
      <table id="tableGuruKurikulum" class="custom-table" style="width:100%">
        <thead>
          <tr>
            <th style="width: 50px; text-align: center;">No</th>
            <th style="width: 180px;">Kategori</th>
            <th style="width: 220px;">Judul / Karakter</th>
            <th>Deskripsi Pembelajaran</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kurikulumList as $index => $item)
          <tr>
            <td class="text-muted" style="text-align: center;">{{ $index + 1 }}</td>
            <td><span class="badge-pill badge-green">{{ $item->kategori }}</span></td>
            <td>
              <div style="font-weight: 700; color: #1e293b; font-size: 13.5px;">{{ $item->judul }}</div>
            </td>
            <td class="text-muted" style="line-height: 1.55;">{{ $item->deskripsi }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center py-4 text-muted">Belum ada data kurikulum pembelajaran terdaftar.</td>
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
    $('#tableGuruKurikulum').DataTable({
      language: {
        search: 'Cari:',
        lengthMenu: 'Tampilkan _MENU_ data',
        info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ kurikulum',
        infoEmpty: 'Tidak ada data yang tersedia',
        infoFiltered: '(difilter dari _MAX_ total kurikulum)',
        paginate: {
          first: 'Pertama',
          last: 'Terakhir',
          next: 'Berikutnya',
          previous: 'Sebelumnya'
        },
        zeroRecords: 'Tidak ada kurikulum yang cocok dengan pencarian',
        emptyTable: 'Belum ada data kurikulum pembelajaran.'
      },
      pageLength: 10,
      order: [[0, 'asc']]
    });
  });
</script>
@endsection
