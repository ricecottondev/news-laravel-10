@extends('layouts.master')
@section('title')
    @lang('translation.Add_Product')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Ecommerce @endslot
        @slot('title') Blog Article Category @endslot
    @endcomponent
<div class="row">
    <div class="col-lg-12 margin-tb">
        
        
    </div>
</div>

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                     <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Judul</label>
                        <div class="col-md-10">
                            : {{ $blog_article_category_models->artikel_kategori_judul }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-10">
                            : {{ $blog_article_category_models->artikel_kategori_status }}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('blog-article-category.index') }}"> Back</a>
        </div>
</div>


@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
