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
            Sub Category
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    {{-- @can('category-create') --}}
                        {{-- <a class="btn btn-success" href="{{ route('category.create') }}"> Create New Category</a> --}}
                        <button class="btn btn-success" onclick="create()"> Create New Sub Category </button>
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
                                    <th>Name Category</th>
                                    <th>Name Sub Category</th>
                                    <th width="280px">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategorys as $key => $subCategory)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $subCategory->name_category }}</td>
                                    <td>{{ $subCategory->name_sub_category }}</td>
                                    <td>
                                        {{-- @can('category-edit') --}}
                                            <button class="btn btn-medium btn-success" onclick="update({{ $subCategory->id_sub_category }})">Edit</button>
                                        {{-- @endcan
                                        @can('category-delete') --}}
                                            <button class="btn btn-medium btn-danger" onclick="destroy({{ $subCategory->id_sub_category }})">Delete</button>
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
    <div class="modal fade" id="ModalCreateSubCategory" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="create_subcategory" method="POST" action="javascript:void(0)"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="category_id"> Name Category </label>
                                <select class="form-select category_id" name="category_id"
                                    id="floatingSelectGrid"
                                    aria-label="Floating label select example">
                                    <option value="0">-- Selected Category --
                                    </option>
                                    @foreach ($getCategorys as $getCategory)
                                        <option value="{{ $getCategory->id }}">
                                            {{ $getCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name Sub Category</label>
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
    <div class="modal fade" id="ModalUpdateSubCategory" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Sub Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg error-contact-edit"
                        style="display:none">
                        <ul></ul>
                    </div>

                    <form id="update_subcategory" method="POST" action="javascript:void(0)"
                        accept-charset="utf-8" enctype="multipart/form-data">
                        {{-- {!! csrf_field() !!} --}}
                        @csrf
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <input type="hidden" class="form-control"
                                    name="id_subcategory"
                                    id="id_subcategory" value="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="category_id_update"> Name Category </label>
                                <select class="form-select category_id_update" name="category_id_update"
                                    id="floatingSelectGrid"
                                    aria-label="Floating label select example">
                                    <option value="0">-- Selected Category --
                                    </option>
                                    @foreach ($getCategorys as $getCategory)
                                        <option value="{{ $getCategory->id }}">
                                            {{ $getCategory->name }}</option>
                                    @endforeach
                                </select>
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
            $('#ModalCreateSubCategory').modal('show');
        }

        $(".btn-success").click(function(){
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);

        });

        $("body").on("click",".btn-danger",function(){
            $(this).parents(".hdtuto").remove();
        });

        // proses submit category
        $('#create_subcategory').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/subcategory/store') }}",
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

                        bootbox.alert('New sub category has been created successfully.');
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
                url: "{{ url('admin/subcategory/show') }}/" + id,
                type: "get",
                cache: false,
                success: function(response) {
                    //fill data to form
                    $('#id_subcategory').val(response.data.id);
                    $('[name="category_id_update"]').val(response.data.category_id);
                    $('#name_update').val(response.data.name);
                    //open modal
                    $('#ModalUpdateSubCategory').modal('show');
                }
            });
        }

        // proses update category
        $('#update_subcategory').submit(function(e) {
            e.preventDefault();
            let id = $('#id_subcategory').val();
            var formData = new FormData(this);
            // console.log(formData);
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/subcategory/update') }}/"+ id,
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

                        bootbox.alert('Sub category has been updated successfully.');
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
                        url: "{{ url('admin/subcategory/destroy') }}/" + id,
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
