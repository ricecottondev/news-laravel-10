@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">      
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                MEMBER LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">MEMBER</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <div class="m-0">
                                <a href="#"
                                    class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter</a>
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_641ac41e77927">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Status:</label>
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true"
                                                    data-placeholder="Select option"
                                                    data-dropdown-parent="#kt_menu_641ac41e77927" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Member Type:</label>
                                            <div class="d-flex">
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-semibold">Notifications:</label>
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_Onepoint_member">
                                <i class="ki-duotone ki-plus "></i>Add MEMBER</button>
                        </div>
                    </div>
                </div>

                
                <div id="kt_app_content" class="app-content flex-column-fluid">                    
                    <div id="kt_app_content_container" class="app-container container-xxl">                        
                        <div class="card">
                            <div class="card-body">

                                {!! Form::open(array('route' => 'logclaimvouchermember.store','method'=>'POST')) !!}

                                <div class="row">
                                
                                    <input type="hidden" name="idmember" value="{{ $idmember }}">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>id_member : </strong>
                                                {!! Form::text('id_member',$idmember,array('placeholder' => 'id_member', 'class' => 'form-control')) !!}
                                            </div>
                                        </div>

                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>kode_voucher : </strong>
                                                <select name="kode_voucher" id="kode_voucher">
                                                    @foreach ($resvoucher as $voucher)
                                                    <option value="{{ $voucher->kode_voucher }}">{{ $voucher->kode_voucher }}</option>
                                                    @endforeach
                                                   
                                                </select>
                                                {!! Form::text('kode_voucher',null,array('placeholder' => 'kode_voucher', 'class' => 'form-control')) !!}
                                            </div>
                                        </div>

                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>status : </strong>
                                                <select name="status" id="status">
                                                    <option value="active">active</option>
                                                    <option value="inactive">inactive</option>
                                                </select>
                                                {{-- {!! Form::text('status',null,array('placeholder' => 'status', 'class' => 'form-control')) !!} --}}
                                            </div>
                                        </div>

                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>deleted : </strong>
                                                <select name="deleted" id="deleted">
                                                    <option value="false">false</option>
                                                    <option value="true">true</option>
                                                </select>
                                                {{-- {!! Form::text('deleted',null,array('placeholder' => 'deleted', 'class' => 'form-control')) !!} --}}
                                            </div>
                                        </div>

                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>flag_used : </strong>
                                                <select name="flag_used" id="flag_used">
                                                    <option value="false">false</option>
                                                    <option value="true">false</option>
                                                </select>
                                                {{-- {!! Form::text('flag_used',null,array('placeholder' => 'flag_used', 'class' => 'form-control')) !!} --}}
                                            </div>
                                        </div>

                                    
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>used_at : </strong>
                                                {!! Form::text('used_at',null,array('placeholder' => 'used_at', 'class' => 'form-control')) !!}
                                            </div>
                                        </div>  

                                
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                
                                    </div>
                                
                                </div>
                                
                                {!! Form::close() !!}

                            </div>

                        </div>                        
                    </div>                    
                </div>                
            </div>            

        </div>        


    </div>    
@endsection

