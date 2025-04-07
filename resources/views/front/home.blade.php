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
    {{-- ========================================================Top News Headline===================================================== --}}
    <section class="mb-5">
        <div class="row">
            <div class="col-md-8">
                <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner mb-3">
                        @foreach ($breaking_news as $bnews)
                            <div class="carousel-item active news-item" data-category={{ $bnews->id }}>
                                <img src="{{ asset('storage/' . $bnews->image) }}" class="d-block w-100" alt="News Image" />
                                <div class="carousel-caption d-none d-md-block" style="background: white">
                                    <h5>{{ $bnews->title }}</h5>
                                    <p class="text-muted">{{ $bnews->short_desc }}</p>
                                    <a href="{{ route('front.news.show', $bnews->slug) }}" class="text-dark text-decoration-none">Read more</a>
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
                <a class="text-decoration-none text-muted"
                href="{{ route('front.news.show', $tnews->slug) }}">


                {{-- <div class="d-flex mb-3">
                        @if ($tnews->image)
                            <img src="{{ asset('storage/' . $tnews->image) }}" alt="News image showing a brief event"
                                class="img-thumbnail me-3" width="150" height="100">

                        @endif
                        <div>
                            <h3 class="h6">{{ $tnews->title }}</h3>

                            <p class="text-muted">{{ Str::words(strip_tags($tnews->content), 20, '...') }}</p>


                            <small class="text-muted">
                                <i class="fas fa-calendar-alt"></i>
                                {{ $tnews->created_at ? $tnews->created_at->format('d M Y') : 'Tanggal Tidak Tersedia' }}
                                | <i class="fas fa-eye"></i> {{ $tnews->views ?? 0 }} Views
                            </small>
                        </div>
                    </div> --}}


                    <div class="cd-flex mb-3 news-container">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <a href="{{ route('front.news.show', $tnews->slug) }}" class="news-title d-block mb-1">
                                    {{ $tnews->title }}
                                </a>
                                <p class="news-snippet">
                                    {{ Str::before(Str::limit(strip_tags($tnews->content), 100), '.') }}.
                                </p>

                            </div>
                            @if($tnews->image)
                                <div class="ms-3" style="flex-shrink: 0; width: 120px;">
                                    <img src="{{ asset('storage/' . $tnews->image) }}" class="img-fluid rounded" alt="{{ $tnews->title }}">
                                </div>
                            @endif
                        </div>
                    </div>

                </a>
                @endforeach






            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="mb-5">
        <h2 class="h3 mb-4">Latest News</h2>
        <div class="row">
            @foreach ($news as $news)
                <div class="col-md-4"><a class="text-decoration-none text-muted"
                        href="{{ route('front.news.show', $news->slug) }}">
                        <div class="d-flex mb-3">
                            @if ($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" alt="News image showing a brief event"
                                    class="img-thumbnail me-3" width="150" height="100">
                            {{-- @else
                                <img src="/images/imagenotavailable.jpg" alt="News image showing a brief event"
                                    class="img-thumbnail me-3" width="150" height="100"> --}}
                            @endif

                            <div>
                                {{-- <h3 class="h6">{{ $news->title }}</h3> --}}
                                <a href="{{ route('front.news.show', $tnews->slug) }}" class="news-title d-block mb-1">
                                    {{ $news->title }}
                                </a>
                                <p class="text-muted">{{ Str::words(strip_tags($news->content), 50, '...') }}</p>
                                <!-- Menampilkan tanggal publikasi dan jumlah views -->
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $news->created_at ? $news->created_at->format('d M Y') : 'Tanggal Tidak Tersedia' }}
                                    | <i class="fas fa-eye"></i> {{ $news->views ?? 0 }} Views
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </section>

    <!-- More News Section -->
    <section class="mb-5">
        <h2 class="h3 mb-4">More News</h2>
        <div class="row">
            @foreach ($not_today_news as $ntnews)
                {{-- <div class="col-md-4"><a class="text-decoration-none text-muted"
                        href="{{ route('front.news.show', $ntnews->slug) }}">
                        <div class="d-flex mb-3">
                            @if ($ntnews->image)
                                <img src="{{ asset('storage/' . $ntnews->image) }}" alt="News image showing a brief event"
                                    class="img-thumbnail me-3" width="150" height="100">

                            @endif

                            <div>
                                <h3 class="h6">{{ $ntnews->title }}</h3>

                                <p class="text-muted">{{ Str::words(strip_tags($ntnews->short_desc), 20, '...') }}</p>

                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $tnews->created_at ? $ntnews->created_at->format('d M Y') : 'Tanggal Tidak Tersedia' }}
                                    | <i class="fas fa-eye"></i> {{ $ntnews->views ?? 0 }} Views
                                </small>
                            </div>
                        </div>
                    </a>
                </div> --}}



                <div class="col-md-6 mb-4 border-bottom pb-3 news-container">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <a href="{{ route('front.news.show', $ntnews->slug) }}" class="news-title d-block mb-1">
                                {{ $ntnews->title }}
                            </a>
                            <p class="news-snippet">
                                {{ Str::before(Str::limit(strip_tags($ntnews->content), 300), '.') }}.
                            </p>
                            {{-- Jika kamu punya informasi penulis --}}
                            {{-- <small class="text-secondary">By {{ $ntnews->author_name }}</small> --}}
                        </div>
                        @if($ntnews->image)
                            <div class="ms-3" style="flex-shrink: 0; width: 120px;">
                                <img src="{{ asset('storage/' . $ntnews->image) }}" class="img-fluid rounded" alt="{{ $ntnews->title }}">
                            </div>
                        @endif
                    </div>
                </div>

            @endforeach
        </div>
    </section>
@endsection
