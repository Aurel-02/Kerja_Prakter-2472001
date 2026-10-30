@extends('layouts.public')

@section('title', 'TK Harapan Bunda - Galeri Foto Kegiatan')

@section('top_container')
  @include('public.navbar.navbar')
@endsection

@section('content')

  {{-- Galeri Section --}}
  <section class="galeri_section layout_padding">
    <div class="container">

      <div class="d-flex justify-content-center align-items-center mb-2">
        <h2 class="main-heading mb-0">
          Foto Kegiatan Sekolah
        </h2>
        <a href="{{ route('admin.galeri') }}" class="btn btn-sm btn-outline-success ml-3" style="border-radius: 20px; font-size: 12px; font-weight: 600;" title="Kelola Galeri di Admin">
          <i class="fa fa-pencil"></i> Kelola Galeri
        </a>
      </div>
      <p class="text-center mb-4">
        Momen-momen berharga dan kenangan indah bersama anak-anak TK Harapan Bunda.
      </p>

      {{-- Filter Tabs --}}
      <div class="galeri-filter-tabs d-flex justify-content-center flex-wrap mb-5">
        <button class="galeri-filter-btn active" data-filter="all" id="filter-all">Semua</button>
        <button class="galeri-filter-btn" data-filter="pentas" id="filter-pentas">Pentas Seni</button>
        <button class="galeri-filter-btn" data-filter="lomba" id="filter-lomba">Lomba</button>
        <button class="galeri-filter-btn" data-filter="kegiatan" id="filter-kegiatan">Kegiatan Belajar</button>
        <button class="galeri-filter-btn" data-filter="fasilitas" id="filter-fasilitas">Fasilitas</button>
      </div>

      {{-- Gallery Grid --}}
      <div class="galeri-masonry-grid" id="galeriGrid">

        @forelse($galeriList as $item)
          @php
            $cat = strtolower($item->kategori ?? 'kegiatan');
            $filterCat = 'kegiatan';
            if (str_contains($cat, 'fasilitas')) $filterCat = 'fasilitas';
            elseif (str_contains($cat, 'lomba')) $filterCat = 'lomba';
            elseif (str_contains($cat, 'pentas')) $filterCat = 'pentas';
            elseif (str_contains($cat, 'wisuda')) $filterCat = 'wisuda';
          @endphp
          <div class="galeri-item" data-category="{{ $filterCat }}">
            <div class="galeri-img-wrap">
              <img src="{{ asset($item->link_foto) }}" alt="{{ $item->judul }}" class="galeri-img">
              <div class="galeri-overlay">
                <div class="galeri-overlay-content">
                  <i class="fa fa-search-plus galeri-zoom-icon"></i>
                  <h5 class="galeri-img-title">{{ $item->judul }}</h5>
                  <span class="galeri-img-tag">{{ $item->kategori ?? 'Dokumentasi' }}</span>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center text-muted py-5">Belum ada foto galeri terpasang.</div>
        @endforelse

      </div>

      {{-- Empty State --}}
      <div class="galeri-empty-state d-none text-center py-5" id="emptyState">
        <p class="text-muted" style="font-size: 1.1rem;">Belum ada foto untuk kategori ini.</p>
      </div>

      {{-- CTA --}}
      <div class="d-flex justify-content-center mt-5">
        <a href="{{ route('contact') }}" class="call_to-btn">
          <span>Hubungi Kami</span>
          <img src="{{ asset('adward/images/right-arrow.png') }}" alt="">
        </a>
      </div>

    </div>
  </section>

  {{-- Lightbox Modal --}}
  <div class="galeri-lightbox-overlay" id="lightboxOverlay">
    <div class="galeri-lightbox-container">
      <button class="galeri-lightbox-close" id="lightboxClose">
        <i class="fa fa-times"></i>
      </button>
      <button class="galeri-lightbox-nav galeri-lightbox-prev" id="lightboxPrev">
        <i class="fa fa-chevron-left"></i>
      </button>
      <div class="galeri-lightbox-img-wrap">
        <img src="" alt="" class="galeri-lightbox-img" id="lightboxImg">
        <div class="galeri-lightbox-caption" id="lightboxCaption"></div>
      </div>
      <button class="galeri-lightbox-nav galeri-lightbox-next" id="lightboxNext">
        <i class="fa fa-chevron-right"></i>
      </button>
    </div>
  </div>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {

    // === Filter Logic ===
    var filterBtns = document.querySelectorAll('.galeri-filter-btn');
    var galeriItems = document.querySelectorAll('.galeri-item');
    var emptyState = document.getElementById('emptyState');

    filterBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        filterBtns.forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        var filter = btn.getAttribute('data-filter');
        var count = 0;
        galeriItems.forEach(function (item) {
          if (filter === 'all' || item.getAttribute('data-category') === filter) {
            item.style.display = '';
            count++;
          } else {
            item.style.display = 'none';
          }
        });
        emptyState.classList.toggle('d-none', count > 0);
      });
    });

    // === Lightbox Logic ===
    var overlay    = document.getElementById('lightboxOverlay');
    var lbImg      = document.getElementById('lightboxImg');
    var lbCaption  = document.getElementById('lightboxCaption');
    var closeBtn   = document.getElementById('lightboxClose');
    var prevBtn    = document.getElementById('lightboxPrev');
    var nextBtn    = document.getElementById('lightboxNext');
    var currentIdx = 0;
    var visible    = [];

    function refreshVisible() {
      visible = Array.from(galeriItems).filter(function (i) { return i.style.display !== 'none'; });
    }

    function showLightbox(idx) {
      refreshVisible();
      currentIdx = (idx + visible.length) % visible.length;
      var item   = visible[currentIdx];
      var img    = item.querySelector('.galeri-img');
      var title  = item.querySelector('.galeri-img-title').textContent;
      var tag    = item.querySelector('.galeri-img-tag').textContent;
      lbImg.src  = img.src;
      lbImg.alt  = img.alt;
      lbCaption.innerHTML = '<strong>' + title + '</strong>&ensp;<span style="color:#fec913;">' + tag + '</span>';
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function hideLightbox() {
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    galeriItems.forEach(function (item, i) {
      item.addEventListener('click', function () {
        refreshVisible();
        var vi = visible.indexOf(item);
        if (vi !== -1) { showLightbox(vi); }
      });
    });

    closeBtn.addEventListener('click', hideLightbox);
    overlay.addEventListener('click', function (e) { if (e.target === overlay) { hideLightbox(); } });
    prevBtn.addEventListener('click', function () { showLightbox(currentIdx - 1); });
    nextBtn.addEventListener('click', function () { showLightbox(currentIdx + 1); });
    document.addEventListener('keydown', function (e) {
      if (!overlay.classList.contains('active')) { return; }
      if (e.key === 'Escape')      { hideLightbox(); }
      if (e.key === 'ArrowLeft')   { showLightbox(currentIdx - 1); }
      if (e.key === 'ArrowRight')  { showLightbox(currentIdx + 1); }
    });

  });
</script>
@endsection
