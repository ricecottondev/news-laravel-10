@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Edit Offering LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Edit Offering</li>
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

                                {!! Form::model($brand, [
                                    'route' => ['onepoint_brand.update', $brand->id],
                                    'method' => 'PUT',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Merchant</label>
                                        <select name="id_merchant" data-control="select2"
                                            class="form-select form-select-solid mb-3 mb-lg-0">
                                            <option value="" disabled>Select Merchant</option>
                                            @foreach ($merchants as $id => $merchantName)
                                                <option value="{{ $id }}"
                                                    {{ $brand->id_merchant == $id ? 'selected' : '' }}>
                                                    {{ $merchantName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_merchant')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Brand</label>
                                        <input type="text" name="brand" class="form-control mb-3 mb-lg-0"
                                            value="{{ $brand->brand }}" placeholder="Enter Brand">
                                        @error('brand')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Status</label>
                                        <select name="status" class="form-select form-select-solid mb-3 mb-lg-0">
                                            <option value="Aktif" {{ $brand->status == 'Aktif' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="Inactive" {{ $brand->status == 'Inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3">Discard</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
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
