
        @extends("back/layouts.layout")
        @section("content")
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            {{-- <div class="row">
              <div class="col-lg-12 margin-tb">
                  <div class="card">
                      <div class="card-body">
                          @can("product-create")
                              <a class="btn btn-success" href="{{ route("pos_products.create") }}"> Create New Pos_products</a>
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">POS PRODUCTS LIST</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                      <!--begin::Item-->
                      <li class="breadcrumb-item text-muted">
                        <a href="{{url("")}}" class="text-muted text-hover-primary">Home</a>
                      </li>
                      <!--end::Item-->
                      <!--begin::Item-->
                      <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                      </li>
                      <!--end::Item-->
                      <!--begin::Item-->
                      <li class="breadcrumb-item text-muted">POS PRODUCTS</li>
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
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Pos_products">
                      <i class="ki-duotone ki-plus "></i>Add POS PRODUCTS</button>
                    <!--end::Primary button-->
                  </div>
                  <!--end::Actions-->
                </div>
                <!--end::Toolbar container-->
              </div>
              <!--end::Toolbar-->
        
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Add task-->
              <div class="modal fade" id="kt_modal_add_Pos_products" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_Pos_products_header">
                      <!--begin::Modal title-->
                      <h2 class="fw-bold">ADD POS PRODUCTS</h2>
                      <!--end::Modal title-->
                      <!--begin::Close-->
                      <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-Pos_productss-modal-action="close">
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
                      {!! Form::open(array("route" => "pos_products.store","method"=>"POST","enctype"=>"multipart/form-data")) !!}
                      {{-- <form id="kt_modal_add_Pos_products_form" class="form" action="#"> --}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_Pos_products_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_Pos_products_header" data-kt-scroll-wrappers="#kt_modal_add_Pos_products_scroll" data-kt-scroll-offset="300px">
                         
                          
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fw-semibold fs-6 mb-2">ID BRAND</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="number" name="id_brand" class="form-control form-control-sm form-control-solid" placeholder="id_brand"  />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fw-semibold fs-6 mb-2">ID CATEGORY</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="number" name="id_category" class="form-control form-control-sm form-control-solid" placeholder="id_category"  />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fw-semibold fs-6 mb-2">ID SUB CATEGORY</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="number" name="id_sub_category" class="form-control form-control-sm form-control-solid" placeholder="id_sub_category"  />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">VARIANT</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("variant", null, array("placeholder" => "VARIANT","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">NAME</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("name", null, array("placeholder" => "NAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">DESCRIPTION</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="description" class="form-control form-control-sm form-control-solid" placeholder="description" value="" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">PORTION</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="portion" aria-label="Select a portion" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
														<option value='solo'>solo</option><option value='doppio'>doppio</option><option value='s'>s</option><option value='m'>m</option><option value='l'>l</option>
								</select>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fw-semibold fs-6 mb-2">PRICE</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="number" name="price" class="form-control form-control-sm form-control-solid" placeholder="price"  />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                  <!--begin::Label-->
                  <label class=" fw-semibold fs-6 mb-2">STOCK</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="number" name="stock" class="form-control form-control-sm form-control-solid" placeholder="stock"  />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">UNITS</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("units", null, array("placeholder" => "UNITS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">FILEIMAGES</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("fileimages", null, array("placeholder" => "FILEIMAGES","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
                         
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                          <button type="reset" class="btn btn-light me-3" data-kt-Pos_products-modal-action="cancel">Discard</button>
                          <button type="submit" class="btn btn-primary" data-kt-Pos_products-modal-action="submit">
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
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - add Pos_products-->
      
              @foreach ($data as $key => $pos_products)
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Edit Pos_products-->
              <div class="modal fade" id="kt_modal_edit_pos_products{{ $pos_products->id }}" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_pos_products_header">
                      <!--begin::Modal title-->
                      <h2 class="fw-bold">EDIT POS PRODUCTS</h2>
                      <!--end::Modal title-->
                      <!--begin::Close-->
                      <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-pos_productss-modal-action="close">
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
                      {{-- {!! Form::open(array("route" => "pos_products.update","method"=>"POST")) !!} --}}
                      {!! Form::model($pos_products, ["method" => "PATCH","route" => ["pos_products.update", $pos_products->id], "enctype"=>"multipart/form-data"]) !!}
                      {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">VARIANT</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("variant", $pos_products->variant, array("placeholder" => "VARIANT","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">NAME</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("name", $pos_products->name, array("placeholder" => "NAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">DESCRIPTION</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="description" class="form-control form-control-sm form-control-solid" placeholder="description" value="{{$pos_products->description}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">PORTION</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="portion" aria-label="Select a portion" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
														<option value='solo'>solo</option><option value='doppio'>doppio</option><option value='s'>s</option><option value='m'>m</option><option value='l'>l</option>
								</select>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">UNITS</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("units", $pos_products->units, array("placeholder" => "UNITS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">FILEIMAGES</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("fileimages", $pos_products->fileimages, array("placeholder" => "FILEIMAGES","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">STATUS</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("status", $pos_products->status, array("placeholder" => "STATUS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
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

              @foreach ($data as $key => $pos_products)
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - ShowPos_products-->
              <div class="modal fade" id="kt_modal_show_pos_products{{ $pos_products->id }}" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                  <!--begin::Modal content-->
                  <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header" id="kt_modal_add_pos_products_header">
                      <!--begin::Modal title-->
                      <h2 class="fw-bold">DETAIL POS PRODUCTS</h2>
                      <!--end::Modal title-->
                      <!--begin::Close-->
                      <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-pos_productss-modal-action="close">
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
                      {{-- {!! Form::open(array("route" => "pos_products.update","method"=>"POST")) !!} --}}
                      {!! Form::model($pos_products, ["method" => "PATCH","route" => ["pos_products.update", $pos_products->id], "enctype"=>"multipart/form-data"]) !!}
                      {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                        
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="id" class="form-control form-control-sm form-control-solid" placeholder="id" value="{{$pos_products->id}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID BRAND</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="id_brand" class="form-control form-control-sm form-control-solid" placeholder="id_brand" value="{{$pos_products->id_brand}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID CATEGORY</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="id_category" class="form-control form-control-sm form-control-solid" placeholder="id_category" value="{{$pos_products->id_category}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">ID SUB CATEGORY</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="id_sub_category" class="form-control form-control-sm form-control-solid" placeholder="id_sub_category" value="{{$pos_products->id_sub_category}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">VARIANT</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("variant", $pos_products->variant, array("placeholder" => "VARIANT","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">NAME</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("name", $pos_products->name, array("placeholder" => "NAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">DESCRIPTION</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="description" class="form-control form-control-sm form-control-solid" placeholder="description" value="{{$pos_products->description}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">PORTION</label>
                <!--end::Label-->
                <!--begin::Input-->
                <select name="portion" aria-label="Select a portion" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
														<option value='solo'>solo</option><option value='doppio'>doppio</option><option value='s'>s</option><option value='m'>m</option><option value='l'>l</option>
								</select>
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">PRICE</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="price" class="form-control form-control-sm form-control-solid" placeholder="price" value="{{$pos_products->price}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">STOCK</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="number" name="stock" class="form-control form-control-sm form-control-solid" placeholder="stock" value="{{$pos_products->stock}}" />
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">UNITS</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("units", $pos_products->units, array("placeholder" => "UNITS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">FILEIMAGES</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("fileimages", $pos_products->fileimages, array("placeholder" => "FILEIMAGES","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
              </div>
              <!--end::Input group-->
              
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class=" fw-semibold fs-6 mb-2">STATUS</label>
                <!--end::Label-->
                <!--begin::Input-->
                {!! Form::text("status", $pos_products->status, array("placeholder" => "STATUS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
                <!--end::Input-->
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
              <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Show user-->
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
      <th class="min-w-125px sorting">Id Brand</th><th class="min-w-125px sorting">Id Category</th><th class="min-w-125px sorting">Id Sub Category</th><th class="min-w-125px sorting">Variant</th><th class="min-w-125px sorting">Name</th><th class="min-w-125px sorting">Portion</th><th class="min-w-125px sorting">Price</th><th class="min-w-125px sorting">Stock</th><th class="min-w-125px sorting">Units</th><th class="min-w-125px sorting">Fileimages</th>
           
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $pos_products)
                <tr>
                    <td style="color:rgba(80, 74, 74, 0.333)" class=" align-items-center text-center"> <a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ ++$i }}</a></td>
                    <td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->id_brand,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->id_category,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->id_sub_category,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->variant,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->name,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->portion,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->price,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->stock,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->units,25) }}</a></td><td><a href="{{ route("pos_products.show",$pos_products->id) }}" class="text-gray-800 text-hover-primary mb-1">{{ Str::limit($pos_products->fileimages,25) }}</a></td>
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
        