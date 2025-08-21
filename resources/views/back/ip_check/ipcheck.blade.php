@extends('back.layouts.layout')
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.0/nouislider.min.js"></script>
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
                        {{-- <tr>
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
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
        <style>
            .nav-link {
                background: #efefef !important;
            }

            .nav-link.active {
                background: #ffffff !important;
            }
        </style>
        <div class=" my-4">
            <ul class="nav nav-tabs bg-active-light fs-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">News
                        Visits</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Page
                        Visits</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Page X News
                        Visits</button>
                </li>
            </ul>
            <div class="tab-content card" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="card my-4">
                        <div class="card-body">
                            <h2 class="mb-4">📰 News Visits</h2>
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
                                        <span id="spinner-btn" class="spinner-border spinner-border-sm me-1 d-none"
                                            role="status" aria-hidden="true"></span>
                                        <span class="btn-label">Export Excel</span>
                                    </button>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="alert alert-info">
                                        <h4>📈 Stats - News Visits</h4>
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
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>Bounce (≤3s):</strong> <span id="bounceVisits">0</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>Sticky Time (avg):</strong> <span id="stickyTime">0 s</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>Max Visit Time:</strong> <span id="maxVisitTime">0 s</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>Min Visit Time:</strong> <span id="minVisitTime">0 s</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <strong>From Facebook:</strong> <span id="fbVisitors">0</span>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="card my-4">
                        <div class="card-body">
                            <h2 class="mb-4">📄 Page Visits</h2>
                            <div class="row row-cols-1 row-cols-sm-5">
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
                                        <span id="spinner-btn" class="spinner-border spinner-border-sm me-1 d-none"
                                            role="status" aria-hidden="true"></span>
                                        <span class="btn-label">Export Excel</span>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="alert alert-info">
                                        <h4 class="mb-3">📈 Statistik Page Visits</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Jumlah Pengunjung Unik (IP):</span>
                                                <strong id="page-unique-visitors"></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Kunjungan:</span>
                                                <strong id="page-total-visits"></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Platform Dominan:</span>
                                                <strong id="page-platform-dominant"></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Durasi Kunjungan:</span>
                                                <strong id="page-total-duration">s</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Durasi Rata-rata:</span>
                                                <strong id="page-avg-duration">s</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>IP Terbanyak:</span>
                                                <strong id="page-most-ip"></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Return Visitor Rate:</span>
                                                <strong id="page-return-visitor">%</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Bounce (≤3s):</span>
                                                <strong id="page-bounce-count"></strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Bounce Rate:</span>
                                                <strong id="page-bounce-rate">%</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Sticky Time (avg):</span>
                                                <strong id="page-sticky-time"> s</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Max Visit Time:</span>
                                                <strong id="page-max-time">s</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Min Visit Time:</span>
                                                <strong id="page-min-time">s</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Dari Facebook:</span>
                                                <strong id="page-facebook-count"></strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-9 mb-4">
                                    <h4 class="text-center">📈 Diagram Pengunjung Unik per Hari</h4>
                                    <canvas id="pageVisitChart" height="100"></canvas>
                                </div>

                                <div class="col-3 mb-4">
                                    <h4 class="mb-3">📊 Diagram Platform Pengguna</h4>
                                    <canvas id="pagePlatformPie" height="100"></canvas>
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">
                    <div class="card my-4">
                        <div class="card-body">
                            <h2 class="mb-4">📄 Page X News Visits</h2>
                            <div class="row row-cols-1 row-cols-sm-3">
                                <div class="col mb-4">
                                    <input type="text" class="selector form-control" id="mergeStartDate"
                                        placeholder="Pilih Tanggal Mulai">
                                </div>
                                <div class="col mb-4">
                                    <input type="text" class="selector form-control" id="mergeEndDate"
                                        placeholder="Pilih Tanggal Selesai">
                                </div>
                                <div class="col mb-4">
                                    <select class="form-select" id="mergeBotOrHumanFilter">
                                        <option value="">Pilih Bot Or Human</option>
                                        <option value="Yes">Bot</option>
                                        <option value="No">Human</option>
                                    </select>
                                </div>
                                <div class="col mb-4">
                                    <input type="text" class="selector form-control" id="mergeStartTime"
                                        placeholder="Pilih Jam Awal">
                                </div>
                                <div class="col mb-4">
                                    <input type="text" class="selector form-control" id="mergeEndTime"
                                        placeholder="Pilih Jam Akhir">
                                </div>
                                <div class="col mb-4">
                                    <label for="durationRange" class="form-label">Visit Duration Range (seconds)</label>
                                    <div id="durationRange" class="mb-2"></div>
                                    <div class="d-flex justify-content-between">
                                        <span id="durationMinLabel">0s</span>
                                        <span id="durationMaxLabel">0s</span>
                                    </div>
                                    <input type="hidden" id="mergeMinDuration" value="0">
                                    <input type="hidden" id="mergeMaxDuration" value="0">
                                </div>
                                <div class="col mb-4">
                                    <select class="form-select text-capitalize" id="mergeCountryFilter">
                                        <option value="">Pilih Country</option>
                                    </select>
                                </div>
                                <div class="col mb-4">
                                    <select class="form-select text-capitalize" id="mergeUrlFilter">
                                        <option value="">Pilih URL</option>
                                    </select>
                                </div>
                                <div class="col mb-4">
                                    <select class="form-select text-capitalize" id="mergeBrowserFilter">
                                        <option value="">Pilih Browser</option>
                                    </select>
                                </div>
                                <div class="col mb-4">
                                    <select class="form-select text-capitalize" id="mergePlatformFilter">
                                        <option value="">Pilih Platform</option>
                                    </select>
                                </div>
                                <div class="col mb-4">
                                    <button id="exportPageXNews" class="btn btn-primary w-100">
                                        <span id="spinner-btn" class="spinner-border spinner-border-sm me-1 d-none"
                                            role="status" aria-hidden="true"></span>
                                        <span class="btn-label">Export Excel</span>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="alert alert-info">
                                        <h4 class="mb-3">📈 Statistik Page x News Visits</h4>
                                        <ul class="list-group" id="global-stats">
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4 mb-4" id="charts-section">
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Pengunjung per Hari</h6>
                                            <canvas id="allVisitorsPerDayChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Jumlah Pengunjung Unik per Hari</h6>
                                            <canvas id="uniqueVisitorsPerDayChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Top 10 URL Terpopuler</h6>
                                            <canvas id="topUrlsChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Jumlah Total Kunjungan per Hari</h6>
                                            <canvas id="totalVisitsPerDayChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Jumlah Kunjungan per Jam</h6>
                                            <canvas id="visitsPerHourChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Distribusi Bot vs Human</h6>
                                            <canvas id="botVsHumanChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Distribusi Negara</h6>
                                            <canvas id="countryDistributionChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Distribusi Platform Pengguna</h6>
                                            <canvas id="platformDistributionChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Distribusi Browser Pengguna</h6>
                                            <canvas id="browserDistributionChart"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Jumlah Kunjungan Berdasarkan Referer</h6>
                                            <canvas id="refererDistributionChart"></canvas>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Visualisasi Jumlah Kunjungan IP per Tanggal dan Jam</h6>

                                            <canvas id="ipBubbleChart"></canvas>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="table-responsive">
                                <table id="combined-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>IP</th>
                                            <th>Visited At</th>
                                            <th>News Visited</th>
                                            <th>Page Visited</th>
                                            <th>News Duration</th>
                                            <th>Page Duration</th>
                                            <th>Bot Status</th>
                                            <th>Browser</th>
                                            <th>Platform</th>
                                            <th>Country</th>
                                            <th>Visited URLs</th>
                                        </tr>
                                    </thead>
                                    <tbody id="combined-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Konversi data PHP ke JSON -->
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Main Application Script -->
    <script>
        let newsVisits = [];
        let pageVisits = [];
        let summarys = [];
        let ipCountryCache = new Map();

        const isoToCountryName = {
            "AD": "Andorra",
            "AE": "United Arab Emirates",
            "AF": "Afghanistan",
            "AG": "Antigua and Barbuda",
            "AI": "Anguilla",
            "AL": "Albania",
            "AM": "Armenia",
            "AO": "Angola",
            "AQ": "Antarctica",
            "AR": "Argentina",
            "AS": "American Samoa",
            "AT": "Austria",
            "AU": "Australia",
            "AW": "Aruba",
            "AX": "Åland Islands",
            "AZ": "Azerbaijan",
            "BA": "Bosnia and Herzegovina",
            "BB": "Barbados",
            "BD": "Bangladesh",
            "BE": "Belgium",
            "BF": "Burkina Faso",
            "BG": "Bulgaria",
            "BH": "Bahrain",
            "BI": "Burundi",
            "BJ": "Benin",
            "BL": "Saint Barthélemy",
            "BM": "Bermuda",
            "BN": "Brunei Darussalam",
            "BO": "Bolivia",
            "BQ": "Bonaire, Sint Eustatius and Saba",
            "BR": "Brazil",
            "BS": "Bahamas",
            "BT": "Bhutan",
            "BV": "Bouvet Island",
            "BW": "Botswana",
            "BY": "Belarus",
            "BZ": "Belize",
            "CA": "Canada",
            "CC": "Cocos (Keeling) Islands",
            "CD": "Congo, Democratic Republic of the",
            "CF": "Central African Republic",
            "CG": "Congo",
            "CH": "Switzerland",
            "CI": "Côte d'Ivoire",
            "CK": "Cook Islands",
            "CL": "Chile",
            "CM": "Cameroon",
            "CN": "China",
            "CO": "Colombia",
            "CR": "Costa Rica",
            "CU": "Cuba",
            "CV": "Cabo Verde",
            "CW": "Curaçao",
            "CX": "Christmas Island",
            "CY": "Cyprus",
            "CZ": "Czechia",
            "DE": "Germany",
            "DJ": "Djibouti",
            "DK": "Denmark",
            "DM": "Dominica",
            "DO": "Dominican Republic",
            "DZ": "Algeria",
            "EC": "Ecuador",
            "EE": "Estonia",
            "EG": "Egypt",
            "EH": "Western Sahara",
            "ER": "Eritrea",
            "ES": "Spain",
            "ET": "Ethiopia",
            "FI": "Finland",
            "FJ": "Fiji",
            "FK": "Falkland Islands (Malvinas)",
            "FM": "Micronesia, Federated States of",
            "FO": "Faroe Islands",
            "FR": "France",
            "GA": "Gabon",
            "GB": "United Kingdom",
            "GD": "Grenada",
            "GE": "Georgia",
            "GF": "French Guiana",
            "GG": "Guernsey",
            "GH": "Ghana",
            "GI": "Gibraltar",
            "GL": "Greenland",
            "GM": "Gambia",
            "GN": "Guinea",
            "GP": "Guadeloupe",
            "GQ": "Equatorial Guinea",
            "GR": "Greece",
            "GS": "South Georgia and the South Sandwich Islands",
            "GT": "Guatemala",
            "GU": "Guam",
            "GW": "Guinea-Bissau",
            "GY": "Guyana",
            "HK": "Hong Kong",
            "HM": "Heard Island and McDonald Islands",
            "HN": "Honduras",
            "HR": "Croatia",
            "HT": "Haiti",
            "HU": "Hungary",
            "ID": "Indonesia",
            "IE": "Ireland",
            "IL": "Israel",
            "IM": "Isle of Man",
            "IN": "India",
            "IO": "British Indian Ocean Territory",
            "IQ": "Iraq",
            "IR": "Iran, Islamic Republic of",
            "IS": "Iceland",
            "IT": "Italy",
            "JE": "Jersey",
            "JM": "Jamaica",
            "JO": "Jordan",
            "JP": "Japan",
            "KE": "Kenya",
            "KG": "Kyrgyzstan",
            "KH": "Cambodia",
            "KI": "Kiribati",
            "KM": "Comoros",
            "KN": "Saint Kitts and Nevis",
            "KP": "Korea, Democratic People's Republic of",
            "KR": "Korea, Republic of",
            "KW": "Kuwait",
            "KY": "Cayman Islands",
            "KZ": "Kazakhstan",
            "LA": "Lao People's Democratic Republic",
            "LB": "Lebanon",
            "LC": "Saint Lucia",
            "LI": "Liechtenstein",
            "LK": "Sri Lanka",
            "LR": "Liberia",
            "LS": "Lesotho",
            "LT": "Lithuania",
            "LU": "Luxembourg",
            "LV": "Latvia",
            "LY": "Libya",
            "MA": "Morocco",
            "MC": "Monaco",
            "MD": "Moldova, Republic of",
            "ME": "Montenegro",
            "MF": "Saint Martin (French part)",
            "MG": "Madagascar",
            "MH": "Marshall Islands",
            "MK": "North Macedonia",
            "ML": "Mali",
            "MM": "Myanmar",
            "MN": "Mongolia",
            "MO": "Macao",
            "MP": "Northern Mariana Islands",
            "MQ": "Martinique",
            "MR": "Mauritania",
            "MS": "Montserrat",
            "MT": "Malta",
            "MU": "Mauritius",
            "MV": "Maldives",
            "MW": "Malawi",
            "MX": "Mexico",
            "MY": "Malaysia",
            "MZ": "Mozambique",
            "NA": "Namibia",
            "NC": "New Caledonia",
            "NE": "Niger",
            "NF": "Norfolk Island",
            "NG": "Nigeria",
            "NI": "Nicaragua",
            "NL": "Netherlands",
            "NO": "Norway",
            "NP": "Nepal",
            "NR": "Nauru",
            "NU": "Niue",
            "NZ": "New Zealand",
            "OM": "Oman",
            "PA": "Panama",
            "PE": "Peru",
            "PF": "French Polynesia",
            "PG": "Papua New Guinea",
            "PH": "Philippines",
            "PK": "Pakistan",
            "PL": "Poland",
            "PM": "Saint Pierre and Miquelon",
            "PN": "Pitcairn",
            "PR": "Puerto Rico",
            "PS": "Palestine, State of",
            "PT": "Portugal",
            "PW": "Palau",
            "PY": "Paraguay",
            "QA": "Qatar",
            "RE": "Réunion",
            "RO": "Romania",
            "RS": "Serbia",
            "RU": "Russia",
            "RW": "Rwanda",
            "SA": "Saudi Arabia",
            "SB": "Solomon Islands",
            "SC": "Seychelles",
            "SD": "Sudan",
            "SE": "Sweden",
            "SG": "Singapore",
            "SH": "Saint Helena, Ascension and Tristan da Cunha",
            "SI": "Slovenia",
            "SJ": "Svalbard and Jan Mayen",
            "SK": "Slovakia",
            "SL": "Sierra Leone",
            "SM": "San Marino",
            "SN": "Senegal",
            "SO": "Somalia",
            "SR": "Suriname",
            "SS": "South Sudan",
            "ST": "Sao Tome and Principe",
            "SV": "El Salvador",
            "SX": "Sint Maarten (Dutch part)",
            "SY": "Syrian Arab Republic",
            "SZ": "Eswatini",
            "TC": "Turks and Caicos Islands",
            "TD": "Chad",
            "TF": "French Southern Territories",
            "TG": "Togo",
            "TH": "Thailand",
            "TJ": "Tajikistan",
            "TK": "Tokelau",
            "TL": "Timor-Leste",
            "TM": "Turkmenistan",
            "TN": "Tunisia",
            "TO": "Tonga",
            "TR": "Turkey",
            "TT": "Trinidad and Tobago",
            "TV": "Tuvalu",
            "TW": "Taiwan",
            "TZ": "Tanzania, United Republic of",
            "UA": "Ukraine",
            "UG": "Uganda",
            "UM": "United States Minor Outlying Islands",
            "US": "United States",
            "UY": "Uruguay",
            "UZ": "Uzbekistan",
            "VA": "Holy See",
            "VC": "Saint Vincent and the Grenadines",
            "VE": "Venezuela",
            "VG": "Virgin Islands (British)",
            "VI": "Virgin Islands (U.S.)",
            "VN": "Viet Nam",
            "VU": "Vanuatu",
            "WF": "Wallis and Futuna",
            "WS": "Samoa",
            "YE": "Yemen",
            "YT": "Mayotte",
            "ZA": "South Africa",
            "ZM": "Zambia",
            "ZW": "Zimbabwe"
        };

        function loadCacheFromStorage() {
            const storedCache = localStorage.getItem('ipCountryCache');
            if (storedCache) {
                ipCountryCache = new Map(Object.entries(JSON.parse(storedCache)));
            }
        }

        function saveCacheToStorage() {
            localStorage.setItem('ipCountryCache', JSON.stringify(Object.fromEntries(ipCountryCache)));
        }

        async function getCountryFromIP(ip) {
            if (ipCountryCache.has(ip)) return ipCountryCache.get(ip);
            let country = 'Unknown';
            try {
                const res = await fetch(`https://ipwhois.app/json/${ip}`);
                if (res.ok) {
                    const data = await res.json();
                    if (data?.country_name) {
                        country = data.country_name;
                        ipCountryCache.set(ip, country);
                        saveCacheToStorage();
                        return country;
                    }
                }
            } catch (_) {}
            try {
                const res = await fetch(`https://ipapi.co/${ip}/json/`);
                if (res.ok) {
                    const data = await res.json();
                    if (data?.country) {
                        country = isoToCountryName[data.country] || data.country;
                        ipCountryCache.set(ip, country);
                        saveCacheToStorage();
                        return country;
                    }
                }
            } catch (_) {}
            ipCountryCache.set(ip, country);
            saveCacheToStorage();
            return country;
        }

        function loadRingkasan(summary) {
            const tableBody = document.querySelector('#tabel-ringkasan tbody');
            tableBody.innerHTML = `
        <tr>
            <td>News Visits</td>
            <td>${summary.news_total || 0}</td>
            <td class="text-danger fw-bold">${summary.news_bots || 0} (${summary.news_bots_percent || 0}%)</td>
            <td class="text-success fw-bold">${summary.news_humans || 0} (${summary.news_humans_percent || 0}%)</td>
        </tr>
        <tr>
            <td>Page Visits</td>
            <td>${summary.page_total || 0}</td>
            <td class="text-danger fw-bold">${summary.page_bots || 0} (${summary.page_bots_percent || 0}%)</td>
            <td class="text-success fw-bold">${summary.page_humans || 0} (${summary.page_humans_percent || 0}%)</td>
        </tr>
    `;
        }

        document.addEventListener("DOMContentLoaded", async function() {
            let chartInstance = null;
            let pieChartInstance = null;
            let pageVisitChartInstance = null;
            let newsTable, pageTable, combinedTable;

            const filterState = {
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

            try {
                const response = await fetch('/api/ipcheck');
                const data = await response.json();
                newsVisits = data.news_visits || [];
                pageVisits = data.page_visits || [];
                summarys = data.summary || {};
                loadRingkasan(summarys);
            } catch (error) {
                console.error('Error fetching data:', error);
            }

            $.fn.dataTable.ext.search.push((settings, data, dataIndex, rowData) => {
                const tableId = settings.nTable.id;
                const filter = tableId === 'table-news-visit' ? filterState.news : filterState.page;
                const date = new Date(rowData.visited_at);
                const start = filter.startDate ? new Date(filter.startDate) : null;
                const end = filter.endDate ? new Date(filter.endDate) : null;

                if (start && end && (date < start || date > end)) return false;
                if (start && date < start) return false;
                if (end && date > end) return false;
                if (filter.bot && rowData.is_bot !== filter.bot) return false;
                if (tableId === 'table-page-visit' && filter.url && rowData.url !== filter.url)
                return false;
                return true;
            });

            function populateFilters(data, startDateId, endDateId, botOrHumanId, type) {
                const startDateInput = document.querySelector(startDateId);
                const endDateInput = document.querySelector(endDateId);
                const botOrHuman = document.querySelector(botOrHumanId);

                flatpickr(startDateInput, {
                    dateFormat: "Y-m-d",
                    maxDate: new Date(),
                    onChange: (selectedDates, dateStr) => {
                        filterState[type].startDate = dateStr;
                        if (filterState[type].startDate && filterState[type].endDate &&
                            new Date(filterState[type].startDate) > new Date(filterState[type]
                                .endDate)) {
                            filterState[type].endDate = '';
                            flatpickr(endDateInput).setDate(null);
                        }
                        refreshTable(type);
                    }
                });

                flatpickr(endDateInput, {
                    dateFormat: "Y-m-d",
                    maxDate: new Date(),
                    onChange: (selectedDates, dateStr) => {
                        filterState[type].endDate = dateStr;
                        if (filterState[type].endDate && filterState[type].startDate &&
                            new Date(filterState[type].endDate) < new Date(filterState[type]
                                .startDate)) {
                            filterState[type].startDate = '';
                            flatpickr(startDateInput).setDate(null);
                        }
                        refreshTable(type);
                    }
                });

                botOrHuman.addEventListener('change', () => {
                    filterState[type].bot = botOrHuman.value;
                    refreshTable(type);
                });
            }

            function populateUrlFilter(data, startDateId, endDateId, botOrHumanId, urlSelectId, type = 'page') {
                const urls = [...new Set(data.map(visit => visit.url))].sort();
                const urlSelect = document.querySelector(urlSelectId);
                urlSelect.innerHTML = '<option value="">Pilih URL</option>';

                const labelCounts = {};
                urls.forEach(url => {
                    let label = decodeURIComponent(url.replace(/^(https?:\/\/)?[^\/]+/, '') || '/');
                    if (label === '/') label = 'home';
                    else {
                        label = label.replace(/^\/|\/$/g, '').replace(/([a-z])([A-Z])/g, '$1 $2')
                            .replace(/[-_]/g, ' ').replace(/\s+/g, ' ').trim().toLowerCase();
                        if (!label) label = 'root';
                    }

                    const domain = url.match(/^(https?:\/\/)([^\/]+)/)?.[2] || '';
                    let finalLabel = labelCounts[label] ? `${label} (${domain})` : label;
                    labelCounts[label] = (labelCounts[label] || 0) + 1;

                    const option = document.createElement('option');
                    option.value = url;
                    option.textContent = finalLabel;
                    urlSelect.appendChild(option);
                });

                populateFilters(data, startDateId, endDateId, botOrHumanId, type);
                urlSelect.addEventListener('change', () => {
                    filterState.page.url = urlSelect.value;
                    refreshTable('page');
                });
            }

            function refreshTable(type) {
                const tableId = type === 'news' ? '#table-news-visit' : '#table-page-visit';
                $(tableId).DataTable().draw();
                if (type === 'news') {
                    updateNewsStats();
                    updateUniqueVisitorsChart();
                    updatePlatformPieChart();
                } else {
                    const filteredData = pageTable.rows({
                        search: 'applied'
                    }).data().toArray();
                    updatePageVisitStats(filteredData);
                    updatePageVisitChart(filteredData);
                }
            }

            function updateNewsStats() {
                const filtered = newsVisits.filter(item => {
                    const date = new Date(item.visited_at);
                    const start = filterState.news.startDate ? new Date(filterState.news.startDate) :
                        null;
                    const end = filterState.news.endDate ? new Date(filterState.news.endDate) : null;
                    return (!start || date >= start) && (!end || date <= end) &&
                        (!filterState.news.bot || item.is_bot === filterState.news.bot);
                });

                const total = filtered.length;
                const uniqueIPs = [...new Set(filtered.map(i => i.ip))];
                const ipCount = {};
                const platformCount = {};
                let totalDuration = 0,
                    bounceCount = 0,
                    returnCount = 0;

                filtered.forEach(d => {
                    const duration = d.duration_seconds || 1;
                    totalDuration += duration;
                    if (duration <= 2) bounceCount++;
                    ipCount[d.ip] = (ipCount[d.ip] || 0) + 1;
                    platformCount[d.platform] = (platformCount[d.platform] || 0) + 1;
                });

                Object.values(ipCount).forEach(count => {
                    if (count > 1) returnCount++;
                });

                const durations = filtered.map(item => item.duration_seconds || 1);
                const maxTime = Math.max(...durations, 1);
                const minTime = Math.min(...durations, 1);
                const stickyTime = filtered.filter(item => (item.duration_seconds || 1) > 3)
                    .reduce((sum, item) => sum + (item.duration_seconds || 1), 0) / (filtered.length || 1);
                const facebookVisitors = filtered.filter(item => (item.referer || '').toLowerCase().includes(
                    'facebook')).length;
                const topIP = Object.entries(ipCount).sort((a, b) => b[1] - a[1])[0]?.[0] || '-';
                const topPlatform = Object.entries(platformCount).sort((a, b) => b[1] - a[1])[0]?.[0] || '-';

                document.getElementById('uniqueNewsVisitors').textContent = uniqueIPs.length;
                document.getElementById('totalNewsVisits').textContent = total;
                document.getElementById('bounceVisits').textContent =
                    `${bounceCount} (${Math.round((bounceCount / total || 0) * 100)}%)`;
                document.getElementById('stickyTime').textContent = `${stickyTime.toFixed(2)} s`;
                document.getElementById('dominantNewsPlatform').textContent = topPlatform;
                document.getElementById('totalDurationNews').textContent = `${totalDuration} s`;
                document.getElementById('averageDurationNews').textContent =
                    `${Math.round(totalDuration / (total || 1))} s`;
                document.getElementById('topNewsIP').textContent = topIP;
                document.getElementById('returnRateNews').textContent = total > 0 ?
                    `${Math.round((returnCount / uniqueIPs.length) * 100)}%` : '0%';
                document.getElementById('bounceNews').textContent = total > 0 ?
                    `${Math.round((bounceCount / total) * 100)}%` : '0%';
                document.getElementById('maxVisitTime').textContent = `${maxTime} s`;
                document.getElementById('minVisitTime').textContent = `${minTime} s`;
                document.getElementById('fbVisitors').textContent = `${facebookVisitors}`;
            }

            function updateUniqueVisitorsChart() {
                const filtered = newsVisits.filter(item => {
                    const date = new Date(item.visited_at);
                    const start = filterState.news.startDate ? new Date(filterState.news.startDate) :
                        null;
                    const end = filterState.news.endDate ? new Date(filterState.news.endDate) : null;
                    return (!start || date >= start) && (!end || date <= end) &&
                        (!filterState.news.bot || item.is_bot === filterState.news.bot);
                });

                const grouped = {};
                filtered.forEach(item => {
                    const day = item.visited_at.substring(0, 10);
                    grouped[day] = grouped[day] || new Set();
                    grouped[day].add(item.ip);
                });

                const labels = Object.keys(grouped).sort();
                const data = labels.map(day => grouped[day].size);

                if (chartInstance) chartInstance.destroy();
                chartInstance = new Chart(document.getElementById('uniqueVisitorsChart').getContext('2d'), {
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
                    const start = filterState.news.startDate ? new Date(filterState.news.startDate) :
                        null;
                    const end = filterState.news.endDate ? new Date(filterState.news.endDate) : null;
                    return (!start || date >= start) && (!end || date <= end) &&
                        (!filterState.news.bot || item.is_bot === filterState.news.bot);
                });

                const platformCounts = {};
                filtered.forEach(item => {
                    const platform = item.platform || 'Unknown';
                    platformCounts[platform] = (platformCounts[platform] || 0) + 1;
                });

                if (pieChartInstance) pieChartInstance.destroy();
                pieChartInstance = new Chart(document.getElementById('platformPieChart').getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: Object.keys(platformCounts),
                        datasets: [{
                            label: 'Jumlah Pengguna',
                            data: Object.values(platformCounts),
                            backgroundColor: Object.keys(platformCounts).map(() =>
                                `rgba(${Math.floor(Math.random() * 200)}, ${Math.floor(Math.random() * 200)}, ${Math.floor(Math.random() * 200)}, 0.7)`
                                )
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

            function updatePageVisitStats(data) {
                const humanData = data.filter(row => row.is_bot === 'No');
                const uniqueIps = [...new Set(humanData.map(v => v.ip))];
                const platformCounts = {};
                const ipCounts = {};
                let totalDuration = 0,
                    minTime = Infinity,
                    maxTime = 0,
                    bounceCount = 0,
                    facebookVisits = 0,
                    returnCount = 0;

                humanData.forEach(row => {
                    const d = row.duration ?? 1;
                    totalDuration += d;
                    if (d <= 3) bounceCount++;
                    if (d > maxTime) maxTime = d;
                    if (d < minTime) minTime = d;
                    if (row.referrer?.toLowerCase().includes('facebook')) facebookVisits++;
                    platformCounts[row.platform] = (platformCounts[row.platform] || 0) + 1;
                    ipCounts[row.ip] = (ipCounts[row.ip] || 0) + 1;
                });

                Object.values(ipCounts).forEach(count => {
                    if (count > 1) returnCount++;
                });

                const totalVisits = humanData.length;
                const avgDuration = totalVisits ? totalDuration / totalVisits : 0;
                const mostCommonIp = Object.entries(ipCounts).sort((a, b) => b[1] - a[1])[0]?.[0] || '-';
                const dominantPlatform = Object.entries(platformCounts).sort((a, b) => b[1] - a[1])[0]?.[0] ||
                    '-';

                document.getElementById('page-unique-visitors').textContent = uniqueIps.length;
                document.getElementById('page-total-visits').textContent = totalVisits;
                document.getElementById('page-platform-dominant').textContent = dominantPlatform;
                document.getElementById('page-total-duration').textContent = `${totalDuration} s`;
                document.getElementById('page-avg-duration').textContent = `${avgDuration.toFixed(2)} s`;
                document.getElementById('page-most-ip').textContent = mostCommonIp;
                document.getElementById('page-return-visitor').textContent = totalVisits > 0 ?
                    `${Math.round((returnCount / uniqueIps.length) * 100)}%` : '0%';
                document.getElementById('page-bounce-count').textContent =
                    `${bounceCount} (${Math.round((bounceCount / totalVisits || 0) * 100)}%)`;
                document.getElementById('page-bounce-rate').textContent =
                    `${(bounceCount / totalVisits * 100 || 0).toFixed(2)}%`;
                document.getElementById('page-sticky-time').textContent = `${avgDuration.toFixed(2)} s`;
                document.getElementById('page-max-time').textContent = `${maxTime} s`;
                document.getElementById('page-min-time').textContent = minTime === Infinity ? '0 s' :
                    `${minTime} s`;
                document.getElementById('page-facebook-count').textContent = facebookVisits;

                if (window.pagePlatformPie) window.pagePlatformPie.destroy();
                window.pagePlatformPie = new Chart(document.getElementById('pagePlatformPie').getContext(
                '2d'), {
                    type: 'pie',
                    data: {
                        labels: Object.keys(platformCounts),
                        datasets: [{
                            data: Object.values(platformCounts),
                            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545',
                                '#6f42c1'
                            ]
                        }]
                    }
                });
            }

            function updatePageVisitChart(filteredData) {
                const ipPerDay = {};
                filteredData.forEach(row => {
                    const date = new Date(row.visited_at).toISOString().slice(0, 10);
                    ipPerDay[date] = ipPerDay[date] || new Set();
                    ipPerDay[date].add(row.ip);
                });

                const labels = Object.keys(ipPerDay).sort();
                const data = labels.map(date => ipPerDay[date].size);

                if (pageVisitChartInstance) pageVisitChartInstance.destroy();
                pageVisitChartInstance = new Chart(document.getElementById('pageVisitChart').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Unique Visitors (by IP)',
                            data,
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Unique Visitors'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Date'
                                }
                            }
                        }
                    }
                });
            }

            newsTable = $('#table-news-visit').DataTable({
                data: newsVisits,
                columns: [{
                        data: 'news_id'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'user_agent'
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
                rowCallback: (row, data) => $(row).attr('data-filter-date', data.visited_at)
            });

            pageTable = $('#table-page-visit').DataTable({
                data: pageVisits,
                columns: [{
                        data: 'url'
                    },
                    {
                        data: 'ip'
                    },
                    {
                        data: 'user_agent'
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
                        render: data => (data ?? 1) + 's'
                    },
                    {
                        data: 'is_bot',
                        render: data => data === 'Yes' ?
                            '<span class="badge bg-danger">Bot</span>' :
                            '<span class="badge bg-success">Human</span>'
                    }
                ],
                rowCallback: (row, data) => $(row).attr('data-filter-date', data.visited_at)
            });

            $('#tabel-ringkasan').DataTable({
                searching: false,
                paging: false,
                lengthChange: false,
                info: false
            });

            populateFilters(newsVisits, "#newsStartDate", "#newsEndDate", "#newsBotOrHumanFilter", 'news');
            populateUrlFilter(pageVisits, "#pagesStartDate", "#pagesEndDate", "#pagesBotOrHumanFilter",
                "#pageUrlFilter");

            const uniqueIPs = new Set([...newsVisits.map(n => n.ip), ...pageVisits.map(p => p.ip)]);
            await Promise.all(Array.from(uniqueIPs).map(ip => getCountryFromIP(ip)));

            const ipMap = {};
            newsVisits.forEach(item => {
                if (!ipMap[item.ip]) ipMap[item.ip] = {
                    news: [],
                    page: [],
                    country: ipCountryCache.get(item.ip) || 'Unknown'
                };
                ipMap[item.ip].news.push({
                    ...item,
                    country: ipMap[item.ip].country
                });
            });
            pageVisits.forEach(item => {
                if (!ipMap[item.ip]) ipMap[item.ip] = {
                    news: [],
                    page: [],
                    country: ipCountryCache.get(item.ip) || 'Unknown'
                };
                ipMap[item.ip].page.push({
                    ...item,
                    country: ipMap[item.ip].country
                });
            });

            const combinedData = Object.entries(ipMap).map(([ip, data], index) => {
                const visitedUrls = data.page.map(p => p.url);
                const allVisitedAt = [...data.news.map(n => n.visited_at), ...data.page.map(p => p
                    .visited_at)].sort((a, b) => new Date(b) - new Date(a));
                const accordionId = `accordion-${index}`;
                return {
                    ip,
                    visitedAtAccordion: `
                <div class="accordion" id="${accordionId}">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-${index}">
                                ${allVisitedAt.length} visits
                            </button>
                        </h2>
                        <div id="collapse-${index}" class="accordion-collapse collapse" data-bs-parent="#${accordionId}">
                            <div class="accordion-body">
                                <ul class="mb-0 list-group list-group-flush">
                                    ${allVisitedAt.map(d => `<li class="list-group-item">${new Date(d).toLocaleString()}</li>`).join('')}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>`,
                    newsVisited: data.news.length ? `✅ (${data.news.length})` : '-',
                    pageVisited: data.page.length ? `✅ (${data.page.length})` : '-',
                    newsDuration: data.news.reduce((sum, d) => sum + (parseInt(d.duration_seconds) ||
                        0), 0) + 's',
                    pageDuration: data.page.reduce((sum, d) => sum + (parseInt(d.duration) || 0), 0) +
                        's',
                    is_bot: data.news[0]?.is_bot || data.page[0]?.is_bot || 'Unknown',
                    browser: data.news[0]?.browser || data.page[0]?.browser || '-',
                    platform: data.news[0]?.platform || data.page[0]?.platform || '-',
                    country: data.country,
                    urls: visitedUrls,
                    allVisitedAt
                };
            });

            const urlSet = new Set(combinedData.flatMap(data => data.urls));
            const browserSet = new Set(combinedData.map(data => data.browser).filter(b => b !== '-'));
            const platformSet = new Set(combinedData.map(data => data.platform).filter(p => p !== '-'));
            const countrySet = new Set(combinedData.map(data => data.country).filter(c => c !== 'Unknown'));

            ['mergeUrlFilter', 'mergeBrowserFilter', 'mergePlatformFilter', 'mergeCountryFilter'].forEach(
            id => {
                const select = document.getElementById(id);
                const set = id === 'mergeUrlFilter' ? urlSet : id === 'mergeBrowserFilter' ?
                    browserSet : id === 'mergePlatformFilter' ? platformSet : countrySet;
                set.forEach(value => {
                    const option = document.createElement('option');
                    option.value = value;
                    option.textContent = value;
                    select.appendChild(option);
                });
            });

            const maxDuration = Math.max(...combinedData.map(data => Math.max(parseInt(data.newsDuration) || 0,
                parseInt(data.pageDuration) || 0)), 1000);
            const durationSlider = document.getElementById('durationRange');
            noUiSlider.create(durationSlider, {
                start: [0, maxDuration],
                connect: true,
                range: {
                    'min': 0,
                    'max': maxDuration
                },
                step: 1,
                format: {
                    to: value => Math.round(value),
                    from: value => Number(value)
                }
            });

            const charts = {
                uniqueVisitorsPerDay: new Chart(document.getElementById('uniqueVisitorsPerDayChart')
                    .getContext('2d'), {
                        type: 'bar'
                    }),
                platformDistribution: new Chart(document.getElementById('platformDistributionChart')
                    .getContext('2d'), {
                        type: 'pie'
                    }),
                browserDistribution: new Chart(document.getElementById('browserDistributionChart')
                    .getContext('2d'), {
                        type: 'pie'
                    }),
                botVsHuman: new Chart(document.getElementById('botVsHumanChart').getContext('2d'), {
                    type: 'pie'
                }),
                topUrls: new Chart(document.getElementById('topUrlsChart').getContext('2d'), {
                    type: 'bar'
                }),
                totalVisitsPerDay: new Chart(document.getElementById('totalVisitsPerDayChart').getContext(
                    '2d'), {
                    type: 'line'
                }),
                visitsPerHour: new Chart(document.getElementById('visitsPerHourChart').getContext('2d'), {
                    type: 'bar'
                }),
                refererDistribution: new Chart(document.getElementById('refererDistributionChart')
                    .getContext('2d'), {
                        type: 'doughnut'
                    }),
                countryDistribution: new Chart(document.getElementById('countryDistributionChart')
                    .getContext('2d'), {
                        type: 'pie'
                    }),
                allVisitorsPerDayChart: new Chart(document.getElementById('allVisitorsPerDayChart')
                    .getContext('2d'), {
                        type: 'bar'
                    })
            };

            function parseTime(timeStr) {
                if (!timeStr) return null;
                const [hours, minutes] = timeStr.split(':').map(Number);
                return hours * 60 + minutes;
            }

            function updateCharts() {
                const filters = {
                    startDate: document.getElementById('mergeStartDate').value,
                    endDate: document.getElementById('mergeEndDate').value,
                    startTime: parseTime(document.getElementById('mergeStartTime').value),
                    endTime: parseTime(document.getElementById('mergeEndTime').value),
                    botFilter: document.getElementById('mergeBotOrHumanFilter').value,
                    urlFilter: document.getElementById('mergeUrlFilter').value,
                    browserFilter: document.getElementById('mergeBrowserFilter').value,
                    platformFilter: document.getElementById('mergePlatformFilter').value,
                    countryFilter: document.getElementById('mergeCountryFilter').value,
                    minDuration: parseInt(document.getElementById('mergeMinDuration').value) || 0,
                    maxDuration: parseInt(document.getElementById('mergeMaxDuration').value) || Infinity
                };

                const start = filters.startDate ? new Date(filters.startDate) : null;
                const end = filters.endDate ? new Date(filters.endDate) : null;

                const filteredNewsVisits = newsVisits.filter(item => {
                    const visitedDate = new Date(item.visited_at);
                    const datePass = (!start || visitedDate >= start) && (!end || visitedDate <= end);
                    const timePass = (filters.startTime === null && filters.endTime === null) ||
                        ((filters.startTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() >= filters.startTime) &&
                            (filters.endTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() <= filters.endTime));
                    const botPass = !filters.botFilter || item.is_bot === filters.botFilter;
                    const browserPass = !filters.browserFilter || item.browser === filters
                    .browserFilter;
                    const platformPass = !filters.platformFilter || item.platform === filters
                        .platformFilter;
                    const countryPass = !filters.countryFilter || (ipCountryCache.get(item.ip) ||
                        'Unknown') === filters.countryFilter;
                    const durationPass = (parseInt(item.duration_seconds) || 0) >= filters
                        .minDuration && (parseInt(item.duration_seconds) || 0) <= filters.maxDuration;
                    return datePass && timePass && botPass && browserPass && platformPass &&
                        countryPass && durationPass;
                });

                const filteredPageVisits = pageVisits.filter(item => {
                    const visitedDate = new Date(item.visited_at);
                    const datePass = (!start || visitedDate >= start) && (!end || visitedDate <= end);
                    const timePass = (filters.startTime === null && filters.endTime === null) ||
                        ((filters.startTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() >= filters.startTime) &&
                            (filters.endTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() <= filters.endTime));
                    const botPass = !filters.botFilter || item.is_bot === filters.botFilter;
                    const urlPass = !filters.urlFilter || item.url === filters.urlFilter;
                    const browserPass = !filters.browserFilter || item.browser === filters
                    .browserFilter;
                    const platformPass = !filters.platformFilter || item.platform === filters
                        .platformFilter;
                    const countryPass = !filters.countryFilter || (ipCountryCache.get(item.ip) ||
                        'Unknown') === filters.countryFilter;
                    const durationPass = (parseInt(item.duration) || 0) >= filters.minDuration && (
                        parseInt(item.duration) || 0) <= filters.maxDuration;
                    return datePass && timePass && botPass && urlPass && browserPass && platformPass &&
                        countryPass && durationPass;
                });

                const allFilteredVisits = [...filteredNewsVisits.map(v => ({
                        ...v,
                        country: ipCountryCache.get(v.ip) || 'Unknown'
                    })),
                    ...filteredPageVisits.map(v => ({
                        ...v,
                        country: ipCountryCache.get(v.ip) || 'Unknown'
                    }))
                ];

                const getDateString = date => new Date(date).toISOString().split('T')[0];

                // Unique Visitors per Day
                const uniqueVisitorsPerDay = {};
                allFilteredVisits.forEach(v => {
                    const date = getDateString(v.visited_at);
                    uniqueVisitorsPerDay[date] = new Set([...(uniqueVisitorsPerDay[date] || []), v.ip]);
                });
                const uniqueVisitorsData = Object.entries(uniqueVisitorsPerDay).map(([date, ips]) => ({
                    date,
                    count: ips.size
                })).sort((a, b) => new Date(a.date) - new Date(b.date));
                charts.uniqueVisitorsPerDay.data = {
                    labels: uniqueVisitorsData.map(d => d.date),
                    datasets: [{
                        label: 'Pengunjung Unik',
                        data: uniqueVisitorsData.map(d => d.count),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                };
                charts.uniqueVisitorsPerDay.options = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                };
                charts.uniqueVisitorsPerDay.update();

                // Platform Distribution
                const platformCounts = {};
                allFilteredVisits.forEach(v => {
                    const platform = v.platform || 'Unknown';
                    platformCounts[platform] = (platformCounts[platform] || 0) + 1;
                });
                charts.platformDistribution.data = {
                    labels: Object.keys(platformCounts),
                    datasets: [{
                        data: Object.values(platformCounts),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                    }]
                };
                charts.platformDistribution.options = {
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                };
                charts.platformDistribution.update();

                // Browser Distribution
                const browserCounts = {};
                allFilteredVisits.forEach(v => {
                    const browser = v.browser || 'Unknown';
                    browserCounts[browser] = (browserCounts[browser] || 0) + 1;
                });
                charts.browserDistribution.data = {
                    labels: Object.keys(browserCounts),
                    datasets: [{
                        data: Object.values(browserCounts),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                    }]
                };
                charts.browserDistribution.options = {
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                };
                charts.browserDistribution.update();

                // Bot vs Human
                const botVsHumanCounts = {
                    Human: allFilteredVisits.filter(v => v.is_bot === 'No').length,
                    Bot: allFilteredVisits.filter(v => v.is_bot === 'Yes').length
                };
                charts.botVsHuman.data = {
                    labels: ['Human', 'Bot'],
                    datasets: [{
                        data: [botVsHumanCounts.Human, botVsHumanCounts.Bot],
                        backgroundColor: ['#36A2EB', '#FF6384']
                    }]
                };
                charts.botVsHuman.options = {
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                };
                charts.botVsHuman.update();

                // Top URLs
                const urlCounts = {};
                filteredPageVisits.forEach(p => {
                    urlCounts[p.url] = (urlCounts[p.url] || 0) + 1;
                });
                const topUrls = Object.entries(urlCounts).sort((a, b) => b[1] - a[1]).slice(0, 10);
                charts.topUrls.data = {
                    labels: topUrls.map(([url]) => url),
                    datasets: [{
                        label: 'Kunjungan',
                        data: topUrls.map(([, count]) => count),
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                };
                charts.topUrls.options = {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                };
                charts.topUrls.update();

                // Total Visits per Day
                const totalVisitsPerDay = {};
                allFilteredVisits.forEach(v => {
                    const date = getDateString(v.visited_at);
                    totalVisitsPerDay[date] = (totalVisitsPerDay[date] || 0) + 1;
                });
                const totalVisitsData = Object.entries(totalVisitsPerDay).map(([date, count]) => ({
                    date,
                    count
                })).sort((a, b) => new Date(a.date) - new Date(b.date));
                charts.totalVisitsPerDay.data = {
                    labels: totalVisitsData.map(d => d.date),
                    datasets: [{
                        label: 'Total Kunjungan',
                        data: totalVisitsData.map(d => d.count),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true
                    }]
                };
                charts.totalVisitsPerDay.options = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                };
                charts.totalVisitsPerDay.update();

                // Visits per Hour
                const visitsPerHour = Array(24).fill(0);
                allFilteredVisits.forEach(v => {
                    visitsPerHour[new Date(v.visited_at).getHours()]++;
                });
                charts.visitsPerHour.data = {
                    labels: Array.from({
                        length: 24
                    }, (_, i) => `${i}:00`),
                    datasets: [{
                        label: 'Kunjungan',
                        data: visitsPerHour,
                        backgroundColor: 'rgba(153, 102, 255, 0.5)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                };
                charts.visitsPerHour.options = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                };
                charts.visitsPerHour.update();

                // Referer Distribution
                const refererCounts = {};
                allFilteredVisits.forEach(v => {
                    const referer = v.referer || 'Unknown';
                    refererCounts[referer] = (refererCounts[referer] || 0) + 1;
                });
                charts.refererDistribution.data = {
                    labels: Object.keys(refererCounts),
                    datasets: [{
                        data: Object.values(refererCounts),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
                    }]
                };
                charts.refererDistribution.options = {
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                };
                charts.refererDistribution.update();

                // Country Distribution
                const countryCounts = {};
                allFilteredVisits.forEach(v => {
                    const country = v.country || 'Unknown';
                    countryCounts[country] = (countryCounts[country] || 0) + 1;
                });
                charts.countryDistribution.data = {
                    labels: Object.keys(countryCounts),
                    datasets: [{
                        data: Object.values(countryCounts),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                            '#FF9F40'
                        ]
                    }]
                };
                charts.countryDistribution.options = {
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    }
                };
                charts.countryDistribution.update();

                // All Visitors per Day
                const allVisitorsPerDay = {};
                allFilteredVisits.forEach(v => {
                    const date = getDateString(v.visited_at);
                    allVisitorsPerDay[date] = (allVisitorsPerDay[date] || 0) + 1;
                });
                const allVisitorsData = Object.entries(allVisitorsPerDay).map(([date, count]) => ({
                    date,
                    count
                })).sort((a, b) => new Date(a.date) - new Date(b.date));
                charts.allVisitorsPerDayChart.data = {
                    labels: allVisitorsData.map(d => d.date),
                    datasets: [{
                        label: 'Semua Pengunjung',
                        data: allVisitorsData.map(d => d.count),
                        backgroundColor: 'rgba(255, 159, 64, 0.5)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                };
                charts.allVisitorsPerDayChart.options = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Semua Pengunjung per Hari'
                        }
                    }
                };
                charts.allVisitorsPerDayChart.update();
            }

            function updateStatistics() {
                const filters = {
                    startDate: document.getElementById('mergeStartDate').value,
                    endDate: document.getElementById('mergeEndDate').value,
                    startTime: parseTime(document.getElementById('mergeStartTime').value),
                    endTime: parseTime(document.getElementById('mergeEndTime').value),
                    botFilter: document.getElementById('mergeBotOrHumanFilter').value,
                    urlFilter: document.getElementById('mergeUrlFilter').value,
                    browserFilter: document.getElementById('mergeBrowserFilter').value,
                    platformFilter: document.getElementById('mergePlatformFilter').value,
                    countryFilter: document.getElementById('mergeCountryFilter').value,
                    minDuration: parseInt(document.getElementById('mergeMinDuration').value) || 0,
                    maxDuration: parseInt(document.getElementById('mergeMaxDuration').value) || Infinity
                };

                const start = filters.startDate ? new Date(filters.startDate) : null;
                const end = filters.endDate ? new Date(filters.endDate) : null;

                const filteredNewsVisits = newsVisits.filter(item => {
                    const visitedDate = new Date(item.visited_at);
                    const datePass = (!start || visitedDate >= start) && (!end || visitedDate <= end);
                    const timePass = (filters.startTime === null && filters.endTime === null) ||
                        ((filters.startTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() >= filters.startTime) &&
                            (filters.endTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() <= filters.endTime));
                    const botPass = !filters.botFilter || item.is_bot === filters.botFilter;
                    const browserPass = !filters.browserFilter || item.browser === filters
                    .browserFilter;
                    const platformPass = !filters.platformFilter || item.platform === filters
                        .platformFilter;
                    const countryPass = !filters.countryFilter || (ipCountryCache.get(item.ip) ||
                        'Unknown') === filters.countryFilter;
                    const durationPass = (parseInt(item.duration_seconds) || 0) >= filters
                        .minDuration && (parseInt(item.duration_seconds) || 0) <= filters.maxDuration;
                    return datePass && timePass && botPass && browserPass && platformPass &&
                        countryPass && durationPass;
                });

                const filteredPageVisits = pageVisits.filter(item => {
                    const visitedDate = new Date(item.visited_at);
                    const datePass = (!start || visitedDate >= start) && (!end || visitedDate <= end);
                    const timePass = (filters.startTime === null && filters.endTime === null) ||
                        ((filters.startTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() >= filters.startTime) &&
                            (filters.endTime === null || visitedDate.getHours() * 60 + visitedDate
                                .getMinutes() <= filters.endTime));
                    const botPass = !filters.botFilter || item.is_bot === filters.botFilter;
                    const urlPass = !filters.urlFilter || item.url === filters.urlFilter;
                    const browserPass = !filters.browserFilter || item.browser === filters
                    .browserFilter;
                    const platformPass = !filters.platformFilter || item.platform === filters
                        .platformFilter;
                    const countryPass = !filters.countryFilter || (ipCountryCache.get(item.ip) ||
                        'Unknown') === filters.countryFilter;
                    const durationPass = (parseInt(item.duration) || 0) >= filters.minDuration && (
                        parseInt(item.duration) || 0) <= filters.maxDuration;
                    return datePass && timePass && botPass && urlPass && browserPass && platformPass &&
                        countryPass && durationPass;
                });

                const totalVisits = filteredNewsVisits.length + filteredPageVisits.length;
                const uniqueIPs = new Set([...filteredNewsVisits.map(n => n.ip), ...filteredPageVisits.map(p =>
                    p.ip)]).size;
                const uniqueURLs = new Set(filteredPageVisits.map(p => p.url)).size;
                const humanVsBot = {
                    human: [...filteredNewsVisits, ...filteredPageVisits].filter(v => v.is_bot === 'No')
                        .length,
                    bot: [...filteredNewsVisits, ...filteredPageVisits].filter(v => v.is_bot === 'Yes')
                        .length
                };
                const avgVisitsPerIP = uniqueIPs > 0 ? (totalVisits / uniqueIPs).toFixed(2) : 0;
                const uniqueDays = new Set([...filteredNewsVisits, ...filteredPageVisits].map(v => new Date(v
                    .visited_at).toDateString())).size;
                const avgVisitsPerDay = uniqueDays > 0 ? (totalVisits / uniqueDays).toFixed(2) : 0;

                const ipVisitCounts = {};
                [...filteredNewsVisits, ...filteredPageVisits].forEach(v => {
                    ipVisitCounts[v.ip] = (ipVisitCounts[v.ip] || 0) + 1;
                });
                const topIPs = Object.entries(ipVisitCounts).sort((a, b) => b[1] - a[1]).slice(0, 5).map(([ip,
                    count
                ]) => ({
                    ip,
                    count
                }));

                const urlVisitCounts = {};
                filteredPageVisits.forEach(p => {
                    urlVisitCounts[p.url] = (urlVisitCounts[p.url] || 0) + 1;
                });
                const topURLs = Object.entries(urlVisitCounts).sort((a, b) => b[1] - a[1]).slice(0, 5).map(([
                    url, count
                ]) => ({
                    url,
                    count
                }));

                document.getElementById('global-stats').innerHTML = `
            <li class="list-group-item d-flex justify-content-between">
                <span>Total Kunjungan:</span><strong>${totalVisits}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total IP Unik:</span><strong>${uniqueIPs}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Total URL Unik:</span><strong>${uniqueURLs}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Human vs Bot:</span>
                <div>
                    <div class="d-flex justify-content-between"><div><strong>Human: </strong></div><div class="ms-3">${humanVsBot.human}</div></div>
                    <div class="d-flex justify-content-between"><div><strong>Bot: </strong></div><div class="ms-3">${humanVsBot.bot}</div></div>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Rata-rata Kunjungan per IP:</span><strong>${Math.floor(avgVisitsPerIP)} visit</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Rata-rata Kunjungan per Hari:</span><strong>${Math.floor(avgVisitsPerDay)} visit</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>IP dengan Kunjungan Terbanyak:</span>
                <div>
                    <table class="table table-bordered">
                        <thead><tr><th>Ip</th><th>Visits</th></tr></thead>
                        <tbody>${topIPs.length ? topIPs.map(ip => `<tr><td>${ip.ip}</td><td>${ip.count}</td></tr>`).join('') : '<tr><td>-</td><td>-</td></tr>'}</tbody>
                    </table>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>URL Terpopuler:</span>
                <div>
                    <table class="table table-bordered">
                        <thead><tr><th>Page</th><th>Visits</th></tr></thead>
                        <tbody>${topURLs.length ? topURLs.map(url => `<tr><td>${url.url}</td><td>${url.count}</td></tr>`).join('') : '<tr><td>-</td><td>-</td></tr>'}</tbody>
                    </table>
                </div>
            </li>`;
            }

            combinedTable = $('#combined-table').DataTable({
                data: combinedData,
                columns: [{
                        data: 'ip'
                    },
                    {
                        data: 'visitedAtAccordion',
                        orderable: false,
                        render: data => data
                    },
                    {
                        data: 'newsVisited'
                    },
                    {
                        data: 'pageVisited'
                    },
                    {
                        data: 'newsDuration'
                    },
                    {
                        data: 'pageDuration'
                    },
                    {
                        data: 'is_bot',
                        render: data => data === 'Yes' ?
                            '<span class="badge bg-danger">Bot</span>' :
                            '<span class="badge bg-success">Human</span>'
                    },
                    {
                        data: 'browser'
                    },
                    {
                        data: 'platform'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            const urlAccordionId = `url-accordion-${meta.row}`;
                            const collapseId = `collapse-urls-${meta.row}`;
                            if (!data.urls.length) return '-';
                            const listItems = data.urls.map(url =>
                                `<li class="list-group-item">${url}</li>`).join('');
                            return `
                    <div class="accordion" id="${urlAccordionId}">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#${collapseId}">
                                    ${data.urls.length} visited URL(s)
                                </button>
                            </h2>
                            <div id="${collapseId}" class="accordion-collapse collapse" data-bs-parent="#${urlAccordionId}">
                                <div class="accordion-body p-0">
                                    <ul class="list-group list-group-flush">${listItems}</ul>
                                </div>
                            </div>
                        </div>
                    </div>`;
                        }
                    }
                ]
            });

            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                const filters = {
                    startDate: document.getElementById('mergeStartDate').value,
                    endDate: document.getElementById('mergeEndDate').value,
                    startTime: parseTime(document.getElementById('mergeStartTime').value),
                    endTime: parseTime(document.getElementById('mergeEndTime').value),
                    countryFilter: document.getElementById('mergeCountryFilter').value,
                    minDuration: parseInt(document.getElementById('mergeMinDuration').value) || 0,
                    maxDuration: parseInt(document.getElementById('mergeMaxDuration').value) ||
                        Infinity
                };

                const rowData = combinedData[dataIndex];
                const durationPass = (parseInt(rowData.newsDuration) || 0) >= filters.minDuration && (
                        parseInt(rowData.newsDuration) || 0) <= filters.maxDuration ||
                    (parseInt(rowData.pageDuration) || 0) >= filters.minDuration && (parseInt(rowData
                        .pageDuration) || 0) <= filters.maxDuration;

                const hasDateTimeInRange = rowData.allVisitedAt.some(date => {
                    const visitedDate = new Date(date);
                    const datePass = (!filters.startDate || visitedDate >= new Date(filters
                        .startDate)) && (!filters.endDate || visitedDate <= new Date(filters
                        .endDate));
                    const timePass = (filters.startTime === null && filters.endTime === null) ||
                        ((filters.startTime === null || visitedDate.getHours() * 60 +
                                visitedDate.getMinutes() >= filters.startTime) &&
                            (filters.endTime === null || visitedDate.getHours() * 60 +
                                visitedDate.getMinutes() <= filters.endTime));
                    const countryPass = !filters.countryFilter || rowData.country === filters
                        .countryFilter;
                    return datePass && timePass && countryPass;
                });

                return hasDateTimeInRange && durationPass;
            });

            ['mergeStartDate', 'mergeEndDate', 'mergeStartTime', 'mergeEndTime', 'mergeCountryFilter'].forEach(
                id => {
                    document.getElementById(id).addEventListener('change', () => combinedTable.draw());
                });

            document.getElementById('mergeBotOrHumanFilter').addEventListener('change', function() {
                const value = this.value;
                combinedTable.column(6).search(value === 'Yes' ? 'Bot' : value === 'No' ? 'Human' : '')
                    .draw();
            });

            document.getElementById('mergeUrlFilter').addEventListener('change', function() {
                const value = this.value;
                $.fn.dataTable.ext.search.push((settings, data, dataIndex) => !value || combinedData[
                    dataIndex].urls.includes(value));
                combinedTable.draw();
                $.fn.dataTable.ext.search.pop();
            });

            ['mergeBrowserFilter', 'mergePlatformFilter', 'mergeCountryFilter'].forEach((id, index) => {
                document.getElementById(id).addEventListener('change', () => combinedTable.column(7 +
                    index).search(document.getElementById(id).value).draw());
            });

            combinedTable.on('draw', () => {
                updateCharts();
                updateStatistics();
            });

            ['mergeStartDate', 'mergeEndDate'].forEach(id => {
                flatpickr(`#${id}`, {
                    dateFormat: 'Y-m-d',
                    onChange: () => combinedTable.draw()
                });
            });

            ['mergeStartTime', 'mergeEndTime'].forEach(id => {
                flatpickr(`#${id}`, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: 'H:i',
                    time_24hr: true,
                    onChange: () => combinedTable.draw()
                });
            });

            const debouncedTableDraw = (func, wait) => {
                let timeout;
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func(...args), wait);
                };
            };

            durationSlider.noUiSlider.on('update', function(values) {
                document.getElementById('durationMinLabel').textContent = values[0] + 's';
                document.getElementById('durationMaxLabel').textContent = values[1] + 's';
                document.getElementById('mergeMinDuration').value = values[0];
                document.getElementById('mergeMaxDuration').value = values[1];
                debouncedTableDraw(() => combinedTable.draw(), 1500)();
            });

            function exportFilteredTableToExcel(tableId, filename) {
                return new Promise(resolve => {
                    const table = $(`#${tableId}`).DataTable();
                    const filteredIndexes = table.rows({
                        search: 'applied'
                    }).indexes();
                    const headers = $(`#${tableId} thead th`).map((_, el) => $(el).text().trim()).get();
                    const exportData = [headers];

                    filteredIndexes.each(function(rowIdx) {
                        const rowData = headers.map((colName, colIdx) => {
                            let data = table.cell(rowIdx, colIdx).data();
                            if (colName.toLowerCase().includes('bot')) return data
                                ?.toLowerCase() === 'yes' ? 'bot' : 'human';
                            if (colName.toLowerCase().includes('duration'))
                            return data ? `${data}s` : '1s';
                            return typeof data === 'string' ? data.replace(/<[^>]+>/g,
                                '') : data;
                        });
                        exportData.push(rowData);
                    });

                    const worksheet = XLSX.utils.aoa_to_sheet(exportData);
                    const workbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
                    XLSX.writeFile(workbook, `${filename}.xlsx`);
                    resolve();
                });
            }

            function setupExportButton(buttonId, tableId, fileName) {
                document.getElementById(buttonId).addEventListener('click', async function() {
                    const btn = this;
                    const spinner = btn.querySelector('#spinner-btn');
                    const label = btn.querySelector('.btn-label') || btn.lastChild;
                    const originalText = label.textContent.trim() || 'Export Excel';

                    try {
                        btn.classList.add('disabled');
                        spinner.classList.remove('d-none');
                        label.textContent = 'Exporting...';
                        await new Promise(resolve => setTimeout(resolve, 50));
                        await exportFilteredTableToExcel(tableId, fileName);
                    } catch (error) {
                        console.error(`Error during export for ${tableId}:`, error);
                    } finally {
                        btn.classList.remove('disabled');
                        spinner.classList.add('d-none');
                        label.textContent = originalText;
                    }
                });
            }

            setupExportButton('exportNewsVisit', 'table-news-visit', 'news-visit-export');
            setupExportButton('exportPageVisit', 'table-page-visit', 'page-visit-export');
            setupExportButton('exportPageXNews', 'combined-table', 'page-x-news-export');

            updateNewsStats();
            updateUniqueVisitorsChart();
            updatePlatformPieChart();
            const firstloadfilteredData = pageTable.rows({
                search: 'applied'
            }).data().toArray();
            updatePageVisitStats(firstloadfilteredData);
            updatePageVisitChart(firstloadfilteredData);
        });
    </script>
@endsection
