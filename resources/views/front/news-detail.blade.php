@extends('front/layouts.layout')

@push('styles')
    <link rel="stylesheet" href="/assets/template3/css/detail.css">
@endpush

@section('content')
    <section>
        <div class="container-lg px-0 pt-4">
            <div class="row g-0">
                <div class="col col-12 px-3">
                    <nav style="--bs-breadcrumb-divider: '/'; font-size: .75em;" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $news->category->name ?? 'Uncategorized' }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $news->title }}</li>
                        </ol>
                    </nav>
                </div>
                {{-- detail news container start --}}
                <div class="col col-12 col-md-8">
                    <div class="row g-0 row-cols-1">
                        {{-- detail news start --}}
                        <div class="col px-3">
                            <header>
                                <h2 class="news-title fs-1 text-warning">
                                    <b class="fw-bold">{{ $news->title }}</b>
                                </h2>
                                <p class="mb-md-4">
                                    <small>
                                        <small>Author <b class="fw-bold">{{ $news->author }}</b></small><br>
                                        {{ strtoupper($news->created_at->format('l, Y M d')) }}<span
                                            class="opacity-25 fs-4 mx-2">|</span><i class="fas fa-clock"></i>
                                        {{ $news->created_at->format('h:i A') }}
                                    </small>
                                </p>
                            </header>
                            <main class="d-flex flex-column row-gap-4">
                                @if ($news->image)
                                    <section>
                                        <div class="news-img position-relative">
                                            <div class="news-action d-none">
                                                <ul
                                                    class="list-unstyled d-flex flex-nowrap justify-content-end flex-md-column mb-md-0">
                                                    <li>
                                                        <a href="#"
                                                            class="text-reset text-decoration-none link-hover">
                                                            <i class="fas fa-bookmark"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="text-reset text-decoration-none link-hover">
                                                            <i class="fas fa-reply"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="text-reset text-decoration-none link-hover">
                                                            <i class="fas fa-share"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="text-reset text-decoration-none link-hover">
                                                            <i class="fas fa-rss"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ratio ratio-4x3">
                                                <img src="{{ asset('storage/' . $news->image) }}" class="object-fit-cover"
                                                    alt="{{ $news->title }}">
                                            </div>
                                            <p>
                                                <small><small>
                                                        Photographer by <b
                                                            class="fw-bold text-reset link-hover-underline">Factabot</b>
                                                    </small></small>
                                            </p>
                                        </div>
                                    </section>
                                @endif

                                <section class="ps-xl-4 px-xxl-5 fs-5 lh-lg">
                                    {!! $news->content !!}

                                    <div class="mt-4" style="font-size: 11px; font-style: italic">
                                        <strong>Disclaimer:</strong>
                                        Factabot provides satirical commentary based on real-world events.
                                        While rooted in factual news reporting, our content uses humor, exaggeration, and
                                        parody for
                                        entertainment and opinion purposes.
                                        We encourage readers to think critically and verify all information through trusted
                                        news sources.
                                        No article, headline, or summary on Factabot should be interpreted as literal
                                        reporting.
                                    </div>
                                </section>
                            </main>
                        </div>


                        <div class="col px-3">
                            <hr class="my-5">
                            <h6 class="fw-bold mb-2">Share this truth+sass</h6>
                            <div class="d-flex flex-wrap gap-2">

                                <!-- WhatsApp -->
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' - ' . route('front.news.show', $news->slug)) }}"
                                    class="btn btn-outline-success d-flex align-items-center gap-2 btn-sm" target="_blank"
                                    onclick="logShare({{ $news->id }}, 'whatsapp')">
                                    <i class="bi bi-whatsapp fs-5"></i> WhatsApp
                                </a>

                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('front.news.show', $news->slug)) }}"
                                    class="btn btn-outline-primary d-flex align-items-center gap-2 btn-sm" target="_blank"
                                    onclick="logShare({{ $news->id }}, 'facebook')">
                                    <i class="bi bi-facebook fs-5"></i> Facebook
                                </a>

                                <!-- Twitter -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('front.news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                    class="btn btn-outline-info d-flex align-items-center gap-2 btn-sm text-info"
                                    target="_blank"
                                    onclick="logShare({{ $news->id }}, 'twitter')>
                                <i class="bi
                                    bi-twitter-x fs-5"></i> Twitter
                                </a>

                                <!-- Telegram -->
                                <a href="https://t.me/share/url?url={{ urlencode(route('front.news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                    class="btn btn-outline-secondary d-flex align-items-center gap-2 btn-sm" target="_blank"
                                    onclick="logShare({{ $news->id }}, 'telegram')>
                                <i class="bi
                                    bi-telegram fs-5"></i> Telegram
                                </a>

                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('front.news.show', $news->slug)) }}"
                                    class="btn btn-outline-primary d-flex align-items-center gap-2 btn-sm" target="_blank"
                                    onclick="logShare({{ $news->id }}, 'linkedin')>
                                <i class="bi
                                    bi-linkedin fs-5"></i> LinkedIn
                                </a>

                                <!-- Copy Link -->
                                <button onclick="copyLink()"
                                    class="btn btn-outline-dark d-flex align-items-center gap-2 btn-sm">
                                    <i class="bi bi-clipboard fs-5"></i> Copy Link
                                </button>
                            </div>
                        </div>





                        {{-- detail news end --}}
                        <div class="col px-3 d-none d-md-block">
                            <hr class="my-5">
                        </div>
                        {{-- promoted news start --}}
                        <div class="col px-3 d-none d-md-block">
                            <h5 class="mb-4 text-danger">
                                <b class="fw-bold">PROMOTED</b>
                            </h5>
                            <div class="row row-cols-2 row-gap-4 gx-4 row-cols-xl-3">
                                @foreach ($promotednews as $pn)
                                    <div class="col">
                                        <figure class="figure">
                                            <div class="figure-img">
                                                <div class="ratio ratio-4x3">
                                                    <img src="{{ asset('storage/' . $pn->image) }}"
                                                        class="object-fit-cover" alt="">
                                                </div>
                                            </div>
                                            <figcaption class="figure-caption">
                                                <p class="mb-0"><small><small>News - <b
                                                                class="fw-bold">Health</b></small></small></p>
                                                <h5 class="fs-6"><b class="fw-bold">
                                                        <a href="#" class="text-reset link-hover-underline">
                                                            {{ $pn->title }}
                                                        </a>
                                                    </b></h5>
                                            </figcaption>
                                        </figure>
                                    </div>
                                @endforeach
                                <!-- end col -->

                            </div><!-- end row -->
                        </div>
                        {{-- promoted news end --}}
                    </div>
                </div>
                {{-- detail news container end --}}
                <div class="col col-12 col-md-auto">
                    <hr class="opacity-100 my-5 d-md-none">
                    <div class="vr h-100 d-none d-md-block mx-lg-3"></div>
                </div>



                {{-- comment start --}}
                <div class="col px-3 col-12 col-md">
                    <aside class="sidenav">
                        <div class="news-comment">
                            <header class="mb-3">
                                <h5 class="fs-reset text-danger">
                                    <b class="fw-bold">COMMENT</b>
                                </h5>
                            </header>
                            <main>
                                <form action="{{ route('news.comment', $news->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" id="parent_id" value="">

                                    @guest
                                        <input type="text" name="guest_name" class="form-control rounded-0 mb-2"
                                            placeholder="Your Name" value="" required>
                                    @endguest

                                    <div class="form-group mb-2">
                                        <textarea name="comment" rows="6" class="form-control rounded-0"
                                            placeholder="Type your opinion about this news here.." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-outline-light rounded-0 w-100">SUBMIT</button>
                                    </div>
                                </form>

                                <hr class="opacity-100 border-3 my-4">
                                <ul class="list-group list-group-flush small">
                                    @foreach ($news->comments->where('parent_id', null) as $comment)
                                        <li class="list-group-item px-0">
                                            <div class="comment-item">
                                                <h5 class="comment-name mb-0 fs-6">
                                                    <b class="fw-medium">
                                                        {{-- {{ $comment->user->name }} --}}
                                                        {{ $comment->displayName() }}
                                                    </b>
                                                </h5>
                                                <p class="comment-date">
                                                    <small><small>{{ $comment->created_at->format('l, Y M d') }}<span
                                                                class="mx-2 opacity-25 fs-5">|</span>{{ $comment->created_at->format('h:i A') }}</small></small>
                                                </p>
                                                <p class="comment-text">{{ $comment->comment }}</p>

                                                @foreach ($comment->replies as $reply)
                                                    <div class="ms-3 mt-2 border-start ps-3">
                                                        <h6 class="mb-0">
                                                            {{-- {{ $reply->user->name }} --}}
                                                            {{ $comment->displayName() }}
                                                        </h6>
                                                        <p class="small text-muted">
                                                            {{ $reply->created_at->diffForHumans() }}</p>
                                                        <p>{{ $reply->comment }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </main>
                        </div>
                    </aside>
                </div>
                {{-- comment end --}}
            </div>
        </div>
    </section>
@endsection
