@extends('back.layouts.layout')

@section('content')
<div class="container">
    <h4 class="mb-4">Request News</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Request</th>
                    <th>Status</th>
                    <th>Notes</th>
                    <th>Date Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $i => $req)
                <tr>
                    <td>{{ $requests->firstItem() + $i }}</td>
                    <td>{{ $req->name }}</td>
                    <td>{{ $req->email }}</td>
                    <td>{{ $req->request }}</td>
                    <td><span class="badge bg-info text-dark">{{ $req->status }}</span></td>
                    <td>{{ $req->notes ?? '-' }}</td>
                    <td>{{ $req->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data request berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $requests->links() }}
    </div>
</div>
@endsection
