@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                {{-- header-start --}}
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Subscribe List</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Transaction</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Subscribe</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a href="{{ route('subscribe.create') }}" class="btn btn-sm btn-primary"><i
                                    class="ki-duotone ki-plus "></i>Add Transaction Subscribe</a>
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

                {{-- body-start --}}
                {{-- <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Products-->
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" data-kt-ecommerce-order-filter="search"
                                            class="form-control form-control-solid w-250px ps-12"
                                            placeholder="Search Order" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                            </div>
                            <div class="card-body pt-0"> --}}

                                {{-- <a href="{{ route('subscribe.create') }}" class="btn btn-primary mb-3">Add Subscription</a> --}}

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Plan</th>
                                            <th>Status</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribes as $subscribe)
                                            <tr>
                                                <td>{{ $subscribe->user->name }}</td>
                                                <td>{{ $subscribe->plan }}</td>
                                                <td>{{ ucfirst($subscribe->status) }}</td>
                                                <td>{{ $subscribe->start_date }}</td>
                                                <td>{{ $subscribe->end_date }}</td>
                                                <td>
                                                    <a href="{{ route('subscribe.edit', $subscribe->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('subscribe.destroy', $subscribe->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check the number of columns in thead
            const theadColumns = document.querySelectorAll("#kt_ecommerce_sales_table thead th").length;
            console.log("Column count in thead:", theadColumns);

            // Check the number of columns in each tbody row
            document.querySelectorAll("#kt_ecommerce_sales_table tbody tr").forEach((row, index) => {
                const tdCount = row.querySelectorAll("td").length;
                console.log(`Row ${index + 1} column count in tbody:`, tdCount);
                if (tdCount !== theadColumns) {
                    console.error(
                        `Mismatch found in Row ${index + 1}: Expected ${theadColumns}, found ${tdCount}`
                    );
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#kt_ecommerce_sales_table').DataTable(); // Basic initialization
        });
    </script>
@endsection
