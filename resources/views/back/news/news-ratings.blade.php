@extends('back.layouts.layout')

@section('content')
<div class="container">
    <h4 class="mb-4">News Rating</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>News Title</th>
                    <th>Spiciness</th>
                    <th>Length</th>
                    <th>Funny</th>
                    <th>Topic</th>
                    <th>IP</th>
                    <th>Date Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ratings as $i => $rating)
                <tr>
                    <td>{{ $ratings->firstItem() + $i }}</td>
                    <td>{{ $rating->news->title ?? '-' }}</td>
                    <td><span class="badge bg-danger text-light">{{ $rating->spiciness }}</span></td>
                    <td>{{ $rating->length }}</td>
                    <td>{{ $rating->funny }}</td>
                    <td>{{ $rating->topic }}</td>
                    <td class="text-muted">{{ $rating->ip_address }}</td>
                    <td>{{ $rating->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada rating.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $ratings->links() }}
    </div>
</div>
@endsection
