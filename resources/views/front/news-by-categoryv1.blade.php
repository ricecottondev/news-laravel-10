@extends('front/layouts.layout')
@section('title', 'News by Category')

@section('content')
    <style>
        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ff00b3;
            text-decoration: none;
            font-family: sans-serif;
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

    {{-- ============================================================================================================== --}}

<h2 class="text-center mb-4">{{ $categoryName }}</h2>

@php
$withImage = $news->filter(fn($item) => $item->image)->values();
$noImage = $news->filter(fn($item) => !$item->image)->values();

$withImageIndex = 0;
$noImageIndex = 0;
$layoutStep = 1;
@endphp

{{-- =============================== Breaking News =============================== --}}
<section class="mb-5">
{{-- <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase">Breaking News</h2> --}}

@while ($withImageIndex < $withImage->count() || $noImageIndex < $noImage->count())
    @if (in_array($layoutStep, [1, 3, 5, 6, 8, 9]))
        {{-- 1 berita bergambar (col-6 + col-6) --}}
        <div class="row mb-4">
            @for ($i = 0; $i < 3; $i++)
                @if (isset($withImage[$withImageIndex]))
                    <div class="col-md-4 mb-3">
                        @php $news = $withImage[$withImageIndex++] @endphp
                        <a href="{{ route('front.news.show', $news->slug) }}"
                            class="text-decoration-none text-dark">
                            <div class="rounded-5 overflow-hidden h-100  d-flex flex-column"
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
                                        <p class="text-white mb-0" style="font-size: 1.25rem; font-color: #fafafa;">
                                            {{-- {{ Str::before(Str::limit(strip_tags($news->content), 300), '.') }} --}}
                                            {{-- {{ Str::limit(strip_tags($news->content), 300) }} --}}
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
                                    <p class="text-white mb-0" style="font-size: 1.25rem;">
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
                            <a href="{{ route('front.news.show', $news->slug) }}" class="text-decoration-none text-dark">
                                <div class="rounded-5 overflow-hidden h-100 d-flex flex-column"
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
                                            <p class="text-white mb-0" style="font-size: 1.25rem;">
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
        @else
            {{-- Normal layout: 1 berita bergambar + 3 tanpa gambar --}}
            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    @if (isset($withImage[$withImageIndex]))
                        @php $news = $withImage[$withImageIndex++] @endphp
                        <a href="{{ route('front.news.show', $news->slug) }}" class="text-decoration-none text-dark">
                            <div class="rounded-5 overflow-hidden h-100 d-flex flex-column"
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
                                        <p class="text-white mb-0" style="font-size: 1.25rem;">
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
                    @endif
                </div>
                <div class="col-md-6">
                    @for ($i = 0; $i < 3; $i++)
                        @if (isset($noImage[$noImageIndex]))
                            @php $news = $noImage[$noImageIndex++] @endphp
                            <div class="mb-3 rounded-4 p-3">
                                <div>
                                    @php
                                        $categoryName =
                                            $news->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                                    @endphp
                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1 mb-2"
                                        style="font-size: 0.75rem;">
                                        {{ strtoupper($categoryName) }}
                                    </span>
                                    <h6 class="news-title fw-bold mb-1">{{ Str::limit($news->title, 70) }}</h6>
                                    <p class="text-white mb-0" style="font-size: 1.25rem;">
                                        {{ Str::words(strip_tags($news->content), 25, '...') }}
                                    </p>
                                </div>
                                <small class="text-white">
                                    <i class="fas fa-calendar-alt me-1"></i> {{ $news->created_at->format('F d, Y') }}
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
</section>


    {{-- ============================================================================================================== --}}


    {{-- <div class="container mt-1">
        <h2 class="text-center mb-4">{{ $categoryName }}</h2>



        <div class="row">
            @if ($news->count() > 0)
                @foreach ($news as $article)
                    <div class="col-md-6 mb-4 border-bottom pb-3 news-container">
                        <div class="news-card h-100 d-flex rounded-5 shadow-sm p-3">
                            <div class="flex-grow-1">
                                <a href="{{ route('front.news.show', $article->slug) }}" class="news-title d-block mb-1">
                                    {{ $article->title }}
                                </a>
                                <p class="news-snippet">
                                    {{ Str::before(Str::limit(strip_tags($article->content), 300), '.') }}.
                                </p>

                            </div>
                            @if ($article->image)
                                <div class="ms-3" style="flex-shrink: 0; width: 120px;">
                                    <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded"
                                        alt="{{ $article->title }}">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p class="text-center text-muted">No news available in this category.</p>
                </div>
            @endif
        </div>



    </div> --}}
@endsection
