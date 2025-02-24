 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - ShowOnepoint_uniquecode-->
 <div class="modal fade" id="kt_modal_show_onepoint_uniquecode{{ $onepoint_uniquecode->id }}" tabindex="-1" aria-hidden="true">                
    <div class="modal-dialog modal-dialog-centered mw-650px">                  
      <div class="modal-content">                    
        <div class="modal-header" id="kt_modal_add_onepoint_uniquecode_header">                      
          <h2 class="fw-bold">DETAIL ONEPOINT UNIQUECODE</h2>                                            
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-onepoint_uniquecodes-modal-action="close">
            <i class="ki-duotone ki-cross fs-1">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
          </div>                      
        </div>                                        
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">                                            
          {!! Form::model($onepoint_uniquecode, ["method" => "PATCH","route" => ["onepoint_uniquecode.update", $onepoint_uniquecode->id], "enctype"=>"multipart/form-data"]) !!}                      
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                          
              <div class="fv-row mb-7">                
                <label class=" fw-semibold fs-6 mb-2">ID</label>                                
                <input type="number" name="id" class="form-control form-control-sm form-control-solid" placeholder="id" value="{{$onepoint_uniquecode->id}}" />                
              </div>              
                            
              <div class="fv-row mb-7">                
                <label class=" fw-semibold fs-6 mb-2">KODE</label>                                
                {!! Form::text("kode", $onepoint_uniquecode->kode, array("placeholder" => "KODE","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
              </div>              
                            
              <div class="fv-row mb-7">                
                <label class=" fw-semibold fs-6 mb-2">POINT</label>                                
                {!! Form::text("point", $onepoint_uniquecode->point, array("placeholder" => "POINT","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
              </div>              
                            
              <div class="fv-row mb-7">                
                <label class=" fw-semibold fs-6 mb-2">STATUS</label>                                
                {!! Form::text("status", $onepoint_uniquecode->status, array("placeholder" => "STATUS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
              </div>              
                            
              <div class="fv-row mb-7">                
                <label class=" fw-semibold fs-6 mb-2">DELETED</label>                                
                {!! Form::text("deleted", $onepoint_uniquecode->deleted, array("placeholder" => "DELETED","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
              </div>              
  
            </div>                                                
            <div class="text-center pt-15">
              <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
              <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
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
  <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Show user-->