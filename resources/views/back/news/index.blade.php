@extends('back/layouts.layout')
@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    {{-- <div class="row">
      <div class="col-lg-12 margin-tb">
          <div class="card">
              <div class="card-body">
                  @can('product-create')
                      <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                  @endcan

              </div>
          </div>
      </div>
  </div> --}}

  <!--begin::Main-->
  <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
      <!--begin::Toolbar-->
      <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
          <!--begin::Page title-->
          <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Users List</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
              <!--begin::Item-->
              <li class="breadcrumb-item text-muted">
                <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="breadcrumb-item text-muted">User Management</li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="breadcrumb-item text-muted">Users</li>
              <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->
          <!--begin::Actions-->
          <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="m-0">
              <!--begin::Menu toggle-->
              <a href="#" class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
              <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                <span class="path1"></span>
                <span class="path2"></span>
              </i>Filter</a>
              <!--end::Menu toggle-->
              <!--begin::Menu 1-->
              <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac41e77927">
                <!--begin::Header-->
                <div class="px-7 py-5">
                  <div class="fs-5 text-dark fw-bold">Filter Options</div>
                </div>
                <!--end::Header-->
                <!--begin::Menu separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Menu separator-->
                <!--begin::Form-->
                <div class="px-7 py-5">
                  <!--begin::Input group-->
                  <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label fw-semibold">Status:</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <div>
                      <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac41e77927" data-allow-clear="true">
                        <option></option>
                        <option value="1">Approved</option>
                        <option value="2">Pending</option>
                        <option value="2">In Process</option>
                        <option value="2">Rejected</option>
                      </select>
                    </div>
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label fw-semibold">Member Type:</label>
                    <!--end::Label-->
                    <!--begin::Options-->
                    <div class="d-flex">
                      <!--begin::Options-->
                      <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                        <input class="form-check-input" type="checkbox" value="1" />
                        <span class="form-check-label">Author</span>
                      </label>
                      <!--end::Options-->
                      <!--begin::Options-->
                      <label class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                        <span class="form-check-label">Customer</span>
                      </label>
                      <!--end::Options-->
                    </div>
                    <!--end::Options-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="mb-10">
                    <!--begin::Label-->
                    <label class="form-label fw-semibold">Notifications:</label>
                    <!--end::Label-->
                    <!--begin::Switch-->
                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                      <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                      <label class="form-check-label">Enabled</label>
                    </div>
                    <!--end::Switch-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Actions-->
                  <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                  </div>
                  <!--end::Actions-->
                </div>
                <!--end::Form-->
              </div>
              <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->
            <!--begin::Secondary button-->
            <!--end::Secondary button-->
            <!--begin::Primary button-->
            {{-- <a href="#" class="btn btn-sm fw-bold btn-info" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a> --}}
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
              <i class="ki-duotone ki-plus "></i>Add User</button>
            <!--end::Primary button-->
          </div>
          <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
      </div>
      <!--end::Toolbar-->





      <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Add task-->
      <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
          <!--begin::Modal content-->
          <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
              <!--begin::Modal title-->
              <h2 class="fw-bold">Add User</h2>
              <!--end::Modal title-->
              <!--begin::Close-->
              <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-users-modal-action="close">
                <i class="ki-duotone ki-cross fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </div>
              <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
              <!--begin::Form-->
              {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
              {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                    <!--end::Image placeholder-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                      <!--begin::Preview existing avatar-->
                      <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg);"></div>
                      <!--end::Preview existing avatar-->
                      <!--begin::Label-->
                      <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="ki-duotone ki-pencil fs-7">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                        <!--begin::Inputs-->
                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                        <!--end::Inputs-->
                      </label>
                      <!--end::Label-->
                      <!--begin::Cancel-->
                      <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="ki-duotone ki-cross fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </span>
                      <!--end::Cancel-->
                      <!--begin::Remove-->
                      <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <i class="ki-duotone ki-cross fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </span>
                      <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                    <!--end::Hint-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    {!! Form::text('name', null, array('placeholder' => 'Full Name','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                    {{-- <input type="text" name="user_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name" value="Emma Smith" /> --}}
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                    {{-- <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="smith@kpmg.com" /> --}}
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Password</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                   
                    {{-- <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="smith@kpmg.com" /> --}}
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                      <!--begin::Label-->
                      <label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                      {{-- <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="smith@kpmg.com" /> --}}
                      <!--end::Input-->
                    </div>
                    <!--end::Input group-->


                  <!--begin::Input group-->
                  <div class="mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                    <!--end::Label-->
                    <!--begin::Roles-->
                    @foreach ($roles as $role)
                    <!--begin::Input row-->
                    <div class="d-flex fv-row">
                      <!--begin::Radio-->
                      <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="roles[]" type="radio" value={{ $role }} id="kt_modal_update_role_option_{{ $loop->index }}" {{ $loop->index==1 ? "checked='checked'" : "" }} />
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_{{ $loop->index }}">
                          <div class="fw-bold text-gray-800">{{ $role }}</div>
                          <div class="text-gray-600">Best for business owners and company administrators</div>
                        </label>
                        <!--end::Label-->
                      </div>
                      <!--end::Radio-->
                    </div>
                    <!--end::Input row-->
                     <div class='separator separator-dashed my-5'></div>
                    @endforeach
                    <!--end::Roles-->
                  </div>
                  <!--end::Input group-->
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                  <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                  <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                  </button>
                </div>
                <!--end::Actions-->
                {!! Form::close() !!}
              <!--end::Form-->
            </div>
            <!--end::Modal body-->
          </div>
          <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
      </div>
      <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Edit user-->


      
      @foreach ($data as $key => $user)
      <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Edit user-->
      <div class="modal fade" id="kt_modal_edit_user{{ $user->id }}" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
          <!--begin::Modal content-->
          <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_user_header">
              <!--begin::Modal title-->
              <h2 class="fw-bold">Edit User</h2>
              <!--end::Modal title-->
              <!--begin::Close-->
              <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-users-modal-action="close">
                <i class="ki-duotone ki-cross fs-1">
                  <span class="path1"></span>
                  <span class="path2"></span>
                </i>
              </div>
              <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
              <!--begin::Form-->
              {{-- {!! Form::open(array('route' => 'users.update','method'=>'POST')) !!} --}}
              {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], "enctype"=>"multipart/form-data"]) !!}
              {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
                    <!--end::Image placeholder-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                      <!--begin::Preview existing avatar-->
                      @if (!empty($user->image))
                      <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ url('images') }}/users/{{ $user->image }});"></div>
                                      {{-- <img src="{{ url('images') }}/users/{{ $user->image }}" alt="Emma Smith" class="w-100" /> --}}
                                    @else
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ url('images') }}/imagenotavailable.jpg);"></div>
                                      {{-- <img src="{{ url('images') }}/imagenotavailable.jpg" alt="Emma Smith" class="w-100" /> --}}
                                    @endif
                     
                      <!--end::Preview existing avatar-->
                      <!--begin::Label-->
                      <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="ki-duotone ki-pencil fs-7">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                        <!--begin::Inputs-->
                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                        <!--end::Inputs-->
                      </label>
                      <!--end::Label-->
                      <!--begin::Cancel-->
                      <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="ki-duotone ki-cross fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </span>
                      <!--end::Cancel-->
                      <!--begin::Remove-->
                      <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <i class="ki-duotone ki-cross fs-2">
                          <span class="path1"></span>
                          <span class="path2"></span>
                        </i>
                      </span>
                      <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                    <!--end::Hint-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    {!! Form::text('name', $user->name, array('placeholder' => 'Full Name','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    {!! Form::text('email', $user->email, array('placeholder' => 'Email','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->
                  <!--begin::Input group-->
                  <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Password</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                    <!--end::Input-->
                  </div>
                  <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                      <!--begin::Label-->
                      <label class="required fw-semibold fs-6 mb-2">Confirm Password</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control form-control-solid mb-3 mb-lg-0')) !!}
                      {{-- <input type="email" name="user_email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com" value="smith@kpmg.com" /> --}}
                      <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                  <!--begin::Input group-->
                  <div class="mb-7">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                    <!--end::Label-->
                    <!--begin::Roles-->
                    @foreach ($roles as $role)
                    <!--begin::Input row-->
                    <div class="d-flex fv-row">
                      <!--begin::Radio-->
                      <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="roles[]" type="radio" value={{ $role }} id="kt_modal_update_role_option_{{ $loop->index }}" {{ $role==(array_search($role,$user->roles->pluck('name','name')->all())) ? "checked='checked'" : "" }} />
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_{{ $loop->index }}">
                          <div class="fw-bold text-gray-800">{{ $role }}</div>
                          <div class="text-gray-600">Best for business owners and company administrators</div>
                        </label>
                        <!--end::Label-->
                      </div>
                      <!--end::Radio-->
                    </div>
                    <!--end::Input row-->
                     <div class='separator separator-dashed my-5'></div>
                    @endforeach
                    <!--end::Roles-->
                  </div>
                  <!--end::Input group-->
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                  <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
                  <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                  </button>
                </div>
                <!--end::Actions-->
                {!! Form::close() !!}
              <!--end::Form-->
            </div>
            <!--end::Modal body-->
          </div>
          <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
      </div>
      <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Edit user-->
      @endforeach


      <!--begin::Content-->
      <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
          <!--begin::Card-->
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                  <table id="datatable-buttons" class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                      style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead>
                          <tr>
                              <th class="min-w-50px sorting">NO</th>
                              <th class="min-w-125px sorting">USER</th>
                              <th class="min-w-125px sorting">EMAIL</th>
                              <th class="min-w-125px sorting">PHONE</th>
                              <th class="min-w-125px sorting">CREATED AT</th>
                              <th class="text-end min-w-100px sorting_disabled">ACTION</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($data as $key => $user)
                              <tr>
                                  <td style="color:rgba(80, 74, 74, 0.333)" class=" align-items-center text-center"> <a href="{{ route('users.show',$user->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ ++$i }}</a></td>
                                 
                                  <td class="d-flex align-items-center">
                                    {{-- <a href="{{ route('users.show',$user->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a> --}}

                                    <!--begin:: Avatar -->
															<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
																<a href="{{ route('users.show',$user->id) }}">
																	<div class="symbol-label">
                                    @if (!empty($user->image))
                                      <img src="{{ url('images') }}/users/{{ $user->image }}" alt="Emma Smith" class="w-100" />
                                    @else
                                      <img src="{{ url('images') }}/imagenotavailable.jpg" alt="Emma Smith" class="w-100" />
                                    @endif
																		
																	</div>
																</a>
															</div>
															<!--end::Avatar-->
															<!--begin::User details-->
															<div class="d-flex flex-column">
																<a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                 @if(!empty($user->getRoleNames()))
                                      @foreach($user->getRoleNames() as $v)
                                         {{-- <label class="badge badge-primary"> --}}
                                          <div class="badge badge-light-success fw-bold">{{ $v }}</div>
                                      {{-- </label> --}}
                                      @endforeach
                                    @endif
															
															</div>
															<!--begin::User details-->

                                  </td>
                                  <td><div class="badge badge-light fw-bold">{{ $user->email }}</div></td>
                                  <td>
                                    @if(!empty($user->phone))
                                    <a href="{{ route('users.show',$user->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user->phone }}</a>
                                   
                                    @else
                                    <span class="badge badge-danger fw-bold">Not Found</span>
                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{ route('users.show',$user->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ $user->created_at }}</a>
                                   
                                  </td>
                                  <td class="text-end">

                                    <a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                      <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                      <!--begin::Menu-->
                                      <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                          <a class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_user{{ $user->id }}">Edit</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                          {!! Form::open(['id' =>'form-id','method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                          {{-- {!! Form::submit('Delete', ['class' => 'menu-link px-3']) !!}  --}}
                                          <a onclick="document.getElementById('form-id').submit();" class="menu-link px-3" data-kt-users-table-filter="delete_row"> Delete</a>
                                          {!! Form::close() !!} 
                                         
                                        </div>
                                        <!--end::Menu item-->
                                      </div>
                                      <!--end::Menu-->

                                  </td>
                              </tr>
                          @endforeach

                      </tbody>
                  </table>
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