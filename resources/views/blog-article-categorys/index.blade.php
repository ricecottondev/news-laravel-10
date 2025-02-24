
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
        @slot('pagetitle') Tables @endslot
        @slot('title') Blog Article Category @endslot
    @endcomponent

 <div class="row">
        <div class="col-lg-12 margin-tb">
             <div class="card">
                <div class="card-body">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('blog-article-category.create') }}"> Create New Blog Article Category</a>
                @endcan
                
                 </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                 <th>No.</th>
                                 <th>Category</th>
                                 <th>Status</th>
                                 <th>Action</th>

                              
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($blog_article_category_models as $blog_article_category)
                        <tr>
                           
                            
                            <td>{{ ++$i }}</td>

                            <td>{{ $blog_article_category->artikel_kategori_judul}}</td>
                            <td>{{ $blog_article_category->artikel_kategori_status}}</td>
                        

                            <td>
                                <form action="{{ route('products.destroy',$blog_article_category->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('blog-article-category.show',$blog_article_category->id) }}">Show</a>
                                    @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('blog-article-category.edit',$blog_article_category->id) }}">Edit</a>
                                    @endcan


                                    @csrf
                                    @method('DELETE')
                                    @can('product-delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
