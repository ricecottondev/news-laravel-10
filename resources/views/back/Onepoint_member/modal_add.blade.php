<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_Onepoint_member" tabindex="-1" aria-hidden="true">                
    <div class="modal-dialog modal-dialog-centered mw-650px">                  
      <div class="modal-content">                    
        <div class="modal-header" id="kt_modal_add_Onepoint_member_header">                      
          <h2 class="fw-bold">ADD ONEPOINT MEMBER</h2>                                            
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-Onepoint_members-modal-action="close">
            <i class="ki-duotone ki-cross fs-1">
              <span class="path1"></span>
              <span class="path2"></span>
            </i>
          </div>                      
        </div>                                        
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">                      
          {!! Form::open(array("route" => "onepoint_member.store","method"=>"POST","enctype"=>"multipart/form-data")) !!}                                         
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_Onepoint_member_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_Onepoint_member_header" data-kt-scroll-wrappers="#kt_modal_add_Onepoint_member_scroll" data-kt-scroll-offset="300px">
             
                            
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">USERNAME</label>                                
      {!! Form::text("username", null, array("placeholder" => "USERNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">PASSWORD</label>                                
      <input type="text" name="password" class="form-control form-control-sm form-control-solid" placeholder="password" value="" />                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">EMAIL</label>                                
      {!! Form::text("email", null, array("placeholder" => "EMAIL","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">EMAILWITHOUTDOT</label>                                
      {!! Form::text("emailwithoutdot", null, array("placeholder" => "EMAILWITHOUTDOT","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">TELP</label>                                
      {!! Form::text("telp", null, array("placeholder" => "TELP","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">FIRSTNAME</label>                                
      {!! Form::text("firstname", null, array("placeholder" => "FIRSTNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">MIDNAME</label>                                
      {!! Form::text("midname", null, array("placeholder" => "MIDNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">LASTNAME</label>                                
      {!! Form::text("lastname", null, array("placeholder" => "LASTNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">NICKNAME</label>                                
      {!! Form::text("nickname", null, array("placeholder" => "NICKNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">WEBSITE</label>                                
      {!! Form::text("website", null, array("placeholder" => "WEBSITE","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class=" fw-semibold fs-6 mb-2">COMPANY</label>                                
      {!! Form::text("company", null, array("placeholder" => "COMPANY","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
    </div>              
                  
    <div class="fv-row mb-7">                
      <label class="d-block fw-semibold fs-6 mb-5">Image</label>                                
      <style>.image-input-placeholder { background-image: url("assets/media/svg/files/blank-image.svg"); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url("assets/media/svg/files/blank-image-dark.svg"); }</style>                                
      <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">                  
        <div class="image-input-wrapper w-125px h-125px" style="background-image: url(assets/media/avatars/300-6.jpg);"></div>                                    
        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
          <i class="ki-duotone ki-pencil fs-7">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>                    
          <input type="file" name="image" accept=".png, .jpg, .jpeg" />
          <input type="hidden" name="image_remove" />                    
        </label>                                    
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
          <i class="ki-duotone ki-cross fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>
        </span>                                    
        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
          <i class="ki-duotone ki-cross fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
          </i>
        </span>                  
      </div>                                
      <div class="form-text">Allowed file types: png, jpg, jpeg.</div>                
    </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">ADDRESS</label>                                
    {!! Form::text("address", null, array("placeholder" => "ADDRESS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">KECAMATAN</label>                                
    {!! Form::text("kecamatan", null, array("placeholder" => "KECAMATAN","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">CITY</label>                                
    {!! Form::text("city", null, array("placeholder" => "CITY","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">PROVINSI</label>                                
    {!! Form::text("provinsi", null, array("placeholder" => "PROVINSI","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">NEGARA</label>                                
    {!! Form::text("negara", null, array("placeholder" => "NEGARA","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">KODENEGARA</label>                                
    {!! Form::text("kodenegara", null, array("placeholder" => "KODENEGARA","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">KODEPOS</label>                                
    {!! Form::text("kodepos", null, array("placeholder" => "KODEPOS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">FLAG NEWS</label>                                
    {!! Form::text("flag_news", null, array("placeholder" => "FLAG NEWS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">STATUS</label>                                
    <select name="status" aria-label="Select a status" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                                            <option value='active'>active</option><option value='inactive'>inactive</option>
                    </select>                
  </div>              
                
  <div class="fv-row mb-7">                
    <label class=" fw-semibold fs-6 mb-2">DELETED</label>                                
    <select name="deleted" aria-label="Select a deleted" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                                            <option value='false'>false</option><option value='true'>true</option>
                    </select>                
  </div>              
  
             
          </div>                                                
            <div class="text-center pt-15">
              <button type="reset" class="btn btn-light me-3" data-kt-Onepoint_member-modal-action="cancel">Discard</button>
              <button type="submit" class="btn btn-primary" data-kt-Onepoint_member-modal-action="submit">
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
  <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - add Onepoint_member-->