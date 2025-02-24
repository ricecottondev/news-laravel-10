@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Create Promo Product </h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Create Promo Product</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                        </div>
                    </div>
                </div>

                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body">

                                {!! Form::open(['route' => 'onepoint_menu_promo.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                    <!-- Input untuk promo_collection -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2"> Navbar Menu Promo Name</label>
                                        <input type="text" name="promo_collection_name"
                                            value="{{ old('promo_collection_name') }}" class="form-control">
                                        @error('promo_collection_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        {!! Form::label('id_merchant', 'Merchant ID') !!}
                                        {!! Form::select('id_merchant', $merchant, old('id_merchant'), [
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                        ]) !!}
                                        @error('id_merchant')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Start Date</label>
                                        <input type="date" name="promo_collection_start"
                                            value="{{ old('promo_collection_start') }}" class="form-control">
                                        @error('promo_collection_start')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">End Date</label>
                                        <input type="date" name="promo_collection_end"
                                            value="{{ old('promo_collection_end') }}" class="form-control">
                                        @error('promo_collection_end')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Dropdown untuk onepoint_produk_id -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Select OnePoint Product(s)</label>
                                        <select name="onepoint_produk_id[]" data-control="select2"
                                            class="form-select form-multiselect form-select-solid mb-3 mb-lg-0" multiple>
                                            @foreach ($onepointProducts as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->namaproduk . ' - ' . $product->kemasan . ' - ' . $product->harga . ' - ' . optional($product->merchant)->merchant_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('onepoint_produk_id')
                                            <div class="alert alert-danger mt-3">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Input untuk promo_products -->
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Promo Product Name</label>
                                        <input type="text" name="promo_product_name"
                                            value="{{ old('promo_product_name') }}" class="form-control">
                                        @error('promo_product_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Diskon Value</label>
                                        <input type="text" name="promo_product_diskon"
                                            value="{{ old('promo_product_diskon') }}" class="form-control">
                                        @error('promo_product_diskon')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Tambahkan input atau dropdown lainnya sesuai kebutuhan -->
                                </div>

                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3">Discard</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                {!! Form::close() !!}




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
                $('.form-multiselect').select2({
                    width: '100%', // Set lebar menjadi 100%
                    placeholder: 'Pilih Promo Product', // Menambahkan placeholder
                });
            });
        </script>
    @endpush
@endsection
