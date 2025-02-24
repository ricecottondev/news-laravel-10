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
            Product List
        @endslot
    @endcomponent

    <div class="row">

        {{-- form atas/ luar --}}
        <div class="col-12 margin-tb">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4">
                {{-- card item --}}
                <div class="col mb-4">
                    <div class="card border shadow h-100 bg-opacity-10">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Brand</h4>
                            <p class="mb-0">
                                <h6>supresso</h6>
                                <h6>pandan garden</h6>

                            </p>
                        </div>
                    </div>
                </div>
                {{-- card item --}}
                <div class="col mb-4">
                    <div class="card border shadow h-100 bg-opacity-25">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Category</h4>
                            <p class="mb-0">
                                <h6>coffee</h6>
                                <h6>baverage</h6>
                                <h6>western food</h6>
                                <h6>indonesian food</h6>
                                
                            </p>
                        </div>
                    </div>
                </div>

                {{-- card item --}}
                <div class="col mb-4">
                    <div class="card border shadow h-100 bg-opacity-50">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Sub Category</h4>
                            <p class="mb-0">
                                <h6>manual brew</h6>
                                <h6>drip coffee</h6>
                                <h6>coffee</h6>
                                <h6>Coffee frappe</h6>
                                <h6>frappe</h6>
                                <h6>tea</h6>
                                <h6>soda</h6>
                                <h6>add-ons</h6>
                                <h6>Supresso Specials</h6>
                                <h6>pizza</h6>
                                <h6>pasta</h6>
                                <h6>main course</h6>
                                <h6>rice bowl</h6>
                                <h6>dessert</h6>
                                <h6>soup</h6>
                                <h6>rice</h6>
                                <h6>sambal</h6>
                                <h6>appetizer</h6>

                            </p>
                        </div>
                    </div>
                </div>

                 {{-- card item --}}
                 <div class="col mb-4">
                    <div class="card border shadow h-100 bg-opacity-50">
                        <div class="card-body">
                            <h4 class="card-title mb-2">Additional</h4>
                            <p class="mb-0">
                               

                            </p>
                        </div>
                    </div>
                </div>

        

            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    

                    <div class="col-lg-12">
                    
                    </div>


                    <div class="w-100 text-end mb-3">
                        @can('product-create')
                            <a class="btn btn-sm btn-success" href="{{ url('admin/product/create') }}"><i class="bi bi-plus-circle-fill"></i> Create New Product</a>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th style="max-height: 100px">Product name</th>
                                    <th style="max-height: 50px;white-space:unset">Price</th>
                                    <th style="max-height: 50px;white-space:unset">Stock</th>
                                    <th style="max-height: 50px;white-space:unset">Units</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:12px;">
                                @foreach ($product_models as $product)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            <div style="background-color: lightgrey;width:60px;heigth:60px;" class="rounded-circle">
                                                @php
                                                    $urlImgError = url('files/' . 'imagenotavailable.jpg');
                                                    if (!empty($product->fileimages)) {
                                                        $image = json_decode($product->fileimages);
                                                    } else {
                                                        $image = "";
                                                    } 
                                                @endphp

                                                @if ($image == "")
                                                    <img class="img-fluid rounded-circle" src="{{ url('files/' . 'imagenotavailable.jpg') }}">
                                                @else
                                                    <img class="rounded-circle" onerror="this.onerror=null;this.src='{{$urlImgError}}'" src="{{ url('files/product-images/'.$image[0]) }}" width="60px">
                                                @endif
                                            </div>
                                            
                                        </td>
                                      
                                        <td style="white-space: unset;">{{ $product->name }}</td>
                                        <td style="white-space: unset;text-align:right;">{{ $product->price }} K</td>
                                        <td style="white-space: unset;text-align:right;">{{ $product->stock }}</td>
                                        <td style="white-space: unset;text-align:right;">{{ $product->units }}</td>
                                      
                                        <td>
                                            <form action="{{ url('admin/product/.destroy', $product->id) }}" method="POST">
                                                <a class="btn btn-sm btn-info"
                                                    href="{{ url('admin/product.show', $product->id) }}">Show</a>
                                                @can('product-edit')
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ url('admin/product.edit', $product->id) }}">Edit</a>
                                                @endcan
                                                {{-- <a class="btn btn-warning"
                                                    href="{{ route('product-images.index', 'id_product=' . $product->id) }}">Add
                                                    Image Product</a> --}}

                                                @csrf
                                                @method('DELETE')
                                                @can('product-delete')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-sm btn-danger">Delete</button>
                                                @endcan
                                            </form>
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
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
