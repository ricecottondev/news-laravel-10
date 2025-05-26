@extends('back.layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                {{-- header-start --}}
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Website Scrapper</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('/') }}" class="text-muted text-hover-primary">Tools</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Scrapper</li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- header-end --}}

                {{-- body-start --}}
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <div class="card-title"></div>
                            </div>
                            <div class="card-body">
                                <div class="card-header d-flex justify-content-center">
                                    <h3>Scraping All Websites</h3>
                                </div>

                                {{-- Error Message --}}
                                @if (session('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="GET" action="{{ route('scrapper.index') }}">
                                    <div class="form-group mb-3 mt-3">
                                        <label><strong>Give me a website link, I will scrape the headers.</strong></label>
                                        <input type="text" name="url" class="form-control mt-3"
                                            value="{{ request('url') }}" placeholder="https://example.com" />
                                    </div>
                                    <div class="form-group d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>

                                {{-- @dump($data) --}}
                                {{-- Scraped Data --}}
                                {{-- @isset($data)
                                    <hr>
                                    <h4>Scraped Headings</h4>
                                    @foreach ($data as $tag => $headings)
                                        <div class="mt-4">
                                            <h5>{{ strtoupper($tag) }}</h5>
                                            <ul>
                                                @forelse ($headings as $text)
                                                    <li>{{ $text }}</li>
                                                @empty
                                                    <li><em>No {{ $tag }} found.</em></li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    @endforeach
                                @endisset --}}

                                {{-- FOR FULL TEXT --}}
                                {{-- @if (isset($data['error']))
                                    <div class="alert alert-danger mt-4">
                                        {{ $data['error'] }}
                                    </div>
                                @elseif($data)
                                    <div class="mt-4">
                                        <h4>Full Text (Gabungan semua teks halaman):</h4>
                                        <pre style="white-space: pre-wrap;">{{ $data['full_text'] }}</pre>

                                        <h4 class="mt-5">Semua Teks per Elemen (tanpa filter tag):</h4>
                                        <ul>
                                            @foreach ($data['node_texts'] as $text)
                                                <li>{{ $text }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}

                                {{-- @if (isset($data['error']))
                                    <div class="alert alert-danger mt-4">
                                        {{ $data['error'] }}
                                    </div>
                                @elseif(!empty($data))
                                    <div class="mt-4"> --}}
                                {{-- <h4>Full Text (Gabungan semua teks halaman):</h4> --}}
                                {{-- <pre style="white-space: pre-wrap;">{{ $data['full_text'] }}</pre> --}}

                                {{-- <h4 class="mt-5">Teks Dikelompokkan Berdasarkan Tag HTML:</h4>

                                        @foreach ($data['grouped_by_tag'] as $tag => $texts)
                                            <div class="mt-3">
                                                <h5><code>&lt;{{ $tag }}&gt;</code></h5>
                                                <ul>
                                                    @foreach ($texts as $text)
                                                        <li>{{ $text }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif --}}

                                <div class="container">
                                    <h2 class="mb-4">Hasil Scraping</h2>

                                    @if (isset($error))
                                        <div class="alert alert-danger">
                                            {{ $error }}
                                        </div>
                                    @elseif(isset($data) && count($data))
                                        <div class="card">
                                            <div class="form-group d-flex justify-content-end">
                                                <button id="btn-export-excel" class="btn btn-success">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-file-earmark-spreadsheet"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5zM3 12v-2h2v2zm0 1h2v2H4a1 1 0 0 1-1-1zm3 2v-2h3v2zm4 0v-2h3v1a1 1 0 0 1-1 1zm3-3h-3v-2h3zm-7 0v-2h3v2z" />
                                                    </svg> Export Excel</button>
                                            </div>
                                            <div class="card-body px-0">

                                                {{-- @foreach ($data['ordered_text'] as $line)
                                                    <p>{{ $line }}</p>
                                                @endforeach --}}

                                                @foreach ($data['ordered_text'] as $item)
                                                    {{-- @if (!empty($item['title']) && !empty($item['summary']) && !empty($item['source']) && !empty($item['topic']) && !empty($item['date'])) --}}
                                                    <div class="mb-4 p-3 border rounded shadow-sm bg-white">
                                                        <a href="{{ $item['url'] }}" target="_blank">
                                                            <h4 class="font-bold text-lg mb-1 text-blue-800">
                                                                {{ $item['title'] }}</h4>
                                                            <p class="text-gray-700 mb-2">{{ $item['summary'] }}</p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Sumber:</strong> {{ $item['source'] }} |
                                                                <strong>Topik:</strong> {{ $item['topic'] }} |
                                                                <strong>Tanggal:</strong> {{ $item['date'] }}
                                                            </p>

                                                            <p class="text-sm text-gray-500" style="text-align: justify;">
                                                                {{ $item['sublink'] }}
                                                            </p>
                                                        </a>
                                                    </div>
                                                    {{-- @endif --}}
                                                @endforeach

                                            </div>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            Tidak ada teks yang ditemukan.
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- body-end --}}
            </div>
        </div>
    </div>
    <script>
        document.getElementById('btn-export-excel').addEventListener('click', function() {
            fetch('{{ route("export.excel") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengunduh file');
                    }

                    const disposition = response.headers.get('Content-Disposition');
                    let filename = 'export.xlsx';
                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        const matches = filenameRegex.exec(disposition);
                        if (matches != null && matches[1]) {
                            filename = matches[1].replace(/['"]/g, '');
                        }
                    }

                    return response.blob().then(blob => ({
                        blob,
                        filename
                    }));
                })
                .then(({
                    blob,
                    filename
                }) => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => {
                    alert(error.message || 'Gagal mengunduh file.');
                    console.error(error);
                });
        });
    </script>


@endsection
