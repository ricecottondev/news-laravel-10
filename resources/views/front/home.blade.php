@extends('front/layouts.layout')
@section('content')




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
                                    <a href="#" class="text-primary text-decoration-none">Read more</a>
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
                    <div class="d-flex mb-3">
                        @if ($tnews->image)
                            <img src="{{ asset('storage/' . $tnews->image) }}" alt="News image showing a brief event"
                                class="img-thumbnail me-3" width="150" height="100">
                        @else
                            <img src="/images/imagenotavailable.jpg" alt="News image showing a brief event"
                                class="img-thumbnail me-3" width="150" height="100">
                        @endif
                        {{-- <img src="https://storage.googleapis.com/a1aa/image/2QV9CWCCbSAlvKH-cq2rocCsYdH60eKPzRXHndhE1GU.jpg"
                        alt="News image showing a brief event" class="img-thumbnail me-3" width="150" height="100"> --}}
                        <div>
                            <h3 class="h6">{{ $tnews->title }}</h3>
                            <p class="text-muted">{{ Str::words(strip_tags($tnews->short_desc), 40, '...') }}</p>

                        </div>
                    </div>
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
                            @else
                                <img src="/images/imagenotavailable.jpg" alt="News image showing a brief event"
                                    class="img-thumbnail me-3" width="150" height="100">
                            @endif

                            <div>
                                <h3 class="h6">{{ $news->title }}</h3>

                                <p class="text-muted">{{ Str::words(strip_tags($news->short_desc), 40, '...') }}</p>

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
                <div class="col-md-4"><a class="text-decoration-none text-muted"
                        href="{{ route('front.news.show', $ntnews->slug) }}">
                        <div class="d-flex mb-3">
                            @if ($ntnews->image)
                                <img src="{{ asset('storage/' . $ntnews->image) }}" alt="News image showing a brief event"
                                    class="img-thumbnail me-3" width="150" height="100">
                            @else
                                <img src="/images/imagenotavailable.jpg" alt="News image showing a brief event"
                                    class="img-thumbnail me-3" width="150" height="100">
                            @endif

                            <div>
                                <h3 class="h6">{{ $ntnews->title }}</h3>

                                <p class="text-muted">{{ Str::words(strip_tags($ntnews->short_desc), 40, '...') }}</p>

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection
