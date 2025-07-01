@extends('back.layouts.layout')

@section('content')
<div class="container">
    <h4 class="mb-4">Quick Poll</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>News Title</th>
                    <th>Poll</th>
                    <th>IP</th>
                    <th>Date Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($polls as $i => $poll)
                <tr>
                    <td>{{ $polls->firstItem() + $i }}</td>
                    <td>{{ $poll->news->title ?? '-' }}</td>
                    <td>
                        @php
                            $labels = [
                                'totally' => '🔥 Totally',
                                'mid' => '😐 Mid',
                                'frozen_peas' => '🥶 Frozen Peas',
                            ];
                        @endphp
                        <span class="badge bg-primary">{{ $labels[$poll->poll_result] ?? $poll->poll_result }}</span>
                    </td>
                    <td class="text-muted">{{ $poll->ip_address }}</td>
                    <td>{{ $poll->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data polling.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $polls->links() }}
    </div>
</div>
@endsection
