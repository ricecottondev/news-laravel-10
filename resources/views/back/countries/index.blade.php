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
                                Country List</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Master</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Country</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a href="{{ route('country.create') }}" class="btn btn-sm btn-primary"><i
                                    class="ki-duotone ki-plus "></i>Add Country</a>
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

                                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($countries as $country)
                                            <tr>
                                                <td>{{ $country->id }}</td>
                                                <td>{{ $country->country_name }}</td>
                                                <td>
                                                    <a href="{{ route('country.edit', $country) }}" class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2"><i class="fas fa-edit"></i></a>
                                                    <form action="{{ route('country.destroy', $country) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline btn-outline-dashed btn-outline-default px-4 me-2"
                                                        onclick="return confirm('sure?');"><i class="fas fa-trash-alt"></i</button>
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
