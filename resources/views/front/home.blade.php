 @extends('front/layouts.layout')
 @section('content')
     @php
         $withImage = $topnews->filter(fn($item) => $item->image)->values();
         $noImage = $topnews->filter(fn($item) => !$item->image)->values();
         $withImageIndex = 0;
         $noImageIndex = 0;
         $layoutCount = 1;
     @endphp
     <section>
         <div class="container-md px-0 px-md-3">
             <div class="row g-0 row-gap-5">
                 <div class="col col-12 col-lg-8 pe-lg-4">
                     <div class="row g-0 row-cols-1">

                         @while ($withImageIndex < $withImage->count() || $noImageIndex < $noImage->count())
                             @php
                                 $isOdd = $layoutCount % 2 === 1;
                             @endphp

                             {{-- ---------------- Layout 1 (Ganjil) ---------------- --}}
                             @if ($isOdd && isset($withImage[$withImageIndex]))
                                 @php
                                     $news1 = $withImage[$withImageIndex++];
                                     $news2 = $withImage[$withImageIndex++] ?? null;
                                     $news3 = $withImage[$withImageIndex++] ?? null;
                                 @endphp

                                 <div class="col">
                                     <div class="row g-0">
                                         <div class="col col-12 px-3 px-md-0">
                                             <div class="news-item row">
                                                 <div class="col col-12">
                                                     <p class="news-category mb-1">
                                                         <small><b class="fw-medium">{{ $news1->category->name ?? '-' }}</b>
                                                             {{ $news1->author }}</small>
                                                     </p>
                                                     <h5 class="news-title fs-1 mb-3 text-danger">
                                                         <a href="{{ route('front.news.show', $news1->slug) }}"
                                                             class="link-hover-underline opacity-100">
                                                             <b class="fw-medium">{{ $news1->title }}</b>
                                                         </a>
                                                     </h5>
                                                     <div class="row">
                                                         <div class="col col-12 col-md-7 order-md-2">
                                                             <div class="news-img ratio ratio-4x3 mb-3">
                                                                 <img src="{{ asset('storage/' . $news1->image) }}"
                                                                     class="object-fit-cover w-100 h-100" alt="">
                                                             </div>
                                                         </div>
                                                         <div class="col col-12 col-md-5 order-md-1">
                                                             <p class="news-text mb-4">
                                                                 {{ Str::words(strip_tags($news1->content), 25, '...') }}
                                                             </p>
                                                             <div class="news-time media small">
                                                                 <div class="media-header">
                                                                     <div class="ratio ratio-1x1 rounded-circle"
                                                                         style="width: 2rem;"></div>
                                                                 </div>
                                                                 <div class="media-body">
                                                                     <div class="mb-1"><small class="opacity-75">Author
                                                                             by</small> <b
                                                                             class="fw-medium">{{ $news1->author }}</b>
                                                                     </div>
                                                                     <div>
                                                                         <small>{{ $news1->created_at->diffForHumans() }}</small>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col col-12">
                                             <hr>
                                         </div>

                                         @foreach ([$news2, $news3] as $news)
                                             @if ($news)
                                                 <div
                                                     class="col col-12 col-md-{{ $loop->first ? '7' : '5' }} {{ $loop->first ? 'px-3 ps-md-0' : 'border-md-start px-3 pe-md-0' }}">
                                                     <div class="news-item row">
                                                         <div class="col col-12">
                                                             <p class="news-category mb-1">
                                                                 <small><b
                                                                         class="fw-medium">{{ $news->category->name ?? '-' }}</b>
                                                                     {{ $news->author }}</small>
                                                             </p>
                                                             <h5
                                                                 class="news-title fs-4 mb-4 {{ $loop->first ? 'text-warning' : '' }}">
                                                                 <a href="{{ route('front.news.show', $news->slug) }}"
                                                                     class="link-hover-underline opacity-100">
                                                                     <b class="fw-medium">{{ $news->title }}</b>
                                                                 </a>
                                                             </h5>
                                                             <div class="row">
                                                                 <div class="col col-7">
                                                                     <p class="news-text mb-4">
                                                                         {{ Str::words(strip_tags($news->content), 20, '...') }}
                                                                     </p>
                                                                     <div class="news-time media small">
                                                                         <div class="media-header">
                                                                             <div class="ratio ratio-1x1 rounded-circle"
                                                                                 style="width: 2rem;"></div>
                                                                         </div>
                                                                         <div class="media-body">
                                                                             <div class="mb-1"><small
                                                                                     class="opacity-75">Author by</small> <b
                                                                                     class="fw-medium">{{ $news->author }}</b>
                                                                             </div>
                                                                             <div>
                                                                                 <small>{{ $news->created_at->diffForHumans() }}</small>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 <div class="col col-5">
                                                                     <div class="news-img ratio ratio-4x3 mb-3">
                                                                         <img src="{{ asset('storage/' . $news->image) }}"
                                                                             class="object-fit-cover w-100 h-100"
                                                                             alt="">
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         @endforeach
                                     </div>
                                 </div>
                                 <div class="col">
                                     <hr class="opacity-75 my-4">
                                 </div>

                                 {{-- ---------------- Layout 2 (Genap) ---------------- --}}
                             @elseif (!$isOdd && isset($withImage[$withImageIndex]))
                                 @php
                                     $main = $withImage[$withImageIndex++];
                                     $side1 = $noImage[$noImageIndex++] ?? null;
                                     $side2 = $noImage[$noImageIndex++] ?? null;
                                 @endphp

                                 <div class="col">
                                     <div class="row g-0">
                                         <div class="col col-12 px-3 col-md-7 ps-md-0">
                                             <div class="news-item row">
                                                 <div class="col col-12">
                                                     <p class="news-category mb-1">
                                                         <small><b class="fw-medium">{{ $main->category->name ?? '-' }}</b>
                                                             {{ $main->author }}</small>
                                                     </p>
                                                     <h5 class="news-title fs-2 mb-3 text-danger">
                                                         <a href="{{ route('front.news.show', $main->slug) }}"
                                                             class="link-hover-underline opacity-100">
                                                             <b class="fw-medium">{{ $main->title }}</b>
                                                         </a>
                                                     </h5>
                                                     <div class="news-img ratio ratio-4x3 mb-3">
                                                         <img src="{{ asset('storage/' . $main->image) }}"
                                                             class="object-fit-cover w-100 h-100" alt="">
                                                     </div>
                                                     <p class="news-text mb-4">
                                                         {{ Str::words(strip_tags($main->content), 25, '...') }}</p>
                                                     <div class="news-time media small">
                                                         <div class="media-header">
                                                             <div class="ratio ratio-1x1 rounded-circle"
                                                                 style="width: 2rem;"></div>
                                                         </div>
                                                         <div class="media-body">
                                                             <div class="mb-1"><small class="opacity-75">Author by</small>
                                                                 <b class="fw-medium">{{ $main->author }}</b>
                                                             </div>
                                                             <div><small>{{ $main->created_at->diffForHumans() }}</small>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="col col-12 d-md-none">
                                             <hr>
                                         </div>
                                         <div class="col col-12 col-md-5 border-md-start">
                                             <div class="row g-0 row-cols-1">
                                                 @foreach ([$side1, $side2] as $side)
                                                     @if ($side)
                                                         <div class="col px-3">
                                                             <div class="news-item row">
                                                                 <div class="col col-12">
                                                                     <p class="news-category mb-1">
                                                                         <small><b
                                                                                 class="fw-medium">{{ $side->category->name ?? '-' }}</b>
                                                                             {{ $side->author }}</small>
                                                                     </p>
                                                                     <h5 class="news-title fs-4 mb-4">
                                                                         <a href="{{ route('front.news.show', $side->slug) }}"
                                                                             class="link-hover-underline opacity-100">
                                                                             <b class="fw-medium">{{ $side->title }}</b>
                                                                         </a>
                                                                     </h5>
                                                                     <p class="news-text mb-4">
                                                                         {{ Str::words(strip_tags($side->content), 20, '...') }}
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
                                                                                     class="fw-medium">{{ $side->author }}</b>
                                                                             </div>
                                                                             <div>
                                                                                 <small>{{ $side->created_at->diffForHumans() }}</small>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                         @if (!$loop->last)
                                                             <div class="col ps-md-3">
                                                                 <hr>
                                                             </div>
                                                         @endif
                                                     @endif
                                                 @endforeach
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endif

                             @php $layoutCount++; @endphp
                         @endwhile

                     </div><!-- end row -->
                 </div><!-- end col -->
                 <div class="col col-12 col-lg-4 ps-lg-4 border-lg-start">
                     <hr class="border-3 opacity-100 my-4 mt-lg-0">
                     <aside class="sticky-top" style="top: 13rem;">
                         <h5 class="mb-3 px-3 px-md-0"><b class="fw-bold">JUST IN</b></h5>
                         <div class="just-wrapper">
                             <div class="row g-0 row-cols-1 row-cols-md-2 row-cols-lg-1 just-list">
                                 <div class="col py-3 px-3 border-bottom px-md-0">
                                     <p class="mb-0"><small>2 minutes ago</small></p>
                                     <p class="fs-5 m-0">
                                         <b class="fw-mediumx">
                                             Exclusive liberals and Nationals closer on Coalition fix,
                                             spotlight moves to litleproud leadership.
                                         </b>
                                     </p>
                                 </div><!-- end col -->
                                 <div class="col py-3 px-3 border-bottom px-md-0">
                                     <p class="mb-0"><small>2 minutes ago</small></p>
                                     <p class="fs-5 m-0">
                                         <b class="fw-mediumx">
                                             Exclusive liberals and Nationals closer on Coalition fix,
                                             spotlight moves to litleproud leadership.
                                         </b>
                                     </p>
                                 </div><!-- end col -->
                                 <div class="col py-3 px-3 border-bottom px-md-0">
                                     <p class="mb-0"><small>2 minutes ago</small></p>
                                     <p class="fs-5 m-0">
                                         <b class="fw-mediumx">
                                             Exclusive liberals and Nationals closer on Coalition fix,
                                             spotlight moves to litleproud leadership.
                                         </b>
                                     </p>
                                 </div><!-- end col -->
                                 <div class="col py-3 px-3 border-bottom px-md-0">
                                     <p class="mb-0"><small>2 minutes ago</small></p>
                                     <p class="fs-5 m-0">
                                         <b class="fw-mediumx">
                                             Exclusive liberals and Nationals closer on Coalition fix,
                                             spotlight moves to litleproud leadership.
                                         </b>
                                     </p>
                                 </div><!-- end col -->
                                 <div class="col py-3 px-3 border-bottom px-md-0">
                                     <p class="mb-0"><small>2 minutes ago</small></p>
                                     <p class="fs-5 m-0">
                                         <b class="fw-mediumx">
                                             Exclusive liberals and Nationals closer on Coalition fix,
                                             spotlight moves to litleproud leadership.
                                         </b>
                                     </p>
                                 </div><!-- end col -->
                                 <div class="col py-3 px-3 border-bottom px-md-0">
                                     <p class="mb-0"><small>2 minutes ago</small></p>
                                     <p class="fs-5 m-0">
                                         <b class="fw-mediumx">
                                             Exclusive liberals and Nationals closer on Coalition fix,
                                             spotlight moves to litleproud leadership.
                                         </b>
                                     </p>
                                 </div><!-- end col -->
                             </div><!-- end row -->
                         </div>
                         <hr class="border-3 opacity-100 my-4">
                         <h5 class="mb-3 px-3 px-md-0"><b class="fw-bold">EDITOR'S PICKS</b></h5>
                         <div class="row g-0">
                             <div class="col col-12 px-3 col-md-6 ps-md-0 col-lg-12 px-lg-0">
                                 <div class="news-item row g-0">
                                     <div class="col col-12">
                                         <div class="news-img ratio ratio-4x3 mb-3">
                                             <img src="" class="object-fit-cover" alt="">
                                         </div>
                                         <p class="news-category mb-1">
                                             <small><b class="fw-medium">Politic</b> Donald Trump</small>
                                         </p>
                                         <h5 class="news-title fs-5 mb-3">
                                             <a href="detail.html" class="link-hover-underline opacity-100">
                                                 <b class="fw-medium">
                                                     Sorry, Donald, but the celebrities you covet will never
                                                     be your friends
                                                 </b>
                                             </a>
                                         </h5>
                                         <div class="news-time media small">
                                             <div class="media-header">
                                                 <div class="ratio ratio-1x1 rounded-circle" style="width: 2rem;"></div>
                                             </div>
                                             <div class="media-body">
                                                 <div class="mb-1"><small class="opacity-75">Author
                                                         by</small> <b class="fw-medium">Yoggi Pradhokot</b>
                                                 </div>
                                                 <div><small>5 minutes ago</small></div>
                                             </div>
                                         </div>
                                     </div><!-- end col -->
                                 </div><!-- end news item -->
                             </div><!-- end col -->
                             <div class="col col-12 px-3 col-md-6 pe-md-0 border-md-start col-lg-12 px-lg-0 border-lg-0">
                                 <div class="row g-0">
                                     <div class="col col-12 d-md-none d-lg-block">
                                         <hr>
                                     </div><!-- end col -->
                                     <div class="col col-12">
                                         <div class="news-item row">
                                             <div class="col col-7">
                                                 <p class="news-category mb-1">
                                                     <small><b class="fw-medium">Politic</b> Donald
                                                         Trump</small>
                                                 </p>
                                                 <h5 class="news-title text-reset">
                                                     <a href="detail.html" class="link-hover-underline opacity-100">
                                                         <b class="fw-medium">
                                                             Sorry, Donald, but the celebrities you covet
                                                             will never be your friends
                                                         </b>
                                                     </a>
                                                 </h5>
                                             </div><!-- end col -->
                                             <div class="col col-5">
                                                 <div class="news-img ratio ratio-4x3">
                                                     <img src="" class="object-fit-cover" alt="">
                                                 </div>
                                             </div><!-- end col -->
                                         </div><!-- end news item -->
                                     </div><!-- end col -->
                                     <div class="col col-12">
                                         <hr>
                                     </div><!-- end col -->
                                     <div class="col col-12">
                                         <div class="news-item row">
                                             <div class="col col-7">
                                                 <p class="news-category mb-1">
                                                     <small><b class="fw-medium">Politic</b> Donald
                                                         Trump</small>
                                                 </p>
                                                 <h5 class="news-title text-reset">
                                                     <a href="detail.html" class="link-hover-underline opacity-100">
                                                         <b class="fw-medium">
                                                             Sorry, Donald, but the celebrities you covet
                                                             will never be your friends
                                                         </b>
                                                     </a>
                                                 </h5>
                                             </div><!-- end col -->
                                             <div class="col col-5">
                                                 <div class="news-img ratio ratio-4x3">
                                                     <img src="" class="object-fit-cover" alt="">
                                                 </div>
                                             </div><!-- end col -->
                                         </div><!-- end news item -->
                                     </div><!-- end col -->
                                 </div><!-- end row -->
                             </div><!-- end col -->
                         </div><!-- end row -->
                     </aside><!-- sticky right aside -->
                 </div><!-- end col -->
             </div><!-- end row -->
         </div><!-- end container -->
     </section>
 @endsection
