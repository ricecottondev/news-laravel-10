 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - ShowOnepoint_member-->
 <div class="modal fade" id="kt_modal_log_claim_uniquecode{{ $onepoint_member->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
      <!--begin::Modal content-->
      <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_add_onepoint_member_header">
          <!--begin::Modal title-->
          <h2 class="fw-bold">DETAIL LOG CLAIM UNIQUECODE MEMBER</h2>
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