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
            Category
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    {{-- @can('category-create') --}}
                        {{-- <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a> --}}
                        <button class="btn btn-success" onclick="create()"> Create New Category </button>
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
                                    <th width="280px">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pos_categorys as $key => $pos_category)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $pos_category->name }}</td>
                                    <td>
                                        {{-- @can('category-edit') --}}
                                            <button class="btn btn-medium btn-success" onclick="update({{ $pos_category->id }})">Edit</button>
                                        {{-- @endcan
                                        @can('category-delete') --}}
                                            <button class="btn btn-medium btn-danger" onclick="destroy({{ $pos_category->id }})">Delete</button>
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
    <div class="modal fade" id="ModalCreateCategory" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create_category" method="POST" action="javascript:void(0)"
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
                                <label class="form-label">Images</label>
                                <div class="input-group hdtuto control-group lst increment" >

                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                    </div>

                                    <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="file" name="filenames[]" class="myfrm form-control">
                                        <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
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
    <div class="modal fade" id="ModalUpdateCategory" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="update_category" method="POST" action="javascript:void(0)"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control"
                                    name="id_category"
                                    id="id_category" value="">
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
                                <label class="form-label">Images</label>
                                <div class="input-group hdtuto control-group lst increment" >

                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                    </div>

                                    <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="file" name="filenames[]" class="myfrm form-control">
                                        <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
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
            $('#ModalCreateCategory').modal('show');
        }

        $(".btn-success").click(function(){
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);

        });

        $("body").on("click",".btn-danger",function(){
            $(this).parents(".hdtuto").remove();
        });

        // proses submit category
        $('#create_category').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/category/store') }}",
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
                        //     text: 'New category has been created successfully.',
                        //     showConfirmButton: false,
                        //     timer: 30000
                        // });

                        bootbox.alert('New category has been created successfully.');
                        setTimeout(function(){// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 4000);
                    } else {
                        printErrorMsg (data.error);
                    }
                }
            });
        });

        // show modal edit category
        function update(id) {
            //fetch detail post with ajax
            $.ajax({
                url: "{{ url('admin/category/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_category').val(response.data.id);
                    $('#name_update').val(response.data.name);
                    //open modal
                    $('#ModalUpdateCategory').modal('show');
                }
            });
        }

        // proses update category
        $('#update_category').submit(function(e) {
            e.preventDefault();
            let id = $('#id_category').val();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/category/update') }}/"+ id,
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
                        //     text: 'Category has been updated successfully.',
                        //     showConfirmButton: false,
                        //     timer: 30000
                        // });

                        bootbox.alert('Category has been updated successfully.');
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
                    // console.log("yes");
                    $.ajax({
                        type: "get",
                        url: "{{ url('admin/category/destroy') }}/" + id,
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
