@extends('back/layouts.layout')
@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">DASHBOARD</h1>
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
                    <a href="#" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a>
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Add Target</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                {{-- coba struktur baru --}}
                {{--  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 mb-5 mb-xl-10 g-3 g-md-4 g-xl-10"> --}}
                <div class="row mb-5 mb-xl-10 g-3 g-md-4 g-xl-10">

                    <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">

                            <div class="card-header pt-5">
                                <h3 class="card-title text-gray-800 fw-bold">Links</h3>
                                <div class="card-toolbar">
                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                        <i class="ki-duotone ki-dots-square fs-1 text-gray-300 me-n1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px d-none" data-kt-menu="true">
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
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
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
                                    <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <i class="ki-duotone ki-exit-right-corner fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <a href="onepoint_uniquecode" class="text-primary fw-semibold fs-6 me-2" target="_blank">Subscribes</a>
                                    <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <i class="ki-duotone ki-exit-right-corner fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                                <div class="separator separator-dashed my-3"></div>
                                <div class="d-flex flex-stack">
                                    <a href="news" class="text-primary fw-semibold fs-6 me-2" target="_blank">News</a>
                                    <button type="button" class="btn btn-icon btn-sm h-auto btn-color-gray-400 btn-active-color-primary justify-content-end">
                                        <i class="ki-duotone ki-exit-right-corner fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-none">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <h5 class="card-title">card title</h5>
                                <p class="card-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel
                                </p>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-none">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10" style="background-color: #F1416C;background-image:url('{{url('template')}}/assets/media/patterns/vector-1.png')">
                            <div class="card-header pt-5">
                                <div class="card-title d-flex flex-column">
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">69</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Active Projects</span>
                                </div>
                            </div>
                            <div class="card-body d-flex align-items-end pt-0">
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                                        <span>43 Pending</span>
                                        <span>72%</span>
                                    </div>
                                    <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                                        <div class="bg-white rounded h-8px" role="progressbar" style="width: 72%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-none">
                        <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10">
                           <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">69,700</span>
                                    <span class="badge badge-light-success fs-base">
                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>2.2%</span>
                                </div>
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">Projects Earnings in April</span>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                            <div class="d-flex flex-center me-5 pt-2">
                                <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                            </div>
                            <div class="d-flex flex-column content-justify-center flex-row-fluid">
                                <div class="d-flex fw-semibold align-items-center">
                                    <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                                    <div class="text-gray-500 flex-grow-1 me-4">Leaf CRM</div>
                                    <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                                </div>
                                <div class="d-flex fw-semibold align-items-center my-3">
                                    <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                                    <div class="text-gray-500 flex-grow-1 me-4">Mivy App</div>
                                    <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                                </div>
                                <div class="d-flex fw-semibold align-items-center">
                                    <div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                                    <div class="text-gray-500 flex-grow-1 me-4">Others</div>
                                    <div class="fw-bolder text-gray-700 text-xxl-end">$45,257</div>
                                </div>
                            </div>
                        </div>
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
