<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_Onepoint_merchant" tabindex="-1" aria-hidden="true">                
    <div class="modal-dialog modal-dialog-centered mw-650px">                  
      <div class="modal-content">                    
        <div class="modal-header" id="kt_modal_add_Onepoint_merchant_header">                      
          <h2 class="fw-bold">ADD ONEPOINT MERCHANT</h2>                                            
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-Onepoint_merchants-modal-action="close">
            <i class="ki-duotone ki-cross fs-1">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
          </div>                      
        </div>                                        
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">                      
          {!! Form::open(array("route" => "onepoint_merchant.store","method"=>"POST","enctype"=>"multipart/form-data")) !!}                      
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_Onepoint_merchant_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_Onepoint_merchant_header" data-kt-scroll-wrappers="#kt_modal_add_Onepoint_merchant_scroll" data-kt-scroll-offset="300px">
             
                            
            <div class="fv-row mb-7">                
              <label class=" fw-semibold fs-6 mb-2">MERCHANT NAME</label>                                
              {!! Form::text("merchant_name", null, array("placeholder" => "MERCHANT NAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
            </div>              
                          
            <div class="fv-row mb-7">                
              <label class=" fw-semibold fs-6 mb-2">DELETED</label>                                
              <select name="deleted" aria-label="Select a deleted" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                          <option value='false'>false</option><option value='true'>true</option>
              </select>                
            </div>              
  
             
            </div>                                                
            <div class="text-center pt-15">
              <button type="reset" class="btn btn-light me-3" data-kt-Onepoint_merchant-modal-action="cancel">Discard</button>
              <button type="submit" class="btn btn-primary" data-kt-Onepoint_merchant-modal-action="submit">
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
  <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - add Onepoint_merchant-->
