@extends('back/layouts.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Testimonial List</h4>
        <a href="{{ route('testimonials.create') }}" class="btn btn-primary">+ Add Testimonial</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Message</th>
                <th>Status</th>
                <th>IP</th>
                <th>User Agent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testimonials as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ Str::limit($item->message, 50) }}</td>
                    <td>
                        <span class="badge {{ $item->status == 'published' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>{{ $item->ip_address }}</td>
                    <td>{{ Str::limit($item->user_agent, 30) }}</td>
                    <td>
                        <a href="{{ route('testimonials.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('testimonials.destroy', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this testimonial?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
