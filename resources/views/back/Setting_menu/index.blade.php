@extends('back/layouts.layout')
@section('content')
    <style type="text/css">
        .cf:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }

        * html .cf {
            zoom: 1;
        }

        *:first-child+html .cf {
            zoom: 1;
        }

        html {
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 100%;
            margin: 0;
            padding: 1.75em;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }

        h1 {
            font-size: 1.75em;
            margin: 0 0 0.6em 0;
        }

        a {
            color: #2996cc;
        }

        a:hover {
            text-decoration: none;
        }

        p {
            line-height: 1.5em;
        }

        .small {
            color: #666;
            font-size: 0.875em;
        }

        .large {
            font-size: 1.25em;
        }

        /**
       * Nestable
       */

        .dd {
            position: relative;
            display: block;
            margin: 0;
            padding: 0;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-list {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .dd-list .dd-list {
            padding-left: 30px;
        }

        .dd-collapsed .dd-list {
            display: none;
        }

        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-handle {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-handle:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-item>button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 25px;
            height: 20px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            font-size: 12px;
            line-height: 1;
            text-align: center;
            font-weight: bold;
        }

        .dd-item>button:before {
            content: '+';
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            text-indent: 0;
        }

        .dd-item>button[data-action="collapse"]:before {
            content: '-';
        }

        .dd-placeholder,
        .dd-empty {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }

        .dd-dragel>.dd-item .dd-handle {
            margin-top: 0;
        }

        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        }

        /**
       * Nestable Extras
       */

        .nestable-lists {
            display: block;
            clear: both;
            padding: 30px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }

        #nestable-menu {
            padding: 0;
            margin: 20px 0;
        }

        #nestable-output,
        #nestable2-output {
            width: 100%;
            height: 7em;
            font-size: 0.75em;
            line-height: 1.333333em;
            font-family: Consolas, monospace;
            padding: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        #nestable2 .dd-handle {
            color: #fff;
            border: 1px solid #999;
            background: #bbb;
            background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
            background: -moz-linear-gradient(top, #bbb 0%, #999 100%);
            background: linear-gradient(top, #bbb 0%, #999 100%);
        }

        #nestable2 .dd-handle:hover {
            background: #bbb;
        }

        #nestable2 .dd-item>button:before {
            color: #fff;
        }

        @media only screen and (min-width: 700px) {

            .dd {
                padding: 1rem
            }

            .dd+.dd {
                margin-left: 2%;
            }

        }

        .dd-hover>.dd-handle {
            background: #2ea8e5 !important;
        }

        /**
       * Nestable Draggable Handles
       */

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #2ea8e5;
            background: #fff;
        }

        .dd-dragel>.dd3-item>.dd3-content {
            margin: 0;
        }

        .dd3-item>button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .dd3-handle:before {
            content: '≡';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }

        .dd3-handle:hover {
            background: #ddd;
        }

        /**
       * Socialite
       */

        .socialite {
            display: block;
            float: left;
            height: 35px;
        }
    </style>


    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        {{-- <div class="row">
              <div class="col-lg-12 margin-tb">
                  <div class="card">
                      <div class="card-body">
                          @can('product-create')
                              <a class="btn btn-success" href="{{ route("setting_menu.create") }}"> Create New Setting_menu</a>
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
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                SETTING MENU LIST</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-muted">SETTING MENU</li>
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
                                <a href="#"
                                    class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter</a>
                                <!--end::Menu toggle-->
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                    id="kt_menu_641ac41e77927">
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
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2"
                                                        checked="checked" />
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
                                            <div
                                                class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary"
                                                data-kt-menu-dismiss="true">Apply</button>
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
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_Setting_menu">
                                <i class="ki-duotone ki-plus "></i>ADD MENU</button>
                            <!--end::Primary button-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--end::Toolbar-->

                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Add task-->
                <div class="modal fade" id="kt_modal_add_Setting_menu" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <!--begin::Modal content-->
                        <div class="modal-content">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_Setting_menu_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">ADD SETTING MENU</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                                    data-kt-Setting_menus-modal-action="close">
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
                                {!! Form::open(['route' => 'setting_menu.store', 'method' => 'POST']) !!}
                                {{-- <form id="kt_modal_add_Setting_menu_form" class="form" action="#"> --}}
                                <!--begin::Scroll-->
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_Setting_menu_scroll"
                                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                    data-kt-scroll-max-height="auto"
                                    data-kt-scroll-dependencies="#kt_modal_add_Setting_menu_header"
                                    data-kt-scroll-wrappers="#kt_modal_add_Setting_menu_scroll"
                                    data-kt-scroll-offset="300px">


                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">MENU NAME</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        {!! Form::text('menu_name', null, [
                                            'placeholder' => 'MENU NAME',
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                        ]) !!}
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">MENU LABEL</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        {!! Form::text('menu_label', null, [
                                            'placeholder' => 'MENU LABEL',
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                        ]) !!}
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">MENU URL</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="menu_url"
                                            class="form-control form-control-sm form-control-solid" placeholder="menu_url"
                                            value="" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">MENU COLOR</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        {!! Form::text('menu_color', null, [
                                            'placeholder' => 'MENU COLOR',
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                        ]) !!}
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">MENU ICON</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        {!! Form::text('menu_icon', null, [
                                            'placeholder' => 'MENU ICON',
                                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                        ]) !!}
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">TYPE</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="type" aria-label="Select a type" data-placeholder="date_period"
                                            class="form-select form-select-sm form-select-solid">
                                            <option value='label'>label</option>
                                            <option value='menu'>menu</option>
                                            <option value='submenu'>submenu</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">STATUS</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="status" aria-label="Select a status"
                                            data-placeholder="date_period"
                                            class="form-select form-select-sm form-select-solid">
                                            <option value='active'>active</option>
                                            <option value='inactive'>inactive</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->

                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class=" fw-semibold fs-6 mb-2">DELETED</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="deleted" aria-label="Select a deleted"
                                            data-placeholder="date_period"
                                            class="form-select form-select-sm form-select-solid">
                                            <option value='true'>true</option>
                                            <option value='false'>false</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->


                                </div>
                                <!--end::Scroll-->
                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3"
                                        data-kt-Setting_menu-modal-action="cancel">Discard</button>
                                    <button type="submit" class="btn btn-primary"
                                        data-kt-Setting_menu-modal-action="submit">
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
                <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - add Setting_menu-->

                @foreach ($data as $key => $setting_menu)
                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Edit Setting_menu-->
                    <div class="modal fade" id="kt_modal_edit_setting_menu{{ $setting_menu->id }}" tabindex="-1"
                        aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_setting_menu_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">EDIT SETTING MENU</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                                        data-kt-setting_menus-modal-action="close">
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
                                    {{-- {!! Form::open(array("route" => "setting_menu.update","method"=>"POST")) !!} --}}
                                    {!! Form::model($setting_menu, [
                                        'method' => 'PATCH',
                                        'route' => ['setting_menu.update', $setting_menu->id],
                                        'enctype' => 'multipart/form-data',
                                    ]) !!}
                                    {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="id"
                                                class="form-control form-control-sm form-control-solid" placeholder="id"
                                                value="{{ $setting_menu->id }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU NAME</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_name', $setting_menu->menu_name, [
                                                'placeholder' => 'MENU NAME',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU LABEL</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_label', $setting_menu->menu_label, [
                                                'placeholder' => 'MENU LABEL',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU URL</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="menu_url"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="menu_url" value="{{ $setting_menu->menu_url }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU COLOR</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_color', $setting_menu->menu_color, [
                                                'placeholder' => 'MENU COLOR',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU PARENT</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="menu_parent"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="menu_parent" value="{{ $setting_menu->menu_parent }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU ICON</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_icon', $setting_menu->menu_icon, [
                                                'placeholder' => 'MENU ICON',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">TYPE</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="type" aria-label="Select a type"
                                                data-placeholder="date_period"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value='label'>label</option>
                                                <option value='menu'>menu</option>
                                                <option value='submenu'>submenu</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">ORDER</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="ord"
                                                class="form-control form-control-sm form-control-solid" placeholder="ord"
                                                value="{{ $setting_menu->ord }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">EXTENSIONTARGET</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="extensiontarget"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="extensiontarget"
                                                value="{{ $setting_menu->extensiontarget }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">STATUS</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" aria-label="Select a status"
                                                data-placeholder="date_period"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value='active'>active</option>
                                                <option value='inactive'>inactive</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">DELETED</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="deleted" aria-label="Select a deleted"
                                                data-placeholder="date_period"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value='true'>true</option>
                                                <option value='false'>false</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

                @foreach ($data as $key => $setting_menu)
                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - ShowSetting_menu-->
                    <div class="modal fade" id="kt_modal_show_setting_menu{{ $setting_menu->id }}" tabindex="-1"
                        aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header" id="kt_modal_add_setting_menu_header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">DETAIL SETTING MENU</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                                        data-kt-setting_menus-modal-action="close">
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
                                    {{-- {!! Form::open(array("route" => "setting_menu.update","method"=>"POST")) !!} --}}
                                    {!! Form::model($setting_menu, [
                                        'method' => 'PATCH',
                                        'route' => ['setting_menu.update', $setting_menu->id],
                                        'enctype' => 'multipart/form-data',
                                    ]) !!}
                                    {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                                    <!--begin::Scroll-->
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                        data-kt-scroll-max-height="auto"
                                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">ID</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="id"
                                                class="form-control form-control-sm form-control-solid" placeholder="id"
                                                value="{{ $setting_menu->id }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU NAME</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_name', $setting_menu->menu_name, [
                                                'placeholder' => 'MENU NAME',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU LABEL</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_label', $setting_menu->menu_label, [
                                                'placeholder' => 'MENU LABEL',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU URL</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="menu_url"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="menu_url" value="{{ $setting_menu->menu_url }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU COLOR</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_color', $setting_menu->menu_color, [
                                                'placeholder' => 'MENU COLOR',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU PARENT</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="menu_parent"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="menu_parent" value="{{ $setting_menu->menu_parent }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">MENU ICON</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            {!! Form::text('menu_icon', $setting_menu->menu_icon, [
                                                'placeholder' => 'MENU ICON',
                                                'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                                            ]) !!}
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">TYPE</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="type" aria-label="Select a type"
                                                data-placeholder="date_period"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value='label'>label</option>
                                                <option value='menu'>menu</option>
                                                <option value='submenu'>submenu</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">ORDER</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="order"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="order" value="{{ $setting_menu->order }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">EXTENSIONTARGET</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="extensiontarget"
                                                class="form-control form-control-sm form-control-solid"
                                                placeholder="extensiontarget"
                                                value="{{ $setting_menu->extensiontarget }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">STATUS</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" aria-label="Select a status"
                                                data-placeholder="date_period"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value='active'>active</option>
                                                <option value='inactive'>inactive</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class=" fw-semibold fs-6 mb-2">DELETED</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="deleted" aria-label="Select a deleted"
                                                data-placeholder="date_period"
                                                class="form-select form-select-sm form-select-solid">
                                                <option value='true'>true</option>
                                                <option value='false'>false</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Scroll-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3"
                                            data-kt-users-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary"
                                            data-kt-users-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                    <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Show user-->
                @endforeach

                @php
                    #GET MENU SIDEBAR FROM DATABASE

                    $res_label = DB::select('select * from setting_menu where type = "label" order by ord');

                    for ($keylabel = 0; $keylabel < count($res_label); $keylabel++) {
                        $lb = $res_label[$keylabel];
                        $array_label[$keylabel] = [];
                        $res_menu = DB::select('select * from setting_menu where menu_parent = ' . $res_label[$keylabel]->id);
                        $lmn = [];
                        for ($key = 0; $key < count($res_menu); $key++) {
                            $mn = $res_menu[$key];
                            $array_menu[$key] = [];
                            $res_submenu[$key] = DB::select('select * from setting_menu where menu_parent = ' . $res_menu[$key]->id);
                            $smn = [];
                            for ($smnkey = 0; $smnkey < count($res_submenu[$key]); $smnkey++) {
                                array_push($smn, $res_submenu[$key][$smnkey]);
                            }
                            $mn->submenu = $smn;
                        }
                        $lb->menu = $res_menu;
                        array_push($array_label[$keylabel], $res_label);
                    }
                @endphp

                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-xxl">



                        <div class="row mb-5 mb-xl-10 g-3 g-md-4 g-xl-10">



                            <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-100 mb-5 mb-xl-10"
                                    style="background-color: #F1416C;background-image:url('{{ url('template') }}/assets/media/patterns/vector-1.png')">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="text-white fs-2hx fw-bold me-2 lh-1 ls-n2">Dinamic Menu</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">The Parent Child menu
                                                widget allows you to display a navigation menu of children pages on your
                                                page based on your settings of the information system</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="cf nestable-lists">
                                        <div class="dd" id="nestable">
                                            <ol class="dd-list">
                                                @foreach ($res_label as $label)
                                                    <li class="dd-item" data-id="{{ $label->id }}">
                                                        <div class="dd-handle">{{ $label->menu_name }}</div>
                                                        <ol class="dd-list">
                                                            @foreach ($label->menu as $menu)
                                                                @if (count($menu->submenu) != null)
                                                                    <li class="dd-item" data-id="{{ $menu->id }}">
                                                                        <div class="dd-handle">{{ $menu->menu_name }}
                                                                        </div>
                                                                        <ol class="dd-list">
                                                                            @foreach ($menu->submenu as $submenu)
                                                                                <li class="dd-item"
                                                                                    data-id="{{ $submenu->id }}">
                                                                                    <div class="dd-handle">
                                                                                        {{ $submenu->menu_name }}</div>
                                                                                </li>
                                                                            @endforeach
                                                                        </ol>
                                                                    @else
                                                                    <li class="dd-item" data-id="{{ $menu->id }}">
                                                                        <div class="dd-handle">{{ $menu->menu_name }}
                                                                        </div>
                                                                    </li>
                                                                @endif

                                                    </li>
                                                @endforeach
                                            </ol>
                                            </li>
                                            @endforeach
                                        </div>
                                        <textarea class="d-none" onchange="menufunction()" id="nestable-output"></textarea>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </div>

                        </div>

                        <div class="card mb-3 d-none">
                            <div class="card-body">
                                <div class="cf nestable-lists">
                                    <div class="dd" id="nestable">
                                        <ol class="dd-list">
                                            @foreach ($res_label as $label)
                                                <li class="dd-item" data-id="{{ $label->id }}">
                                                    <div class="dd-handle">Item {{ $label->id }},
                                                        {{ $label->menu_name }}</div>
                                                    <ol class="dd-list">
                                                        @foreach ($label->menu as $menu)
                                                            @if (count($menu->submenu) != null)
                                                                <li class="dd-item" data-id="{{ $menu->id }}">
                                                                    <div class="dd-handle">Item {{ $menu->id }},
                                                                        {{ $menu->menu_name }}</div>
                                                                    <ol class="dd-list">
                                                                        @foreach ($menu->submenu as $submenu)
                                                                            <li class="dd-item"
                                                                                data-id="{{ $submenu->id }}">
                                                                                <div class="dd-handle">Item
                                                                                    {{ $submenu->id }},
                                                                                    {{ $submenu->menu_name }}</div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                @else
                                                                <li class="dd-item" data-id="{{ $menu->id }}">
                                                                    <div class="dd-handle">Item {{ $menu->id }},
                                                                        {{ $menu->menu_name }}</div>
                                                                </li>
                                                            @endif

                                                </li>
                                            @endforeach
                                        </ol>
                                        </li>
                                        @endforeach
                                    </div>
                                    <textarea class="d-none" onchange="menufunction()" id="nestable-output"></textarea>
                                </div>



                                <div class="row d-none">
                                    {{-- <div class="col-lg-6">RGR</div> --}}
                                    <div class="col-lg-6 ms-auto">

                                        <div class="cf nestable-lists border-0">

                                            <div id="nestable">
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="1">
                                                        <div class="dd-handle">Itedfewferergdm 1</div>
                                                    </li>
                                                    <li class="dd-item" data-id="2">
                                                        <div class="dd-handle">Item 2</div>
                                                        <ol class="dd-list">
                                                            <li class="dd-item" data-id="3">
                                                                <div class="dd-handle">Item 3</div>
                                                            </li>
                                                            <li class="dd-item" data-id="4">
                                                                <div class="dd-handle">Item 4</div>
                                                            </li>
                                                            <li class="dd-item" data-id="5">
                                                                <div class="dd-handle">Item 5</div>
                                                                <ol class="dd-list">
                                                                    <li class="dd-item" data-id="6">
                                                                        <div class="dd-handle">Item 6</div>
                                                                    </li>
                                                                    <li class="dd-item" data-id="7">
                                                                        <div class="dd-handle">Item 7</div>
                                                                    </li>
                                                                    <li class="dd-item" data-id="8">
                                                                        <div class="dd-handle">Item 8</div>
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                            <li class="dd-item" data-id="9">
                                                                <div class="dd-handle">Item 9</div>
                                                            </li>
                                                            <li class="dd-item" data-id="10">
                                                                <div class="dd-handle">Item 10</div>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                    <li class="dd-item" data-id="11">
                                                        <div class="dd-handle">Item 11</div>
                                                    </li>
                                                    <li class="dd-item" data-id="12">
                                                        <div class="dd-handle">Item 12</div>
                                                    </li>
                                                </ol>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>



                        <!--begin::Card-->
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="datatable-buttons"
                                        class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="min-w-50px sorting">NO</th>
                                                <td class="min-w-125px sorting">Action</th>
                                                <th class="min-w-125px sorting">Menu Name</th>
                                                <th class="min-w-125px sorting">Menu Label</th>
                                                <th class="min-w-125px sorting">Menu Url</th>
                                                <th class="min-w-125px sorting">Menu Color</th>
                                                <th class="min-w-125px sorting">Menu Parent</th>
                                                <th class="min-w-125px sorting">Menu Icon</th>
                                                <th class="min-w-125px sorting">Type</th>
                                                <th class="min-w-125px sorting">Order</th>
                                                <th class="min-w-125px sorting">Extensiontarget</th>
                                                <th class="min-w-125px sorting">Status</th>
                                                <th class="min-w-125px sorting">Deleted</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $setting_menu)
                                                <tr>
                                                    <td style="color:rgba(80, 74, 74, 0.333)"
                                                        class=" align-items-center text-center"> <a
                                                            href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ ++$i }}</a>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">Actions
                                                            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_show_setting_menu{{ $setting_menu->id }}">Show</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a class="menu-link px-3" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_edit_setting_menu{{ $setting_menu->id }}">Edit</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                {!! Form::open([
                                                                    'id' => 'form-id',
                                                                    'method' => 'DELETE',
                                                                    'route' => ['setting_menu.destroy', $setting_menu->id],
                                                                    'style' => 'display:inline',
                                                                ]) !!}
                                                                {{-- {!! Form::submit("Delete", ["class" => "menu-link px-3"]) !!}  --}}
                                                                <a onclick="document.getElementById('form-id').submit();"
                                                                    class="menu-link px-3"
                                                                    data-kt-setting_menus-table-filter="delete_row">
                                                                    Delete</a>
                                                                {!! Form::close() !!}

                                                            </div>
                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->

                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->menu_name }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->menu_label }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->menu_url }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->menu_color }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->menu_parent }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->menu_icon }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->type }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->order }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->extensiontarget }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->status }}</a>
                                                    </td>
                                                    <td><a href="{{ route('setting_menu.show', $setting_menu->id) }}"
                                                            class="text-gray-800 text-hover-primary mb-1">{{ $setting_menu->deleted }}</a>
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
