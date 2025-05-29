@extends('front/layouts.layout')
@section('title', 'News by Category')

@section('content')

    <section class="pt-1">



        <hr class="mt-0">
    </section>
    <section>
        <div class="container-lg px-0">
            <div class="row g-0">
                <div class="col col-12 col-md-8">
                    @php
                        $withImage = $news->filter(fn($item) => $item->image)->values();
                        $noImage = $news->filter(fn($item) => !$item->image)->values();
                        $withImageIndex = 0;
                        $noImageIndex = 0;
                        $layoutStep = 1;
                    @endphp
                    <!-- news -->
                    <div class="news">
                        @while ($withImageIndex < $withImage->count() || $noImageIndex < $noImage->count())
                            @php
                                $odd = $layoutStep % 2 == 1;
                            @endphp

                            {{-- ---------------- Layout News 1 (ganjil) ---------------- --}}
                            @if ($odd && isset($withImage[$withImageIndex]))
                                @php
                                    $news1 = $withImage[$withImageIndex++];
                                    $news2 = $withImage[$withImageIndex++] ?? null;
                                    $news3 = $noImage[$noImageIndex++] ?? null;

                                    $countnews = 0;
                                    if (!empty($news1)) {
                                        $countnews++;
                                        # code...
                                    }
                                    if (!empty($news2)) {
                                        $countnews++;
                                        # code...
                                    }
                                    if (!empty($news3)) {
                                        $countnews++;
                                        # code...
                                    }
                                    // dump($countnews);
                                @endphp

                                <div class="row g-0">
                                    {{-- News 1 (utama) --}}
                                    <div class="col px-3 col-12">
                                        <div class="news-item">
                                            <header>
                                                <p class="news-category">
                                                    <small><b class="fw-bold">{{ $news1->category->name ?? '-' }}</b>
                                                        {{ $news1->author }}</small>
                                                </p>
                                                <h5 class="news-title hot-news text-warning">
                                                    <b class="fw-bold">
                                                        <a href="{{ route('front.news.show', $news1->slug) }}"
                                                            class="text-reset link-hover-underline">
                                                            {{ $news1->title }}
                                                        </a>
                                                    </b>
                                                </h5>
                                            </header>
                                            <main>
                                                <div class="row row-cols-1 row-cols-md-2">
                                                    <div class="col order-md-2">
                                                        <div class="ratio ratio-4x3 news-img">
                                                            <img src="{{ asset('storage/' . $news1->image) }}"
                                                                class="object-fit-cover" alt="{{ $news1->title }}">
                                                        </div>
                                                    </div>
                                                    <div class="col order-md-1">
                                                        <p class="news-text">
                                                            {{ Str::words(strip_tags($news1->content), 30, '...') }}</p>
                                                        <div class="news-time media small">
                                                            <div class="media-header">
                                                                <div class="ratio ratio-1x1 rounded-circle"
                                                                    style="width: 2rem;"></div>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="mb-1"><small class="opacity-75">Author
                                                                        by</small> <b
                                                                        class="fw-medium">{{ $news1->author }}</b></div>
                                                                <div>
                                                                    <small>{{ $news1->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </main>
                                        </div>
                                    </div>

                                    {{-- Separator --}}
                                    <div class="col col-12 px-md-3">
                                        <hr>
                                    </div>

                                    {{-- News 2 (dengan gambar) --}}
                                    @if ($news2)
                                        <div class="col px-3 col-12 {{ $countnews > 2 ? 'col-md-7' : ''}}">
                                            <div class="news-item">
                                                <header>
                                                    <p class="news-category">
                                                        <small><b class="fw-bold">{{ $news2->category->name ?? '-' }}</b>
                                                            {{ $news2->author }}</small>
                                                    </p>
                                                    <h5 class="news-title">
                                                        <b class="fw-bold">
                                                            <a href="{{ route('front.news.show', $news2->slug) }}"
                                                                class="text-reset link-hover-underline">
                                                                {{ $news2->title }}
                                                            </a>
                                                        </b>
                                                    </h5>
                                                </header>
                                                <main>
                                                    <div class="row row-cols-1 row-cols-md-2">
                                                        <div class="col order-md-2">
                                                            <div class="ratio ratio-4x3 news-img">
                                                                <img src="{{ asset('storage/' . $news2->image) }}"
                                                                    class="object-fit-cover" alt="{{ $news2->title }}">
                                                            </div>
                                                        </div>
                                                        <div class="col order-md-1">
                                                            <p class="news-text elipsis-4">
                                                                {{ Str::words(strip_tags($news2->content), 20, '...') }}
                                                            </p>
                                                            <div class="news-time media small">
                                                                <div class="media-header">
                                                                    <div class="ratio ratio-1x1 rounded-circle"
                                                                        style="width: 2rem;"></div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="mb-1"><small class="opacity-75">Author
                                                                            by</small> <b
                                                                            class="fw-medium">{{ $news2->author }}</b>
                                                                    </div>
                                                                    <div>
                                                                        <small>{{ $news2->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </main>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- Garis Vertikal --}}
                                    <div class="col col-12 col-md-auto">
                                        <hr class="d-md-none">
                                        <div class="vr h-100 d-none d-md-block"></div>
                                    </div>

                                    {{-- News 3 (tanpa gambar) --}}
                                    @if ($news3)
                                        <div class="col px-3 col-12 col-md">
                                            <div class="news-item">
                                                <header>
                                                    <p class="news-category">
                                                        <small><b class="fw-bold">{{ $news3->category->name ?? '-' }}</b>
                                                            {{ $news3->author }}</small>
                                                    </p>
                                                    <h5 class="news-title">
                                                        <b class="fw-bold">
                                                            <a href="{{ route('front.news.show', $news3->slug) }}"
                                                                class="text-reset link-hover-underline">
                                                                {{ $news3->title }}
                                                            </a>
                                                        </b>
                                                    </h5>
                                                </header>
                                                <main>
                                                    <p class="news-text elipsis-4">
                                                        {{ Str::words(strip_tags($news3->content), 25, '...') }}</p>
                                                    <div class="news-time media small">
                                                        <div class="media-header">
                                                            <div class="ratio ratio-1x1 rounded-circle"
                                                                style="width: 2rem;"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="mb-1"><small class="opacity-75">Author
                                                                    by</small>
                                                                <b class="fw-medium">{{ $news3->author }}</b>
                                                            </div>
                                                            <div><small>{{ $news3->created_at->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </main>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="px-md-3">
                                    <hr>
                                </div>

                                {{-- ---------------- Layout News 2 (genap) ---------------- --}}
                            @else
                                @php
                                    $main = $withImage[$withImageIndex++] ?? null;
                                    $side1 = $noImage[$noImageIndex++] ?? null;
                                    $side2 = $noImage[$noImageIndex++] ?? null;

                                    $countnews = 0;
                                    if (!empty($main)) {
                                        $countnews++;
                                        # code...
                                    }
                                    if (!empty($side1)) {
                                        $countnews++;
                                        # code...
                                    }
                                    if (!empty($side2)) {
                                        $countnews++;
                                        # code...
                                    }
                                    // dump($countnews);

                                @endphp



                                @if ($main)
                                    <div class="row g-0">
                                        <div class="col px-3 col-12 {{ $countnews > 1 ? 'col-md-7' : '' }}">
                                            <div class="news-item">
                                                <header>
                                                    <p class="news-category">
                                                        <small><b class="fw-bold">{{ $main->category->name ?? '-' }}</b>
                                                            {{ $main->author }}</small>
                                                    </p>
                                                    <h5 class="news-title text-warning">
                                                        <b class="fw-bold">
                                                            <a href="{{ route('front.news.show', $main->slug) }}"
                                                                class="text-reset link-hover-underline">
                                                                {{ $main->title }}
                                                            </a>
                                                        </b>
                                                    </h5>
                                                </header>
                                                <main>
                                                    <div class="row row-cols-1">
                                                        <div class="col">
                                                            <div class="ratio ratio-4x3 news-img">
                                                                <img src="{{ asset('storage/' . $main->image) }}"
                                                                    class="object-fit-cover" alt="{{ $main->title }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <p class="news-text">
                                                                {{ Str::words(strip_tags($main->content), 30, '...') }}
                                                            </p>
                                                            <div class="news-time media small">
                                                                <div class="media-header">
                                                                    <div class="ratio ratio-1x1 rounded-circle"
                                                                        style="width: 2rem;"></div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <div class="mb-1"><small class="opacity-75">Author
                                                                            by</small> <b
                                                                            class="fw-medium">{{ $main->author }}</b>
                                                                    </div>
                                                                    <div>
                                                                        <small>{{ $main->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </main>
                                            </div>
                                        </div>
                                        <div class="col col-12 col-md-auto">
                                            <hr class="d-md-none">
                                            <div class="vr h-100 d-none d-md-block"></div>
                                        </div>
                                        <div class="col col-12 col-md">
                                            <div class="row g-0">
                                                @foreach ([$side1, $side2] as $news)
                                                    @if ($news)
                                                        <div class="col px-3 col-12">
                                                            <div class="news-item">
                                                                <header>
                                                                    <p class="news-category">
                                                                        <small><b
                                                                                class="fw-bold">{{ $news->category->name ?? '-' }}</b>
                                                                            {{ $news->author }}</small>
                                                                    </p>
                                                                    <h5 class="news-title">
                                                                        <b class="fw-bold">
                                                                            <a href="{{ route('front.news.show', $news->slug) }}"
                                                                                class="text-reset link-hover-underline">
                                                                                {{ $news->title }}
                                                                            </a>
                                                                        </b>
                                                                    </h5>
                                                                </header>
                                                                <main>
                                                                    <p class="news-text elipsis-4">
                                                                        {{ Str::words(strip_tags($news->content), 25, '...') }}
                                                                    </p>
                                                                    <div class="news-time media small">
                                                                        <div class="media-header">
                                                                            <div class="ratio ratio-1x1 rounded-circle"
                                                                                style="width: 2rem;"></div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div class="mb-1"><small
                                                                                    class="opacity-75">Author by</small>
                                                                                <b
                                                                                    class="fw-medium">{{ $news->author }}</b>
                                                                            </div>
                                                                            <div>
                                                                                <small>{{ $news->created_at->diffForHumans() }}</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </main>
                                                            </div>
                                                        </div>
                                                        @if (!$loop->last)
                                                            <div class="col col-12 px-md-3">
                                                                <hr>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-md-3">
                                        <hr>
                                    </div>
                                @endif
                            @endif

                            @php $layoutStep++; @endphp
                        @endwhile
                    </div>
                    <!-- end news -->

                </div><!-- end col -->
                <div class="col col-12 col-md-auto">
                    <hr class="opacity-100 my-5 d-md-none">
                    <div class="vr h-100 d-none d-md-block mx-lg-3"></div>
                </div><!-- end col -->
                <div class="col px-3 col-12 col-md">
                    <aside class="sidenav">

                        <div class="just-in">
                            <header>
                                <h5 class="fs-reset mb-3 text-danger">
                                    <b class="fw-bold">JUST IN</b>
                                </h5>
                            </header>
                            <main>
                                <ul class="list-group list-group-flush">
                                    @foreach ($justinnews as $jin)
                                        <li class="list-group-item px-0">
                                            <p class="mb-1">
                                                <small><small>{{ $jin->created_at->diffForHumans() }}</small></small>
                                            </p>
                                            <h5 class="fs-reset">
                                                <b class="fw-medium">
                                                    <a href="{{ route('front.news.show', $jin->slug) }}"
                                                        class="text-reset link-hover-underline" decorate="none">
                                                        {{-- <a href="{{ route('front.news.show', $jin->slug) }}" --}}
                                                        {{ $jin->title }}
                                                    </a>
                                                </b>
                                            </h5>
                                        </li>
                                    @endforeach

                                    {{-- <li class="list-group-item px-0">
                                         <p class="mb-1">
                                             <small><small>2 minutes ago</small></small>
                                         </p>
                                         <h5 class="fs-reset">
                                             <b class="fw-medium">
                                                 <a href="#" class="text-reset link-hover-underline">
                                                     Exclusive liberals and Nationals closer on Coalition fix,
                                                     spotlight moves to litleproud leadership.
                                                 </a>
                                             </b>
                                         </h5>
                                     </li>
                                     <li class="list-group-item px-0">
                                         <p class="mb-1">
                                             <small><small>2 minutes ago</small></small>
                                         </p>
                                         <h5 class="fs-reset">
                                             <b class="fw-medium">
                                                 <a href="#" class="text-reset link-hover-underline">
                                                     Exclusive liberals and Nationals closer on Coalition fix,
                                                     spotlight moves to litleproud leadership.
                                                 </a>
                                             </b>
                                         </h5>
                                     </li>
                                     <li class="list-group-item px-0">
                                         <p class="mb-1">
                                             <small><small>2 minutes ago</small></small>
                                         </p>
                                         <h5 class="fs-reset">
                                             <b class="fw-medium">
                                                 <a href="#" class="text-reset link-hover-underline">
                                                     Exclusive liberals and Nationals closer on Coalition fix,
                                                     spotlight moves to litleproud leadership.
                                                 </a>
                                             </b>
                                         </h5>
                                     </li> --}}
                                </ul>
                            </main>
                        </div><!-- end just in -->

                        <div>
                            <hr class="opacity-100">
                        </div>

                        <div class="editors-picks">
                            <header>
                                <h5 class="fs-reset mb-3 text-danger">
                                    <b class="fw-bold">EDITOR'S PICK'S</b>
                                </h5>
                            </header>
                            <main>
                                <ul class="list-group list-group-flush">
                                    @foreach ($editorpicknews as $epn)
                                        @if ($loop->first)
                                            <li class="list-group-item px-0">
                                                <div class="news-item">
                                                    <header>
                                                        <div class="ratio ratio-4x3 news-img">
                                                            <img src="" class="object-fit-cover" alt="">
                                                        </div>
                                                    </header>
                                                    <main>
                                                        <p class="news-category">
                                                            <small><b class="fw-bold">Politic</b> Donald Trump</small>
                                                        </p>
                                                        <h5 class="news-title fs-5">
                                                            <b class="fw-bold">
                                                                <a href="{{ route('front.news.show', $epn->slug) }}"
                                                                    class="text-reset link-hover-underline">
                                                                    {{ $epn->title }}
                                                                </a>
                                                            </b>
                                                        </h5>
                                                        <div class="news-time media small">
                                                            <div class="media-header">
                                                                <div class="ratio ratio-1x1 rounded-circle"
                                                                    style="width: 2rem;">
                                                                </div>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="mb-1"><small class="opacity-75">Author
                                                                        by</small> <b
                                                                        class="fw-medium">{{ $epn->author }}</b>
                                                                </div>
                                                                <div>
                                                                    <small>{{ $epn->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </main>
                                                </div>
                                            </li>
                                        @else
                                            <li class="list-group-item px-0">
                                                <div class="news-item">
                                                    <div class="row">
                                                        <div class="col col-7">
                                                            <p class="news-category">
                                                                <small><small><b class="fw-bold">Politic</b> Donald
                                                                        Trump</small></small>
                                                            </p>
                                                            <h5 class="news-title fs-6">
                                                                <b class="fw-bold">
                                                                    <a href="detail.html"
                                                                        class="text-reset link-hover-underline">
                                                                        {{ $epn->title }}
                                                                    </a>
                                                                </b>
                                                            </h5>
                                                        </div><!-- end col -->
                                                        <div class="col col-5">
                                                            <div class="ratio ratio-4x3 news-img">
                                                                <img src="" class="object-fit-cover"
                                                                    alt="">
                                                            </div>
                                                        </div><!-- end col -->
                                                    </div><!-- end row -->
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- <li class="list-group-item px-0">
                                         <div class="news-item">
                                             <div class="row">
                                                 <div class="col col-7">
                                                     <p class="news-category">
                                                         <small><small><b class="fw-bold">Politic</b> Donald
                                                                 Trump</small></small>
                                                     </p>
                                                     <h5 class="news-title fs-6">
                                                         <b class="fw-bold">
                                                             <a href="detail.html"
                                                                 class="text-reset link-hover-underline">
                                                                 Sorry, Donald, but the celebrities you covet will
                                                                 never be your friends
                                                             </a>
                                                         </b>
                                                     </h5>
                                                 </div><!-- end col -->
                                                 <div class="col col-5">
                                                     <div class="ratio ratio-4x3 news-img">
                                                         <img src="" class="object-fit-cover" alt="">
                                                     </div>
                                                 </div><!-- end col -->
                                             </div><!-- end row -->
                                         </div>
                                     </li> --}}
                                    {{-- <li class="list-group-item px-0">
                                         <div class="news-item">
                                             <div class="row">
                                                 <div class="col col-7">
                                                     <p class="news-category">
                                                         <small><small><b class="fw-bold">Politic</b> Donald
                                                                 Trump</small></small>
                                                     </p>
                                                     <h5 class="news-title fs-6">
                                                         <b class="fw-bold">
                                                             <a href="detail.html"
                                                                 class="text-reset link-hover-underline">
                                                                 Sorry, Donald, but the celebrities you covet will
                                                                 never be your friends
                                                             </a>
                                                         </b>
                                                     </h5>
                                                 </div><!-- end col -->
                                                 <div class="col col-5">
                                                     <div class="ratio ratio-4x3 news-img">
                                                         <img src="" class="object-fit-cover" alt="">
                                                     </div>
                                                 </div><!-- end col -->
                                             </div><!-- end row -->
                                         </div>
                                     </li> --}}
                                </ul>
                            </main>
                        </div><!-- end editors picks -->

                    </aside><!-- end sidenav -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

@endsection
