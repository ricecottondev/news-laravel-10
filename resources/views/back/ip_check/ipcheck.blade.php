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
                {{-- <div class="row row-cols-1 row-cols-sm-5">
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
                            <option value="Yes">Bot</option>
                            <option value="No">Human</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <button id="exportNewsVisit" class="btn btn-primary w-100">
                            <span id="spinner-btn" class="spinner-border spinner-border-sm me-1 d-none" role="status"
                                aria-hidden="true"></span>
                            <span class="btn-label">Export Excel</span>
                        </button>

                    </div>
                </div> --}}
                <div class="row row-cols-1 row-cols-sm-4">
                    <div class="col mb-4">
                        <input type="text" class="selector form-control" id="newsStartDate"
                            placeholder="Pilih Tanggal Mulai">
                    </div>
                    <div class="col mb-4">
                        <input type="text" class="selector form-control" id="newsEndDate"
                            placeholder="Pilih Tanggal Selesai">
                    </div>
                    <div class="col mb-4">
                        <select class="form-select" id="newsBotOrHumanFilter">
                            <option value="">Pilih Bot Or Human</option>
                            <option value="Yes">Bot</option>
                            <option value="No">Human</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <button id="exportNewsVisit" class="btn btn-primary w-100">
                            <span id="spinner-btn" class="spinner-border spinner-border-sm me-1 d-none" role="status"
                                aria-hidden="true"></span>
                            <span class="btn-label">Export Excel</span>
                        </button>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="alert alert-info">
                            <h4>📈 Statistik Tambahan - News Visits</h4>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Jumlah Pengunjung Unik (IP):</span>
                                    <strong id="uniqueNewsVisitors">0</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total Kunjungan:</span>
                                    <strong id="totalNewsVisits">0</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Platform Dominan:</span>
                                    <strong id="dominantNewsPlatform">-</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total Durasi Kunjungan:</span>
                                    <strong id="totalDurationNews">0s</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Durasi Rata-rata:</span>
                                    <strong id="averageDurationNews">0s</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>IP yang Paling Sering Muncul:</span>
                                    <strong id="topNewsIP">-</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Return Visitor Rate:</span>
                                    <strong id="returnRateNews">0%</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Bounce-like Behavior:</span>
                                    <strong id="bounceNews">0%</strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-9 mb-4">
                        <h4 class="mb-3">📊 Diagram Pengunjung Unik per Hari</h4>
                        <canvas id="uniqueVisitorsChart" height="100"></canvas>
                    </div>
                    <div class="col-3 mb-4">
                        <h4 class="mb-3">📊 Diagram Platform Pengguna</h4>
                        <canvas id="platformPieChart" height="100"></canvas>
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
                                <th>Bot?</th>
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
                <div class="row row-cols-1 row-cols-md-5">
                    <div class="col mb-4">
                        <input type="text" class="selector form-control" id="pagesStartDate"
                            placeholder="Pilih Tanggal Mulai">
                    </div>
                    <div class="col mb-4">
                        <input type="text" class="selector form-control" id="pagesEndDate"
                            placeholder="Pilih Tanggal Selesai">
                    </div>
                    <div class="col mb-4">
                        <select class="form-select" id="pagesBotOrHumanFilter">
                            <option value="">Pilih Bot Or Human</option>
                            <option value="Yes">Bot</option>
                            <option value="No">Human</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <select class="form-select text-capitalize" id="pageUrlFilter">
                            <option value="">Pilih URL</option>
                        </select>
                    </div>
                    <div class="col mb-4">
                        <button id="exportPageVisit" class="btn btn-primary w-100">
                            <span id="spinner-btn" class="spinner-border spinner-border-sm me-1 d-none" role="status"
                                aria-hidden="true"></span>
                            <span class="btn-label">Export Excel</span>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table-page-visit" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%">URL</th>
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
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const newsVisits = @json($newsVisits);
        const pageVisits = @json($pageVisits);


        document.addEventListener("DOMContentLoaded", function() {
            let chartInstance = null;
            let pieChartInstance = null;
            let filterState = {
                news: {
                    startDate: '',
                    endDate: '',
                    bot: ''
                },
                page: {
                    startDate: '',
                    endDate: '',
                    bot: '',
                    url: ''
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
                const isBot = rowData.is_bot; // 'Yes' atau 'No'

                // Filter berdasarkan start date dan end date
                const start = filter.startDate ? new Date(filter.startDate) : null;
                const end = filter.endDate ? new Date(filter.endDate) : null;

                // Filter berdasarkan start date dan end date
                if (start && end) {
                    if (date < start || date > end) return false;
                } else if (start) {
                    if (date < start) return false;
                } else if (end) {
                    if (date > end) return false;
                }

                if (filter.bot && isBot !== filter.bot) return false;

                return true;
            });

            function populateFilters(data, startDate, endDate, botOrHuman, type) {

                // Inisialisasi Flatpickr untuk Start Date
                flatpickr(startDate, {
                    dateFormat: "Y-m-d",
                    maxDate: new Date(), // Batasi hingga hari ini (3 Juni 2025)
                    onChange: function(selectedDates, dateStr) {
                        filterState[type].startDate = dateStr || '';
                        if (filterState[type].startDate && filterState[type].endDate &&
                            new Date(filterState[type].startDate) > new Date(filterState[type].endDate)
                        ) {
                            filterState[type].endDate = '';
                            flatpickr(endDateInput).setDate(null);
                        }
                        refreshTable('news');
                    }
                });

                // Inisialisasi Flatpickr untuk End Date
                flatpickr(endDate, {
                    dateFormat: "Y-m-d",
                    maxDate: new Date(), // Batasi hingga hari ini
                    onChange: function(selectedDates, dateStr) {
                        filterState[type].endDate = dateStr || '';
                        if (filterState[type].endDate && filterState[type].startDate &&
                            new Date(filterState[type].endDate) < new Date(filterState[type].startDate)
                        ) {
                            filterState[type].startDate = '';
                            flatpickr(startDateInput).setDate(null);
                        }
                        refreshTable('news');
                    }
                });

                // Bot or Human filter
                botOrHuman.addEventListener('change', function() {
                    filterState.news.bot = this.value;
                    refreshTable('news');
                });
            }

            // Fungsi untuk mengisi dropdown filter URL (untuk Page Visits)
            function populateUrlFilter(data, startDate, endDate, botOrHuman, urlSelect, type = 'page') {
                const urls = new Set();
                data.forEach(visit => urls.add(visit.url));

                // Objek untuk melacak label yang sudah digunakan
                const labelCounts = {};
                const processedUrls = [];

                // Proses URL untuk membuat label
                Array.from(urls).sort().forEach(url => {
                    // Hilangkan domain
                    let cleanUrl = url.replace(/^(https?:\/\/)?[^\/]+/, '') || '/';

                    // Decode URL-encoded characters (e.g., %20, %E2%80%99)
                    let label = decodeURIComponent(cleanUrl);

                    // Tentukan domain untuk penanganan duplikat
                    const domainMatch = url.match(/^(https?:\/\/)([^\/]+)/);
                    const domain = domainMatch ? domainMatch[2] : '';

                    // Buat label awal
                    if (label === '/') {
                        label = 'home';
                    } else {
                        label = label.replace(/^\/|\/$/g, ''); // Hapus '/' di awal/akhir
                        if (label.includes('/')) {
                            const segments = label.split('/');
                            if (segments.length > 1 && segments.slice(1).some(seg => seg.includes('-'))) {
                                // Format text/text-text-text menjadi text: text text
                                const firstSegment = segments[0];
                                const rest = segments.slice(1).join(' ').replace(/-/g, ' ');
                                label = `${firstSegment}: ${rest}`;
                            } else {
                                // Ganti '/' dengan spasi
                                label = segments.join(' ');
                            }
                        }
                        // Tambahkan spasi sebelum huruf besar (camelCase)
                        label = label.replace(/([a-z])([A-Z])/g, '$1 $2').toLowerCase();
                        // Ganti tanda '-' atau '_' dengan spasi
                        label = label.replace(/[-_]/g, ' ');
                        // Hilangkan karakter yang tidak perlu dan bersihkan spasi berlebih
                        label = label.replace(/[^\w\s]/g, '').replace(/\s+/g, ' ').trim();
                        if (!label) label = 'root';
                    }

                    // Tangani duplikat label
                    let finalLabel = label;
                    if (labelCounts[label]) {
                        finalLabel = `${label} (${domain})`;
                        labelCounts[label]++;
                    } else {
                        labelCounts[label] = 1;
                    }

                    processedUrls.push({
                        url,
                        label: finalLabel
                    });
                });

                // Inisialisasi Flatpickr untuk Start Date
                flatpickr(startDate, {
                    dateFormat: "Y-m-d",
                    maxDate: new Date(), // Batasi hingga hari ini (3 Juni 2025)
                    onChange: function(selectedDates, dateStr) {
                        filterState[type].startDate = dateStr || '';
                        if (filterState[type].startDate && filterState[type].endDate &&
                            new Date(filterState[type].startDate) > new Date(filterState[type].endDate)
                        ) {
                            filterState[type].endDate = '';
                            flatpickr(endDateInput).setDate(null);
                        }
                        filterPageTable();
                    }
                });

                // Inisialisasi Flatpickr untuk End Date
                flatpickr(endDate, {
                    dateFormat: "Y-m-d",
                    maxDate: new Date(), // Batasi hingga hari ini
                    onChange: function(selectedDates, dateStr) {
                        filterState[type].endDate = dateStr || '';
                        if (filterState[type].endDate && filterState[type].startDate &&
                            new Date(filterState[type].endDate) < new Date(filterState[type].startDate)
                        ) {
                            filterState[type].startDate = '';
                            flatpickr(startDateInput).setDate(null);
                        }
                        filterPageTable();
                    }
                });

                // Bot or Human filter
                botOrHuman.addEventListener('change', function() {
                    filterState.page.bot = this.value;
                    filterPageTable();
                });

                // Isi dropdown
                urlSelect.innerHTML = '<option value="">Pilih URL</option>';
                processedUrls.forEach(({
                    url,
                    label
                }, index) => {
                    const option = document.createElement('option');
                    option.value = url;
                    option.textContent = `${label}`;
                    // option.textContent = `${index + 1}. ${label} -> ${url}`;
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
                        const date = new Date(rowData.visited_at);
                        const filter = filterState.page;

                        // Buat salinan start & end dan atur jamnya
                        const start = filter.startDate ? new Date(filter.startDate) : null;
                        const end = filter.endDate ? new Date(filter.endDate) : null;

                        if (start) start.setHours(0, 0, 0, 0); // jam 00:00:00
                        if (end) end.setHours(23, 59, 59, 999); // jam 23:59:59

                        // Filter berdasarkan tanggal yang inklusif
                        if (start && end) {
                            if (!(date >= start && date <= end)) return false;
                        } else if (start) {
                            if (date < start) return false;
                        } else if (end) {
                            if (date > end) return false;
                        }

                        // Filter bot/human
                        if (filter.bot && rowData.is_bot !== filter.bot) return false;

                        // Filter berdasarkan URL
                        if (urlFilter && urlFilter !== rowData.url) return false;

                        return true;
                    }
                );

                table.draw();
                $.fn.dataTable.ext.search.pop();
            }


            function refreshTable(type) {
                const tableId = type === 'news' ? '#table-news-visit' : '#table-page-visit';
                $(tableId).DataTable().draw();
                if (type === 'news') {
                    updateNewsStats();
                    updateUniqueVisitorsChart();
                    updatePlatformPieChart();
                }

            }

            function updateNewsStats() {
                const data = newsVisits.filter(item => {
                    const date = new Date(item.visited_at);
                    const start = filterState.news.startDate ? new Date(filterState.news.startDate) : null;
                    const end = filterState.news.endDate ? new Date(filterState.news.endDate) : null;
                    if (start && date < start) return false;
                    if (end && date > end) return false;
                    if (filterState.news.bot && item.is_bot !== filterState.news.bot) return false;
                    return true;
                });

                const total = data.length;
                const uniqueIPs = [...new Set(data.map(i => i.ip))];
                const ipCount = {};
                const platformCount = {};
                let totalDuration = 0;
                let bounceCount = 0;
                let returnCount = 0;

                data.forEach(d => {
                    totalDuration += d.duration_seconds || 1;
                    if ((d.duration_seconds || 1) <= 2) bounceCount++;
                    ipCount[d.ip] = (ipCount[d.ip] || 0) + 1;
                    platformCount[d.platform] = (platformCount[d.platform] || 0) + 1;
                });

                Object.values(ipCount).forEach(count => {
                    if (count > 1) returnCount++;
                });

                const topIP = Object.entries(ipCount).sort((a, b) => b[1] - a[1])[0]?.[0] || '-';
                const topPlatform = Object.entries(platformCount).sort((a, b) => b[1] - a[1])[0]?.[0] || '-';

                document.getElementById('uniqueNewsVisitors').textContent = uniqueIPs.length;
                document.getElementById('totalNewsVisits').textContent = total;
                document.getElementById('dominantNewsPlatform').textContent = topPlatform;
                document.getElementById('totalDurationNews').textContent = totalDuration + 's';
                document.getElementById('averageDurationNews').textContent = Math.round(totalDuration / (total ||
                    1)) + 's';
                document.getElementById('topNewsIP').textContent = topIP;
                document.getElementById('returnRateNews').textContent = total > 0 ? Math.round((returnCount /
                    uniqueIPs.length) * 100) + '%' : '0%';
                document.getElementById('bounceNews').textContent = total > 0 ? Math.round((bounceCount / total) *
                    100) + '%' : '0%';
            }

            function updateUniqueVisitorsChart() {
                const filtered = newsVisits.filter(item => {
                    const date = new Date(item.visited_at);
                    const start = filterState.news.startDate ? new Date(filterState.news.startDate) : null;
                    const end = filterState.news.endDate ? new Date(filterState.news.endDate) : null;
                    if (start && date < start) return false;
                    if (end && date > end) return false;
                    if (filterState.news.bot && item.is_bot !== filterState.news.bot) return false;
                    return true;
                });

                const grouped = {};

                filtered.forEach(item => {
                    const day = item.visited_at.substring(0, 10); // 'YYYY-MM-DD'
                    grouped[day] = grouped[day] || new Set();
                    grouped[day].add(item.ip);
                });

                const labels = Object.keys(grouped).sort();
                const data = labels.map(day => grouped[day].size);

                // Hancurkan chart sebelumnya jika ada
                if (chartInstance) chartInstance.destroy();

                const ctx = document.getElementById('uniqueVisitorsChart').getContext('2d');
                chartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Pengunjung Unik',
                            data,
                            backgroundColor: '#3b82f6'
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            function updatePlatformPieChart() {
                const filtered = newsVisits.filter(item => {
                    const date = new Date(item.visited_at);
                    const start = filterState.news.startDate ? new Date(filterState.news.startDate) : null;
                    const end = filterState.news.endDate ? new Date(filterState.news.endDate) : null;
                    if (start && date < start) return false;
                    if (end && date > end) return false;
                    if (filterState.news.bot && item.is_bot !== filterState.news.bot) return false;
                    return true;
                });

                const platformCounts = {};
                filtered.forEach(item => {
                    const platform = item.platform || 'Unknown';
                    platformCounts[platform] = (platformCounts[platform] || 0) + 1;
                });

                const labels = Object.keys(platformCounts);
                const data = Object.values(platformCounts);

                if (pieChartInstance) pieChartInstance.destroy();

                const ctx = document.getElementById('platformPieChart').getContext('2d');
                pieChartInstance = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Jumlah Pengguna',
                            data,
                            backgroundColor: labels.map(() => getRandomColor()),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            function getRandomColor() {
                const r = Math.floor(Math.random() * 200);
                const g = Math.floor(Math.random() * 200);
                const b = Math.floor(Math.random() * 200);
                return `rgba(${r}, ${g}, ${b}, 0.7)`;
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
                        // render: data => data.length > 60 ? data.substr(0, 60) + '...' : data
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
                        render: data => (data ?? 1) + 's'
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
                        // render: data => data.length > 60 ? data.substr(0, 60) + '...' : data
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
                        render: data => (data === 0 || data == null ? '1' : data) + 's'
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
                "#newsStartDate",
                "#newsEndDate",
                document.getElementById('newsBotOrHumanFilter'),
                'news');

            populateUrlFilter(pageVisits,
                "#pagesStartDate",
                "#pagesEndDate",
                document.getElementById('pagesBotOrHumanFilter'),
                document.getElementById('pageUrlFilter'));

            // Summary Table
            $('#tabel-ringkasan').DataTable({
                searching: false,
                paging: false,
                lengthChange: false,
                info: false
            });


            function exportFilteredTableToExcel(tableId, filename = 'Export') {
                return new Promise((resolve) => {
                    const table = $(`#${tableId}`).DataTable();
                    const filteredIndexes = table.rows({
                        search: 'applied'
                    }).indexes();

                    const headers = $(`#${tableId} thead th`).map(function() {
                        return $(this).text().trim();
                    }).get();

                    const exportData = [headers];

                    filteredIndexes.each(function(rowIdx) {
                        const rowData = [];
                        headers.forEach((colName, colIdx) => {
                            let data = table.cell(rowIdx, colIdx).data();

                            // Jaga agar kolom "Bot?" tetap bot/human saja
                            if (colName.toLowerCase().includes('bot')) {
                                rowData.push(data?.toLowerCase() === 'yes' ? 'bot' :
                                    'human');
                            } else if (colName.toLowerCase().includes('duration')) {
                                rowData.push(data ? `${data}s` : '1s');
                            } else {
                                const cleanData = typeof data === 'string' ? stripHtml(
                                    data) : data;
                                rowData.push(cleanData);
                            }

                        });
                        exportData.push(rowData);
                    });

                    const worksheet = XLSX.utils.aoa_to_sheet(exportData);
                    const workbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
                    XLSX.writeFile(workbook, `${filename}.xlsx`);

                    resolve(); // Trigger selesai
                });
            }

            function stripHtml(html) {
                const tmp = document.createElement("div");
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || "";
            }

            function setupExportButton(buttonId, tableId, fileName) {
                document.getElementById(buttonId).addEventListener('click', async function() {
                    const btn = this;
                    const spinner = btn.querySelector('#spinner-btn');
                    const label = btn.querySelector('.btn-label') || btn.lastChild;
                    const originalText = label.textContent.trim() || 'Export Excel';

                    if (!spinner) {
                        console.error(`Spinner element not found in button #${buttonId}`);
                        return;
                    }

                    try {
                        btn.classList.add('disabled');
                        spinner.classList.remove('d-none');
                        label.textContent = 'Exporting...';

                        // Delay kecil untuk memastikan spinner ter-render
                        await new Promise(resolve => setTimeout(resolve, 50));
                        await exportFilteredTableToExcel(tableId, fileName);

                        btn.classList.remove('disabled');
                        spinner.classList.add('d-none');
                        label.textContent = originalText;
                    } catch (error) {
                        console.error(`Error during export for ${tableId}:`, error);
                        btn.classList.remove('disabled');
                        spinner.classList.add('d-none');
                        label.textContent = originalText;
                    }
                });
            }

            // Inisialisasi tombol ekspor
            setupExportButton('exportNewsVisit', 'table-news-visit', 'news-visit-export');
            setupExportButton('exportPageVisit', 'table-page-visit', 'page-visit-export');

        });
    </script>
@endsection
