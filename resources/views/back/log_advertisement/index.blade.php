@extends('back.layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div class="container">
                    <h3 class="mb-4">Log Advertisement</h3>

                    {{-- Form Tambah Log --}}
                    <form action="{{ route('log-advertisement.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label">Advertisement</label>
                                <input type="text" name="advertisement" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Log</label>
                                <input type="datetime-local" name="created_at" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </form>

                    {{-- Table Data Log --}}
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Advertisement</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->advertisement }}</td>
                                    <td>{{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i') }}</td>

                                    <td>
                                        <form action="{{ route('log-advertisement.destroy', $log->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus log ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
