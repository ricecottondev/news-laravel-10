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
    {{-- Optional: Title --}}
    {{-- <h2 class="text-center mb-4">{{ $categoryName }}</h2> --}}

    <div class="row">
        @if($news->count() > 0)
            @foreach($news as $article)
                <div class="col-md-6 mb-4 news-container border-bottom">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <a href="{{ route('front.news.show', $article->slug) }}" class="news-title d-block mb-1">
                                {{ Str::limit($article->title, 70) }}
                            </a>
                            <p class="news-snippet">
                                {{ Str::limit(strip_tags($article->content), 300) }}
                            </p>
                            <small class="text-muted d-block">
                                {{ $article->created_at->diffForHumans() }}
                                @if(isset($categoryName)) | {{ $categoryName }} @endif
                            </small>
                        </div>
                        @if($article->image)

                                <img src="{{ asset('storage/' . $article->image) }}" class="img-thumbnail me-3" width="250" height="200" alt="{{ $article->title }}">

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
