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
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
          <!--begin::Page title-->
          <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">CRUD BUILDER</h1>
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
              <li class="breadcrumb-item text-muted">Setting</li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
              </li>
              <!--end::Item-->
              <!--begin::Item-->
              <li class="breadcrumb-item text-muted">Web</li>
              <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page title-->
         
        </div>
        <!--end::Toolbar container-->
      </div>
      <!--end::Toolbar-->







      <!--begin::Content-->
      <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
          <!--begin::Card-->
          <div class="card">
            <div class="card-body">
             

            {!! Form::open(array('route' => 'crud.index','method'=>'POST')) !!}
            @csrf
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4">

                  {{-- menu item --}}
                  <div class="row mb-3">
                    <div class="col-4">
                      <strong class="me-3 w-25">Table:</strong>
                    </div>
                    <div class="col-8">
                      <select class="form-select form-select-solid w-100" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" name="table" onchange="this.form.submit()">
                        <option></option>  
                        @foreach ($res_tables as $table)
                              <option value="{{$table->table_name}}" {{$table->table_name==$tabel ? "selected" : ""}}>{{$table->table_name}} </option>
                          @endforeach
                      </select>
                    </div>
                  </div>
            {!! Form::close() !!}

            {!! Form::open(array('route' => 'crud.index','method'=>'POST')) !!}
                  {{-- menu item --}}
                  <div class="row mb-3">
                    <div class="col-4">
                      <strong class="me-3 w-25">Subject:</strong>
                      <br><i class="fs-9">the subject of crud</i>
                    </div>
                    <div class="col-8">
                      <input name="subject" class="form-control form-control-solid w-100" type="text" value="{{ strtoupper(str_replace("_"," ",$tabel)) }}">
                    </div>
                  </div>

                  {{-- menu item --}}
                  <div class="row mb-3">
                    <div class="col-4">
                      <strong class="me-3 w-25">Label:</strong>
                    </div>
                    <div class="col-8">
                      <input name="label" class="form-control form-control-solid w-100" type="text" value="{{ strtoupper(str_replace("_"," ",$tabel)) }}">
                    </div>
                  </div>

                </div>
            </div>
           

            @if (count($res_field)!=0)
            <div class="table-responsive">
                <table class="table align-middle table-striped table-bordered table-row-dashed">
                  <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;"><strong>FIELD</strong></th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;"><strong>LABEL</strong></th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;"><strong>TYPE 
                          <button type="button" class="btn p-0"
                          data-bs-toggle="tooltip" data-bs-placement="top"
                          data-bs-custom-class="custom-tooltip"
                          data-bs-title="This feature underconstructions">
                            <i class="txt text-danger bi bi-exclamation-circle-fill"></i>
                          </button></strong>
                        </th>
                        <th colspan="4" style="text-align: center;"><strong>SHOW ON</strong></th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">
                          <strong>VALIDATIONS</strong>
                          <button type="button" class="btn p-0"
                          data-bs-toggle="tooltip" data-bs-placement="top"
                          data-bs-custom-class="custom-tooltip"
                          data-bs-title="This feature underconstructions">
                            <i class="txt text-danger bi bi-exclamation-circle-fill"></i>
                          </button>
                          <br><i class="fs-9">required, bla bla</i>
                        </th>
                      
                    </tr>
                    <tr>
                      <th><strong>COLUMN LIST</strong></th>
                      <th><strong>ADD FORMS</strong></th>
                      <th><strong>EDIT FORMS</strong></th>
                      <th><strong>SHOW PAGES</strong></th>
                    
                  </tr>
                  </thead>
                
                    @foreach ($res_field as $field)
                    <tr>
                        <td>{{$field->Field}} 
                          <div class="badge badge-light-success fw-bold">{{$field->Type}}</div>
                        </td>
                        <td> 
                          <input name="{{$field->Field.'_field_label'}}" class="form-control form-control-solid w-100" type="text" value="{{strtoupper(str_replace("_"," ",$field->Field))}}">
                        </td>
                        <td>                         
                          <select class="form-select form-select-solid" name="{{$field->Field.'_type'}}"  data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option value="text">Text</option>
                            <option value = "checkbox">checkbox</option>
                            <option value = "color">color</option>
                            <option value = "date">date</option>
                            <option value = "datetime-local">datetime-local</option>
                            <option value = "email">email</option>
                            <option value = "file" {{ $field->Field=='file'? "selected" : "" }}>file</option>
                            <option value = "hidden">hidden</option>
                            <option value = "image" {{ $field->Field=='image'? "selected" : "" }}>image</option>
                            <option value = "month">month</option>
                            <option value = "number" {{ str_contains($field->Type,'int') ? "selected" : "" }}>number</option>
                            <option value = "password">password</option>
                            <option value = "radio">radio</option>
                            <option value = "range">range</option>
                            <option value = "reset">reset</option>
                            <option value = "search">search</option>
                            <option value = "submit">submit</option>
                            <option value = "tel">tel</option>
                            <option value = "text">text</option>
                            <option value = "time">time</option>
                            <option value = "url">url</option>
                            <option value = "week">week</option>
                            
                          </select>
                        </td>
                        <td>
                          @if (strtoupper($field->Type)=='TEXT' || str_contains($field->Type,'int'))
                          <input type="checkbox" name="{{ $field->Field.'_show_column_list' }}" >
                          @else
                          <input type="checkbox" checked name="{{ $field->Field.'_show_column_list' }}" >
                          @endif
                         
                        </td>
                        <td><input type="checkbox" checked name="{{ $field->Field.'_show_add_forms' }}" ></td>
                        <td><input type="checkbox" checked name="{{ $field->Field.'_show_edit_forms' }}" ></td>
                        <td><input type="checkbox" checked name="{{ $field->Field.'_show_show_pages' }}" ></td>
                        <td> <input name="{{$field->Field.'_validation'}}" class="form-control form-control-solid w-100" type="text" value=""></td>
                      
                    </tr>
                    @endforeach
                </table>
            </div>
               
                <br>
                <input name = "name_mvc" type="hidden" value={{$tabel}}>
                <button class="btn btn-primary" name="set_mvc" type="submit">Create MVC</button>
                {!! Form::close() !!}

            @endif
            <code><p class="text text-dark mb-3 mt-2"><b>Message :</b>{!!$message!!}</p></code>
            
            <p> <a href="{{ url($tabel) }}">Click Here to Open Route {{ $tabel }}</a></p>
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


<script>
 var res_field = @json($res_field);
   console.log(res_field);
 
</script>


@endsection

