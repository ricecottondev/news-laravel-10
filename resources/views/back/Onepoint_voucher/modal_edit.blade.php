 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - Edit Onepoint_voucher-->
 <div class="modal fade" id="kt_modal_edit_onepoint_voucher{{ $voucher->id }}" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered mw-650px">
         <div class="modal-content">
             <div class="modal-header" id="kt_modal_add_onepoint_voucher_header">
                 <h2 class="fw-bold">EDIT ONEPOINT VOUCHER</h2>
                 <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                     data-kt-onepoint_vouchers-modal-action="close">
                     <i class="ki-duotone ki-cross fs-1">
                         <span class="path1"></span>
                         <span class="path2"></span>
                     </i>
                 </div>
             </div>
             <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                 {!! Form::model($onepoint_voucher, [
                     'method' => 'PATCH',
                     'route' => ['onepoint_voucher.update', $voucher->id],
                     'enctype' => 'multipart/form-data',
                 ]) !!}

                 <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll" data-kt-scroll="true"
                     data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                     data-kt-scroll-dependencies="#kt_modal_add_user_header"
                     data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                     <div class="fv-row mb-7">
                         <label class="fw-semibold fs-6 mb-2">DATE START</label>
                         <input type="date" name="date_start" class="form-control form-control-sm form-control-solid"
                             placeholder="yyyy-mm-dd" value="{{ $voucher->date_start }}" />
                     </div>

                     <div class="fv-row mb-7">
                         <label class="fw-semibold fs-6 mb-2">DATE END</label>
                         <input type="date" name="date_end" class="form-control form-control-sm form-control-solid"
                             placeholder="yyyy-mm-dd" value="{{ $voucher->date_end }}" />
                     </div>


                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">KODE VOUCHER</label>
                         {!! Form::text('kode_voucher', $voucher->kode_voucher, [
                             'placeholder' => 'KODE VOUCHER',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>

                     {{-- <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">ID MERCHANT</label>
                        {!! Form::text('id_merchant', $voucher->id_merchant, [
                            'placeholder' => 'ID MERCHANT',
                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                        ]) !!}
                    </div> --}}

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">ID MERCHANT</label>
                         <select name="id_merchant" id="id_merchant" aria-label="Select a disctype"
                             data-placeholder="date_period" class="form-select form-select-sm form-select-solid">
                             @foreach ($merchant as $merchant)
                                 <option value="{{ $merchant->id }}"
                                     {{ $voucher->id_merchant == $merchant->id ? 'selected' : '' }}>
                                     {{ $merchant->merchant_name }}</option>
                             @endforeach

                         </select>
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">LABEL</label>
                         {!! Form::text('label', $voucher->label, [
                             'placeholder' => 'LABEL',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">SHORT DESC</label>
                         {!! Form::text('short_desc', $voucher->short_desc, [
                             'placeholder' => 'SHORT DESC',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">DESC</label>
                         {!! Form::text('desc', $voucher->desc, [
                             'placeholder' => 'DESC',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">DISCTYPE</label>
                         <select name="disctype" aria-label="Select a disctype" data-placeholder="date_period"
                             class="form-select form-select-sm form-select-solid">
                             <option value='Diskon' {{ $voucher->disctype == 'Diskon' ? 'selected' : '' }}>Diskon
                             </option>
                             <option value='Cashback' {{ $voucher->disctype == 'Cashback' ? 'selected' : '' }}>Cashback
                             </option>
                             <option value='Bebas Onkir' {{ $voucher->disctype == 'Bebas Onkir' ? 'selected' : '' }}>
                                 Bebas Onkir</option>
                         </select>
                     </div>


                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">POINT NEED</label>
                         {!! Form::text('pointneed', $voucher->pointneed, [
                             'placeholder' => 'POINT NEED',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>
                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">QTY VOUCHER</label>
                         {!! Form::text('qtyvoucher', $voucher->qtyvoucher, [
                             'placeholder' => 'QTY VOUCHER',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>
                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">DISC VALUE</label>
                         {!! Form::text('discvalue', $voucher->discvalue, [
                             'placeholder' => 'DISC VALUE',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">MINORDER</label>
                         {!! Form::text('minorder', $voucher->minorder, [
                             'placeholder' => 'MINORDER',
                             'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                         ]) !!}
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">STATUS</label>
                         <select name="status" aria-label="Select a status" data-placeholder="date_period"
                             class="form-select form-select-sm form-select-solid">
                             <option value='active'>active</option>
                             <option value='inactive'>inactive</option>
                         </select>
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">DELETED</label>
                         <select name="deleted" aria-label="Select a deleted" data-placeholder="date_period"
                             class="form-select form-select-sm form-select-solid">
                             <option value='false' {{ $voucher->deleted == 'false' ? 'selected' : '' }}>false</option>
                             <option value='true' {{ $voucher->deleted == 'true' ? 'selected' : '' }}>true</option>
                         </select>
                     </div>

                     <div class="fv-row mb-7">
                         <label class=" fw-semibold fs-6 mb-2">FLAG TYPE</label>
                         <select name="type_flag" aria-label="Select a deleted" data-placeholder="date_period"
                             class="form-select form-select-sm form-select-solid">
                             <option value='claim' {{ $voucher->type_flag == 'claim' ? 'selected' : '' }}>claim
                             </option>
                             <option value='gift' {{ $voucher->type_flag == 'gift' ? 'selected' : '' }}>gift</option>
                         </select>
                     </div>

                 </div>
                 <div class="text-center pt-15">
                     <button type="reset" class="btn btn-light me-3"
                         data-kt-users-modal-action="cancel">Discard</button>
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
 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Edit user-->
