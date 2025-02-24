@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                UNIQUECODE LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">UNIQUECODE</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            {{-- <div class="m-0">
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
                            </div> --}}
                            {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Onepoint_uniquecode">
                      <i class="ki-duotone ki-plus "></i>Add UNIQUECODE</button>  
                       --}}
                            <a class="btn btn-sm btn-primary" href="{{ route('onepoint_uniquecode.create') }}">Create
                                Generate Code</a>

                            {{-- <form class="" action="{{ url('/generateuniquecode') }}"
                                onsubmit="return confirm('Are you sure you want to create voucher?');" id="inputForm"
                                style="display: none;" method="POST">
                                @csrf
                                <div class="d-flex column-gap-2">
                                    <input type="text" class="form-control" maxlength=12 id="limitgenerate"
                                        name="limitgenerate" placeholder="total uniquecode">
                                    <input type="text" class="form-control" maxlength=12 id="valuepoint"
                                        name="valuepoint" placeholder="point value">
                                    <button type="submit" class="btn btn-sm btn-danger">Create</button>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>

                <script>
                    // Function to toggle the visibility of the form
                    function toggleFormVisibility() {
                        var form = document.getElementById('inputForm');
                        if (form.style.display === 'none') {
                            form.style.display = 'block';
                        } else {
                            form.style.display = 'none';
                        }
                    }

                    // Add click event listener to the button
                    var showFormBtn = document.getElementById('showFormBtn');
                    showFormBtn.addEventListener('click', toggleFormVisibility);
                </script>

                @include('back.Onepoint_uniquecode.modal_add')

                @foreach ($data as $key => $onepoint_uniquecode)
                    @include('back.Onepoint_uniquecode.modal_edit')
                @endforeach

                @foreach ($data as $key => $onepoint_uniquecode)
                    @include('back.Onepoint_uniquecode.modal_show')
                @endforeach


                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body">

                                <div id="reader"></div>

                                {{-- <div id="qr-reader-results"></div> --}}
                                <div id="reader-results"></div>

                                {{-- <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script> --}}
                                <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
                                {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
                                <script src="html5-qrcode-demo.js"></script>

                                <div class="table-responsive">
                                    <table id="datatable-buttons"
                                        class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="min-w-50px sorting">NO</th>
                                                <th class="min-w-125px sorting">Kode</th>
                                                <th class="min-w-125px sorting">Label</th>
                                                {{-- <th class="min-w-125px sorting">Barcode</th> --}}
                                                <th class="min-w-125px sorting">Point</th>
                                                <th class="min-w-125px sorting">Status</th>
                                                <th class="min-w-125px sorting">Expired</th>
                                                <th class="min-w-125px sorting">Deleted</th>
                                                <th class="min-w-125px sorting">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $onepoint_uniquecode)
                                                <tr>
                                                    <td style="color:rgba(80, 74, 74, 0.333)"
                                                        class=" align-items-center text-center"> <a href="#"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ ++$i }}</a>
                                                    </td>

                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($onepoint_uniquecode->kode, 25) }}</a>
                                                    </td>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($onepoint_uniquecode->label, 25) }}</a>
                                                    </td>
                                                    {{-- <td style="color:rgba(80, 74, 74, 0.333)"
                                                    class=" align-items-center text-center">
                                                        @php
                                                            
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                                            $barcode = str_replace("-","",$onepoint_uniquecode->kode);
                                                            
                                                        @endphp 
                                                        
                                                        {!! $generator->getBarcode($barcode, $generator::TYPE_CODE_128) !!}
                                                        <br>
                                                        {!! $generator->getBarcode($onepoint_uniquecode->kode, $generator::TYPE_CODE_93) !!}
                                                        <br>
                                                        {!! $generator->getBarcode($barcode, $generator::TYPE_CODE_93) !!} 
                                                        <div id="uniquecode1"></div>
                                                        <div id="uniquecode2"></div>
                                                        <div id="uniquecode3"></div>
                                                        <div id="uniquecode4"></div> 
                                                    
                                                </td> --}}
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($onepoint_uniquecode->point, 25) }}</a>
                                                    </td>
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($onepoint_uniquecode->status, 25) }}</a>
                                                    </td>
                                                    <td>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}" class="text-gray-800 text-hover-primary mb-1">
                                                            <?php
                                                            // Jika expired_date null, return string kosong
                                                            if ($onepoint_uniquecode->expired_date === null) {
                                                                echo '';
                                                            } else {
                                                                // Ambil tanggal sekarang
                                                                $now = now();
                                                    
                                                                // Konversi expired_date menjadi objek Carbon untuk memudahkan perbandingan
                                                                $expiredDate = \Carbon\Carbon::parse($onepoint_uniquecode->expired_date);
                                                    
                                                                // Ambil tanggal sebagai string tanpa jam, menit, dan detik
                                                                $nowDate = $now->toDateString();
                                                                $expiredDateDate = $expiredDate->toDateString();
                                                    
                                                                // Periksa apakah tanggal saat ini lebih besar dari tanggal expired
                                                                if ($nowDate > $expiredDateDate) {
                                                                    // Jika lebih besar, tambahkan kelas 'danger'
                                                                    echo '<span class="badge badge-danger">' . $expiredDateDate . '</span>';
                                                                } else {
                                                                    // Jika tidak lebih besar, tambahkan kelas 'success'
                                                                    echo '<span class="badge badge-success">' . $expiredDateDate . '</span>';
                                                                }
                                                            }
                                                            ?>
                                                        </a>
                                                    </td>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    <td><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($onepoint_uniquecode->deleted, 25) }}</a>
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
                                                                    data-bs-target="#kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}">Show</a>
                                                            </div>

                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_edit_onepoint_uniquecode{{ $onepoint_uniquecode->id }}">Edit</a>
                                                            </div>

                                                            <div class="menu-item px-3">
                                                                {!! Form::open([
                                                                    'id' => 'form-id_' . $onepoint_uniquecode->id,
                                                                    'method' => 'DELETE',
                                                                    'route' => ['onepoint_uniquecode.destroy', $onepoint_uniquecode->id],
                                                                    'style' => 'display:inline',
                                                                ]) !!}
                                                                <a onclick="document.getElementById('form-id_{{ $onepoint_uniquecode->id }}').submit();"
                                                                    class="menu-link px-3"
                                                                    data-kt-users-table-filter="delete_row"> Delete</a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        </div>


                                                    </td>
                                                </tr>
                                            @endforeach

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
@endsection
