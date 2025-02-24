@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                               Kode MEMBER </h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Kode MEMBER</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                           
{{--                           
                                <a class="btn btn-sm btn-primary" href="{{ route('onepoint_member.create')}}">Create Member</a> --}}
                        </div>
                    </div>
                </div>





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
                                                <th class="min-w-125px sorting">Kode</th>
                                                <th class="min-w-125px sorting">Status</th>
                                                <th class="min-w-125px sorting">Member</th>
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
                    url: '{{ route('uniquecode.member.table') }}', // Update the URL according to your route
                    type: 'GET',
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'uniquecode',
                        name: 'uniquecode'
                    },
                    {
    data: 'status',
    name: 'status',
    render: function(data, type, row) {
        if (data === 'unused') {
            return '<span class="badge badge-success">Belum Digunakan</span>';
        } else if (data === 'used') {
            return '<span class="badge badge-danger">Sudah Digunakan</span>';
        } else {
            return 'Tidak Diketahui'; // Atau sesuaikan dengan kebutuhan Anda
        }
    }
},
                    {
    "data": function(row) {
        return row.member && row.member.user && row.member.user.name !== null ? row.member.user.name : "";
    },
    "name": "member.user.name"
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
