@extends('front/layouts.layout')
@section('content')
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

    {{-- =============================== Breaking News =============================== --}}
    <section class="mb-5">
        <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase">Breaking News</h2>
        <div class="row">
            @foreach ($topnews as $tnews)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('front.news.show', $tnews->slug) }}" class="text-decoration-none text-dark">
                        <div class="d-flex border rounded overflow-hidden h-100 custom-shadow">
                            @if ($tnews->image)
                                <img src="{{ asset('storage/' . $tnews->image) }}" class="flex-shrink-0"
                                    alt="{{ $tnews->title }}" style="width: 120px; height: auto; object-fit: cover;">
                            @endif
                            <div class="p-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="news-title d-block mb-1 fw-bold">{{ Str::limit($tnews->title, 70) }}</h6>
                                    <p class="news-snippet">{{ Str::words(strip_tags($tnews->content), 25, '...') }}</p>
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt"></i> {{ $tnews->created_at?->format('d M Y') }}
                                    &nbsp;|&nbsp;
                                    <i class="fas fa-eye"></i> {{ $tnews->views ?? 0 }} Views
                                    @php
                                        $categoryName =
                                            $tnews->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                                    @endphp

                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1"
                                        style="font-size: 0.75rem;">
                                        {{ strtoupper($categoryName) }}
                                    </span>
                                    </span>
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-start">
            <a href="{{ url($defaultCountry . '/newscategory/Breaking%20News') }}" class="btn btn-outline-dark">See All
                Breaking News</a>
        </div>
    </section>

    {{-- =============================== More News =============================== --}}
    <section class="mb-5">
        <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase">More News</h2>
        <div class="row">
            @foreach ($not_today_news as $ntnews)
                <div class="col-md-6 mb-4 border-bottom pb-3 news-container">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <a href="{{ route('front.news.show', $ntnews->slug) }}"
                                class="news-title d-block mb-1 fw-bold">
                                {{ $ntnews->title }}
                            </a>
                            <p class="news-snippet">{{ Str::before(Str::limit(strip_tags($ntnews->content), 300), '.') }}.
                            </p>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $ntnews->created_at?->format('d M Y') ?? 'Tanggal Tidak Tersedia' }}
                                | <i class="fas fa-eye"></i> {{ $ntnews->views ?? 0 }} Views
                            </small>
                        </div>
                        @if ($ntnews->image)
                            <div class="ms-3" style="flex-shrink: 0; width: 120px;">
                                <img src="{{ asset('storage/' . $ntnews->image) }}" class="img-fluid rounded"
                                    alt="{{ $ntnews->title }}">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-start">
            <a href="{{ url($defaultCountry . '/news') }}" class="btn btn-outline-dark">See All News</a>
        </div>
    </section>


    @php
        $chunks = $groupedByCategory->chunk(4); // Bagi per 4 kolom kategori
    @endphp

    @foreach ($chunks as $categoryChunk)
        @php
            $colCount = $categoryChunk->count();
            $colSize = 12 / $colCount;
        @endphp

        <div class="row mb-5">
            @foreach ($categoryChunk as $categoryName => $newsList)
                <div class="col-md-{{ $colSize }}">
                    <h2 class="border-bottom pb-2 mb-3 fw-bold text-uppercase">{{ $categoryName }}</h2>

                    @php
                        $firstNews = $newsList->first();
                        $otherNews = $newsList->skip(1)->take(5);
                        $contentLimit = $colSize == 12 ? 300 : 100;
                    @endphp

                    {{-- Berita pertama: dengan gambar --}}
                    @if ($firstNews)
                        <div class="d-flex mb-3 align-items-start">
                            @if ($firstNews->image)
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{ asset('storage/' . $firstNews->image) }}" class="rounded"
                                        alt="{{ $firstNews->title }}"
                                        style="width: 80px; height: auto; object-fit: cover;">
                                </div>
                            @endif

                            <div class="flex-grow-1">
                                <a href="{{ route('front.news.show', $firstNews->slug) }}"
                                    class="news-title-after-first d-block mb-1">
                                    {{ Str::limit($firstNews->title, 70) }}
                                </a>
                                <p class="news-snippet">
                                    {{ Str::limit(strip_tags($firstNews->content), $contentLimit) }}
                                </p>
                                <small class="text-secondary d-block">
                                    {{ $firstNews->created_at->diffForHumans() }} | {{ $categoryName }}
                                </small>
                            </div>
                        </div>
                    @endif

                    {{-- Berita lainnya: hanya judul & waktu --}}
                    @foreach ($otherNews as $news)
                        <div class="d-flex mb-3 align-items-start">
                            @if ($tnews->image)
                                <img src="{{ asset('storage/' . $tnews->image) }}" class="rounded"
                                    alt="{{ $firstNews->title }}" style="width: 80px; height: auto; object-fit: cover;">
                            @endif
                            <div>
                                <a href="{{ route('front.news.show', $news->slug) }}"
                                    class="news-title-after-first d-block mb-1">
                                    {{ Str::limit($news->title, 70) }}
                                </a>
                                <p class="news-snippet">
                                    {{ Str::limit(strip_tags($news->content), $contentLimit) }}
                                </p>
                                <small class="text-muted">
                                    {{ $news->created_at->diffForHumans() }} |
                                    <span class="badge bg-danger text-white rounded-pill px-2 py-1"
                                        style="font-size: 0.75rem;">
                                        {{ strtoupper($categoryName) }}
                                    </span>
                                </small>
                            </div>
                        </div>


                        {{-- <div class="border-top pt-2 mb-2">
                            <a href="{{ route('front.news.show', $news->slug) }}"
                                class="news-title-after-first d-block mb-1">
                                {{ Str::limit($news->title, 70) }}
                            </a>
                            <p class="news-snippet">
                                {{ Str::limit(strip_tags($news->content), $contentLimit) }}
                            </p>
                            <small class="text-muted">
                                {{ $news->created_at->diffForHumans() }} | {{ $categoryName }}
                            </small>
                        </div> --}}
                    @endforeach

                    <div class="text-start">
                        <a href="{{ url($defaultCountry . '/newscategory/' . $categoryName) }}"
                            class="btn btn-outline-dark">See All
                            {{ $categoryName }} News</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
