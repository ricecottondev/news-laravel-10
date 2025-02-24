@extends('back/layouts.layout')
@section('content')
    <div class="d-flex flex-column flex-column-fluid">      
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                CLAIM UNIQUECODE MEMBER ({{ $resmember[0]->email }}) LIST</h1>
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="{{ url('') }}" class="text-muted text-hover-primary">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                </li>
                                <li class="breadcrumb-item text-muted">LOG UNIQUECODE MEMBER</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                           
                            <a class="btn btn-sm btn-primary" href="{{ route('logclaimuniquecodemember.create',['idmember' => $idmember]) }}">
                                <i class="ki-duotone ki-plus "></i>Add Uniquecode Member</a>
                        </div>
                    </div>
                </div>

                
                <div id="kt_app_content" class="app-content flex-column-fluid">                    
                    <div id="kt_app_content_container" class="app-container container-xxl">                        
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="datatable-buttons"
                                        class="table align-middle table-striped  table-row-dashed fs-6 gy-5 dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="min-w-50px sorting">NO</th>
                                                <th class="min-w-125px sorting">Kode Uniquecode</th>
                                                <th class="min-w-125px sorting">point</th>
                                                
                                                
                                                <th class="min-w-125px sorting">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            @foreach ($reslogclaimuniquecode  as $key => $claim_uniquecode)
                                                <tr>
                                                    <td style="color:rgba(80, 74, 74, 0.333)"
                                                        class=" align-items-center text-center"> {{ ++$i }}
                                                    </td>
                                                    <td>{{ $claim_uniquecode->id_uniquecode  }}
                                                                                                               
                                                    </td>
                                                    <td>{{ $claim_uniquecode->point  }}
                                                    </td>
                                                   
                                 
                                                    <td>
                                                      <a href="#"
                                                          class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                          data-kt-menu-trigger="click"
                                                          data-kt-menu-placement="bottom-end">Actions
                                                          <i class="ki-duotone ki-down fs-5 ms-1"></i></a>                                                     
                                                      <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-225px py-4"
                                                          data-kt-menu="true">

                                                         
                                                        <div class="menu-item px-3">
                                                            <a class="menu-link px-3" href="{{ url('logclaimvouchermember')."/".$claim_uniquecode->id_uniquecode }}">Log Claim Voucher</a>
                                                        </div>

                                                          <div class="menu-item px-3">
                                                              <a class="menu-link px-3" data-bs-toggle="modal"
                                                                  data-bs-target="#kt_modal_show_onepoint_member{{ $claim_uniquecode->id_uniquecode }}">Show</a>
                                                          </div>

                                                          <div class="menu-item px-3">
                                                              <a class="menu-link px-3" data-bs-toggle="modal"
                                                                  data-bs-target="#kt_modal_edit_onepoint_member{{ $claim_uniquecode->id_uniquecode }}">Edit</a>
                                                          </div>

                                                          <div class="menu-item px-3">
                                                              {!! Form::open([
                                                                  'id' => 'form-id_' . $claim_uniquecode->id_uniquecode,
                                                                  'method' => 'DELETE',
                                                                  'route' => ['onepoint_member.destroy', $claim_uniquecode->id_uniquecode],
                                                                  'style' => 'display:inline',
                                                              ]) !!}
                                                              <a onclick="document.getElementById('form-id_{{ $claim_uniquecode->id_uniquecode }}').submit();"
                                                                  class="menu-link px-3"
                                                                  data-kt-users-table-filter="delete_row"> Delete</a>
                                                              {!! Form::close() !!}
                                                          </div>                                                           
                                                      </div>
                                                   

                                                  </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>                        
                    </div>                    
                </div>                
            </div>            

        </div>        


    </div>    
@endsection

