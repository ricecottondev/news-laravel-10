@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">DASHBOARD
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Dashboards</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3 d-none">
                    <a href="#" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary"
                        data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a>
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">Add Target</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                {{-- coba struktur baru --}}
                {{--  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-5 mb-xl-10 g-3 g-md-4 g-xl-10"> --}}
                <div class="row mb-5 mb-xl-10 g-3 g-md-4 g-xl-10">

                    <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                        <div
                            class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">

                            <div class="card-header pt-5">
                                <h3 class="card-title text-gray-800 fw-bold">Links</h3>
                                <div class="card-toolbar">
                                    <button
                                        class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                        data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1 text-gray-300 me-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px d-none"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick Actions</div>
                                        </div>
                                        <div class="separator mb-3 opacity-75"></div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Ticket</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Customer</a>
                                        </div>
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="right-start">
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">New Group</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Admin Group</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Staff Group</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Member Group</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">New Contact</a>
                                        </div>
                                        <div class="separator mt-3 opacity-75"></div>
                                        <div class="menu-item px-3">
                                            <div class="menu-content px-3 py-3">
                                                <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-5">
                                <div class="d-flex flex-stack">
                                    <a href="back/users" class="text-primary fw-semibold fs-6 me-2" target="_blank">User</a>
                                    <button type="button"
                                        class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <i class="ki-duotone ki-exit-right-corner fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <a href="onepoint_uniquecode" class="text-primary fw-semibold fs-6 me-2"
                                        target="_blank">Subscribes</a>
                                    <button type="button"
                                        class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <i class="ki-duotone ki-exit-right-corner fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <a href="news" class="text-primary fw-semibold fs-6 me-2" target="_blank">News</a>
                                    <button type="button"
                                        class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <i class="ki-duotone ki-exit-right-corner fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-6 mt-5">
                        <div
                            class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <h2 class="mb-4">Top Visited News</h2>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Visit Count</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topNews as $index => $item)
                                            <tr>
                                                <td>{{ $topNews->firstItem() + $index }}</td>
                                                <td>{{ $newsDetails[$item->news_id]->title ?? 'Unknown' }}</td>
                                                <td>{{ $item->visit_count }}</td>
                                                <td>
                                                    <a href="{{ route('front.news.show', $newsDetails[$item->news_id]->slug ?? '#') }}"
                                                        target="_blank" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No data available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $topNews->links() !!}
                                </div>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>

                    <div class="col-6 mt-5">
                        <div
                            class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <h2 class="mb-4">Top Visited News (Platform ≠ 0)</h2>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Visit Count</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($filteredTopNews as $index => $item)
                                            <tr>
                                                <td>{{ $filteredTopNews->firstItem() + $index }}</td>
                                                <td>{{ $newsDetailsFiltered[$item->news_id]->title ?? 'Unknown' }}</td>
                                                <td>{{ $item->visit_count }}</td>
                                                <td>
                                                    <a href="{{ route('front.news.show', $newsDetailsFiltered[$item->news_id]->slug ?? '#') }}"
                                                        target="_blank" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No data available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $filteredTopNews->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 mt-5">
                        <div
                            class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <h2 class="mb-4">Top Duration News (Platform ≠ 0)</h2>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>News Title</th>
                                            <th>Total Visits</th>
                                            <th>Total Duration (s)</th>
                                            <th>Average Duration (s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($filteredDurationNews as $index => $item)
                                            <tr>
                                                <td>{{ $filteredDurationNews->firstItem() + $index }}</td>
                                                <td>{{ $newsDetailsFiltered[$item->news_id]->title ?? 'Unknown' }}</td>
                                                <td>{{ $item->visit_count }}</td>
                                                <td>{{ $item->total_duration }}</td>
                                                <td>{{ number_format($item->avg_duration, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No data available.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $filteredDurationNews->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mt-5">
                        <div class="card card-flush">
                            <div class="card-header">
                                <h3 class="card-title">Page Visit Count</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Page</th>
                                            <th>Total Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pageViews as $item)
                                            <tr>
                                                <td>{{ $item->url }}</td>
                                                <td>{{ $item->total_visits }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mt-5">
                        <div class="card card-flush">
                            <div class="card-header">
                                <h3 class="card-title">Page Duration Stats</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Page</th>
                                            <th>Total Visits</th>
                                            <th>Total Duration (s)</th>
                                            <th>Average Duration (s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pageDurations as $item)
                                            <tr>
                                                <td>{{ $item->url }}</td>
                                                <td>{{ $item->visits }}</td>
                                                <td>{{ $item->total_duration }}</td>
                                                <td>{{ number_format($item->avg_duration, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mt-5">
                        <div class="card card-flush">
                            <div class="card-header">
                                <h3 class="card-title">Visitor Duration by IP</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>IP Address</th>
                                            <th>Total Visits</th>
                                            <th>Total Duration (s)</th>
                                            <th>Avg Duration (s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ipDurations as $item)
                                            <tr>
                                                <td>{{ $item->ip }}</td>
                                                <td>{{ $item->visits }}</td>
                                                <td>{{ $item->total_duration }}</td>
                                                <td>{{ number_format($item->avg_duration, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 mt-5">
                        <div
                            class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <h2 class="mb-4">Platform Usage (Visits)</h2>

                                <div class="card p-4">
                                    <canvas id="platformChart" width="400" height="400"></canvas>
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    const ctx = document.getElementById('platformChart').getContext('2d');
                                    const platformChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: {!! json_encode($platforms) !!},
                                            datasets: [{
                                                data: {!! json_encode($counts) !!},
                                                backgroundColor: [
                                                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                legend: {
                                                    position: 'right'
                                                },
                                                title: {
                                                    display: true,
                                                    text: 'Visitor Platforms'
                                                }
                                            }
                                        }
                                    });
                                </script>

                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endsection
