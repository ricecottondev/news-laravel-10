@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                Edit Member LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">Edit Member</li>
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

                                {!! Form::model($member, ['route' => ['onepoint_member.update', $member->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" >
                                
                                    <div class="card">
                                        <div class="card-body">
                                            {!! Form::model($member, ['route' => ['onepoint_member.update', $member->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                   
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Email</label>
                                                        <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="{{ $member->email }}">
                                                        @error('email')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                 
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Telephone</label>
                                                        <input type="text" name="telp" class="form-control form-control-lg form-control-solid" placeholder="Telephone" value="{{ $member->telp }}">
                                                        @error('telp')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Address</label>
                                                        <textarea name="address" class="form-control form-control-lg form-control-solid" placeholder="Address">{{ $member->address }}</textarea>
                                                        @error('address')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Gender</label>
                                                        <select name="gender" class="form-select form-select-solid mb-3 mb-lg-0">
                                                            <option value="male" {{ $member->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                            <option value="female" {{ $member->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    
                                                   
                                                   
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">KTP</label>
                                                        <input type="text" name="ktp" class="form-control form-control-lg form-control-solid" placeholder="KTP" value="{{ $member->ktp }}">
                                                        @error('ktp')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">UniqueCode</label>
                                                        <input type="text" name="uniquecode" class="form-control form-control-lg form-control-solid" placeholder="uniquecode" value="{{ $member->uniquecode }}" readonly>
                                                        @error('uniquecode')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Qrcode</label>
                                                        <input type="text" name="qrcode" class="form-control form-control-lg form-control-solid" placeholder="qrcode" value="{{ $member->qrcode }}" readonly>
                                                        @error('qrcode')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Barcode</label>
                                                        <input type="text" name="barcode" class="form-control form-control-lg form-control-solid" placeholder="barcode" value="{{ $member->barcode }}" readonly>
                                                        @error('barcode')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                   
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Birth Date</label>
                                                        <input type="date" name="birth_date" class="form-control form-control-lg form-control-solid" placeholder="Birth Date" value="{{ $member->birth_date }}">
                                                        @error('birth_date')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="fv-row mb-7">
                                                        <label class="fw-semibold fs-6 mb-2">Status</label>
                                                        <select name="status" class="form-select form-select-solid mb-3 mb-lg-0">
                                                            <option value="active" {{ $member->status == 'active' ? 'selected' : '' }}>Active</option>
                                                            <option value="inactive" {{ $member->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                        @error('status')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center pt-15">
                                                <button type="reset" class="btn btn-light me-3" >Discard</button>
                                                <button type="submit" class="btn btn-primary" >
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                    
                                    
                                  

                             


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
