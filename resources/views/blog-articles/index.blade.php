
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
        @slot('title') Blog Article @endslot
    @endcomponent

 <div class="row">
        <div class="col-lg-12 margin-tb">
             <div class="card">
                <div class="card-body">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('blog-article-category.create') }}"> Create New Blog Article</a>
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
                               <th>Artikel Kode</th>
                               <th>Artikel Web</th>
                               <th>Artikel Static</th>
                               <th>Artikel Kategori_id</th>
                               <th>Artikel Lang</th>
                               <th>Artikel Judul</th>
                               <th>Artikel Short</th>
                               <th>Artikel Format</th>
                               <th>Artikel Konten</th>
                               <th>Artikel Note</th>
                               <th>Artikel Cover</th>
                               <th>Artikel Covermobile</th>
                               <th>Artikel Time</th>
                               <th>Artikel Url</th>
                               <th>Artikel Timestart</th>
                               <th>Artikel Timeend</th>
                               <th>Artikel Group</th>
                               <th>Artikel Status</th>
                               <th>Status</th>
                               <th>Action</th>

                              
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($blog_article_models as $blog_article)
                        <tr>
                           
                            
                            <td>{{ ++$i }}</td>

                            <td>{{ $blog_article->artikel_kode}}</td>
                            <td>{{ $blog_article->artikel_web}}</td>
                          
 <td>{{ $blog_article->artikel_static}}</td>
 <td>{{ $blog_article->artikel_kategori_id}}</td>
 <td>{{ $blog_article->artikel_lang}}</td>
 <td>{{ $blog_article->artikel_judul}}</td>
 <td>{{ $blog_article->artikel_short}}</td>
 <td>{{ $blog_article->artikel_format}}</td>
 <td>{{ $blog_article->artikel_konten}}</td>
 <td>{{ $blog_article->artikel_note}}</td>
 <td>{{ $blog_article->artikel_cover}}</td>
 <td>{{ $blog_article->artikel_covermobile}}</td>
 <td>{{ $blog_article->artikel_time}}</td>
 <td>{{ $blog_article->artikel_url}}</td>
 <td>{{ $blog_article->artikel_timestart}}</td>
 <td>{{ $blog_article->artikel_timeend}}</td>
 <td>{{ $blog_article->artikel_group}}</td>
 <td>{{ $blog_article->artikel_status}}</td>
 <td>{{ $blog_article->status}}</td>

                        

                            <td>
                                <form action="{{ route('products.destroy',$blog_article->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('blog-article-category.show',$blog_article->id) }}">Show</a>
                                    @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('blog-article-category.edit',$blog_article->id) }}">Edit</a>
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
