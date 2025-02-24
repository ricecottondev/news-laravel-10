 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - ShowOnepoint_member-->
 <div class="modal fade" id="kt_modal_show_onepoint_member{{ $onepoint_member->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
      <!--begin::Modal content-->
      <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_add_onepoint_member_header">
          <!--begin::Modal title-->
          <h2 class="fw-bold">DETAIL ONEPOINT MEMBER</h2>
          <!--end::Modal title-->
          <!--begin::Close-->
          <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" data-kt-onepoint_members-modal-action="close">
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
          {{-- {!! Form::open(array("route" => "onepoint_member.update","method"=>"POST")) !!} --}}
          {!! Form::model($onepoint_member, ["method" => "PATCH","route" => ["onepoint_member.update", $onepoint_member->id], "enctype"=>"multipart/form-data"]) !!}
          {{-- <form id="kt_modal_add_user_form" class="form" action="#"> --}}
            <!--begin::Scroll-->
            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
            
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">ID</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="number" name="id" class="form-control form-control-sm form-control-solid" placeholder="id" value="{{$onepoint_member->id}}" />
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">USERNAME</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("username", $onepoint_member->username, array("placeholder" => "USERNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">PASSWORD</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="password" class="form-control form-control-sm form-control-solid" placeholder="password" value="{{$onepoint_member->password}}" />
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">EMAIL</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("email", $onepoint_member->email, array("placeholder" => "EMAIL","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">EMAILWITHOUTDOT</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("emailwithoutdot", $onepoint_member->emailwithoutdot, array("placeholder" => "EMAILWITHOUTDOT","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">TELP</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("telp", $onepoint_member->telp, array("placeholder" => "TELP","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">FIRSTNAME</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("firstname", $onepoint_member->firstname, array("placeholder" => "FIRSTNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">MIDNAME</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("midname", $onepoint_member->midname, array("placeholder" => "MIDNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">LASTNAME</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("lastname", $onepoint_member->lastname, array("placeholder" => "LASTNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">NICKNAME</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("nickname", $onepoint_member->nickname, array("placeholder" => "NICKNAME","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">WEBSITE</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("website", $onepoint_member->website, array("placeholder" => "WEBSITE","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">COMPANY</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("company", $onepoint_member->company, array("placeholder" => "COMPANY","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">IMAGE</label>
    <!--end::Label-->
    <!--begin::Input-->
    <input type="text" name="image" class="form-control form-control-sm form-control-solid" placeholder="image" value="{{$onepoint_member->image}}" />
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">ADDRESS</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("address", $onepoint_member->address, array("placeholder" => "ADDRESS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">KECAMATAN</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("kecamatan", $onepoint_member->kecamatan, array("placeholder" => "KECAMATAN","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">CITY</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("city", $onepoint_member->city, array("placeholder" => "CITY","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">PROVINSI</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("provinsi", $onepoint_member->provinsi, array("placeholder" => "PROVINSI","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">NEGARA</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("negara", $onepoint_member->negara, array("placeholder" => "NEGARA","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">KODENEGARA</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("kodenegara", $onepoint_member->kodenegara, array("placeholder" => "KODENEGARA","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">KODEPOS</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("kodepos", $onepoint_member->kodepos, array("placeholder" => "KODEPOS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">FLAG NEWS</label>
    <!--end::Label-->
    <!--begin::Input-->
    {!! Form::text("flag_news", $onepoint_member->flag_news, array("placeholder" => "FLAG NEWS","class" => "form-control form-control-solid mb-3 mb-lg-0")) !!}
    <!--end::Input-->
  </div>
  <!--end::Input group-->
  
  <!--begin::Input group-->
  <div class="fv-row mb-7">
    <!--begin::Label-->
    <label class=" fw-semibold fs-6 mb-2">STATUS</label>
    <!--end::Label-->
    <!--begin::Input-->
    <select name="status" aria-label="Select a status" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                                            <option value='active'>active</option><option value='inactive'>inactive</option>
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
    <select name="deleted" aria-label="Select a deleted" data-control="select2" data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                                            <option value='false'>false</option><option value='true'>true</option>
                    </select>
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