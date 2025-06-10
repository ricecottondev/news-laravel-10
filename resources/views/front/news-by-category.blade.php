@extends('front/layouts.layout')
@section('title', 'News by Category')
@push('styles')
     <link rel="stylesheet" href="/assets/template3/css/landing.css">
 @endpush
@section('content')

    <section class="pt-1">
        <div
            class="source-news text-bg-warning text-center py-1 mb-3 d-md-flex flex-wrap align-items-md-center px-md-3 justify-content-md-center column-gap-md-4">
             <div> “We read everything — SMH, ABC, Nine, Seven,SBS, 10News, The Guardian, anyone who does journalism, even the ones behind paywalls — and spin it into sarcasm faster than you can say ‘breaking’.”</div>
            @isset($countryname)
                @if ($countryname == 'usa')
                    <div class="d-flex flex-nowrap justify-content-center gap-2 align-items-center d-none">
                        <div>
                            <img src="/assets/template3/asset/img/bloomberg_news.png" width="20" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/bloomberg_news.png" width="35" height="auto"
                                alt="" class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/cnn_news.png" width="55" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/cnn_news.png" width="80" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/fox_news.png" width="55" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/fox_news.png" width="95" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/nyt_news.png" width="50" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/nyt_news.png" width="85" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/reuters_news.png" width="50" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/reuters_news.png" width="95" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <!-- end col -->
                    </div>
                    <div class="text-nowrap d-none">and anyone who still does journalism</div>
                @else
                    <div class="d-flex flex-nowrap justify-content-center gap-2 align-items-center d-none">
                        <div>
                            <img src="/assets/template3/asset/img/abc-logo-v1.png" width="20" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/abc-logo-v1.png" width="35" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/theguardian-logo.png" width="55" height="auto"
                                alt="" class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/theguardian-logo.png" width="80" height="auto"
                                alt="" class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/sbsnews-logo.png" width="55" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/sbsnews-logo.png" width="95" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/7news.png" width="50" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/7news.png" width="85" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/9news.png" width="50" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/9news.png" width="95" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/10news.png" width="50" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/10news.png" width="75" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                        <div>
                            <img src="/assets/template3/asset/img/smh.png" width="20" height="auto" alt=""
                                class="my-1 my-lg-0 d-lg-none">
                            <img src="/assets/template3/asset/img/smh.png" width="40" height="auto" alt=""
                                class="my-1 my-lg-0 d-none d-lg-inline">
                        </div><!-- end col -->
                    </div>
                    <div class="text-nowrap d-none">and anyone who still does journalism</div>
                @endif
            @endisset
        </div><!-- end source news -->

        <div class="journalist">
            <div class="container-lg">
                <div class="journalist">
                    <h5 class="fs-reset mb-3">
                        <b class="fw-bold">
                            Our Journalists
                        </b>
                    </h5>
                    <div class="journalist-list pb-3 text-center text-md-start">
                        <div class="row g-0 flex-nowrap">
                            <div class="col">
                                <div class="row g-3 journalist-item">
                                    <div class="col col-12 col-md-7">
                                        <div class="ratio ratio-1x1 border border-3 border-danger">
                                            <img src="/assets/template3/asset/img/user/clara.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col col-12 col-md-5">
                                        <h5 class="fs-4 text-danger">
                                            <a href="#" class="text-reset link-hover-underline">
                                                <b class="fw-bold">Clara</b>
                                            </a>
                                        </h5>
                                        <p class="m-0">
                                            Let's fix the news, with facts, fire and a wink.
                                        </p>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end col -->
                            <div class="col col-auto">
                                <div class="vr h-100 mx-3"></div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="row g-3 journalist-item">
                                    <div class="col col-12 col-md-7">
                                        <div class="ratio ratio-1x1 border border-3 border-warning">
                                            <img src="/assets/template3/asset/img/user/lola.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col col-12 col-md-5">
                                        <h5 class="fs-4 text-warning">
                                            <a href="#" class="text-reset link-hover-underline">
                                                <b class="fw-bold">Lola</b>
                                            </a>
                                        </h5>
                                        <p class="m-0">
                                            It is legal, unfortunately for them.
                                        </p>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end col -->
                            <div class="col col-auto">
                                <div class="vr h-100 mx-3"></div>
                            </div><!-- end col -->
                            <div class="col">
                                <div class="row g-3 journalist-item">
                                    <div class="col col-12 col-md-7">
                                        <div class="ratio ratio-1x1 border border-3 border-white">
                                            <img src="/assets/template3/asset/img/user/phor.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col col-12 col-md-5">
                                        <h5 class="fs-4 text-white">
                                            <a href="#" class="text-reset link-hover-underline">
                                                <b class="fw-bold">Phor</b>
                                            </a>
                                        </h5>
                                        <p class="m-0">
                                            When the truth hits, it hits like Phor.
                                        </p>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div>
                </div><!-- end journalist -->
            </div><!-- end container -->
        </div><!-- end journalist -->

        <hr class="mt-0">
    </section>
    <section>
        <div class="container-lg px-0">
            <div class="row g-0">
                <div class="col col-12 col-md-8">
                    @php
                        // $withImage = $news->filter(fn($item) => $item->image)->values();
                        // $noImage = $news->filter(fn($item) => !$item->image)->values();
                        // $withImageIndex = 0;
                        // $noImageIndex = 0;
                        // $layoutStep = 1;
                    @endphp
                    <!-- news -->
                    <div class="news">
                        @foreach ($news->values()->chunk(3) as $index => $chunk)
                             @php $chunk = $chunk->values(); @endphp {{-- Reindex ulang tiap chunk --}}
                             @if ((($index % 3) + 1) === 1)
                                 @include('front.layouts.news1', ['items' => $chunk])
                             @elseif ((($index % 3) + 1) === 2)
                                 @include('front.layouts.news3', ['items' => $chunk])
                             @elseif ((($index % 3) + 1) === 3)
                                 @include('front.layouts.news2', ['items' => $chunk])
                             @endif
                         @endforeach
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
                                                        @if ($epn->color == 'P')
                                                            <h5 class="news-title fs-5 text-danger">
                                                            @elseif ($epn->color == 'Y')
                                                                <h5 class="news-title fs-5 text-warning">
                                                                @else
                                                                    <h5 class="news-title fs-5">
                                                        @endif
                                                        {{-- <h5 class="news-title fs-5"> --}}
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
                                                            @if ($epn->color == 'P')
                                                                         <h5 class="news-title fs-6 text-danger">
                                                                         @elseif ($epn->color == 'Y')
                                                                             <h5 class="news-title fs-6 text-warning">
                                                                             @else
                                                                                 <h5 class="news-title fs-6">
                                                                     @endif
                                                            {{-- <h5 class="news-title fs-6"> --}}
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
