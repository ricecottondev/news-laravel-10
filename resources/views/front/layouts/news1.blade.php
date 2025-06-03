<div class="row g-0">

    {{-- Berita 1 --}}
    @if (isset($items[0]))
        <div class="col px-3 col-12">
            <div class="news-item">
                <header>
                    <p class="news-category">
                        @php
                            $categoryName = $items[0]->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                        @endphp
                        <small>
                            @if ($items[0]->order == '1')
                                <b class="fw-bold">Top Roast of The Day!</b>
                            @elseif ($items[0]->order == '2')
                                <b class="fw-bold">WTF!</b>
                            @elseif ($items[0]->order == '3')
                                <b class="fw-bold">Who voted for this?!</b>
                            @elseif ($items[0]->order == '7')
                                <b class="fw-bold">Burn it all down!</b>
                            @elseif ($items[0]->order == '8')
                                <b class="fw-bold">Who's getting dragged today?</b>
                            @else
                                <b class="fw-bold">{{ $categoryName ?? '-' }}</b>
                            @endif

                        </small>
                    </p>
                    @if ($items[0]->color == 'P')
                        <h5 class="news-title hot-news text-danger">
                        @elseif ($items[0]->color == 'Y')
                            <h5 class="news-title hot-news text-warning">
                            @else
                                <h5 class="news-title hot-news">
                    @endif
                    <b class="fw-bold">
                        <a href="{{ url('/news/' . $items[0]->slug) }}" class="text-reset link-hover-underline">
                            {{ $items[0]->title }}
                        </a>
                    </b>
                    </h5>
                </header>
                <main>
                    <div class="row row-cols-1 {{ $items[0]->image ? 'row-cols-md-2' : 'row-cols-md-1' }}">
                        @if ($items[0]->image)
                            <div class="col order-md-2">
                                <div class="ratio ratio-4x3 news-img">
                                    <img src="{{ asset('storage/' . $items[0]->image) }}" class="object-fit-cover"
                                        alt="{{ $items[0]->title }}">
                                </div>
                            </div>
                        @endif
                        <div class="col order-md-1">
                            <p class="news-text">
                                {{ Str::words(strip_tags($items[0]->short_desc), 40, '...') }}
                            </p>
                            <div class="news-time media small">
                                <div class="media-header">
                                    @if ($items[0]->color == 'P')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-danger"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/clara.jpg"
                                                class="object-fit-cover" alt="">
                                        </div>
                                    @elseif ($items[0]->color == 'Y')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-warning"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/lola.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    @else
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-white"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/phor.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <div class="mb-1"><small class="opacity-75">Author by</small>
                                        @if ($items[0]->color == 'P')
                                            <b class="fw-medium text-danger">Clara</b>
                                        @elseif ($items[0]->color == 'Y')
                                            <b class="fw-medium text-warning">Lola</b>
                                        @else
                                            <b class="fw-medium">Phor</b>
                                        @endif

                                    </div>
                                    <div><small>{{ $items[0]->created_at->diffForHumans() }}</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="col col-12 px-md-3">
            <hr>
        </div>
    @endif

    {{-- Berita 2 --}}
    @if (isset($items[1]))
        <div class="col px-3 col-12 col-md-7">
            <div class="news-item">
                <header>
                    <p class="news-category">
                        @php
                            $categoryName = $items[1]->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                        @endphp
                        <small>
                             <small>
                            @if ($items[1]->order == '1')
                                <b class="fw-bold">Top Roast of The Day!</b>
                            @elseif ($items[1]->order == '2')
                                <b class="fw-bold">WTF!</b>
                            @elseif ($items[1]->order == '3')
                                <b class="fw-bold">Who voted for this?!</b>
                            @elseif ($items[1]->order == '7')
                                <b class="fw-bold">Burn it all down!</b>
                            @elseif ($items[1]->order == '8')
                                <b class="fw-bold">Who's getting dragged today?</b>
                            @else
                                <b class="fw-bold">{{ $categoryName ?? '-' }}</b>
                            @endif

                        </small>
                        </small>
                    </p>
                    @if ($items[1]->color == 'P')
                        <h5 class="news-title text-danger">
                        @elseif ($items[1]->color == 'Y')
                            <h5 class="news-title text-warning">
                            @else
                                <h5 class="news-title ">
                    @endif
                    <b class="fw-bold">
                        <a href="{{ url('/news/' . $items[1]->slug) }}" class="text-reset link-hover-underline">
                            {{ $items[1]->title }}
                        </a>
                    </b>
                    </h5>
                </header>
                <main>
                    <div class="row row-cols-1 {{ $items[1]->image ? 'row-cols-md-2' : 'row-cols-md-1' }}">
                        @if ($items[1]->image)
                            <div class="col order-md-2">
                                <div class="ratio ratio-4x3 news-img">
                                    <img src="{{ asset('storage/' . $items[1]->image) }}" class="object-fit-cover"
                                        alt="{{ $items[1]->title }}">
                                </div>
                            </div>
                        @endif
                        <div class="col order-md-1">
                            <p class="news-text {{ $items[1]->image ? 'elipsis-4' : 'elipsis-6' }}">
                                {{ Str::words(strip_tags($items[1]->short_desc), 50, '...') }}
                            </p>
                            <div class="news-time media small">
                                <div class="media-header">
                                    @if ($items[1]->color == 'P')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-danger"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/clara.jpg"
                                                class="object-fit-cover" alt="">
                                        </div>
                                    @elseif ($items[1]->color == 'Y')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-warning"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/lola.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    @else
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-white"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/phor.jpg" class="object-fit-cover"
                                                alt="">
                                        </div>
                                    @endif
                                </div>
                                <div class="media-body">
                                    <div class="mb-1"><small class="opacity-75">Author by</small>
                                        @if ($items[1]->color == 'P')
                                            <b class="fw-medium text-danger">Clara</b>
                                        @elseif ($items[1]->color == 'Y')
                                            <b class="fw-medium text-warning">Lola</b>
                                        @else
                                            <b class="fw-medium">Phor</b>
                                        @endif
                                    </div>
                                    <div><small>{{ $items[1]->created_at->diffForHumans() }}</small></div>
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
    @endif

    {{-- Berita 3 --}}
    @if (isset($items[2]))
        <div class="col px-3 col-12 col-md">
            <div class="news-item">
                <header>
                    <p class="news-category">
                        @php
                            $categoryName = $items[2]->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
                        @endphp
                        <small>
                            <small>
                            @if ($items[2]->order == '1')
                                <b class="fw-bold">Top Roast of The Day!</b>
                            @elseif ($items[2]->order == '2')
                                <b class="fw-bold">WTF!</b>
                            @elseif ($items[2]->order == '3')
                                <b class="fw-bold">Who voted for this?!</b>
                            @elseif ($items[2]->order == '7')
                                <b class="fw-bold">Burn it all down!</b>
                            @elseif ($items[2]->order == '8')
                                <b class="fw-bold">Who's getting dragged today?</b>
                            @else
                                <b class="fw-bold">{{ $categoryName ?? '-' }}</b>
                            @endif

                        </small>
                        </small>
                    </p>
                    @if ($items[2]->color == 'P')
                        <h5 class="news-title text-danger">
                        @elseif ($items[2]->color == 'Y')
                            <h5 class="news-title text-warning">
                            @else
                                <h5 class="news-title ">
                    @endif
                    <b class="fw-bold">
                        <a href="{{ url('/news/' . $items[2]->slug) }}" class="text-reset link-hover-underline">
                            {{ $items[2]->title }}
                        </a>
                    </b>
                    </h5>
                </header>
                <main>
                    <div class="row row-cols-1">
                        <div class="col order-md-1">
                            <p class="news-text elipsis-4 d-none d-md-block">
                                {{ Str::words(strip_tags($items[2]->short_desc), 30, '...') }}
                            </p>
                            <div class="news-time media small">
                                <div class="media-header">
                                    @if ($items[2]->color == 'P')
                                        <div class="ratio ratio-1x1 rounded-circle border border-2 border-danger"
                                            style="width: 2rem;">
                                            <img src="/assets/template3/asset/img/user/clara.jpg"
                                                class="object-fit-cover" alt="">
                                        </div>
                                    @elseif ($items[2]->color == 'Y')
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
                                    <div class="mb-1"><small class="opacity-75">Author by</small>
                                        @if ($items[2]->color == 'P')
                                            <b class="fw-medium text-danger">Clara</b>
                                        @elseif ($items[2]->color == 'Y')
                                            <b class="fw-medium text-warning">Lola</b>
                                        @else
                                            <b class="fw-medium">Phor</b>
                                        @endif
                                    </div>
                                    <div><small>{{ $items[2]->created_at->diffForHumans() }}</small></div>
                                </div>
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
