@extends('back/layouts.layout')

@section('content')
<div class="container">
    <h3 class="mb-4">Blocked IPs</h3>

    <a href="{{ route('blocked-ips.create') }}" class="btn btn-sm btn-primary mb-3">+ Add New</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>IP Address</th>
                <th>Reason</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ips as $ip)
                <tr>
                    <td>{{ $ip->ip }}</td>
                    <td>{{ $ip->reason }}</td>
                    <td>
                        <a href="{{ route('blocked-ips.edit', $ip->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('blocked-ips.destroy', $ip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Unblock this IP?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Unblock</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ips->links() }}
</div>
@endsection
