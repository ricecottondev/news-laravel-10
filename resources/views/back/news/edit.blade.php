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
                                Edit News</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Master</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">News</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_user">
                                <i class="ki-duotone ki-plus "></i>Edit News</button>
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
                                    <div class="d-flex align-items-center position-relative my-1">
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
                                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="title">Judul</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{$news->category_id == $category->id ? "selected": ""}}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="short_desc">Deskripsi Singkat</label>
                                        <input type="text" class="form-control" id="short_desc" name="short_desc" value="{{ $news->short_desc }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Konten</label>
                                        <textarea class="form-control" id="content" name="content" rows="5" required>{{ $news->content }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Penulis</label>
                                        <input type="text" class="form-control" id="author" name="author" value="{{ $news->author }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $news->slug }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draf</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <input type="file" class="form-control" id="image" name="image">

                                        <!-- Menampilkan gambar yang ada -->
                                        @if($news->image)
                                            <img src="{{ asset('storage/' . $news->image) }}" alt="Current Image" width="150" class="mt-2">
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
