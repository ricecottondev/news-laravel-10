@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Edit User </h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Edit User</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">


                        </div>
                    </div>
                </div>



                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">
                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body">

                                {!! Form::model($user, [
                                    'route' => ['onepoint_user.update', $user->id],
                                    'method' => 'PUT',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Name</label>
                                        {!! Form::text('name', old('name', $user->name), ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Verification Date</label>
                                        <input type="datetime-local" name="email_verified_at"
                                            value="{{ $user->email_verified_at ? $user->email_verified_at->format('Y-m-d\TH:i') : '' }}"
                                            class="form-control">
                                        @error('email_verified_at')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Role</label>
                                        {!! Form::select('role', $roles->pluck('name', 'name'), $user->roles->first()->name, [
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                        ]) !!}
                                    </div>


                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Email</label>
                                        {!! Form::email('email', old('email', $user->email), [
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            'readonly',
                                        ]) !!}
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Password</label>
                                        {!! Form::password('password', ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="fv-row mb-7">
                                        <label class="fw-semibold fs-6 mb-2">Confirm Password</label>
                                        {!! Form::password('password_confirmation', ['class' => 'form-control form-control-solid mb-3 mb-lg-0']) !!}
                                    </div>
                                </div>

                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3">Discard</button>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                {!! Form::close() !!}



                            </div>

                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Content container-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->

        </div>
        <!--end:::Main-->


    </div>
    <!--end::Content-->
@endsection
