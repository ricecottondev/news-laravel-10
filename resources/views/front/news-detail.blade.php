@extends('front/layouts.layout')
@section('content')
    <!-- Breadcrumb -->
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/" class="text-decoration-none text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $news->slug }}</li>
            </ol>
        </nav>
    </div>

    <!-- Article Header -->
    <div class="container bg-white p-4">
        <h1 class="display-5 fw-bold mb-3">
            {{ $news->title }}
        </h1>
        <div class="d-flex align-items-center">

            <img src="/images/imagenotavailable.jpg"
                alt="Author's profile picture" class="rounded-circle me-3" width="50" height="50" />
            <div>
                <p class="mb-0 text-secondary">{{ $news->author }}</p>
                <p class="mb-0 text-secondary">Chief political correspondent</p>
            </div>
        </div>
    </div>

    <!-- Article Content -->
    <div class="container bg-white p-4">
        <div class="d-flex align-items-center mb-4">
            <button class="btn btn-link text-primary me-3">
                <i class="fas fa-play me-2"></i>Listen to this article
            </button>
            <div class="d-flex">
                <button class="btn btn-link text-secondary me-2">
                    <i class="fas fa-font"></i>
                </button>
                <button class="btn btn-link text-secondary me-2">
                    <i class="fas fa-font"></i>
                </button>
                <button class="btn btn-link text-secondary">
                    <i class="fas fa-font"></i>
                </button>
            </div>
        </div>
        <p class="text-secondary mb-4">
            {{$news->short_desc}}
        </p>
        @if ($news->image)

                <img src="{{ asset('storage/' . $news->image) }}"
                alt="{{ $news->slug }}" class="img-fluid mb-4" />
        @else
            <img src="/images/imagenotavailable.jpg" alt="image not available" class="img-fluid mb-4"
               >
        @endif

        <p class="text-secondary mb-4 text-justify">
            {{$news->content}}
        </p>

    </div>
@endsection
