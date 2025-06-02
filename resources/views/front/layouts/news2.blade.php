<div class="row g-0">
    {{-- Berita 1 --}}
    {{-- @dump($items) --}}
    @if (isset($items[0]))
        <div class="col px-3 col-12 col-md-7">
            <div class="news-item">
                <header>
                    <p class="news-category">
                        <small>
                            <b class="fw-bold">{{ $items[0]->category->name ?? 'General' }}</b> {{ $items[0]->title }}
                        </small>
                    </p>
                    @if ($items[0]->color == 'P')
                        <h5 class="news-title text-danger">
                        @elseif ($items[0]->color == 'Y')
                            <h5 class="news-title text-warning">
                            @else
                                <h5 class="news-title ">
                    @endif
                    <b class="fw-bold">
                        <a href="{{ url('/news/' . $items[0]->slug) }}" class="text-reset link-hover-underline">
                            {{ $items[0]->title }}
                        </a>
                    </b>
                    </h5>
                </header>
                <main>
                    <div class="row row-cols-1">
                        <div class="col">
                            <div class="ratio ratio-4x3 news-img">
                                <img src="{{ asset($items[0]->image ?? 'assets/template3/asset/news/default.jpg') }}"
                                    class="object-fit-cover" alt="">
                            </div>
                        </div>
                        <div class="col">
                            <p class="news-text">
                                {{ Str::words(strip_tags($items[0]->content), 30, '...') }}
                            </p>
                            <div class="news-time media small">
                                <div class="media-header">
                                    <div class="ratio ratio-1x1 rounded-circle" style="width: 2rem;">
                                        @if ($items[0]->color == 'P')
                                            <img src="assets/template3/asset/img/user/clara.jpg"
                                                class="object-fit-cover" alt="">
                                        @elseif ($items[0]->color == 'Y')
                                            <img src="assets/template3/asset/img/user/lola.jpg" class="object-fit-cover"
                                                alt="">
                                        @else
                                            <img src="assets/template3/asset/img/user/phor.jpg" class="object-fit-cover"
                                                alt="">
                                        @endif
                                    </div>
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
        <div class="col col-12 col-md-auto">
            <hr class="d-md-none">
            <div class="vr h-100 d-none d-md-block"></div>
        </div>
    @endif
    {{-- ================================================================================================================================================================ --}}
    <div class="col col-12 col-md">
        <div class="row g-0">
            {{-- Berita 2 --}}
            @if (isset($items[1]))
                <div class="col px-3 col-12">
                    <div class="news-item">
                        <header>
                            <p class="news-category">
                                <small>
                                    <b class="fw-bold">{{ $items[1]->category->name ?? 'General' }}</b>
                                    {{ $items[1]->title }}
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
                            <div class="row row-cols-1">
                                <div class="col d-none">
                                    <div class="ratio ratio-4x3 news-img">
                                        <img src="{{ asset($items[1]->image ?? 'assets/template3/asset/news/default.jpg') }}"
                                            class="object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="news-text elipsis-4">
                                        {{ Str::words(strip_tags($items[1]->content), 30, '...') }}
                                    </p>
                                    <div class="news-time media small">
                                        <div class="media-header">
                                            <div class="ratio ratio-1x1 rounded-circle" style="width: 2rem;">
                                                @if ($items[1]->color == 'P')
                                                    <img src="assets/template3/asset/img/user/clara.jpg"
                                                        class="object-fit-cover" alt="">
                                                @elseif ($items[1]->color == 'Y')
                                                    <img src="assets/template3/asset/img/user/lola.jpg"
                                                        class="object-fit-cover" alt="">
                                                @else
                                                    <img src="assets/template3/asset/img/user/phor.jpg"
                                                        class="object-fit-cover" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="mb-1"><small class="opacity-75">Author by</small> @if ($items[1]->color == 'P')
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
                <div class="col col-12 px-md-3">
                    <hr>
                </div>
            @endif
            {{-- =============================================================================================================================================== --}}
            {{-- Berita 3 --}}
            @if (isset($items[2]))
                <div class="col px-3 col-12">
                    <div class="news-item">
                        <header>
                            <p class="news-category">
                                <small>
                                    <b class="fw-bold">{{ $items[2]->category->name ?? 'General' }}</b>
                                    {{ $items[2]->title }}
                                </small>
                            </p>
                            <h5 class="news-title">
                                <b class="fw-bold">
                                    <a href="{{ url('/news/' . $items[2]->slug) }}"
                                        class="text-reset link-hover-underline">
                                        {{ $items[2]->title }}
                                    </a>
                                </b>
                            </h5>
                        </header>
                        <main>
                            <div class="row row-cols-1">
                                <div class="col d-none">
                                    <div class="ratio ratio-4x3 news-img">
                                        <img src="{{ asset($items[2]->image ?? 'assets/template3/asset/news/default.jpg') }}"
                                            class="object-fit-cover" alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <p class="news-text elipsis-4">
                                        {{ Str::words(strip_tags($items[2]->content), 30, '...') }}
                                    </p>
                                    <div class="news-time media small">
                                        <div class="media-header">
                                            <div class="ratio ratio-1x1 rounded-circle" style="width: 2rem;">
                                                @if ($items[2]->color == 'P')
                                                    <img src="assets/template3/asset/img/user/clara.jpg"
                                                        class="object-fit-cover" alt="">
                                                @elseif ($items[2]->color == 'Y')
                                                    <img src="assets/template3/asset/img/user/lola.jpg"
                                                        class="object-fit-cover" alt="">
                                                @else
                                                    <img src="assets/template3/asset/img/user/phor.jpg"
                                                        class="object-fit-cover" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="mb-1"><small class="opacity-75">Author by</small> @if ($items[2]->color == 'P')
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
    </div>
</div>
<div class="px-md-3">
    <hr>
</div>
