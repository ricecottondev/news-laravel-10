<div class="row g-0">
    <div class="col col-12 col-md-8">
        <div class="row g-0">
            <div class="col col-12 px-md-3">
                <hr>
            </div>
            <div class="col col-12 px-3">
                <h5 class="text-uppercase mb-4">
                    <b class="fw-bold">{{ strtoupper($category ?? 'CATEGORY') }}</b> <i class="fas fa-chevron-right"></i>
                </h5>
            </div>
            @if (count($items) > 0)
                @php $first = $items[0]; @endphp
                <div class="col col-12 col-md px-3">
                    <div class="news-item">
                        @if ($first->image)
                            <header>
                                <div class="ratio ratio-4x3 news-img mb-3">
                                    <img src="{{ asset('storage/' . $first->image) }}" class="object-fit-cover"
                                        alt="{{ $first->title }}">
                                </div>
                            </header>
                        @endif
                        <main>
                            @if (strtoupper($first->color) == 'P')
                                <h5 class="news-title text-danger">
                                @elseif (strtoupper($first->color) == 'Y')
                                    <h5 class="news-title text-warning">
                                    @else
                                        <h5 class="news-title ">
                            @endif
                            <b class="fw-bold">
                                <a href="{{ route('front.news.show', $first->slug) }}"
                                    class="text-reset link-hover-underline">
                                    {{ $first->title }}
                                </a>
                            </b>
                            </h5>
                            <p class="news-text elipsis-4">
                                {{ Str::words(strip_tags($first->content), 30, '...') }}
                            </p>
                            <div class="news-time media small">
                                <div class="media-header">
                                    @if (strtoupper($first->color) == 'P')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-danger"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/clara.jpg"
                                                class="object-fit-cover" alt="">
                                        </div>
                                    @elseif (strtoupper($first->color) == 'Y')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-warning"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/lola.jpg"
                                                class="object-fit-cover" alt="">
                                        </div>
                                    @else
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-white"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/phor.jpg"
                                                class="object-fit-cover" alt="">
                                        </div>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <div><small class="opacity-75">Author by</small>
                                        @if (strtoupper($first->color) == 'P')
                                            <b class="fw-medium text-danger">Clara</b>
                                        @elseif (strtoupper($first->color) == 'Y')
                                            <b class="fw-medium text-warning">Lola</b>
                                        @else
                                            <b class="fw-medium">Phor</b>
                                        @endif
                                    </div>
                                    <div><small>{{ $first->created_at->diffForHumans() }}</small></div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            @endif

            <div class="col col-12 col-md-auto">
                <hr class="d-md-none">
                <div class="vr h-100 d-none d-md-block"></div>
            </div>

            <div class="col col-12 col-md">
                @foreach ($items->slice(1, 3) as $item)
                    <div class="px-3">
                        <div class="news-item">
                            <div class="row">
                                <div class="col col-8">
                                    @if (strtoupper($item->color) == 'P')
                                        <h5 class="news-title text-danger">
                                        @elseif (strtoupper($item->color) == 'Y')
                                            <h5 class="news-title text-warning">
                                            @else
                                                <h5 class="news-title ">
                                    @endif
                                    <b class="fw-bold">
                                        <a href="{{ route('front.news.show', $item->slug) }}"
                                            class="text-reset link-hover-underline">
                                            {{ $item->title }}
                                        </a>
                                    </b>
                                    </h5>
                                    <div class="news-time media small">
                                        <div class="media-header">
                                            @if (strtoupper($item->color) == 'P')
                                                <div class="ratio ratio-1x1 rounded-circle border border-2 border-danger"
                                                    style="width: 2rem;">
                                                    <img src="/assets/template3/asset/img/user/clara.jpg"
                                                        class="object-fit-cover" alt="">
                                                </div>
                                            @elseif (strtoupper($item->color) == 'Y')
                                                <div class="ratio ratio-1x1 rounded-circle border border-2 border-warning"
                                                    style="width: 2rem;">
                                                    <img src="/assets/template3/asset/img/user/lola.jpg"
                                                        class="object-fit-cover" alt="">
                                                </div>
                                            @else
                                                <div class="ratio ratio-1x1 rounded-circle border border-2 border-white"
                                                    style="width: 2rem;">
                                                    <img src="/assets/template3/asset/img/user/phor.jpg"
                                                        class="object-fit-cover" alt="">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            <div><small class="opacity-75">Author by</small>
                                                @if (strtoupper($item->color) == 'P')
                                                    <b class="fw-medium text-danger">Clara</b>
                                                @elseif (strtoupper($item->color) == 'Y')
                                                    <b class="fw-medium text-warning">Lola</b>
                                                @else
                                                    <b class="fw-medium">Phor</b>
                                                @endif
                                            </div>
                                            <div><small>{{ $item->created_at->diffForHumans() }}</small></div>
                                        </div>
                                    </div>
                                </div>
                                @if ($item->image)
                                    <div class="col col-4">
                                        <div class="ratio ratio-1x1 news-img">
                                            <img src="{{ asset('storage/' . $item->image) }}" class="object-fit-cover"
                                                alt="{{ $item->title }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                        <div class="px-md-3">
                            <hr>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col col-12 col-md-auto">
        <div class="vr h-100 d-none d-md-block mx-lg-3"></div>
    </div>
    <div class="col col-12 col-md">
        <div class="sidenav">
            <div class="px-md-3">
                <hr class="mb-0">
            </div>
            <div class="more px-3">
                <header>
                    <h5 class="fs-reset mb-3 text-danger">
                        <b class="fw-bold">MORE IN {{ strtoupper($category ?? '-') }}</b>
                    </h5>
                </header>
                <main>
                    <ul class="more-list list-unstyled d-flex flex-column row-gap-4 small">
                        @foreach ($items->slice(4) as $item)
                            <li class="more-item">
                                <a href="{{ route('front.news.show', $item->slug) }}"
                                    class="text-reset link-hover link-hover-underline">
                                    <b class="fw-bold text-uppercase">{{ $item->slug ?? '' }}</b> -
                                    {{ Str::words(strip_tags($item->short_desc), 35, '...') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </main>
            </div>
        </div>
    </div>
</div>
