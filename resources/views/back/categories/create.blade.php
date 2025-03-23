@extends('back/layouts.layout')
@section('content')


<div class="d-flex flex-column flex-column-fluid">
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">

            {{-- header-start --}}
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Add Category</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Master</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Category</li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3 d-none">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_user">
                            <i class="ki-duotone ki-plus "></i>Add Category</button>
                    </div>
                </div>
            </div>
            {{-- header-end --}}

            {{-- body-start --}}
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!--begin::Products-->
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1 d-none">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" data-kt-ecommerce-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-12"
                                        placeholder="Search Order" />
                                </div>
                                <!--end::Search-->
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success mt-2">Save</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {{-- body-end --}}

        </div>
    </div>
</div>



@endsection
