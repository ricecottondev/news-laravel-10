  @extends('back/layouts.layout')
  @section('content')
      <div class="container">
          <h2>List Komentar Berita</h2>
          @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Berita</th>
                      <th>Komentar</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($comments as $comment)
                      <tr>
                          <td>{{ $comment->displayName() }}</td>
                          <td>{{ $comment->news->title ?? '-' }}</td>
                          <td>{{ $comment->comment }}</td>
                          <td>
                              <span class="badge bg-{{ $comment->status === 'published' ? 'success' : 'secondary' }}">
                                  {{ ucfirst($comment->status) }}
                              </span>
                          </td>
                          <td>
                              <a href="{{ route('back.news-comments.edit', $comment->id) }}"
                                  class="btn btn-sm btn-primary">Edit</a>

                              <form action="{{ route('back.news-comments.destroy', $comment->id) }}" method="POST"
                                  style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button onclick="return confirm('Yakin ingin menghapus komentar ini?')"
                                      class="btn btn-sm btn-danger">Hapus</button>
                              </form>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  @endsection
