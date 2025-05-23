@extends('front/layouts.layout')

@push('styles')
    <style>
        .custom-separator {
            font-size: 0.8rem;
            /* gap: 0.25rem; */
            text-align: center;
            flex-wrap: wrap;
        }

        .separator-item {
            white-space: nowrap;
        }

        .separator-divider {
            opacity: 0.5;
        }

        .fade-in-delayed {
            opacity: 0;
            animation: fadeIn 1s ease-in-out 1s forwards;
            /* Durasi: 1s, Delay: 2s, 'forwards' untuk mempertahankan akhir animasi */
        }

        .card-content {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            /* Ubah max lines kalau perlu */
            -webkit-line-clamp: 6;
            line-height: 1.4em;
            max-height: calc(1.4em * 6);
            /* Sesuai jumlah line clamp */
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 430px) {
            .custom-separator {
                font-size: 0.765rem;
                font-family: sans-serif;
                /* 10px */
            }
        }

        @media (max-width: 414px) {
            .custom-separator {
                font-size: 0.625rem;
                font-family: sans-serif;
                /* 10px */
            }
        }

        @media (max-width: 390px) {
            .custom-separator {
                font-size: 0.52rem;
                font-family: sans-serif;
                /* 8px */
            }
        }

        @media (max-width: 375px) {
            .custom-separator {
                font-size: 0.5rem;
                font-family: sans-serif;
                /* 8px */
            }
        }

        @media (max-width: 360px) {
            .custom-separator {
                font-size: 0.565rem;
                font-family: sans-serif;
                /* 8px */
            }
        }

        @media (max-width: 344px) {
            .custom-separator {
                font-size: 0.52rem;
                font-family: sans-serif;
                /* 8px */
            }
        }

        .responsive-title {
        font-size: 1.5rem;
        }

        .responsive-title-2 {
        font-size: 1.1rem;
        }

        /* Tablet */
        @media (min-width: 576px) {
            .responsive-title {
                font-size: 1.5rem;
            }
            .responsive-title-2 {
                font-size: 1.1rem;
            }
            .responsive-desc {
                font-size: 1.1rem;
            }
            .responsive-time {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 768px) {
            .responsive-flex {
            flex-direction: column !important;
            margin: 0 20px !important; /* lebih ramping di mobile */
            }
        }

        /* Laptop/Desktop */
        @media (min-width: 992px) {
            .responsive-title {
                font-size: 1.9rem;
            }
            .responsive-title-2 {
                font-size: 1.2rem;
            }
            .responsive-desc {
                font-size: 1.2rem;
            }
            .responsive-time {
                font-size: 1rem;
            }
        }

        /* Very large screen (≥1200px) */
        @media (min-width: 1200px) {
            .responsive-title {
                font-size: 2.2rem;
            }
            .responsive-title-2 {
                font-size: 1.4rem;
            }
        }

        .phone-frame-wrapper {
            background: url('/images/desain_popup_landing.png') no-repeat center center;
            background-size: contain;
            position: relative;
            width: 100%;
            max-width: 400px;
            aspect-ratio: 9/18;
            /* Sesuaikan dengan bentuk handphone */
            padding: 60px 30px;
            /* Sesuaikan area layar di dalam bingkai */
            box-sizing: border-box;
        }

        .phone-content {
            height: 100%;
            overflow-y: auto;
        }

        .phone-content::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush
@section('content')

<div style="background-color: #f7ca46; color: black; padding: 10px; display: flex; align-items: center; justify-content: center; gap: 10px; flex-wrap: wrap;">
    <div style="font-size: 13px; font-weight: bold;">
      The News Is Full of Spin. Here’s the Sarcastic Truth, straight from
    </div>

    <img src="/assets/logo/abc_logo_v1.png" alt="ABC Logo" class="img-fluid" style="max-height: 20px;">
    <img src="/assets/logo/theguardian_logo.png" alt="The Guardian Logo" class="img-fluid" style="max-height: 20px;">
    <img src="/assets/logo/sbsnews_logo.png" alt="SBS News Logo" class="img-fluid" style="max-height: 20px;">
    <img src="/assets/logo/7news.png" alt="7news" class="img-fluid" style="max-height: 20px;">
    <img src="/assets/logo/9news.png" alt="9news" class="img-fluid" style="max-height: 20px;">
    <img src="/assets/logo/10news.png" alt="10news" class="img-fluid" style="max-height: 20px;">
    <img src="/assets/logo/smh.png" alt="smh" class="img-fluid" style="max-height: 20px;">
    <div style="font-size: 13px;  font-weight: bold;">
      and anyone who still does journalism
    </div>
  </div>

  <div class="mb-2 responsive-flex" style="display: flex; margin: 0 70px;">
    <!-- Clara Block -->
    <div style="display: flex; align-items: center; justify-content: center; padding: 10px; flex: 1;">
      <img src="/images/clara.jpg" width="200" height="220" alt="Clara" style="border: 2px solid #cd4aac; margin-right: 10px;">
      <div>
        <div style="font-size: 30px; font-weight: bold; color: #cd4aac;">Clara</div>
        <div style="font-size: 16px;">Let's fix the news, with facts, fire and a wink</div>
      </div>
    </div>

    <!-- Lola Block -->
    <div style="display: flex; align-items: center; justify-content: center; padding: 10px; flex: 1;">
      <img src="/images/lola.jpg" width="200" height="220" alt="Lola" style="border: 2px solid #f7ca46; margin-right: 10px;">
      <div>
        <div style="font-size: 30px; font-weight: bold; color: #f7ca46;">Lola</div>
        <div style="font-size: 16px;">It is legal, unfortunately for them</div>
      </div>
    </div>

    <!-- Phor Block -->
    <div style="display: flex; align-items: center; justify-content: center; padding: 10px; flex: 1;">
      <img src="/images/phor.jpg" width="200" height="220" alt="Phor" style="border: 2px solid white; margin-right: 10px;">
      <div>
        <div style="font-size: 30px; font-weight: bold; color: white;">Phor</div>
        <div style="font-size: 16px;">When the truth hits, it hits like Phor</div>
      </div>
    </div>
  </div>



    {{-- ========================== Section image slider (Hidden Section) ========================== --}}

    <section class="mb-3">
        <h6 class="text-4xl font-bold mb-4" style="color: #FF4EB0;">
            The News Is Full of Spin. Here’s the Sarcastic Truth.
        </h6>
        @if ($banner_status)
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banner as $index => $value)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset($pathimg . $value->image_desktop) }}" class="d-block w-100"
                                alt="{{ $value->title ?? 'Banner' }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif


        {{-- <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/assets/banner/banner1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/assets/banner/banner2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/assets/banner/banner3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> --}}
    </section>
    {{-- ========================== Top News Headline (Hidden Section) ========================== --}}
    <section class="mb-5 d-none">
        <div class="row">
            <div class="col-md-8 d-none">
                <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner mb-3">
                        @foreach ($breaking_news as $index => $bnews)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }} news-item"
                                data-category="{{ $bnews->id }}">
                                <img src="{{ asset('storage/' . $bnews->image) }}" class="d-block w-100" alt="News Image">
                                <div class="carousel-caption d-none d-md-block bg-white text-dark p-2 rounded">
                                    <h5>{{ $bnews->title }}</h5>
                                    <p class="text-muted">{{ $bnews->short_desc }}</p>
                                    <a href="{{ route('front.news.show', $bnews->slug) }}"
                                        class="text-dark text-decoration-none">Read more</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                @foreach ($topnews as $tnews)
                    <a class="text-decoration-none text-muted" href="{{ route('front.news.show', $tnews->slug) }}">
                        <div class="cd-flex mb-3 news-container">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <span class="news-title d-block mb-1 fw-bold">{{ $tnews->title }}</span>
                                    <p class="news-snippet">
                                        {{ Str::before(Str::limit(strip_tags($tnews->content), 100), '.') }}.</p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $tnews->created_at?->format('d M Y') ?? 'Tanggal Tidak Tersedia' }}
                                        | <i class="fas fa-eye"></i> {{ $tnews->views ?? 0 }} Views
                                    </small>
                                </div>
                                @if ($tnews->image)
                                    <div class="ms-3" style="flex-shrink: 0; width: 120px;">
                                        <img src="{{ asset('storage/' . $tnews->image) }}" class="img-fluid rounded"
                                            alt="{{ $tnews->title }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @php
        $withImage = $topnews->filter(fn($item) => $item->image)->values();
        $noImage = $topnews->filter(fn($item) => !$item->image)->values();

        $withImageIndex = 0;
        $noImageIndex = 0;
        $layoutStep = 1;
    @endphp

    {{-- =============================== Breaking News =============================== --}}

    {{-- desktop --}}
    <section class="mb-5 {{ count($topnews)==0 ? "d-none" : "" }}" >
        <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase" style="color: #FF4EB0;">Breaking News</h2>

        @while ($withImageIndex < $withImage->count() || $noImageIndex < $noImage->count())
            @if (in_array($layoutStep, [1, 3, 5, 6, 8, 9]))
                {{-- 1 berita bergambar (col-6 + col-6) --}}
                @if (in_array($layoutStep, [1]))
                <div class="row mb-4">
                    {{-- Kiri: 1 berita besar (70%) --}}
                    @if (isset($withImage[$withImageIndex]))
                        <div class="col-12 col-md-8 mb-3">
                            @php $news = $withImage[$withImageIndex++] @endphp
                            <a href="{{ route('front.news.show', $news->slug) }}"
                                class="text-decoration-none text-dark play-sound-link">
                                <div class="rounded-2 overflow-hidden h-100 d-flex flex-column" style="min-height: 100%;">
                                    <div class="position-relative" style="height: 400px;">
                                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                            class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                    <div class="p-3 d-flex flex-column">
                                        @php
                                            $categoryName = $news->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                                        @endphp
                                        <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                        style="font-size: 0.75rem; width: fit-content;">
                                        {{ strtoupper($categoryName) }}
                                        </span>

                                        <h5 class="news-title fw-bold mb-1 responsive-title">{{ Str::limit($news->title, 80) }}</h5>

                                        <p class="text-white mb-0" style="font-size: 1rem;">
                                            {{ Str::words(strip_tags($news->content), 25, '...') }}
                                        </p>

                                        <small class="text-white mt-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $news->created_at->format('F d, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                    {{-- Kanan: 2 berita kecil bertumpuk (30%) --}}
                    <div class="col-12 col-md-4">
                        <div class="row">
                            @for ($j = 0; $j < 2; $j++)
                                @if (isset($withImage[$withImageIndex]))
                                    <div class="col-md-12 mb-3">
                                        @php $news = $withImage[$withImageIndex++] @endphp
                                        <a href="{{ route('front.news.show', $news->slug) }}"
                                            class="text-decoration-none text-dark play-sound-link">
                                            <div class="rounded-2 overflow-hidden d-flex flex-column" style="min-height: 100%;">
                                                <div class="position-relative" style="height: 180px;">
                                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                                        class="img-fluid w-100 h-100" style="object-fit: cover;">
                                                </div>
                                                <div class="p-2 d-flex flex-column justify-content-between">

                                                    {{-- Kategori --}}
                                                    @php
                                                        $categoryName = $news->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                                                    @endphp
                                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                                        style="font-size: 0.75rem; width: fit-content;">
                                                        {{ strtoupper($categoryName) }}
                                                    </span>

                                                    {{-- Judul --}}
                                                    <h6 class="news-title fw-bold mb-1 responsive-title-2">
                                                        {{ Str::limit($news->title, 60) }}
                                                    </h6>

                                                    {{-- Deskripsi --}}
                                                    <p class="text-white mb-0" style="font-size: 1rem;">
                                                        {{ Str::words(strip_tags($news->content), 15, '...') }}
                                                    </p>

                                                    {{-- Tanggal --}}
                                                    <small class="text-white mt-2">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ $news->created_at->format('F d, Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                @else
                <div class="row mb-4">
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($withImage[$withImageIndex]))
                            <div class="col-md-4 mb-3">
                                @php $news = $withImage[$withImageIndex++] @endphp
                                <a href="{{ route('front.news.show', $news->slug) }}"
                                    class="text-decoration-none text-dark play-sound-link">
                                    <div class="rounded-2 overflow-hidden h-100 d-flex flex-column"
                                        style="min-height: 200px;">
                                        <div class="position-relative" style="height: 300px;">
                                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                                class="img-fluid w-100 h-100" style="object-fit: cover;">
                                        </div>
                                        <div class="p-3 d-flex flex-column justify-content-between h-100">

                                            <div>
                                                {{-- Kategori --}}
                                                @php
                                                    $categoryName =
                                                        $news->countriesCategoriesNews->first()?->category?->name ??
                                                        'No Category';
                                                @endphp
                                                <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                                    style="font-size: 0.75rem;">
                                                    {{ strtoupper($categoryName) }}
                                                </span>

                                                {{-- Judul --}}
                                                <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}</h6>

                                                {{-- Deskripsi singkat --}}
                                                <p class="text-white mb-0" style="font-size: 1rem;">
                                                    {{ Str::words(strip_tags($news->content), 25, '...') }}
                                                </p>
                                            </div>
                                            <small class="text-white mt-3">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $news->created_at->format('F d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
                @endif
            @elseif (in_array($layoutStep, [2, 4, 7]))
                {{-- 3 berita tanpa gambar --}}
                <div class="row mb-4">
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($noImage[$noImageIndex]))
                            @php $news = $noImage[$noImageIndex++] @endphp
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('front.news.show', $news->slug) }}"
                                    class="text-decoration-none text-dark d-block h-100">
                                    <div class="rounded-4 p-3 h-100">
                                        <div>
                                            {{-- Kategori --}}
                                            @php
                                                $categoryName =
                                                    $news->countriesCategoriesNews->first()?->category?->name ??
                                                    'No Category';
                                            @endphp
                                            <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                                style="font-size: 0.75rem;">
                                                {{ strtoupper($categoryName) }}
                                            </span>

                                            {{-- Judul --}}
                                            <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}</h6>

                                            {{-- Deskripsi singkat --}}
                                            <p class="text-white mb-0" style="font-size: 1rem;">
                                                {{ Str::words(strip_tags($news->content), 25, '...') }}
                                            </p>
                                        </div>
                                        <small class="text-white">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $news->created_at->format('F d, Y') }}
                                        </small>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
            @elseif (in_array($layoutStep, [10, 11, 12, 13]))
                @php
                    // Jika berita tanpa gambar sudah habis
                    $isNoImageAvailable = isset($noImage[$noImageIndex]);
                @endphp

                @if (!$isNoImageAvailable && isset($withImage[$withImageIndex]) && isset($withImage[$withImageIndex + 1]))
                    {{-- Fallback: tampilkan 2 berita bergambar sejajar --}}
                    <div class="row mb-4">
                        @for ($i = 0; $i < 2; $i++)
                            @if (isset($withImage[$withImageIndex]))
                                @php $news = $withImage[$withImageIndex++] @endphp
                                <div class="col-md-6 mb-3">
                                    <a href="{{ route('front.news.show', $news->slug) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="rounded-2 overflow-hidden h-100 d-flex flex-column"
                                            style="min-height: 200px;">
                                            <div class="position-relative" style="height: 300px;">
                                                <img src="{{ asset('storage/' . $news->image) }}"
                                                    alt="{{ $news->title }}" class="img-fluid w-100 h-100"
                                                    style="object-fit: cover;">
                                            </div>
                                            <div class="p-3 d-flex flex-column justify-content-between h-100">
                                                <div>
                                                    @php
                                                        $categoryName =
                                                            $news->countriesCategoriesNews->first()?->category?->name ??
                                                            'No Category';
                                                    @endphp
                                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                                        style="font-size: 0.75rem;">
                                                        {{ strtoupper($categoryName) }}
                                                    </span>

                                                    <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}
                                                    </h6>
                                                    <p class="text-white mb-0" style="font-size: 1rem;">
                                                        {{ Str::words(strip_tags($news->content), 25, '...') }}
                                                    </p>
                                                </div>
                                                <small class="text-muted mt-3">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $news->created_at->format('F d, Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endfor
                    </div>
                @else
                    {{-- Normal layout: 1 berita bergambar + 3 tanpa gambar --}}
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            @if (isset($withImage[$withImageIndex]))
                                @php $news = $withImage[$withImageIndex++] @endphp
                                <a href="{{ route('front.news.show', $news->slug) }}"
                                    class="text-decoration-none text-dark">
                                    <div class="rounded-2 overflow-hidden h-100 d-flex flex-column"
                                        style="min-height: 200px;">
                                        <div class="position-relative" style="height: 300px;">
                                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                                class="img-fluid w-100 h-100" style="object-fit: cover;">
                                        </div>
                                        <div class="p-3 d-flex flex-column justify-content-between h-100">
                                            <div>
                                                @php
                                                    $categoryName =
                                                        $news->countriesCategoriesNews->first()?->category?->name ??
                                                        'No Category';
                                                @endphp
                                                <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                                    style="font-size: 0.75rem;">
                                                    {{ strtoupper($categoryName) }}
                                                </span>
                                                <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}
                                                </h6>
                                                <p class="text-muted mb-0" style="font-size: 1rem;">
                                                    {{ Str::words(strip_tags($news->content), 25, '...') }}
                                                </p>
                                            </div>
                                            <small class="text-muted mt-3">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $news->created_at->format('F d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @for ($i = 0; $i < 3; $i++)
                                @if (isset($noImage[$noImageIndex]))
                                    @php $news = $noImage[$noImageIndex++] @endphp
                                    <div class="mb-3 border rounded-4 p-3">
                                        <div>
                                            @php
                                                $categoryName =
                                                    $news->countriesCategoriesNews->first()?->category?->name ??
                                                    'No Category';
                                            @endphp
                                            <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                                style="font-size: 0.75rem;">
                                                {{ strtoupper($categoryName) }}
                                            </span>
                                            <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}</h6>
                                            <p class="text-white mb-0" style="font-size: 1rem;">
                                                {{ Str::words(strip_tags($news->content), 25, '...') }}
                                            </p>
                                        </div>
                                        <small class="text-white">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $news->created_at->format('F d, Y') }}
                                        </small>
                                    </div>
                                @endif
                            @endfor
                        </div>
                    </div>
                @endif
            @endif


            @php
                $layoutStep++;
                if ($layoutStep > 13) {
                    $layoutStep = 1;
                }
            @endphp
        @endwhile
        <h4 class="fw-bold text-uppercase text-end mb-3" style="font-size: 0.9rem;">
            <a href="{{ url($defaultCountry . '/newscategory/Breaking%20News') }}" class="text-decoration-underline"
                style="color: #FF4EB0;">
                More Breaking News
            </a>
        </h4>
    </section>


    {{-- =============================== More News =============================== --}}
    <section class="d-none mb-5">
        <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase" style="color: #FF4EB0;">More News</h2>

        {{-- @foreach ($not_today_news as $ntnews)
                <div class="col-md-6 mb-4">


                    <a href="{{ route('front.news.show', $ntnews->slug) }}" class="text-decoration-none text-dark">
                        <div class="border rounded-5 overflow-hidden h-100 custom-shadow d-flex flex-column"
                            style="min-height: 200px;">


                            @if ($ntnews->image)
                                <div class="position-relative"
                                    style="height:'400px';">
                                    <img src="{{ asset('storage/' . $ntnews->image) }}" alt="{{ $ntnews->title }}"
                                        class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                            @endif


                            <div class="p-3 d-flex flex-column justify-content-between h-100">
                                <div>

                                    @php
                                        $categoryName =
                                            $ntnews->countriesCategoriesNews->first()?->category?->name ??
                                            'No Category';
                                    @endphp
                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                        style="font-size: 0.75rem;">
                                        {{ strtoupper($categoryName) }}
                                    </span>


                                    <h6 class="news-title fw-bold mb-1">{{ Str::limit($ntnews->title, 70) }}</h6>


                                    <p class="text-muted mb-0" style="font-size: 1.25rem;">
                                        {{ Str::words(strip_tags($ntnews->content), 25, '...') }}
                                    </p>
                                </div>


                                <small class="text-muted mt-3">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $ntnews->created_at?->format('F d, Y') }}
                                </small>
                            </div>

                        </div>
                    </a>

                </div>
            @endforeach --}}
        @php
            $newsCount = count($not_today_news);
        @endphp

        @for ($i = 0; $i < $newsCount; $i += 2)
            @php
                $first = $not_today_news[$i];
                $second = $not_today_news[$i + 1] ?? null;

                $firstHasImage = !empty($first->image);
                $secondHasImage = $second && !empty($second->image);

                if ($firstHasImage && !$secondHasImage) {
                    $firstCol = 10;
                    $secondCol = 2;
                } elseif (!$firstHasImage && $secondHasImage) {
                    $firstCol = 2;
                    $secondCol = 10;
                } else {
                    $firstCol = 6;
                    $secondCol = 6;
                }
            @endphp

            {{-- Baris 2 kolom --}}
            <div class="row mb-4">
                {{-- First Item --}}
                <div class="col-md-{{ $firstCol }} mb-4">
                    <a href="{{ route('front.news.show', $first->slug) }}" class="text-decoration-none text-dark">
                        <div class="rounded-5 overflow-hidden h-100 d-flex flex-column" style="min-height: 100px;">
                            @if ($firstHasImage)
                                <div class="position-relative" style="height: 250px;">
                                    <img src="{{ asset('storage/' . $first->image) }}" alt="{{ $first->title }}"
                                        class="img-fluid w-100 h-100" style="object-fit: cover;">
                                </div>
                            @endif

                            <div class="p-3 d-flex flex-column justify-content-between h-100">
                                <div>
                                    @php
                                        $categoryName =
                                            $first->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                                    @endphp
                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                        style="font-size: 0.75rem;">
                                        {{ strtoupper($categoryName) }}
                                    </span>

                                    <h6 class="news-title fw-bold mb-1">{{ Str::limit($first->title, 70) }}</h6>

                                    <p class="text-white mb-0" style="font-size: 1.25rem;">
                                        {{ Str::words(strip_tags($first->content), 25, '...') }}
                                    </p>
                                </div>
                                <small class="text-white mt-3">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $first->created_at?->format('F d, Y') }}
                                </small>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- Second Item (optional) --}}
                @if ($second)
                    <div class="col-md-{{ $secondCol }} mb-4">
                        <a href="{{ route('front.news.show', $second->slug) }}" class="text-decoration-none text-dark">
                            <div class="rounded-5 overflow-hidden h-100 d-flex flex-column" style="min-height: 100px;">
                                @if ($secondHasImage)
                                    <div class="position-relative" style="height: 250px;">
                                        <img src="{{ asset('storage/' . $second->image) }}" alt="{{ $second->title }}"
                                            class="img-fluid w-100 h-100" style="object-fit: cover;">
                                    </div>
                                @endif

                                <div class="p-3 d-flex flex-column justify-content-between h-100">
                                    <div>
                                        @php
                                            $categoryName =
                                                $second->countriesCategoriesNews->first()?->category?->name ??
                                                'No Category';
                                        @endphp
                                        <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                            style="font-size: 0.75rem;">
                                            {{ strtoupper($categoryName) }}
                                        </span>

                                        <h6 class="news-title fw-bold mb-1">{{ Str::limit($second->title, 70) }}</h6>

                                        <p class="text-white mb-0 card-content" style="font-size: 1.25rem;">
                                            {{ $second->short_desc }}
                                        </p>
                                    </div>
                                    <small class="text-white mt-3">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $second->created_at?->format('F d, Y') }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        @endfor





        <div class="text-start">
            <a href="{{ url($defaultCountry . '/news') }}" class="btn btn-outline-warning text-light">See All News</a>
        </div>
    </section>


    <section class="mb-5">


        @php
            $chunks = $groupedByCategory->chunk(4); // Bagi per 4 kolom kategori
        @endphp

        @foreach ($chunks as $categoryChunk)
            @php
                $colCount = $categoryChunk->count();
                $isSingle = $colCount === 1;
                $isFiveInTotal = $groupedByCategory->count() === 5 && $loop->last;
            @endphp

            <div class="row mb-5">
                @foreach ($categoryChunk as $index => $newsList)
                    @php
                        $categoryName = is_string($index) ? $index : $newsList->first()?->category->name;
                        $isFifth = $isFiveInTotal && $loop->last;
                        $colSize = $isSingle || $isFifth ? 6 : floor(12 / $colCount);
                        $firstNews = $newsList->first();
                        $otherNews = $newsList->skip(1)->take(5);
                        $contentLimit = $colSize == 12 ? 300 : 100;
                    @endphp

                    <div class="col-md-{{ $colSize }} mb-4">
                        <div class="p-3 mb-4 rounded-4 shadow-sm h-100">
                            <a href="{{ url($defaultCountry . '/newscategory/' . $categoryName) }}"
                                class="text-decoration-none text-dark">
                                {{-- Kategori --}}
                                {{-- <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                    style="font-size: 0.75rem;">
                                    {{ strtoupper($categoryName) }}
                                </span> --}}
                                <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase" style="color: #FF4EB0;">
                                    {{ $categoryName }}</h2>
                            </a>

                            {{-- Kategori --}}
                            {{-- Berita pertama --}}
                            @if ($firstNews)
                                <div class="mb-3">
                                    @if ($firstNews->image)
                                        <a href="{{ route('front.news.show', $firstNews->slug) }}">
                                            <img src="{{ asset('storage/' . $firstNews->image) }}"
                                                class="img-fluid rounded mb-3 w-100" alt="{{ $firstNews->title }}"
                                                style="object-fit: cover; max-height: 220px;">
                                        </a>
                                    @endif

                                    <a href="{{ route('front.news.show', $firstNews->slug) }}"
                                        class="news-title-after-first d-block mb-2 fw-bold fs-6"  style="font-size: 1rem;">
                                        {{ Str::limit($firstNews->title, 90) }}
                                    </a>

                                    <p class="text-white mb-0 card-content" style="font-size: 0.8rem;">
                                    {{-- <p class="text-white news-snippet mb-2"> --}}
                                        {{ Str::limit(strip_tags($firstNews->content), $contentLimit) }}
                                    </p>

                                    <small class="text-white d-block">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $firstNews->created_at->format('F d, Y') }}
                                        {{-- <span class="badge bg-danger text-white rounded-pill px-2 py-1"
                                            style="font-size: 0.75rem;">
                                            {{ strtoupper($categoryName) }}
                                        </span> --}}
                                    </small>
                                </div>
                            @endif

                            {{-- Berita lainnya --}}
                            @foreach ($otherNews as $news)
                                <div class="mb-3">
                                    @if ($news->image)
                                        <a href="{{ route('front.news.show', $news->slug) }}">
                                            <img src="{{ asset('storage/' . $news->image) }}"
                                                class="img-fluid rounded mb-3 w-100" alt="{{ $news->title }}"
                                                style="object-fit: cover; max-height: 220px;">
                                        </a>
                                    @endif

                                    <a href="{{ route('front.news.show', $news->slug) }}"
                                        class="news-title-after-first d-block mb-2 fw-bold fs-6" style="font-size: 1rem;">
                                        {{ Str::limit($news->title, 90) }}
                                    </a>

                                    <p class="text-white mb-0 card-content" style="font-size: 0.8rem;">
                                    {{-- <p class="news-snippet mb-2"> --}}
                                        {{ Str::limit(strip_tags($news->content), $contentLimit) }}
                                    </p>

                                    <small class="text-white d-block">
                                        {{ $news->created_at->format('F d, Y') }}
                                        {{-- <span class="badge bg-danger text-white rounded-pill px-2 py-1"
                                            style="font-size: 0.75rem;">
                                            {{ strtoupper($categoryName) }}
                                        </span> --}}
                                    </small>
                                </div>
                            @endforeach

                            <div class="text-start mt-3">
                                <a href="{{ url($defaultCountry . '/newscategory/' . $categoryName) }}"
                                    class="btn btn-outline-dark">See All {{ $categoryName }} News</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach


    </section>

    @include('front.layouts.modalpopup_new')


    {{-- <script>
        let startTime = Date.now();
        window.addEventListener("beforeunload", function() {
            const duration = Math.round((Date.now() - startTime) / 1000);
            const data = {
                url: window.location.pathname,
                duration: duration
            };

            const blob = new Blob([JSON.stringify(data)], {
                type: 'application/json'
            });
            navigator.sendBeacon('/track-page-duration', blob);
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // const newsModalEl = document.getElementById('newsPopupModal');
            const newsModalEl = document.getElementById('contributorModal');
            const newsModal = new bootstrap.Modal(newsModalEl);

            // Cek apakah modal sudah pernah ditampilkan sebelumnya
            // if (!localStorage.getItem("newsModalShown")) {
            newsModal.show();
            //     localStorage.setItem("newsModalShown", "true");
            // }

            // Tombol Close
            document.getElementById('customCloseBtn').addEventListener('click', function() {
                newsModal.hide();
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
