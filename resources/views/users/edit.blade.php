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
        @slot('title') Edit User @endslot
    @endcomponent
<div class="row">
    <div class="col-lg-12 margin-tb">
      
      
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<div class="row">
    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @csrf

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-10">
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Confirm Password</label>
                        <div class="col-md-10">
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Role</label>
                        <div class="col-md-10">
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>

               

                </div>
            </div>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
</div>


@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
