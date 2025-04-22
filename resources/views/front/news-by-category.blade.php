@extends('front/layouts.layout')
@section('title', 'News by Category')

@section('content')
    <style>
        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a1a;
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



    @php
        $newsCount = count($news);
    @endphp

    @for ($i = 0; $i < $newsCount; $i += 2)
        @php
            $first = $news[$i];
            $second = $news[$i + 1] ?? null;

            $firstHasImage = !empty($first->image);
            $secondHasImage = $second && !empty($second->image);
            $isLast = $i == $newsCount - 1;

            if ($isLast && $firstHasImage) {
                // Jika item terakhir dan ada gambar, ukuran full 12
                $firstCol = 12;
                $secondCol = 0; // Tidak ada second item
            } elseif ($firstHasImage && !$secondHasImage) {
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
        <div class="container mt-1">
            <h2 class="text-center mb-4">{{ $categoryName }}</h2>

            {{-- Baris 2 kolom --}}
            <div class="row mb-4">
                {{-- First Item --}}
                <div class="col-md-{{ $firstCol }} mb-4">
                    <a href="{{ route('front.news.show', $first->slug) }}" class="text-decoration-none text-dark">
                        <div class="border rounded-5 overflow-hidden h-100 custom-shadow d-flex flex-column"
                            style="min-height: 100px;">
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

                                    <p class="text-muted mb-0" style="font-size: 0.875rem;">
                                        {{ Str::words(strip_tags($first->content), 25, '...') }}
                                    </p>
                                </div>
                                <small class="text-muted mt-3">
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
                            <div class="border rounded-5 overflow-hidden h-100 custom-shadow d-flex flex-column"
                                style="min-height: 100px;">
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

                                        <p class="text-muted mb-0 card-content" style="font-size: 0.875rem;">
                                            {{ $second->short_desc }}
                                        </p>
                                    </div>
                                    <small class="text-muted mt-3">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $second->created_at?->format('F d, Y') }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endfor


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
