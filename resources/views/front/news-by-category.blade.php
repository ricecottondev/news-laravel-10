@extends('front/layouts.layout')
@section('title', 'News by Category')

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
<div class="container mt-1">
    <h2 class="text-center mb-4">{{ $categoryName }}</h2>



    <div class="row">
        @if($news->count() > 0)
            @foreach($news as $article)
                <div class="col-md-6 mb-4 border-bottom pb-3 news-container">
                    <div class="news-card h-100 d-flex rounded-5 shadow-sm p-3">
                        <div class="flex-grow-1">
                            <a href="{{ route('front.news.show', $article->slug) }}" class="news-title d-block mb-1">
                                {{ $article->title }}
                            </a>
                            <p class="news-snippet">
                                {{ Str::before(Str::limit(strip_tags($article->content), 300), '.') }}.
                            </p>
                            {{-- Jika kamu punya informasi penulis --}}
                            {{-- <small class="text-secondary">By {{ $article->author_name }}</small> --}}
                        </div>
                        @if($article->image)
                            <div class="ms-3" style="flex-shrink: 0; width: 120px;">
                                <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded" alt="{{ $article->title }}">
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
</div>
@endsection
