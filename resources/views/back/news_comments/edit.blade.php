  @extends('back/layouts.layout')
  @section('content')
      <div class="container">
          <h2>Edit Status Komentar</h2>

          <form action="{{ route('back.news-comments.update', $comment->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                  <label class="form-label">Komentar</label>
                  <textarea class="form-control" rows="4" readonly>{{ $comment->comment }}</textarea>
              </div>

              <div class="mb-3">
                  <label class="form-label">Status</label>
                  <select name="status" class="form-control" required>
                      <option value="draft" {{ $comment->status === 'draft' ? 'selected' : '' }}>Draft</option>
                      <option value="published" {{ $comment->status === 'published' ? 'selected' : '' }}>Published</option>
                  </select>
              </div>

              <button class="btn btn-success">Simpan</button>
              <a href="{{ route('back.news-comments.index') }}" class="btn btn-secondary">Kembali</a>
          </form>
      </div>
  @endsection
