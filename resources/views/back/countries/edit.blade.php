@extends('back/layouts.layout')
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
                                Country</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ route('country.index') }}"
                                        class="text-muted text-hover-primary">Countries</a>
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
                                <form action="{{ route('country.update', $country->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="country_name">Country Name</label>
                                        <input type="text" name="country_name" class="form-control"
                                            value="{{ $country->country_name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Categories</label>
                                        <div class="row">
                                            @foreach ($categories as $category)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="category_ids[]"
                                                            value="{{ $category->id }}" class="form-check-input"
                                                            {{ in_array($category->id, $selectedCategoryIds) ? 'checked' : '' }}>
                                                        <label class="form-check-label">{{ $category->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a href="{{ route('country.index') }}" class="btn btn-secondary mt-3">Back</a>
                                    <button type="submit" class="btn btn-primary mt-3">Update</button>
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
