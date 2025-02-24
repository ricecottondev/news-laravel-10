@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">


        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                VOUCHER LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">VOUCHER</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <div class="m-0">
                                <a href="#"
                                    class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter</a>
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_641ac41e77927">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Status:</label>
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                    data-placeholder="Select option"
                                                    data-dropdown-parent="#kt_menu_641ac41e77927" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Member Type:</label>
                                            <div class="d-flex">
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Notifications:</label>
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_Onepoint_voucher">
                                <i class="ki-duotone ki-plus "></i>Add VOUCHER</button>
                        </div>
                    </div>
                </div>

                @include('back.Onepoint_voucher.modal_add')

                @foreach ($data as $key => $onepoint_voucher)
                    @foreach ($onepoint_voucher->vouchers as $key => $voucher)
                        @include('back.Onepoint_voucher.modal_edit')
                    @endforeach
                @endforeach

                @foreach ($data as $key => $onepoint_voucher)
                    @foreach ($onepoint_voucher->vouchers as $key => $voucher)
                        @include('back.Onepoint_voucher.modal_show')
                    @endforeach
                @endforeach

                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="datatable-buttons"
                                        class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="min-w-50px sorting">NO</th>
                                                <th class="min-w-125px sorting">Kode Voucher</th>

                                                <th class="min-w-125px sorting">Label</th>
                                                <th class="min-w-125px sorting">Short Desc</th>
                                                <th class="min-w-125px sorting">Status</th>
                                                <th class="min-w-125px sorting">Deleted</th>
                                                <th class="min-w-125px sorting">TYPE FLAG</th>
                                                <th class="min-w-125px sorting">Action</th>

                                            </tr>
                                        </thead>
                                        @foreach ($data as $key => $onepoint_voucher)
                                            <tbody>
                                                <tr>
                                                    <td colspan="7">
                                                        <h3>{{ strtoupper($onepoint_voucher->merchant_name) }} <span
                                                                class="badge text-light rounded-pill"
                                                                style="left: 75%; font-size: .875em; background-color: #fd00fd;">{{ count($onepoint_voucher->vouchers) }}
                                                                Vouchers</span></h3>
                                                    </td>
                                                </tr>
                                                @if (count($onepoint_voucher->vouchers) > 0)
                                                    @foreach ($onepoint_voucher->vouchers as $key => $voucher)
                                                        <tr>
                                                            <td style="color:rgba(80, 74, 74, 0.333)"
                                                                class=" align-items-center text-center">
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td>{{ Str::limit($voucher->kode_voucher, 25) }}
                                                                <span class="badge text-light rounded-pill"
                                                                    style="left: 75%; font-size: .875em; background-color: #fd4f00;">{{ $voucher->qtyvoucher }}</span>
                                                                <span class="badge text-light rounded-pill"
                                                                    style="left: 75%; font-size: .875em; background-color: #00fd87;">{{ $voucher->claimed }}</span>

                                                            </td>

                                                            <td>{{ Str::limit($voucher->label, 25) }}
                                                            </td>
                                                            <td>{{ Str::limit($voucher->short_desc, 25) }}
                                                            </td>

                                                            <td>{{ Str::limit($voucher->status, 25) }}
                                                            </td>
                                                            <td>{{ Str::limit($voucher->deleted, 25) }}
                                                            </td>
                                                            <td>{{ Str::limit($voucher->type_flag, 25) }}
                                                            </td>
                                                            <td>
                                                                <a href="#"
                                                                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end">Actions
                                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                                    data-kt-menu="true">

                                                                    <div class="menu-item px-3">
                                                                        <a class="menu-link px-3" data-bs-toggle="modal"
                                                                            data-bs-target="#kt_modal_show_onepoint_voucher{{ $voucher->id }}">Show</a>
                                                                    </div>

                                                                    <div class="menu-item px-3">
                                                                        <a class="menu-link px-3" data-bs-toggle="modal"
                                                                            data-bs-target="#kt_modal_edit_onepoint_voucher{{ $voucher->id }}">Edit</a>
                                                                    </div>

                                                                    <div class="menu-item px-3">
                                                                        {!! Form::open([
                                                                            'id' => 'form-id_' . $voucher->id,
                                                                            'method' => 'DELETE',
                                                                            'route' => ['onepoint_voucher.destroy', $voucher->id],
                                                                            'style' => 'display:inline',
                                                                        ]) !!}
                                                                        <a href="#"
                                                                            class="menu-link px-3 delete-link"
                                                                            data-voucher-id="{{ $voucher->id }}">Delete</a>
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="8"> Tidak ada Vouchers</td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        @endforeach
                                    </table>




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add a click event listener to the delete link
                document.querySelectorAll('.delete-link').forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();

                        // Show SweetAlert confirmation
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You won\'t be able to revert this!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            // If the user clicks "Yes," submit the form
                            if (result.isConfirmed) {
                                var formId = 'form-id_' + link.dataset.voucherId;
                                document.getElementById(formId).submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
