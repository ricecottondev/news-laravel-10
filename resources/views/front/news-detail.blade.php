@extends('front/layouts.layout')

@section('content')
    <div class="container bg-white p-4">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="display-5 fw-bold mb-3">{{ $news->title }}</h1>
        <p class="text-secondary mb-4">{{ $news->short_desc }}</p>

        @if ($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->slug }}" class="img-fluid mb-4">
        @else
            <img src="/images/imagenotavailable.jpg" alt="image not available" class="img-fluid mb-4">
        @endif

        <p class="text-secondary mb-4 text-justify">{{ $news->content }}</p>

        <!-- Comments Section -->
        <h4 class="mt-5">Comments ({{ $news->comments->count() }})</h4>
        <div class="mt-4">
            @foreach ($news->comments->where('parent_id', null) as $comment)
                <div class="border p-3 mb-3">
                    <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->diffForHumans() }}
                    <p class="mb-2">{{ $comment->comment }}</p>

                    <!-- Reply Button -->
                    {{-- <button class="btn btn-sm btn-primary reply-btn" data-id="{{ $comment->id }}">Reply</button> --}}
                    <button class="btn btn-sm btn-outline-primary reply-btn" data-id="{{ $comment->id }}">
                        Reply
                    </button>

                    <!-- Display Replies -->
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


    <script>
        document.querySelectorAll('.reply-btn').forEach(button => {
            button.addEventListener('click', function() {
                let parentId = this.dataset.id;
                document.getElementById('reply_parent_id').value = parentId;

                let replyModal = new bootstrap.Modal(document.getElementById('replyModal'));
                replyModal.show();
            });
        });
    </script>
@endsection
