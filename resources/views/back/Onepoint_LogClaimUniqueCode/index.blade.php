@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Log Claim UniqueCode (Point) LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Log Claim UniqueCode (Point)</li>
                            </ul>
                        </div>
                        {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
                          
                            <a class="btn btn-sm btn-primary" href="{{ route('onepoint_list_log_claim_uniquecode.create')}}">Create</a>

                        </div> --}}
                    </div>
                </div>



                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body">


                                <div class="table-responsive">
                                    <table id="user-table"
                                        class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="min-w-50px sorting">NO</th>
                                                <th class="min-w-125px sorting">Member</th>
                                                <th class="min-w-125px sorting">Kode</th>
                                                <th class="min-w-125px sorting">Point</th>
                                                <th class="min-w-125px sorting">Label</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content container-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->

        </div>
        <!--end:::Main-->

    </div>
    <!--end::Content-->

    @push('scripts')
        <script>
            $(document).ready(function() {

                $('#user-table').DataTable({


                    ajax: {
                        url: '{{ route('log-claim-uniquecode.table') }}',
                        type: 'GET',
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        // {
                        //     data: null,
                        //     render: function(data, type, row) {
                        //         let actionsHtml = `
                //             <div class="dropdown">
                //                 <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm dropdown-toggle"
                //                     data-bs-toggle="dropdown" aria-expanded="false">
                //                     Actions <i class="ki-duotone ki-down fs-5 ms-1"></i>
                //                 </a>
                //                 <div class="dropdown-menu">
                //                     ${getMenuItems(row)}
                //                 </div>
                //             </div>`;
                        //         return actionsHtml;
                        //     }

                        // },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                if (row.member.length > 0) {
                                    return row.member[0].email;
                                } else {
                                    return 'tidak ada user';
                                }
                            }
                        },

                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                if (row.uniquecode) {
                                    return row.uniquecode.kode;
                                }
                            }
                        },
                        {
                            data: 'point',
                            name: 'point'
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                if (row.uniquecode && row.uniquecode.label) {
                                    return row.uniquecode.label;
                                }
                            }
                        },
                    ],
                    error: function(xhr, error, thrown) {
                        console.log('Error:', error);
                    },
                });

            });





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
                            url: "{{ url('') }}/user-delete/" +
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
                                    // timer: 3000
                                });
                                window.location.href = "{{ url('onepoint_list_log_claim_uniquecode') }}";
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
@endsection
