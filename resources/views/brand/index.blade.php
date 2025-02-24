@extends('layouts.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Tables
        @endslot
        @slot('title')
            Brand
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    {{-- @can('brand-create') --}}
                        {{-- <a class="btn btn-success" href="{{ route('brand.create') }}"> Create New Brand</a> --}}
                        <button class="btn btn-success" onclick="create()"> Create New Brand </button>
                    {{-- @endcan --}}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="280px">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $key => $brand)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->description }}</td>
                                    <td>
                                        {{-- @can('brand-edit') --}}
                                            <button class="btn btn-medium btn-success" onclick="update({{ $brand->id }})">Edit</button>
                                        {{-- @endcan
                                        @can('brand-delete') --}}
                                            <button class="btn btn-medium btn-danger" onclick="destroy({{ $brand->id }})">Delete</button>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    {{-- modal create --}}
    <div class="modal fade" id="ModalCreateBrand" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create_brand" method="POST" action="javascript:void(0)"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control"
                                    name="name"
                                    id="name" placeholder="Contoh: Chocolate">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">description</label>
                                <textarea id="description" name="description" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal update --}}
    <div class="modal fade" id="ModalUpdatebrand" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="update_brand" method="POST" action="javascript:void(0)"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control"
                                    name="id_brand"
                                    id="id_brand" value="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control"
                                    name="name_update"
                                    id="name_update" placeholder="Contoh: Chocolate">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">description</label>
                                <textarea id="description_update" name="description_update" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
    <script type="text/javascript">
        function create(){
            //open modal create
            $('#ModalCreateBrand').modal('show');
        }

        // proses submit brand
        $('#create_brand').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/brand/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {

                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Successfully. ',
                        //     text: 'New brand has been created successfully.',
                        //     showConfirmButton: false,
                        //     timer: 30000
                        // });

                        bootbox.alert('New brand has been created successfully.');
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 4000);
                    } else {
                        printErrorMsg (data.error);
                    }
                }
            });
        });

        // show modal edit brand
        function update(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/brand/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_brand').val(response.data.id);
                    $('#name_update').val(response.data.name);
                    $('#description_update').val(response.data.description);
                    //open modal
                    $('#ModalUpdatebrand').modal('show');
                }
            });
        }

        // proses update brand
        $('#update_brand').submit(function(e) {
            e.preventDefault();
            let id = $('#id_brand').val();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/brand/update') }}/"+ id,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: (data) => {
                    if ($.isEmptyObject(data.error)) {
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'successfully. ',
                        //     text: 'brand has been updated successfully.',
                        //     showConfirmButton: false,
                        //     timer: 30000
                        // });

                        bootbox.alert('brand has been updated successfully.');
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 4000);

                    } else {

                        printErrorMsg (data.error);
                    }
                }
            });
        });

        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        function destroy(id) {
            // Confirm box
            bootbox.confirm("Do you really want to delete record?", function(result) {

                if(result){
                    // AJAX Request
                    console.log("yes");
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/brand/destroy') }}/" + id,
                        success: function(data) {

                            bootbox.alert('Record has been deleted successfully.');
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 4000);

                            // Swal.fire({
                            //     icon: 'success',
                            //     title: 'Berhasil Hapus Data. ',
                            //     text: 'Data Type Outlet Berhasil dihapus.',
                            //     showConfirmButton: true,
                            //     // timer: 3000
                            // });
                        }
                    });
                }
            });
        }




    </script>

    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
