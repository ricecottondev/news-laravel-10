@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                MEMBER LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">MEMBER</li>
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
                           
                                <a class="btn btn-sm btn-primary" href="{{ route('onepoint_member.create')}}">Create Member</a>
                                <a class="btn btn-sm btn-danger" href="{{ route('generate.qr.all')}}" onclick="return confirm('Apakah Anda yakin ingin generate QR Semua Member Yang Kosong Uniquecode?')">Generate All Qr Code</a>
                        </div>
                    </div>
                </div>



                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            

                {{-- @include('back.Onepoint_member.modal_add')

                @foreach ($data as $key => $onepoint_member)
                    @include('back.Onepoint_member.modal_edit')
                @endforeach

                @foreach ($data as $key => $onepoint_member)
                    @include('back.Onepoint_member.modal_show')
                @endforeach --}}



                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="member-table"
                                        class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="min-w-50px sorting">NO</th>
                                                <th class="min-w-125px sorting">Action</th>
                                                <th class="min-w-125px sorting">Email</th>
                                                <th class="min-w-125px sorting">Status</th>
                                                <th class="min-w-125px sorting">Deleted</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#member-table').DataTable({
                ajax: {
                    url: '{{ route('member.table') }}', // Update the URL according to your route
                    type: 'GET',
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            let actionsHtml = `
                                <div class="dropdown">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        ${getMenuItems(row)}
                                    </div>
                                </div>`;
                            return actionsHtml;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'deleted',
                        name: 'deleted'
                    },
                ],
                error: function(xhr, error, thrown) {
                    console.log('Error:', error);
                },
            });
        });

        function getMenuItems(row) {
            let menuHtml = '';
            // Check session role and build menu items accordingly
            var formEdit = "{{ route('onepoint_member.edit', ['onepoint_member' => 'id_member']) }}";
            formEdit = formEdit.replace('id_member', row.id);

                    menuHtml += `
            <div class="menu-item px-3">
                <a class="menu-link px-3" href="{{ url('listlogclaimuniquecodemember') }}/${row.id}">Log Claim Uniquecode</a>
            </div>
            <div class="menu-item px-3">
                <a class="menu-link px-3" href="{{ url('listlogclaimvouchermember') }}/${row.id}">Log Claim Voucher</a>
            </div>`;

            if (!row.uniquecode) {
                menuHtml += `
                <div class="menu-item px-3">
                    <a class="dropdown-item" href="{{ url('generate-qr') }}/${row.id}" onclick="return confirm('Apakah Anda yakin ingin generate QR?')">Generate QR</a>
                </div>`;
            }

            menuHtml += `
            <div class="menu-item px-3">
                <a href="${formEdit}" class="dropdown-item" >Edit</a>
            </div>
            <div class="menu-item px-3">
                <a href="#" class="dropdown-item" onclick="actions(${row.id});">Delete</a>
            </div>`;

            return menuHtml;
        }

        function actions(id) {
            var csrfToken = "{{ csrf_token() }}";
            Swal.fire({
                icon: 'warning',
                title: 'Delete',
                text: 'Are You sure want to delete !',
                showCancelButton: !0,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                reverseButtons: !0
            }).then(function(e) {
                if (e.value === true) {
                    $.ajax({
                        url: "{{ url('') }}/member-delete/" +
                            id, // Update the URL according to your route
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: `${data.message}`,
                                showConfirmButton: true,
                            });
                            window.location.href = "{{ url('onepoint_member') }}";
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function(dismiss) {
                return false;
            });
        }
    </script>
@endpush
