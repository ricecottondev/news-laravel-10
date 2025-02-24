 <!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++begin::Modal - ShowOnepoint_voucher-->
 <div class="modal fade" id="kt_modal_show_onepoint_voucher{{ $voucher->id }}" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_onepoint_voucher_header">
                <h2 class="fw-bold">DETAIL ONEPOINT VOUCHER</h2>
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

                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
                    data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                    data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#kt_modal_add_user_header"
                    data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">ID</label>
                        <input type="number" name="id"
                            class="form-control form-control-sm form-control-solid" placeholder="id"
                            value="{{ $voucher->id }}" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">KODE VOUCHER</label>
                        {!! Form::text('kode_voucher', $voucher->kode_voucher, [
                            'placeholder' => 'KODE VOUCHER',
                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                        ]) !!}
                    </div>

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">ID MERCHANT</label>
                        {!! Form::text('id_merchant', $voucher->id_merchant, [
                            'placeholder' => 'ID MERCHANT',
                            'class' => 'form-control form-control-solid mb-3 mb-lg-0',
                        ]) !!}
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
                        <label class=" fw-semibold fs-6 mb-2">POINTNEED</label>
                        <input type="number" name="pointneed"
                            class="form-control form-control-sm form-control-solid"
                            placeholder="pointneed" value="{{ $voucher->pointneed }}" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">QTYVOUCHER</label>
                        <input type="number" name="qtyvoucher"
                            class="form-control form-control-sm form-control-solid"
                            placeholder="qtyvoucher" value="{{ $voucher->qtyvoucher }}" />
                    </div>

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">DISCTYPE</label>
                        <select name="disctype" aria-label="Select a disctype" data-control="select2"
                            data-placeholder="date_period"
                            class="form-select form-select-sm form-select-solid">
                            <option value='Diskon'>Diskon</option>
                            <option value='Cashback'>Cashback</option>
                            <option value='Bebas Onkir'>Bebas Onkir</option>
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">DISCVALUE</label>
                        <input type="number" name="discvalue"
                            class="form-control form-control-sm form-control-solid"
                            placeholder="discvalue" value="{{ $voucher->discvalue }}" />
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
                        <select name="status" aria-label="Select a status" data-control="select2"
                            data-placeholder="date_period"
                            class="form-select form-select-sm form-select-solid">
                            <option value='active'>active</option>
                            <option value='inactive'>inactive</option>
                        </select>
                    </div>

                    <div class="fv-row mb-7">
                        <label class=" fw-semibold fs-6 mb-2">DELETED</label>
                        <select name="deleted" aria-label="Select a deleted" data-control="select2"
                            data-placeholder="date_period"
                            class="form-select form-select-sm form-select-solid">
                            <option value='false'>false</option>
                            <option value='true'>true</option>
                        </select>
                    </div>

                </div>
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
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!--+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++end::Modal - Show user-->