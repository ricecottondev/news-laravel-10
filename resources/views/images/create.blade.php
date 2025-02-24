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
        @slot('pagetitle') Supresso @endslot
        @slot('title') Product Image @endslot
    @endcomponent

  

<div class="container lst">

  

@if (count($errors) > 0)

<div class="alert alert-danger">

    <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>

    <ul>

      @foreach ($errors->all() as $error)

          <li>{{ $error }}</li>

      @endforeach

    </ul>

</div>

@endif

  

@if(session('success'))

<div class="alert alert-success">

  {{ session('success') }}

</div> 

@endif

  
{{-- 
<h3 class="well">Laravel 8 Multiple Image Upload - ItSolutionStuff.com</h3> --}}

 
    <div class="row"><form action="{{ route('products.store') }}" method="POST">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
    <form method="post" action="{{url('file')}}" enctype="multipart/form-data">

        @csrf

      

        <div class="input-group hdtuto control-group lst increment" >

          <input type="file" name="filenames[]" class="myfrm form-control">

          <div class="input-group-btn"> 

            <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>

          </div>

        </div>

        <div class="clone hide">

          <div class="hdtuto control-group lst input-group" style="margin-top:10px">

            <input type="file" name="filenames[]" class="myfrm form-control">

            <div class="input-group-btn"> 

              <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>

            </div>

          </div>

        </div>

      

        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

      

    </form>        
                    </div>  
                </div>
            </div>
    </div>
</div>

  @endsection
@section('script')
<script type="text/javascript">

    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
          alert(lsthmtl);
      });
      
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto").remove();

      });

    });

</script>

  @endsection

