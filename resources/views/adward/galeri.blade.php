@extends('layouts.adward')

@section('title', 'TK Harapan Bunda - Galeri Foto Kegiatan')

@section('top_container')
  @include('adward.partials.navbar')
@endsection

@section('content')

  {{-- Galeri Section --}}
  <section class="galeri_section layout_padding">
    <div class="container">

      <h2 class="main-heading">
        Foto Kegiatan Sekolah
      </h2>
      <p class="text-center mb-4">
        Momen-momen berharga dan kenangan indah bersama anak-anak TK Harapan Bunda.
      </p>

      {{-- Filter Tabs --}}
      <div class="galeri-filter-tabs d-flex justify-content-center flex-wrap mb-5">
        <button class="galeri-filter-btn active" data-filter="all" id="filter-all">Semua</button>
        <button class="galeri-filter-btn" data-filter="pentas" id="filter-pentas">Pentas Seni</button>
        <button class="galeri-filter-btn" data-filter="lomba" id="filter-lomba">Lomba</button>
        <button class="galeri-filter-btn" data-filter="kegiatan" id="filter-kegiatan">Kegiatan Belajar</button>
        <button class="galeri-filter-btn" data-filter="wisuda" id="filter-wisuda">Wisuda</button>
      </div>

      {{-- Gallery Grid --}}
      <div class="galeri-masonry-grid" id="galeriGrid">

        {{-- Item 1 --}}
        <div class="galeri-item" data-category="pentas">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/kids.jpg') }}" alt="Pentas Seni Anak" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Pentas Seni</h5>
                <span class="galeri-img-tag">Desember 2025</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 2 --}}
        <div class="galeri-item" data-category="lomba">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/kidss.jpg') }}" alt="Lomba Agustusan" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Lomba Agustusan</h5>
                <span class="galeri-img-tag">Agustus 2025</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 3 --}}
        <div class="galeri-item" data-category="kegiatan">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/harbun.png') }}" alt="Kegiatan Belajar" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Kegiatan Belajar</h5>
                <span class="galeri-img-tag">2025/2026</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 4 - Wide --}}
        <div class="galeri-item galeri-item-wide" data-category="wisuda">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/kids.jpg') }}" alt="Wisuda Kelulusan" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Wisuda Kelulusan</h5>
                <span class="galeri-img-tag">Juni 2026</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 5 --}}
        <div class="galeri-item" data-category="kegiatan">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/kidss.jpg') }}" alt="Cooking Class" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Cooking Class</h5>
                <span class="galeri-img-tag">Maret 2026</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 6 --}}
        <div class="galeri-item" data-category="lomba">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/harbun.png') }}" alt="Market Day" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Market Day</h5>
                <span class="galeri-img-tag">November 2025</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 7 --}}
        <div class="galeri-item" data-category="pentas">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/kids.jpg') }}" alt="Pentas Seni TVRI" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Pentas Seni TVRI</h5>
                <span class="galeri-img-tag">Januari 2026</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 8 - Tall --}}
        <div class="galeri-item galeri-item-tall" data-category="kegiatan">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/kidss.jpg') }}" alt="Manasik Haji" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Manasik Haji</h5>
                <span class="galeri-img-tag">Oktober 2025</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Item 9 --}}
        <div class="galeri-item" data-category="kegiatan">
          <div class="galeri-img-wrap">
            <img src="{{ asset('adward/images/harbun.png') }}" alt="Kartinian" class="galeri-img">
            <div class="galeri-overlay">
              <div class="galeri-overlay-content">
                <i class="fa fa-search-plus galeri-zoom-icon"></i>
                <h5 class="galeri-img-title">Kartinian</h5>
                <span class="galeri-img-tag">April 2026</span>
              </div>
            </div>
          </div>
        </div>

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
