@extends('back/layouts.layout')

@section('content')


        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">


                    {{-- header-start --}}
                    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                <h1
                                    class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                    News Visit Dashboard</h1>
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                    <li class="breadcrumb-item text-muted">
                                        <a href="../../demo1/dist/index.html"
                                            class="text-muted text-hover-primary">News</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                    </li>
                                    <li class="breadcrumb-item text-muted">News Visit</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    {{-- header-end --}}

                    {{-- body-start --}}
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-xxl">
                            <!--begin::Products-->
                            <div class="card card-flush">
                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <!--begin::Search-->

                                        <!--end::Search-->
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>News Title</th>
                                                <th>IP Address</th>
                                                <th>Browser</th>
                                                <th>Platform</th>
                                                <th>Referer</th>
                                                <th>Visited At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($visits as $visit)
                                                <tr>
                                                    <td>{{ $loop->iteration + $visits->firstItem() - 1 }}</td>
                                                    <td>
                                                        <a href="{{ route('front.news.show', $visit->news->slug ?? '') }}"
                                                            target="_blank">
                                                            {{ $visit->news->title ?? '-' }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $visit->ip }}</td>
                                                    <td>{{ $visit->browser ?? '-' }}</td>
                                                    <td>{{ $visit->platform ?? '-' }}</td>
                                                    <td>{{ $visit->referer ?? '-' }}</td>
                                                    <td>{{ date('d-m-Y H:i', strtotime($visit->visited_at)) }}</td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">No visit records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-center">
                                        {{ $visits->links() }}
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Products-->
                        </div>
                    </div>
                    {{-- body-end --}}

                </div>
            </div>
        </div>

@endsection
