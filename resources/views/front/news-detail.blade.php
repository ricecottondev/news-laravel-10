@extends('front/layouts.layout')
@php
    function convertToEmbedUrl($url)
    {
        // Convert normal YouTube URL to embed
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([\w-]{11})/', $url, $matches);
        return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : $url;
    }
@endphp


@section('content')
    <div class="container d-flex justify-content-center">
        <div class="bg-white p-4 w-100" style="max-width: 800px;">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="news-container">
                <div class="news-title-detail mb-3">{{ $news->title }}</div>
                <p class="text-secondary mb-4">{{ $news->short_desc }}</p>


                @if ($news->video_url)
                    <div class="mb-4">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#videoModal">
                            <i class="bi bi-play-circle"></i> Watch Video
                        </button>
                    </div>
                @endif



                @if ($news->image)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->slug }}"
                            class="img-fluid rounded" style="max-height: 400px; width: auto; object-fit: cover;">
                    </div>
                @endif



                {{-- <div class="news-snippet mb-4">
                {!! $processedContent !!}
            </div> --}}


                <div class="news-snippet-detail mb-4">
                    @php

                        $cleanContent = strip_tags(
                            $news->content,
                            '<p><br><b><strong><i><em><ul><li><ol><a><blockquote><img>',
                        );

                        $sentences = preg_split('/(?<=[.?!])\s+/', $cleanContent, -1, PREG_SPLIT_NO_EMPTY);

                        $paragraph = '';
                        $maxLength = 300;
                    @endphp

                    @foreach ($sentences as $sentence)
                        @php
                            $paragraph .= $sentence . ' ';
                        @endphp

                        @if (strlen($paragraph) >= $maxLength)
                            <p class="mb-3 text-justify">{{ trim($paragraph) }}</p>
                            @php $paragraph = ''; @endphp
                        @endif
                    @endforeach


                    @if (!empty(trim($paragraph)))
                        <p class="mb-3 text-justify">{{ trim($paragraph) }}</p>
                    @endif

                    <div class="mb-4" style="font-size: 11px; font-style: italic">
                        <strong>Disclaimer:</strong>
                        Factabot provides satirical commentary based on real-world events.
                        While rooted in factual news reporting, our content uses humor, exaggeration, and parody for
                        entertainment and opinion purposes.
                        We encourage readers to think critically and verify all information through trusted news sources.
                        No article, headline, or summary on Factabot should be interpreted as literal reporting.

                    </div>


                    <div class="mb-4">
                        <h6 class="fw-bold mb-2">Share this News:</h6>
                        <div class="d-flex flex-wrap gap-2">

                            <!-- WhatsApp -->
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' - ' . route('front.news.show', $news->slug)) }}"
                                class="btn btn-outline-success d-flex align-items-center gap-2 btn-sm" target="_blank">
                                <i class="bi bi-whatsapp fs-5"></i> WhatsApp
                            </a>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('front.news.show', $news->slug)) }}"
                                class="btn btn-outline-primary d-flex align-items-center gap-2 btn-sm" target="_blank">
                                <i class="bi bi-facebook fs-5"></i> Facebook
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('front.news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                class="btn btn-outline-info d-flex align-items-center gap-2 btn-sm text-info"
                                target="_blank">
                                <i class="bi bi-twitter-x fs-5"></i> Twitter
                            </a>

                            <!-- Telegram -->
                            <a href="https://t.me/share/url?url={{ urlencode(route('front.news.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                class="btn btn-outline-secondary d-flex align-items-center gap-2 btn-sm" target="_blank">
                                <i class="bi bi-telegram fs-5"></i> Telegram
                            </a>

                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('front.news.show', $news->slug)) }}"
                                class="btn btn-outline-primary d-flex align-items-center gap-2 btn-sm" target="_blank">
                                <i class="bi bi-linkedin fs-5"></i> LinkedIn
                            </a>

                            <!-- Copy Link -->
                            <button onclick="copyLink()"
                                class="btn btn-outline-dark d-flex align-items-center gap-2 btn-sm">
                                <i class="bi bi-clipboard fs-5"></i> Copy Link
                            </button>
                        </div>
                    </div>

                </div>




            </div>




            <!-- Comments Section -->
            <h4 class="mt-5">Comments ({{ $news->comments->count() }})</h4>
            <h6>*We remove anything illegal, hateful, defamatory.</h6>
            <div class="mt-4">
                @foreach ($news->comments->where('parent_id', null) as $comment)
                    <div class="border p-3 mb-3">
                        <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->diffForHumans() }}
                        <p class="mb-2">{{ $comment->comment }}</p>

                        @auth
                            <button class="btn btn-sm btn-outline-primary reply-btn" data-id="{{ $comment->id }}">
                                Reply
                            </button>
                        @endauth

                        @foreach ($comment->replies as $reply)
                            <div class="ms-4 border-start ps-3 mt-2">
                                <strong>{{ $reply->user->name }}</strong> - {{ $reply->created_at->diffForHumans() }}
                                <p class="mb-2">{{ $reply->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Comment Form -->
            @auth
                <h5 class="mt-4">Leave a Reply</h5>
                <form action="{{ route('news.comment', $news->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" id="parent_id" value="">
                    <div class="mb-3">
                        <textarea class="form-control" name="comment" rows="4" placeholder="Comment..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Post Comment</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">Login</a> to leave a comment.</p>
            @endauth

            <!-- Suggested News -->
            @if ($suggestedNews->isNotEmpty())
                <div class="mt-5">
                    <h4>Suggestions</h4>
                    <ul>
                        @foreach ($suggestedNews as $suggestion)
                            <li>
                                <a href="{{ route('front.news.show', $suggestion->slug) }}" class="news-sugestion">
                                    {{ $suggestion->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal for Reply Comment -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Reply Comment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('news.comment', $news->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="news_id" value="{{ $news->id }}">
                        <input type="hidden" name="parent_id" id="reply_parent_id">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Reply</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($news->video_url)
        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="videoModalLabel">News Video</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe id="youtubePlayer" width="100%" height="400"
                                src="{{ convertToEmbedUrl($news->video_url) }}" title="YouTube video" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        let startTime = Date.now();

        window.addEventListener("beforeunload", function () {
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
        });
    </script>
@endsection
