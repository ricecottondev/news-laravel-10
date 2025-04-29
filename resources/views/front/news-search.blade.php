@extends('front/layouts.layout')
@section('content')
    <style>
        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
            text-decoration: none;
        }

        .news-title:hover {
            text-decoration: underline;
        }

        .news-snippet {
            color: #4a4a4a;
            font-size: 0.95rem;
            line-height: 1.5;
            font-family: sans-serif;
        }

        .news-container {
            border-bottom: 1px solid #ddd;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .news-image {
            width: 120px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
    <h2 class="mb-4">Search Results for: "{{ $query }}"</h2>

    @if ($news->count() > 0)
        @php
            $withImage = $news->filter(fn($item) => $item->image)->values();
            $noImage = $news->filter(fn($item) => !$item->image)->values();

            $withImageIndex = 0;
            $noImageIndex = 0;
            $layoutStep = 1;
        @endphp



        @while ($withImageIndex < $withImage->count() || $noImageIndex < $noImage->count())
            @if (in_array($layoutStep, [1, 3, 5, 6, 8, 9]))
                {{-- 1 berita bergambar (col-6 + col-6) --}}
                <div class="row mb-4">
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($withImage[$withImageIndex]))
                            <div class="col-md-4 mb-3">
                                @php $news = $withImage[$withImageIndex++] @endphp
                                <a href="{{ route('front.news.show', $news->slug) }}" class="text-decoration-none text-dark">
                                    <div class="border rounded-5 overflow-hidden h-100 custom-shadow d-flex flex-column"
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
                                                <p class="text-muted mb-0" style="font-size: 1.25rem;">
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
            @elseif (in_array($layoutStep, [2, 4, 7]))
                {{-- 3 berita tanpa gambar --}}
                <div class="row mb-4">
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($noImage[$noImageIndex]))
                            @php $news = $noImage[$noImageIndex++] @endphp
                            <div class="col-md-4 mb-3">
                                <a href="{{ route('front.news.show', $news->slug) }}"
                                    class="text-decoration-none text-dark d-block h-100">
                                    <div class="border rounded-4 p-3 h-100 custom-shadow">
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
                                            <p class="text-muted mb-0" style="font-size: 1.25rem;">
                                                {{ Str::words(strip_tags($news->content), 25, '...') }}
                                            </p>
                                        </div>
                                        <small class="text-muted">
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
                                        <div class="border rounded-5 overflow-hidden h-100 custom-shadow d-flex flex-column"
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
                                                    <p class="text-muted mb-0" style="font-size: 1.25rem;">
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
                                    <div class="border rounded-5 overflow-hidden h-100 custom-shadow d-flex flex-column"
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
                                                <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}</h6>
                                                <p class="text-muted mb-0" style="font-size: 1.25rem;">
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
                                    <div class="mb-3 border rounded-4 p-3 custom-shadow">
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
                                            <p class="text-muted mb-0" style="font-size: 1.25rem;">
                                                {{ Str::words(strip_tags($news->content), 25, '...') }}
                                            </p>
                                        </div>
                                        <small class="text-muted">
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
    @else
        <p>No news found for "{{ $query }}".</p>
    @endif




@endsection
