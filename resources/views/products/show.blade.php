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
            Show Product
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
        {{-- <form action="{{ route('products.update', $product_models->id) }}" method="POST" enctype="multipart/form-data"> --}}
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @csrf
                    @method('PUT')



                    <div class="row">
                        <div class="col-lg-12">
                            <div id="addproduct-accordion" class="custom-accordion">
                                <div class="card">
                                    <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse"
                                        aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
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
                                                <label class="col-md-2 col-package-label"> SKU:</label>
                                                <div class="col-md-10">{{ $product_models->sku }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Name :</label>
                                                <div class="col-md-10">{{ $product_models->product_name }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Detail :</label>
                                                <div class="col-md-10">{{ $product_models->product_detail }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Shortdetail :</label>
                                                <div class="col-md-10">{{ $product_models->product_shortdetail }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Brand :</label>
                                                <div class="col-md-10">{{ $product_models->product_brand }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Collection :</label>
                                                <div class="col-md-10">
                                                    <select class="form-select" name="product_collection">
                                                        @foreach ($product_collection_models as $product_collection)
                                                            <option value={{ $product_collection->id }}
                                                                @if ($product_models->product_collection == $product_collection->id) selected @endif>
                                                                {{ $product_collection->product_collection_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Type :</label>
                                                <div class="col-md-10">

                                                    <select class="form-select" name="product_type">
                                                        @foreach ($product_type_models as $product_type)
                                                            <option value={{ $product_type->id }}
                                                                @if ($product_models->product_type == $product_type->id) selected @endif>
                                                                {{ $product_type->product_type_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Form :</label>
                                                <div class="col-md-10">

                                                    <select class="form-select" name="product_form">
                                                        @foreach ($product_form_models as $product_form)
                                                            <option value={{ $product_form->id }}
                                                                @if ($product_models->product_form == $product_form->id) selected @endif>
                                                                {{ $product_form->product_form_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Package :</label>
                                                <div class="col-md-10">
                                                    <select class="form-select" name="product_package">
                                                        @foreach ($product_package_models as $product_package)
                                                            <option value={{ $product_package->id }}
                                                                @if ($product_models->product_package == $product_package->id) selected @endif>
                                                                {{ $product_package->product_package_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Price :</label>
                                                <div class="col-md-10">{{ $product_models->product_price }}

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Price Currency
                                                    :</label>
                                                <div class="col-md-10">{{ $product_models->product_price_currency }}

                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Expiry item</label>
                                                <div class="col-md-10">
                                                    <div class="form-check form-switch">
                                                        @if ($product_models->expiry_flag == 'Y')
                                                            <input class="form-check-input" type="checkbox" id="c-expiry"
                                                                checked />
                                                        @else
                                                            <input class="form-check-input" type="checkbox"
                                                                id="c-expiry" />
                                                        @endif
                                                        <input type="hidden" value="{{ $product_models->expiry_flag }}"
                                                            name="expiry_flag" id="expiry_flag">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
                                        aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                                        aria-controls="addproduct-img-collapse">
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
                                            @if (isset($images))
                                                @foreach ($images as $image)
                                                    @if ($loop->first)
                                                        <div class="input-group hdtuto control-group lst increment">

                                                            <img src="{{ url('files/product-images/' . $image) }}"
                                                                width="100px">
                                                            <div class="input-group-btn">

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="clone hide">
                                                            <div class="hdtuto control-group lst input-group"
                                                                style="margin-top:10px">

                                                                <img src="{{ url('files/product-images/' . $image) }}"
                                                                    width="100px">
                                                                <div class="input-group-btn">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (count($images) == 1)
                                                        <div class="clone hide">
                                                            <div class="hdtuto control-group lst input-group"
                                                                style="margin-top:10px">

                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-danger" type="button"><i
                                                                            class="fldemo glyphicon glyphicon-remove"></i>
                                                                        Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
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
                                            @endif



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
                                                <label class="col-md-2 col-package-label"> Product Weight :</label>
                                                <div class="col-md-10">{{ $product_models->product_weight }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Width :</label>
                                                <div class="col-md-10">{{ $product_models->product_width }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Height :</label>
                                                <div class="col-md-10">{{ $product_models->product_height }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Length :</label>
                                                <div class="col-md-10">{{ $product_models->product_length }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Acidity Score
                                                    :</label>
                                                <div class="col-md-10">{{ $product_models->product_acidityscore }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Acidity Desc
                                                    :</label>
                                                <div class="col-md-10">{{ $product_models->product_aciditydesc }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Body Score :</label>
                                                <div class="col-md-10">{{ $product_models->product_bodyscore }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Body Desc :</label>
                                                <div class="col-md-10">{{ $product_models->product_bodydesc }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Roast Desc :</label>
                                                <div class="col-md-10">{{ $product_models->product_roastdesc }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Type Desc :</label>
                                                <div class="col-md-10">{{ $product_models->product_typedesc }}

                                                </div>

                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Product Intensity :</label>
                                                <div class="col-md-10">{{ $product_models->product_intensity }}

                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <a href="#addproduct-stock-collapse" class="text-dark collapsed"
                                        data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                        aria-haspopup="true" aria-controls="addproduct-stock-collapse">
                                        <div class="p-4">

                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="avatar-xs">
                                                        <div
                                                            class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            04
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Stock</h5>
                                                    <p class="text-muted text-truncate mb-0">Fill all information below
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="addproduct-stock-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">



                                            <div class="mb-3 row d-none">
                                                <label class="col-md-2 col-package-label"> Status Stock :</label>
                                                <div class="col-md-10">{{ $product_models->status_stock }}

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Stock Web:</label>
                                                <div class="col-md-10">{{ $product_models->stockweb }}

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Stock Buy:</label>
                                                <div class="col-md-10">{{ $product_models->stockbuy }}

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Stock Reserve:</label>
                                                <div class="col-md-10">{{ $product_models->stockreserve }}

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label"> Stock Vend:</label>
                                                <div class="col-md-10">{{ $product_models->stockvend }}

                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-md-2 col-package-label">Status :</label>
                                                <div class="col-md-10">
                                                    {{ $product_models->status }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card">
                                    <a href="#product-review-collapse" class="text-dark collapsed"
                                        data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false"
                                        aria-haspopup="true" aria-controls="product-review-collapse">
                                        <div class="p-4">

                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <div class="avatar-xs">
                                                        <div
                                                            class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                            05
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-1 overflow-hidden">
                                                    <h5 class="font-size-16 mb-1">Review</h5>
                                                    <p class="text-muted text-truncate mb-0">Fill all information below
                                                    </p>
                                                </div>
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                            </div>

                                        </div>
                                    </a>

                                    <div id="product-review-collapse" class="collapse"
                                        data-bs-parent="#addproduct-accordion">
                                        <div class="p-4 border-top">
                                            <h3 class="gotham-bold mb-3">Ratings & Reviews</h3>
                                            <div class="row align-md-center">
                                                <div class="col-md-auto mb-3 mb-md-0 text-center">
                                                    <h1 class="display-1 gotham-bold lh-1">
                                                        {{ number_format((float) $rating->ravg, 2, '.', '') }}</h1>
                                                    <p class="mb-0">
                                                        @for ($b = 0; $b < $rating->rcount; $b++)
                                                            <i class="bi bi-star-fill"></i>
                                                        @endfor
                                                        @for ($b = 0; $b < (5 - $rating->rcount) ; $b++)
                                                            <i class="bi bi-star"></i>
                                                        @endfor
                                                        {{-- <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i> --}}
                                                        <br>
                                                        ({{ $rating->rcount }} X Ratings)
                                                    </p>
                                                </div>
                                                <div class="col-auto d-none d-md-block">
                                                    <div class="h-100 border-start border-secondary"></div>
                                                </div>
                                                <div class="col-md">
                                                    <ul class="media list-unstyled mb-0">
                                                        <li class="d-flex flex-nowrap align-items-center w-100 mb-2">
                                                            <h5 class="fw-bold text-center mb-0 mr-2"
                                                                style="width: 30px;">5</h5>
                                                            <div class="progress w-100">
                                                                <div class="progress-bar rounded-pill bg-dark p-0" style="width: {{ !empty($rating->rating5) ? (($rating->rating5 / $rating->rcount) * 100).'%' :'0%' }} "
                                                                    role="progressbar" aria-label="Basic example"
                                                                    aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex flex-nowrap align-items-center w-100 mb-2">
                                                            <h5 class="fw-bold text-center mb-0 mr-2"
                                                                style="width: 30px;">4</h5>
                                                            <div class="progress w-100">
                                                                <div class="progress-bar rounded-pill bg-dark p-0" style="width: {{ !empty($rating->rating4) ? (($rating->rating4 / $rating->rcount) * 100).'%' :'0%' }} "
                                                                    role="progressbar" aria-label="Basic example"
                                                                    aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex flex-nowrap align-items-center w-100 mb-2">
                                                            <h5 class="fw-bold text-center mb-0 mr-2"
                                                                style="width: 30px;">3</h5>
                                                            <div class="progress w-100">
                                                                <div class="progress-bar rounded-pill bg-dark p-0" style="width: {{ !empty($rating->rating3) ? (($rating->rating3 / $rating->rcount) * 100).'%' :'0%' }} "
                                                                    role="progressbar" aria-label="Basic example"
                                                                    aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex flex-nowrap align-items-center w-100 mb-2">
                                                            <h5 class="fw-bold text-center mb-0 mr-2"
                                                                style="width: 30px;">2</h5>
                                                            <div class="progress w-100">
                                                                <div class="progress-bar rounded-pill bg-dark p-0" style="width: {{ !empty($rating->rating2) ? (($rating->rating2 / $rating->rcount) * 100).'%' :'0%' }} "
                                                                    role="progressbar" aria-label="Basic example"
                                                                    aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-flex flex-nowrap align-items-center w-100 mb-2">
                                                            <h5 class="fw-bold text-center mb-0 mr-2"
                                                                style="width: 30px;">1</h5>
                                                            <div class="progress w-100">
                                                                <div class="progress-bar rounded-pill bg-dark p-0" style="width: {{ !empty($rating->rating1) ? (($rating->rating1 / $rating->rcount) * 100).'%' :'0%' }} "
                                                                    role="progressbar" aria-label="Basic example"
                                                                    aria-valuenow="0" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="table-responsive mb-4">
                                                <div class="btn-group text-nowrap mb-2">
                                                    <button class="btn btn-outline-dark fs-inherit active"
                                                        onclick="searchrating('~')">All
                                                        Reviews</button>
                                                    <button class="btn btn-outline-dark fs-inherit"
                                                        onclick="searchrating(1)"><i class="bi bi-star-fill"></i>
                                                        1</button>
                                                    <button class="btn btn-outline-dark fs-inherit"
                                                        onclick="searchrating(2)"><i class="bi bi-star-fill"></i>
                                                        2</button>
                                                    <button class="btn btn-outline-dark fs-inherit"
                                                        onclick="searchrating(3)"><i class="bi bi-star-fill"></i>
                                                        3</button>
                                                    <button class="btn btn-outline-dark fs-inherit"
                                                        onclick="searchrating(4)"><i class="bi bi-star-fill"></i>
                                                        4</button>
                                                    <button class="btn btn-outline-dark fs-inherit"
                                                        onclick="searchrating(5)"><i class="bi bi-star-fill"></i>
                                                        5</button>
                                                </div>
                                            </div>

                                            <ul class="media list-unstyled reviews-list mb-0">
                                                {{-- @foreach ($t_review_product as $review)
                                                    <li class="media-item">
                                                        <div class="media-body">
                                                            <h5 class="gotham-bold text-capitalize lh-1 mb-2">
                                                                {{ $review->nomerorder }}</h5>
                                                            <p class="lh-1 mb-2">
                                                                @for ($b = 0; $b < $review->rating; $b++)
                                                                    <i class="bi bi-star-fill"></i>
                                                                @endfor
                                                                @for ($b = 0; $b < 5 - $review->rating; $b++)
                                                                    <i class="bi bi-star"></i>
                                                                @endfor

                                                            </p>
                                                            <p class="lh-1 mb-4">{{ $review->created_at }}</p>
                                                            <p class="small">
                                                                {{ $review->review }}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach --}}
                                                <div id="strrating"></div>
                                            </ul>
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
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {{-- </form> --}}
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        let datarating = @json($t_review_product);
        var results = [];
        var strrating = "";

        $(window).on('load', function() {
            var res = searcharray(datarating, '~');
            document.getElementById("strrating").innerHTML = res;
        })

        function searchrating(star) {
                       var res = searcharray(datarating, star);
            document.getElementById("strrating").innerHTML = res;
        }

        function searcharray(rating, r) {
            results = [];
            strrating = "";
            for (var i = 0; i < rating.length; i++) {
                if (r == '~') {
                    strrating +=
                        "<li class='media-item'><div class='media-body'><h5 class='gotham-bold text-capitalize lh-1 mb-2'>" +
                        rating[i]['namalengkap'] + "</h5>";
                    strrating += "<p class='lh-1 mb-2'>";
                    for ($b = 0; $b < rating[i]['rating']; $b++) {
                        strrating += "<i class='bi bi-star-fill'></i>";
                    }
                    for ($b = 0; $b < (5-(rating[i]['rating'])); $b++) {
                        strrating += "<i class='bi bi-star'></i>";
                    }

                    strrating += "</p>";
                    strrating += "<p class='lh-1 mb-4'>" + rating[i]['tanggalorder'] + "</p>";
                    strrating += "<p class='small'>";
                    strrating += rating[i]['review'];
                    strrating += "</p></div></li>";
                } else {
                    if (rating[i]['rating'] == r) {
                        results.push(rating[i]);
                        strrating +=
                            "<li class='media-item'><div class='media-body'><h5 class='gotham-bold text-capitalize lh-1 mb-2'>" +
                            rating[i]['namalengkap'] + "</h5>";
                        strrating += "<p class='lh-1 mb-2'>";
                        for ($b = 0; $b < rating[i]['rating']; $b++) {
                            strrating += "<i class='bi bi-star-fill'></i>";
                        }
                        for ($bf = 0; $bf < (5-(rating[i]['rating'])); $bf++) {
                            strrating += "<i class='bi bi-star'></i>";
                        }

                        strrating += "</p>";
                        strrating += "<p class='lh-1 mb-4'>" + rating[i]['tanggalorder'] + "</p>";
                        strrating += "<p class='small'>";
                        strrating += rating[i]['review'];
                        strrating += "</p></div></li>";
                    }
                }

            }

            return strrating;
        }

        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);

            });

            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".hdtuto").remove();

            });
        });

        $("#c-expiry").on("click", function(e) {
            e.preventDefault;
            const isChecked = $(this).is(":checked");
            if (isChecked) {
                $("[name='expiry_flag']").val("Y");
            } else {
                $("[name='expiry_flag']").val("N");
            }
        });
    </script>
    <script></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
@endsection
