@extends('front/layouts.layout')
@section('content')
    <h2 class="mb-4">Search Results for: "{{ $query }}"</h2>

    @if ($news->count() > 0)
        <div class="row">
            @foreach ($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $item->image }}" class="card-img-top" alt="{{ $item->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">{{ Str::limit($item->content, 100) }}</p>
                            <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-dark">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $news->links() }}
        </div>
    @else
        <p>No news found for "{{ $query }}".</p>
    @endif
@endsection
