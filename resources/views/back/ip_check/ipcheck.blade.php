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
                    <div class="d-none d-md-block col mb-4"></div>
                    <div class="d-none d-md-block col mb-4"></div>
                    <div class="d-none d-md-block col mb-4"></div>
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

    <script>
        const newsVisits = @json($newsVisits);
        const pageVisits = @json($pageVisits);

        document.addEventListener("DOMContentLoaded", function() {
            let filterState = {
                news: {
                    startDate: '',
                    endDate: '',
                    bot: ''
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

            // function populateFilters(data, yearSelect, monthSelect, daySelect, botOrHuman, type) {
            //     const years = new Set();
            //     const monthsByYear = {};
            //     const daysByMonthYear = {};

            //     data.forEach(visit => {
            //         const date = new Date(visit.visited_at);
            //         const year = date.getFullYear().toString();
            //         const month = String(date.getMonth() + 1).padStart(2, '0');
            //         const day = String(date.getDate()).padStart(2, '0');
            //         const yearMonth = `${year}-${month}`;

            //         years.add(year);
            //         if (!monthsByYear[year]) monthsByYear[year] = new Set();
            //         monthsByYear[year].add(month);
            //         if (!daysByMonthYear[yearMonth]) daysByMonthYear[yearMonth] = new Set();
            //         daysByMonthYear[yearMonth].add(day);
            //     });

            //     // Populate year dropdown
            //     yearSelect.innerHTML = '<option value="">Pilih Tahun</option>';
            //     Array.from(years).sort().forEach(year => {
            //         yearSelect.innerHTML += `<option value="${year}">${year}</option>`;
            //     });

            //     // Update months
            //     yearSelect.addEventListener('change', () => {
            //         const selectedYear = yearSelect.value;
            //         filterState[type].year = selectedYear;
            //         filterState[type].month = '';
            //         filterState[type].day = '';
            //         monthSelect.innerHTML = '<option value="">Pilih Bulan</option>';
            //         daySelect.innerHTML = '<option value="">Pilih Tanggal</option>';

            //         if (selectedYear === "") {
            //             refreshTable(type); // Reset table if year is cleared
            //             return;
            //         }

            //         if (monthsByYear[selectedYear]) {
            //             Array.from(monthsByYear[selectedYear]).sort().forEach(month => {
            //                 const monthName = new Date(2025, parseInt(month) - 1).toLocaleString(
            //                     'id-ID', {
            //                         month: 'long'
            //                     });
            //                 monthSelect.innerHTML +=
            //                     `<option value="${month}">${monthName}</option>`;
            //             });
            //         }
            //         refreshTable(type);
            //     });

            //     // Update days
            //     monthSelect.addEventListener('change', () => {
            //         const year = yearSelect.value;
            //         const month = monthSelect.value;
            //         const yearMonth = `${year}-${month}`;
            //         filterState[type].month = month;
            //         filterState[type].day = '';
            //         daySelect.innerHTML = '<option value="">Pilih Tanggal</option>';

            //         if (month === "") {
            //             refreshTable(type); // Reset if month cleared
            //             return;
            //         }

            //         if (daysByMonthYear[yearMonth]) {
            //             Array.from(daysByMonthYear[yearMonth]).sort().forEach(day => {
            //                 daySelect.innerHTML += `<option value="${day}">${day}</option>`;
            //             });
            //         }
            //         refreshTable(type);
            //     });

            //     // Day filter
            //     daySelect.addEventListener('change', () => {
            //         filterState[type].day = daySelect.value;
            //         refreshTable(type);
            //     });

            //     // Bot or Human filter
            //     botOrHuman.addEventListener('change', function() {
            //         filterState.news.bot = this.value;
            //         refreshTable('news');
            //     });

            // }

            // Fungsi untuk mengisi dropdown filter URL (untuk Page Visits)
            function populateUrlFilter(data, urlSelect) {
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
                        render: data => (data === 0 || data == null ? '1' : data ) + 's'
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
            // populateFilters(newsVisits,
            //     document.getElementById('newsYearFilter'),
            //     document.getElementById('newsMonthFilter'),
            //     document.getElementById('newsDayFilter'),
            //     document.getElementById('newsBotOrHumanFilter'),
            //     'news');

            populateUrlFilter(pageVisits, document.getElementById('pageUrlFilter'));

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
                            } else if(colName.toLowerCase().includes('duration')) {
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
