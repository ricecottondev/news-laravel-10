@extends('back.layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- header-start --}}
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Update Banner</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('banner.index') }}" class="text-muted text-hover-primary">Banner</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Edit</li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- header-end --}}

                {{-- body-start --}}
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <div class="card card-flush">
                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <div class="card-title">
                                    <h3>Edit Form</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <form action="{{ route('banner.update', $banner->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label>Banner Name</label>
                                        <input value="{{ $banner->name }}" type="text" name="name" id="name"
                                            class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Image Desktop</label>
                                        <input value="{{ $banner->image_desktop }}" type="file" name="image_desktop"
                                            id="image_desktop" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Image Mobile</label>
                                        <input value="{{ $banner->image_mobile }}" type="file" name="image_mobile"
                                            id="image_mobile" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Start Date</label>
                                        <input value="{{ $banner->start }}" type="date" name="start"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>End Date</label>
                                        <input value="{{ $banner->end }}" type="date" name="end"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-5">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $banner->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"{{ $banner->status == 'inactive' ? 'selected' : '' }}>
                                                InActive</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <input class="form-check-input" name="deleted" id="deleted" type="checkbox"
                                            value="1" {!! $banner->deleted ? 'checked' : '' !!}>
                                        <label for="deleted">
                                            Deleted
                                        </label>
                                    </div>


                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        @endsection
