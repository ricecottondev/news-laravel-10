@extends('back/layouts.layout')

@section('content')
<div class="container mt-4">
    <h4>Uncategorized News</h4>

    <form method="POST" action="{{ route('admin.assign.uncategorized') }}" class="mb-4">
        @csrf
        <div class="row align-items-end">
            <div class="col-md-4">
                <label for="country_id" class="form-label">Select Country</label>
                <select name="country_id" id="country_id" class="form-select" required>
                    <option value="">-- Choose Country --</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Assign All to "Uncategorized"</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($uncategorizedNews as $news)
                <tr>
                    <td>{{ $news->title }}</td>
                    <td>{{ $news->created_at->format('d M Y') }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignModal"
                            data-news="{{ $news->id }}">
                            Assign Country
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Assign -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="assignForm">
            @csrf
            <input type="hidden" name="news_id" id="modal_news_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign to Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="country_id" class="form-label">Select Country</label>
                    <select name="country_id" id="country_id" class="form-select" required>
                        <option value="">-- Choose --</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const assignModal = document.getElementById('assignModal');
    assignModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const newsId = button.getAttribute('data-news');
        document.getElementById('modal_news_id').value = newsId;
    });

    document.getElementById('assignForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch("{{ route('news-master.assign.category') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            if (res.success) {
                alert('Success!');
                location.reload();
            } else {
                alert('Failed: ' + res.message);
            }
        });
    });
});
</script>
@endpush
