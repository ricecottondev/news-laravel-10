@extends('back.layouts.layout')
@section('content')
    <div class="container">
        <h1 class="mb-4">IP Checker</h1>
        <div class="card my-4">
            <div class="card-body">
                <h2 class="mb-4">📊 Ringkasan Kunjungan</h2>
                <table id="tabel-ringkasan" class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Jenis</th>
                            <th>Total</th>
                            <th>Bot</th>
                            <th>Human</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>News Visits</td>
                            <td>{{ $summary['news_total'] }}</td>
                            <td class="text-danger fw-bold">
                                {{ $summary['news_bots'] }} ({{ $summary['news_bots_percent'] }}%)
                            </td>
                            <td class="text-success fw-bold">
                                {{ $summary['news_humans'] }} ({{ $summary['news_humans_percent'] }}%)
                            </td>
                        </tr>
                        <tr>
                            <td>Page Visits</td>
                            <td>{{ $summary['page_total'] }}</td>
                            <td class="text-danger fw-bold">
                                {{ $summary['page_bots'] }} ({{ $summary['page_bots_percent'] }}%)
                            </td>
                            <td class="text-success fw-bold">
                                {{ $summary['page_humans'] }} ({{ $summary['page_humans_percent'] }}%)
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card my-4">
            <div class="card-body">
                <h2 class="mb-4">📰 News Visits</h2>
                <table id="table-news-visit" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>News ID</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            {{-- <th>Referer</th> --}}
                            <th>Browser</th>
                            <th>Platform</th>
                            <th>Visited At</th>
                            <th>Duration</th>
                            <th>Bot?..</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($newsVisits as $visit)
                            <tr>
                                <td>{{ $visit->news_id }}</td>
                                <td>{{ $visit->ip }}</td>
                                <td>{{ Str::limit($visit->user_agent, 60) }}</td>
                                {{-- <td>{{ $visit->referer }}</td> --}}
                                <td>{{ $visit->browser }}</td>
                                <td>{{ $visit->platform }}</td>
                                <td>{{ $visit->visited_at }}</td>
                                <td>{{ $visit->duration_seconds }}s</td>
                                <td>
                                    @if ($visit->is_bot == 'Yes')
                                        <span class="badge bg-danger">Bot</span>
                                    @else
                                        <span class="badge bg-success">Human</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card my-4">
            <div class="card-body">
                <h2 class="mt-5 mb-4">📄 Page Visits</h2>
                <table id="table-page-visit" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            <th>Browser</th>
                            <th>Platform</th>
                            <th>Visited At</th>
                            <th>Duration</th>
                            <th>Bot?</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pageVisits as $visit)
                            <tr>
                                <td>{{ $visit->url }}</td>
                                <td>{{ $visit->ip }}</td>
                                <td>{{ Str::limit($visit->user_agent, 60) }}</td>
                                <td>{{ $visit->browser }}</td>
                                <td>{{ $visit->platform }}</td>
                                <td>{{ $visit->visited_at }}</td>
                                <td>{{ $visit->duration }}s</td>
                                <td>
                                    @if ($visit->is_bot == 'Yes')
                                        <span class="badge bg-danger">Bot</span>
                                    @else
                                        <span class="badge bg-success">Human</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tabel-ringkasan').DataTable({
                searching: false,
                paging: false, // Hides pagination
                lengthChange: false,
                info: false,
            });
            $('#table-news-visit').DataTable(); // Basic initialization
            $('#table-page-visit').DataTable(); // Basic initialization
        });
    </script>
@endsection
