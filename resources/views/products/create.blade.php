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
            Supresso
        @endslot
        @slot('title')
            Create New Product
        @endslot
    @endcomponent



    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <form action="{{ url('admin/products.store') }}" method="POST">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        @csrf

                        <div class="row">
                            <div class="col-lg-12">
                                <div id="addproduct-accordion" class="custom-accordion">
                                    <div class="card">
                                        <a href="#addproduct-billinginfo-collapse" class="text-dark"
                                            data-bs-toggle="collapse" aria-expanded="true"
                                            aria-controls="addproduct-billinginfo-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                01
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Product Info</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="addproduct-billinginfo-collapse" class="collapse show"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                               
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Name :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_name"
                                                            placeholder="">
                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Description :</label>
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" style="height:150px" name="product_detail" placeholder=""></textarea>
                                                    </div>

                                                </div>
                                               
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Brand :</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="product_brand">
                                                            @foreach ($brand as $product_brand)
                                                                <option value={{ $product_brand->id }}>
                                                                    {{ $product_brand->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Category :</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="product_category">
                                                            @foreach ($category as $product_category)
                                                                <option value={{ $product_category->id }}>
                                                                    {{ $product_category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Sub Category :</label>
                                                    <div class="col-md-10">

                                                        <select class="form-select" name="product_brand">
                                                            @foreach ($subcategory as $product_subcategory)
                                                                <option value={{ $product_subcategory->id }}>
                                                                    {{ $product_subcategory->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>
                                               
                                             
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Price :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_price"
                                                            placeholder="">
                                                    </div>

                                                </div>
                                                {{-- <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Product Price Currency
                                                        :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text"
                                                            name="product_price_currency" placeholder="">
                                                    </div>

                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <a href="#addproduct-img-collapse" class="text-dark collapsed"
                                            data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                            aria-haspopup="true" aria-controls="addproduct-img-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                02
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Product Image</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="addproduct-img-collapse" class="collapse"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">


                                                <div class="input-group hdtuto control-group lst increment">

                                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-success" type="button"><i
                                                                class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                                    </div>
                                                </div>

                                                <div class="clone hide">
                                                    <div class="hdtuto control-group lst input-group"
                                                        style="margin-top:10px">
                                                        <input type="file" name="filenames[]"
                                                            class="myfrm form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-danger" type="button"><i
                                                                    class="fldemo glyphicon glyphicon-remove"></i>
                                                                Remove</button>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <a href="#addproduct-metadata-collapse" class="text-dark collapsed"
                                            data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                            aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
                                            <div class="p-4">

                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        <div class="avatar-xs">
                                                            <div
                                                                class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                03
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 overflow-hidden">
                                                        <h5 class="font-size-16 mb-1">Meta Data</h5>
                                                        <p class="text-muted text-truncate mb-0">Fill all information below
                                                        </p>
                                                    </div>
                                                    <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <div id="addproduct-metadata-collapse" class="collapse"
                                            data-bs-parent="#addproduct-accordion">
                                            <div class="p-4 border-top">
                                               
                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label"> Stock :</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" type="text" name="status_stock"
                                                            placeholder="">
                                                    </div>

                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-md-2 col-package-label">Status :</label>
                                                    <div class="col-md-10">
                                                        <select class="form-select" name="status">
                                                            <option>Active</option>
                                                            <option>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>








                    </div>
                </div>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('admin/product') }}"> Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);

            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();

            });

        });
    </script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
