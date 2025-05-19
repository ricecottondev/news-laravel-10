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
                                            <div class="card-body">

                                                {{-- @foreach ($data['ordered_text'] as $line)
                                                    <p>{{ $line }}</p>
                                                @endforeach --}}

                                                @foreach ($data['ordered_text'] as $item)
                                                    {{-- @if (
                                                        !empty($item['title']) &&
                                                            !empty($item['summary']) &&
                                                            !empty($item['source']) &&
                                                            !empty($item['topic']) &&
                                                            !empty($item['date'])) --}}
                                                            <a href="{{ $item['url'] }}" target="_blank">
                                                        <div class="mb-4 p-3 border rounded shadow-sm bg-white">
                                                            <h4 class="font-bold text-lg mb-1 text-blue-800">
                                                                {{ $item['title'] }}</h4>
                                                            <p class="text-gray-700 mb-2">{{ $item['summary'] }}</p>
                                                            <p class="text-sm text-gray-500">
                                                                <strong>Sumber:</strong> {{ $item['source'] }} |
                                                                <strong>Topik:</strong> {{ $item['topic'] }} |
                                                                <strong>Tanggal:</strong> {{ $item['date'] }}
                                                            </p>
                                                        </div></a>
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
@endsection
