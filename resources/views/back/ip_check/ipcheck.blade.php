@extends('back.layouts.layout')
@section('content')
    <div class="container">
        <h1 class="my-10">IP Checker</h1>
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
                <div class="row row-cols-1 row-cols-sm-5">
                    <div class="col mb-4">
                        <select class="form-select" id="newsYearFilter">
                            <option value="">Pilih Tahun</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <select class="form-select" id="newsMonthFilter">
                            <option value="">Pilih Bulan</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <select class="form-select" id="newsDayFilter">
                            <option value="">Pilih Tanggal</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <select class="form-select" id="newsBotOrHumanFilter">
                            <option value="">Pilih Bot Or Human</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <button class="btn btn-success w-100">Export Excel</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table-news-visit" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>News ID</th>
                                <th>IP</th>
                                <th>User Agent</th>
                                <th>Browser</th>
                                <th>Platform</th>
                                <th>Visited At</th>
                                <th>Duration</th>
                                <th>Bot?..</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($newsVisits as $visit)
                                <tr data-filter-id="{{ $visit->news_id }}" data-filter-date="{{ $visit->visited_at }}">
                                    <td>{{ $visit->news_id }}</td>
                                    <td>{{ $visit->ip }}</td>
                                    <td>{{ Str::limit($visit->user_agent, 60) }}</td>
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
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card my-4">
            <div class="card-body">
                <h2 class="mt-5 mb-4">📄 Page Visits</h2>
                <div class="row">
                    <div class="col-12 col-md-4 mb-4">
                        <select class="form-select" id="pageUrlFilter">
                            <option value="">Pilih URL</option>
                        </select>
                    </div>
                    {{-- <div class="col-12 col-md-4 mb-4">
                        <select class="form-select" id="newsMonthFilter">
                            <option value="">Pilih Bulan</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <select class="form-select" id="newsDayFilter">
                            <option value="">Pilih Tanggal</option>
                        </select>
                    </div> --}}
                </div>
                <div class="table-responsive">
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
                            {{-- @foreach ($pageVisits as $visit)
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
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Konversi data PHP ke JSON -->
    <script>
        const newsVisits = @json($newsVisits);
        const pageVisits = @json($pageVisits);

        document.addEventListener("DOMContentLoaded", function() {
            let filterState = {
                news: {
                    year: '',
                    month: '',
                    day: ''
                },
                page: {
                    year: '',
                    month: '',
                    day: ''
                }
            };

            // Global filter function for both tables
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex, rowData, counter) {
                const tableId = settings.nTable.id;
                const filter = tableId === 'table-news-visit' ? filterState.news : filterState.page;
                const date = new Date(rowData.visited_at);
                const rowYear = date.getFullYear().toString();
                const rowMonth = String(date.getMonth() + 1).padStart(2, '0');
                const rowDay = String(date.getDate()).padStart(2, '0');

                if (filter.year && rowYear !== filter.year) return false;
                if (filter.month && rowMonth !== filter.month) return false;
                if (filter.day && rowDay !== filter.day) return false;

                return true;
            });

            function populateFilters(data, yearSelect, monthSelect, daySelect, botOrHuman, type) {
                const years = new Set();
                const monthsByYear = {};
                const daysByMonthYear = {};

                data.forEach(visit => {
                    const date = new Date(visit.visited_at);
                    const year = date.getFullYear().toString();
                    const month = String(date.getMonth() + 1).padStart(2, '0');
                    const day = String(date.getDate()).padStart(2, '0');
                    const yearMonth = `${year}-${month}`;

                    years.add(year);
                    if (!monthsByYear[year]) monthsByYear[year] = new Set();
                    monthsByYear[year].add(month);
                    if (!daysByMonthYear[yearMonth]) daysByMonthYear[yearMonth] = new Set();
                    daysByMonthYear[yearMonth].add(day);
                });

                // Populate year dropdown
                yearSelect.innerHTML = '<option value="">Pilih Tahun</option>';
                Array.from(years).sort().forEach(year => {
                    yearSelect.innerHTML += `<option value="${year}">${year}</option>`;
                });

                // Update months
                yearSelect.addEventListener('change', () => {
                    const selectedYear = yearSelect.value;
                    filterState[type].year = selectedYear;
                    filterState[type].month = '';
                    filterState[type].day = '';
                    monthSelect.innerHTML = '<option value="">Pilih Bulan</option>';
                    daySelect.innerHTML = '<option value="">Pilih Tanggal</option>';

                    if (selectedYear === "") {
                        refreshTable(type); // Reset table if year is cleared
                        return;
                    }

                    if (monthsByYear[selectedYear]) {
                        Array.from(monthsByYear[selectedYear]).sort().forEach(month => {
                            const monthName = new Date(2025, parseInt(month) - 1).toLocaleString(
                                'id-ID', {
                                    month: 'long'
                                });
                            monthSelect.innerHTML +=
                                `<option value="${month}">${monthName}</option>`;
                        });
                    }
                    refreshTable(type);
                });

                // Update days
                monthSelect.addEventListener('change', () => {
                    const year = yearSelect.value;
                    const month = monthSelect.value;
                    const yearMonth = `${year}-${month}`;
                    filterState[type].month = month;
                    filterState[type].day = '';
                    daySelect.innerHTML = '<option value="">Pilih Tanggal</option>';

                    if (month === "") {
                        refreshTable(type); // Reset if month cleared
                        return;
                    }

                    if (daysByMonthYear[yearMonth]) {
                        Array.from(daysByMonthYear[yearMonth]).sort().forEach(day => {
                            daySelect.innerHTML += `<option value="${day}">${day}</option>`;
                        });
                    }
                    refreshTable(type);
                });

                // Day filter
                daySelect.addEventListener('change', () => {
                    filterState[type].day = daySelect.value;
                    refreshTable(type);
                });

            }

            // Fungsi untuk mengisi dropdown filter URL (untuk Page Visits)
            function populateUrlFilter(data, urlSelect) {
                const urls = new Set();
                data.forEach(visit => {
                    urls.add(visit.url);
                });

                urlSelect.innerHTML = '<option value="">Pilih URL</option>';
                Array.from(urls).sort().forEach(url => {
                    const option = document.createElement('option');
                    option.value = url;
                    option.textContent = url.length > 50 ? url.substr(0, 50) + '...' :
                        url; // Batasi tampilan
                    urlSelect.appendChild(option);
                });

                urlSelect.addEventListener('change', filterPageTable);
            }

            // Fungsi filter untuk Page Table
            function filterPageTable() {
                const urlFilter = document.getElementById('pageUrlFilter').value;
                const table = $('#table-page-visit').DataTable();

                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        if (settings.nTable.id !== 'table-page-visit') return true;
                        const rowData = table.row(dataIndex).data();
                        const rowUrl = rowData.url;

                        if (urlFilter && urlFilter !== rowUrl) return false;

                        return true;
                    }
                );

                table.draw();
                $.fn.dataTable.ext.search.pop();
            }

            function refreshTable(type) {
                const tableId = type === 'news' ? '#table-news-visit' : '#table-page-visit';
                $(tableId).DataTable().draw();
            }

            // Init DataTables
            const newsTable = $('#table-news-visit').DataTable({
                data: newsVisits,
                columns: [{
                        data: 'news_id'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'user_agent',
                        render: data => data.length > 60 ? data.substr(0, 60) + '...' : data
                    },
                    {
                        data: 'browser'
                    },
                    {
                        data: 'platform'
                    },
                    {
                        data: 'visited_at'
                    },
                    {
                        data: 'duration_seconds',
                        render: data => data + 's'
                    },
                    {
                        data: 'is_bot',
                        render: data => data === 'Yes' ?
                            '<span class="badge bg-danger">Bot</span>' :
                            '<span class="badge bg-success">Human</span>'
                    }
                ],
                rowCallback: (row, data) => {
                    $(row).attr('data-filter-date', data.visited_at);
                }
            });

            const pageTable = $('#table-page-visit').DataTable({
                data: pageVisits,
                columns: [{
                        data: 'url'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'user_agent',
                        render: data => data.length > 60 ? data.substr(0, 60) + '...' : data
                    },
                    {
                        data: 'browser'
                    },
                    {
                        data: 'platform'
                    },
                    {
                        data: 'visited_at'
                    },
                    {
                        data: 'duration',
                        render: data => data + 's'
                    },
                    {
                        data: 'is_bot',
                        render: data => data === 'Yes' ?
                            '<span class="badge bg-danger">Bot</span>' :
                            '<span class="badge bg-success">Human</span>'
                    }
                ],
                rowCallback: (row, data) => {
                    $(row).attr('data-filter-date', data.visited_at);
                }
            });

            // Init filters
            populateFilters(newsVisits,
                document.getElementById('newsYearFilter'),
                document.getElementById('newsMonthFilter'),
                document.getElementById('newsDayFilter'),
                document.getElementById('newsBotOrHumanFilter'),
                'news');

            populateUrlFilter(pageVisits, document.getElementById('pageUrlFilter'));
            
            // Summary Table
            $('#tabel-ringkasan').DataTable({
                searching: false,
                paging: false,
                lengthChange: false,
                info: false
            });
        });
    </script>
@endsection
