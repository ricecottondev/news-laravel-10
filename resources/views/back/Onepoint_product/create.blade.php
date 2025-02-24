@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Create Product LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Create Product</li>
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

                                {!! Form::open(['route' => 'onepoint_product.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                    <!-- Fields -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="fv-row mb-7">
                                                {!! Form::label('id_brand', 'Brand ID') !!}
                                                {!! Form::select('id_brand', $brand, old('id_brand'), [
                                                    'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                                ]) !!}
                                                @error('id_brand')
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
                                                {!! Form::label('namaproduk', 'Nama Produk') !!}
                                                {!! Form::text('namaproduk', old('namaproduk'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('namaproduk')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="fv-row mb-7">
                                                {!! Form::label('shortdescription', 'Short Description') !!}
                                                {!! Form::textarea('shortdescription', old('shortdescription'), [
                                                    'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                                    'rows' => '2',
                                                ]) !!}
                                                @error('shortdescription')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('packing', 'Packing') !!}
                                                {!! Form::text('packing', old('packing'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('packing')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('kemasan', 'Kemasan') !!}
                                                {!! Form::text('kemasan', old('kemasan'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('kemasan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('harga', 'Harga') !!}
                                                {!! Form::text('harga', old('harga'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('harga')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('specification', 'Specification') !!}
                                                {!! Form::textarea('specification', old('specification'), [
                                                    'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                                    'rows' => '2',
                                                ]) !!}
                                                @error('specification')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('description', 'Description') !!}
                                                {!! Form::textarea('description', old('description'), [
                                                    'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                                    'rows' => '2',
                                                ]) !!}
                                                @error('description')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>





                                            {{-- <div class="mb-3">
                                                {!! Form::label('hargadiskon', 'Harga Diskon') !!}
                                                {!! Form::text('hargadiskon', old('hargadiskon'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('hargadiskon')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}





                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                {!! Form::label('product_status', 'Product Status') !!}
                                                <div class="form-check">
                                                    {!! Form::hidden('product_status', 0) !!}
                                                    {!! Form::checkbox('product_status', 1, old('product_status'), [
                                                        'class' => 'form-check-input',
                                                        'id' => 'flexCheckDefault',
                                                    ]) !!}
                                                    {!! Form::label('flexCheckDefault', 'Product Status', ['class' => 'form-check-label']) !!}
                                                </div>
                                                @error('product_status')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="mb-3">
                                                {!! Form::label('kategori', 'Kategori') !!}
                                                {!! Form::text('kategori', old('kategori'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('kategori')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('subkategori', 'Subkategori') !!}
                                                {!! Form::text('subkategori', old('subkategori'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('subkategori')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('sku', 'SKU') !!}
                                                {!! Form::text('sku', old('sku'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('sku')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('jumlahstock', 'Jumlah Stock') !!}
                                                {!! Form::text('jumlahstock', old('jumlahstock'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('jumlahstock')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('berat', 'Berat') !!}
                                                {!! Form::text('berat', old('berat'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('berat')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('panjang', 'Panjang') !!}
                                                {!! Form::text('panjang', old('panjang'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('panjang')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('lebar', 'Lebar') !!}
                                                {!! Form::text('lebar', old('lebar'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('lebar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('tinggi', 'Tinggi') !!}
                                                {!! Form::text('tinggi', old('tinggi'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('tinggi')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('produkunggulan', 'Produk Unggulan') !!}
                                                {!! Form::text('produkunggulan', old('produkunggulan'), [
                                                    'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                                ]) !!}
                                                @error('produkunggulan')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- <div class="mb-3">
                                                {!! Form::label('product_status', 'Product Status') !!}
                                                {!! Form::text('product_status', old('product_status'), [
                                                    'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                                ]) !!}
                                                @error('product_status')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}





                                        </div>


                                        <div class="col-md-4">

                                            <div class="mb-3">
                                                {!! Form::label('gambar', 'Gambar') !!}
                                                {!! Form::file('gambar', ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('gambar')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- 
                                            <div class="mb-3">
                                                {!! Form::label('gambar1', 'Gambar 1') !!}
                                                {!! Form::file('gambar1', ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('gambar1')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('gambar2', 'Gambar 2') !!}
                                                {!! Form::file('gambar2', ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('gambar2')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('gambar3', 'Gambar 3') !!}
                                                {!! Form::file('gambar3', ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('gambar3')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            <div class="mb-3">
                                                {!! Form::label('beratbersih', 'Berat Bersih') !!}
                                                {!! Form::text('beratbersih', old('beratbersih'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('beratbersih')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('kind', 'Kind') !!}
                                                {!! Form::text('kind', old('kind'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('kind')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="mb-3">
                                                {!! Form::label('beratkotor', 'Berat Kotor') !!}
                                                {!! Form::text('beratkotor', old('beratkotor'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('beratkotor')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="mb-3">
                                                {!! Form::label('promo', 'Promo') !!}
                                                {!! Form::text('promo', old('promo'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('promo')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- <div class="mb-3">
                                                {!! Form::label('status', 'Status') !!}
                                                {!! Form::text('status', old('status'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('status')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            <div class="mb-3">
                                                {!! Form::label('slug', 'Slug') !!}
                                                {!! Form::text('slug', old('slug'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('slug')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                {!! Form::label('url', 'URL') !!}
                                                {!! Form::text('url', old('url'), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                                @error('url')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

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
@endsection
