@extends('front/layouts.layout')

@push('styles')
    <link rel="stylesheet" href="/assets/template3/css/detail.css">
@endpush

@section('content')
    <section>
        @php
            $categoryName = $news->countriesCategoriesNews->first()?->category?->name ?? 'No Category';
        @endphp
        <div class="container-lg px-0 pt-4">
            <div class="row g-0">
                <div class="col col-12 px-3">
                    <nav style="--bs-breadcrumb-divider: '/'; font-size: .75em;" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $categoryName ?? 'Uncategorized' }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $news->title }}</li>
                        </ol>
                    </nav>
                </div>
                {{-- detail news container start --}}
                <div class="col col-12 col-md-8">
                    <div class="row g-0 row-cols-1">
                        {{-- detail news start --}}
                        <div class="col px-3 mb-5">
                            <header>

                                @if (strtoupper($news->color) == 'P')

                                    <h2 class="news-title fs-1  text-danger">
                                    @elseif (strtoupper($news->color) == 'Y')
                                        <h2 class="news-title fs-1 text-warning">
                                        @else
                                            <h2 class="news-title fs-1">
                                @endif
                                {{-- <h2 class="news-title fs-1 text-warning"> --}}
                                <b class="fw-bold">{{ $news->title }}</b>
                                </h2>
                                <p class="mb-md-4">
                                    <small>
                                        <small>Author by
                                            @if (strtoupper($news->color) == 'P')
                                                <b class="fw-medium text-danger">Clara</b>
                                            @elseif (strtoupper($news->color) == 'Y')
                                                <b class="fw-medium text-warning">Lola</b>
                                            @else
                                                <b class="fw-medium">Phor</b>
                                            @endif
                                        </small><br>
                                        {{ $news->created_at->format('l, Y M d') }}<span
                                            class="opacity-25 fs-4 mx-2">|</span><i class="fas fa-clock"></i>
                                        {{ $news->created_at->format('h:i A') }}
                                    </small>
                                </p>
                            </header>
                            <main class="d-flex flex-column row-gap-4">
                                @if ($news->image)
                                    <section>
                                        <div class="news-img position-relative">
                                            <div class="news-action">
                                                <ul class="list-unstyled d-flex flex-nowrap justify-content-end flex-md-column mb-md-0">
                                                    <li>
                                                        <a href="https://api.whatsapp.com/send?text=Australia%E2%80%99s+Identity+Crisis%3A+We%E2%80%99re+in+Asia%2C+Not+Texas%E2%80%94Deal+With+It+%F0%9F%87%A6%F0%9F%87%BA%E2%9E%A1%EF%B8%8F%F0%9F%8C%8F+-+http%3A%2F%2F192.168.6.229%3A8000%2Fnews%2Faustralias-identity-crisis-were-in-asia-not-texas-deal-with-it" class="text-reset text-decoration-none p-lg-4 link-hover">
                                                            <i class="fab fa-whatsapp fa-lg"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2F192.168.6.229%3A8000%2Fnews%2Faustralias-identity-crisis-were-in-asia-not-texas-deal-with-it" class="text-reset text-decoration-none p-lg-4 link-hover">
                                                            <i class="fab fa-facebook-f fa-lg"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="https://twitter.com/intent/tweet?url=http%3A%2F%2F192.168.6.229%3A8000%2Fnews%2Faustralias-identity-crisis-were-in-asia-not-texas-deal-with-it&text=Australia%E2%80%99s+Identity+Crisis%3A+We%E2%80%99re+in+Asia%2C+Not+Texas%E2%80%94Deal+With+It+%F0%9F%87%A6%F0%9F%87%BA%E2%9E%A1%EF%B8%8F%F0%9F%8C%8F" class="text-reset text-decoration-none p-lg-4 link-hover">
                                                            <i class="fab fa-x-twitter fa-lg"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="https://t.me/share/url?url=http%3A%2F%2F192.168.6.229%3A8000%2Fnews%2Faustralias-identity-crisis-were-in-asia-not-texas-deal-with-it&text=Australia%E2%80%99s+Identity+Crisis%3A+We%E2%80%99re+in+Asia%2C+Not+Texas%E2%80%94Deal+With+It+%F0%9F%87%A6%F0%9F%87%BA%E2%9E%A1%EF%B8%8F%F0%9F%8C%8F" class="text-reset text-decoration-none p-lg-4 link-hover">
                                                            <i class="fab fa-telegram fa-lg"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="vr h-100 mx-2 d-md-none"></div>
                                                        <hr class="m-0 d-none d-md-block">
                                                    </li>
                                                    <li>
                                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=http%3A%2F%2F192.168.6.229%3A8000%2Fnews%2Faustralias-identity-crisis-were-in-asia-not-texas-deal-with-it" class="text-reset text-decoration-none p-lg-4 link-hover">
                                                            <i class="fab fa-linkedin-in fa-lg"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="ratio ratio-1x1">
                                                <img src="{{ asset('storage/' . $news->image) }}" class="object-fit-cover" alt="{{ $news->title }}">
                                            </div>
                                            <p>
                                                <small><small>
                                                    Photographer by <b class="fw-bold text-reset link-hover-underline">Factabot</b>
                                                </small></small>
                                            </p>
                                        </div>
                                    </section>
                                @endif

                                <section class="ps-xl-4 px-xxl-5 fs-5 lh-lg">
                                    {!! $news->short_desc !!}
                                    <hr class="py-3">
                                    {!! $processedContent !!}

                                    <div class="mt-4" style="font-size: 11px; font-style: italic">
                                        <strong>Disclaimer:</strong>
                                        Factabot provides satirical commentary based on real-world events covered by major Australian news outlets.
                                        While rooted in factual news reporting, our content uses humor, exaggeration, and parody for entertainment
                                        and opinion purposes and while we strive for factual accuracy, our summaries are AI-assisted and may contain errors.
                                        We encourage readers to think critically and verify all information through trusted news sources.
                                        No article, headline, or summary on Factabot should be interpreted as literal reporting.
                                        Always check trusted news sources (like ABC, Nine, SMH, etc.) for original reporting.
                                    </div>
                                </section>
                            </main>
                        </div>

                        <div class="col px-3 pt-5 d-flex flex-column row-gap-4">
                            <div>
                                <h6 class="fw-bold mb-3">🧨 YOU MADE IT TO THE END. NOW WHAT?</h6>
                                <div class="d-flex flex-wrap gap-2">G
    
                                    <!-- WhatsApp -->
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' - ' . route('front.news.show', $news->slug)) }}" class="btn btn-outline-success d-flex align-items-center gap-2 btn-sm" target="_blank" onclick="logShare({{ $news->id }}, 'whatsapp')">
                                        <i class="fab fa-whatsapp fa-lg"></i> WhatsApp
                                    </a>
    
                                    <!-- Facebook -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('front.news.show', $news->slug)) }}" class="btn btn-outline-primary d-flex align-items-center gap-2 btn-sm" target="_blank" onclick="logShare({{ $news->id }}, 'facebook')">
                                        <i class="fab fa-facebook-f fa-lg"></i> Facebook
                                    </a>
    
                                    <!-- Twitter -->
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('front.news.show', $news->slug)) }}&text={{ urlencode($news->title) }}" class="btn btn-outline-info d-flex align-items-center gap-2 btn-sm text-info" target="_blank" onclick="logShare({{ $news->id }}, 'twitter')">
                                        <i class="fab fa-x-twitter fa-lg"></i> Twitter
                                    </a>
    
                                    <!-- Telegram -->
                                    <a href="https://t.me/share/url?url={{ urlencode(route('front.news.show', $news->slug)) }}&text={{ urlencode($news->title) }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 btn-sm" target="_blank" onclick="logShare({{ $news->id }}, 'telegram')">
                                        <i class="fab ta-telegram fa-lg"></i> Telegram
                                    </a>
    
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('front.news.show', $news->slug)) }}" class="btn btn-outline-primary d-flex align-items-center gap-2 btn-sm" target="_blank" onclick="logShare({{ $news->id }}, 'linkedin')">
                                        <i class="fab fa-linkedin-in fa-lg"></i> LinkedIn
                                    </a>
    
                                    <!-- Copy Link -->
                                    <button onclick="copyLink()" class="btn btn-outline-dark d-flex align-items-center gap-2 btn-sm">
                                        <i class="bi bi-clipboard fs-5"></i> Copy Link
                                    </button>
    
                                </div>
                            </div>
                            <div>
                                <p>
                                    Like that roast? Don't keep it to yourself. <button class="btn btn-outline-light btn-sm">Share <i class="fas fa-share"></i></button>
                                </p>
                            </div>
                            <div>
                                <h5 class="fs-reset">
                                    Oi, be honest—what'd you reckon?
                                </h5>
                                <ul class="list-unstyled d-flex flex-column row-gap-2">
                                    <li>
                                        ☕️ <b class="fw-medium">Spiciness</b>&nbsp;:&nbsp;&nbsp;&nbsp;
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-success" for="option1">Mild</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-warning" for="option2">Medium</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-danger" for="option3">Nuclear</label>
                                        </div>
                                    </li>
                                    <li>
                                        ⌛ <b class="fw-medium">Length</b>&nbsp;:&nbsp;&nbsp;&nbsp;
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-success" for="option4">Blink</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option5" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-warning" for="option5">Scroll</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option6" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-danger" for="option6">Scroll of Destiny</label>
                                        </div>
                                    </li>
                                    <li>
                                        💀 <b class="fw-medium">Funny factor</b>&nbsp;:&nbsp;&nbsp;&nbsp;
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option7" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-success" for="option7">Chuckle</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option8" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-warning" for="option8">Snort</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option9" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-danger" for="option9">Spat out my drink</label>
                                        </div>
                                    </li>
                                    <li>
                                        🧠 <b class="fw-medium">Topic</b>&nbsp;:&nbsp;&nbsp;&nbsp;
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option10" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-success" for="option10">Please never again</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option11" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-warning" for="option11">Meh</label>
                                        </div>
                                        <div class="form-check form-check-inline p-0 m-0">
                                            <input type="radio" class="btn-check" name="options" id="option12" autocomplete="off">
                                            <label class="btn btn-sm btn-outline-danger" for="option12">Banger</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- detail news end --}}
                        <div class="col px-3 d-none d-md-block">
                            <hr class="my-5">
                        </div>
                        {{-- promoted news start --}}
                        <div class="col px-3">

                            @if (strtoupper($news->color) == 'P')
                                <h5 class="mb-4 text-danger">
                                    <b class="fw-bold">other stories Clara's raging at:</b>
                                </h5>
                            @elseif (strtoupper($news->color) == 'Y')
                                <h5 class="mb-4 text-warning">
                                    <b class="fw-bold">other stories Lola's raging at:</b>
                                </h5>
                            @else
                                <h5 class="mb-4">
                                    <b class="fw-bold">other stories Phor's raging at:</b>
                                </h5>
                            @endif



                            <div class="row row-cols-2 row-gap-4 gx-4 row-cols-xl-3">
                                @foreach ($promotednews as $pn)
                                @if ($pn->image)
                                    <div class="col">
                                        <figure class="figure">
                                            <div class="figure-img">
                                                <div class="ratio ratio-1x1">
                                                    <img src="{{ asset('storage/' . $pn->image) }}"
                                                        class="object-fit-cover" alt="">
                                                </div>
                                            </div>
                                            <figcaption class="figure-caption">
                                                <p class="mb-0"><small><small>News - <b
                                                                class="fw-bold">{{$pn->countriesCategoriesNews->first()?->category?->name ?? 'No Category'}}</b></small></small></p>

                                                @if (strtoupper($pn->color) == 'P')
                                                    <h5 class="news-title fs-6  text-danger">
                                                    @elseif (strtoupper($pn->color) == 'Y')
                                                        <h5 class="news-title fs-6 text-warning">
                                                        @else
                                                            <h5 class="news-title fs-6">
                                                @endif
                                                {{-- <h5 class="fs-6"> --}}
                                                <b class="fw-bold">
                                                    <a href="{{ route('front.news.show', $pn->slug) }}"
                                                        class="text-reset link-hover-underline">
                                                        {{ $pn->title }}
                                                    </a>
                                                </b></h5>
                                            </figcaption>
                                        </figure>
                                    </div>
                                @endif
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
                        <div class="subscribe">
                            <p>
                                “🚨 Daily Roast Drops – Subscribe Now”
                            </p>
                            <div class="form">
                                <div class="input-group">
                                    <input type="email" class="form-control rounded-0 border-light border-end-0 pe-0" placeholder="Your Email">
                                    <button class="btn rounded-0 border-light border-start-0">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div><hr class="my-4"></div>
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
                                        <input type="text" name="guest_name" class="form-control border-light rounded-0 mb-2" placeholder="Your Name" value="" required>
                                    @endguest

                                    <div class="form-group mb-2">
                                        <textarea name="comment" rows="6" class="form-control border-light rounded-0" placeholder="Type your opinion about this news here.." required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-outline-light rounded-0 w-100">SUBMIT</button>
                                    </div>
                                </form>

                                <hr class="my-4">
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

    <script>
        function logShare(newsId, platform) {
            fetch('/log-share', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    news_id: newsId,
                    platform: platform
                })
            }).then(res => res.json())
              .then(data => console.log('Logged share:', data))
              .catch(err => console.error('Share log error:', err));
        }
    </script>


    <script>
        let startTime = Date.now();

        window.addEventListener("beforeunload", function() {
            const endTime = Date.now();
            const durationSeconds = Math.floor((endTime - startTime) / 1000);

            navigator.sendBeacon("/track-duration", JSON.stringify({
                news_id: {{ $news->id }},
                duration: durationSeconds
            }));
        });
    </script>


    <script>
        function copyLink() {
            const link = "{{ route('front.news.show', $news->slug) }}";
            navigator.clipboard.writeText(link).then(() => {
                alert('Link berhasil disalin!');
            }).catch(err => {
                alert('Gagal menyalin link: ' + err);
            });
        }
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', function() {
                const parentId = this.dataset.id;
                document.getElementById('reply_parent_id').value = parentId;
                const replyModal = new bootstrap.Modal(document.getElementById('replyModal'));
                replyModal.show();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('youtubePlayer');
            const originalSrc = iframe?.src;

            if (modal && iframe) {
                modal.addEventListener('hidden.bs.modal', function() {
                    iframe.src = ''; // stop video
                    iframe.src = originalSrc; // reset to original URL
                });
            }

            const sound = new Audio('/assets/sound/kids-saying-yay-sound-effect.mp3');
            sound.play().catch((e) => {
                console.log("Playback failed:", e); // misal autoplay diblokir
            });
        });
    </script>
@endsection
