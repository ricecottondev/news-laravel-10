@extends('layouts.master')
@section('title')
    @lang('translation.Home')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/ui/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Sliders @endslot
        @slot('title') Home @endslot
    @endcomponent
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div>
            <h2>Sliders</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>	
        <p>{{ $message }}</p>
    </div>
@endif

<div class="mb-3" style="text-align: right">
    @can('role-create')
        <a class="btn btn-sm btn-success" href="{{ route('sliders.create') }}"><i class="bi bi-plus"></i> Create New Slider</a>
    @endcan
</div>
<input type="hidden" value="{{Session::get('success')}}" va>
<div style="overflow-x: auto;">
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <td>No</td>
                <td>Title</td>
                <td>Active Date</td>
                <td>Created Date</td>
                <td>Flag</td>
                <td style="width:fit-content;" align="center">Action</td>
             </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $key=>$item)
        
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->active_date }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>

                        @if ($item->flag == "Y")
                            <i class="bi bi-check-circle-fill"></i>
                        @else
                            <i class="bi bi-x-circle"></i>
                        @endif

                    </td>
                    <td style="width:fit-content;" align="center">
                        <a href="slider-edit/{{$item->id}}" class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                        {{-- <a href="slider-delete/{{$item->id}}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Delete</a> --}}
                        {{-- <button class="btn btn-sm btn-primary" onclick="edit('{{ $item->id }}')"><i class="bi bi-pencil-square"></i> Edit</button> --}}
                        {{-- <button class="btn btn-sm btn-danger" onclick="delete('{{ $item->id }}')"><i class="bi bi-trash"></i> Delete</button> --}}
                    </td>
                </tr>
                
            @endforeach
    
        </tbody>
      
    </table>
</div>
<script src="{{asset('ui/js/jquery-3.6.0.min.js') }}"></script>


@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
