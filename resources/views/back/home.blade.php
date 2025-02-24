@extends('back/layouts.layout')
@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Customer List</h1>
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
                    <li class="breadcrumb-item text-muted">Customers</li>
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
                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_641ac428124dc">
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
                                    <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_641ac428124dc" data-allow-clear="true">
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
                <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Create</a>
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Customers" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Filter</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter">
                                            <option></option>
                                            <option value="aug">August</option>
                                            <option value="sep">September</option>
                                            <option value="oct">October</option>
                                            <option value="nov">November</option>
                                            <option value="dec">December</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-semibold mb-3">Payment Type:</label>
                                        <!--end::Label-->
                                        <!--begin::Options-->
                                        <div class="d-flex flex-column flex-wrap fw-semibold" data-kt-customer-table-filter="payment_type">
                                            <!--begin::Option-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="payment_type" value="all" checked="checked" />
                                                <span class="form-check-label text-gray-600">All</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="payment_type" value="visa" />
                                                <span class="form-check-label text-gray-600">Visa</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                <input class="form-check-input" type="radio" name="payment_type" value="mastercard" />
                                                <span class="form-check-label text-gray-600">Mastercard</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="radio" name="payment_type" value="american_express" />
                                                <span class="form-check-label text-gray-600">American Express</span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                            <i class="ki-duotone ki-exit-up fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Export</button>
                            <!--end::Export-->
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Add Customer</button>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                            <div class="fw-bold me-5">
                            <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
                            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-125px">Customer Name</th>
                                <th class="min-w-125px">Email</th>
                                <th class="min-w-125px">Company</th>
                                <th class="min-w-125px">Payment Method</th>
                                <th class="min-w-125px">Created Date</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">smith@kpmg.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4393</td>
                                <td>14 Dec 2020, 8:43 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">melody@altbox.com</a>
                                </td>
                                <td>Google</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 3518</td>
                                <td>01 Dec 2020, 10:12 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">max@kt.com</a>
                                </td>
                                <td>Bistro Union</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 5491</td>
                                <td>12 Nov 2020, 2:01 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">sean@dellito.com</a>
                                </td>
                                <td>Astro Limited</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 4477</td>
                                <td>21 Oct 2020, 5:54 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Brian Cox</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">brian@exchange.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 9073</td>
                                <td>19 Oct 2020, 7:32 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Mikaela Collins</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">mik@pex.com</a>
                                </td>
                                <td>Keenthemes</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 7985</td>
                                <td>23 Sep 2020, 12:37 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Francis Mitcham</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">f.mit@kpmg.com</a>
                                </td>
                                <td>Paypal</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 6779</td>
                                <td>11 Sep 2020, 3:15 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Olivia Wild</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">olivia@corpmail.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 1121</td>
                                <td>03 Sep 2020, 1:08 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Neil Owen</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">owen.neil@gmail.com</a>
                                </td>
                                <td>Paramount</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 6200</td>
                                <td>01 Sep 2020, 4:58 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Dan Wilson</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">dam@consilting.com</a>
                                </td>
                                <td>Trinity Studio</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 4500</td>
                                <td>18 Aug 2020, 3:34 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Bold</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">emma@intenso.com</a>
                                </td>
                                <td>B&T Legal Services</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4880</td>
                                <td>14 Aug 2020, 1:21 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Ana Crown</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">ana.cf@limtel.com</a>
                                </td>
                                <td>Paysafe Security</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 8971</td>
                                <td>11 Aug 2020, 5:13 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">smith@kpmg.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4393</td>
                                <td>14 Dec 2020, 8:43 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">melody@altbox.com</a>
                                </td>
                                <td>Google</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 3518</td>
                                <td>01 Dec 2020, 10:12 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">max@kt.com</a>
                                </td>
                                <td>Bistro Union</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 5491</td>
                                <td>12 Nov 2020, 2:01 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">sean@dellito.com</a>
                                </td>
                                <td>Astro Limited</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 4477</td>
                                <td>21 Oct 2020, 5:54 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Brian Cox</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">brian@exchange.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 9073</td>
                                <td>19 Oct 2020, 7:32 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Mikaela Collins</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">mik@pex.com</a>
                                </td>
                                <td>Keenthemes</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 7985</td>
                                <td>23 Sep 2020, 12:37 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Francis Mitcham</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">f.mit@kpmg.com</a>
                                </td>
                                <td>Paypal</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 6779</td>
                                <td>11 Sep 2020, 3:15 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Olivia Wild</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">olivia@corpmail.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 1121</td>
                                <td>03 Sep 2020, 1:08 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Neil Owen</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">owen.neil@gmail.com</a>
                                </td>
                                <td>Paramount</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 6200</td>
                                <td>01 Sep 2020, 4:58 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Dan Wilson</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">dam@consilting.com</a>
                                </td>
                                <td>Trinity Studio</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 4500</td>
                                <td>18 Aug 2020, 3:34 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Bold</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">emma@intenso.com</a>
                                </td>
                                <td>B&T Legal Services</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4880</td>
                                <td>14 Aug 2020, 1:21 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Ana Crown</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">ana.cf@limtel.com</a>
                                </td>
                                <td>Paysafe Security</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 8971</td>
                                <td>11 Aug 2020, 5:13 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">smith@kpmg.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4393</td>
                                <td>14 Dec 2020, 8:43 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">melody@altbox.com</a>
                                </td>
                                <td>Google</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 3518</td>
                                <td>01 Dec 2020, 10:12 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">max@kt.com</a>
                                </td>
                                <td>Bistro Union</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 5491</td>
                                <td>12 Nov 2020, 2:01 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">sean@dellito.com</a>
                                </td>
                                <td>Astro Limited</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 4477</td>
                                <td>21 Oct 2020, 5:54 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Brian Cox</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">brian@exchange.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 9073</td>
                                <td>19 Oct 2020, 7:32 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Mikaela Collins</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">mik@pex.com</a>
                                </td>
                                <td>Keenthemes</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 7985</td>
                                <td>23 Sep 2020, 12:37 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Francis Mitcham</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">f.mit@kpmg.com</a>
                                </td>
                                <td>Paypal</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 6779</td>
                                <td>11 Sep 2020, 3:15 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Olivia Wild</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">olivia@corpmail.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 1121</td>
                                <td>03 Sep 2020, 1:08 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Neil Owen</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">owen.neil@gmail.com</a>
                                </td>
                                <td>Paramount</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 6200</td>
                                <td>01 Sep 2020, 4:58 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Dan Wilson</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">dam@consilting.com</a>
                                </td>
                                <td>Trinity Studio</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 4500</td>
                                <td>18 Aug 2020, 3:34 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Bold</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">emma@intenso.com</a>
                                </td>
                                <td>B&T Legal Services</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4880</td>
                                <td>14 Aug 2020, 1:21 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Ana Crown</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">ana.cf@limtel.com</a>
                                </td>
                                <td>Paysafe Security</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 8971</td>
                                <td>11 Aug 2020, 5:13 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Emma Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">smith@kpmg.com</a>
                                </td>
                                <td>-</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 4393</td>
                                <td>14 Dec 2020, 8:43 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Melody Macy</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">melody@altbox.com</a>
                                </td>
                                <td>Google</td>
                                <td data-filter="visa">
                                <img src="assets/media/svg/card-logos/visa.svg" class="w-35px me-3" alt="" />**** 3518</td>
                                <td>01 Dec 2020, 10:12 am</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Max Smith</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">max@kt.com</a>
                                </td>
                                <td>Bistro Union</td>
                                <td data-filter="mastercard">
                                <img src="assets/media/svg/card-logos/mastercard.svg" class="w-35px me-3" alt="" />**** 5491</td>
                                <td>12 Nov 2020, 2:01 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <a href="../../demo1/dist/apps/customers/view.html" class="text-gray-800 text-hover-primary mb-1">Sean Bean</a>
                                </td>
                                <td>
                                    <a href="#" class="text-gray-600 text-hover-primary mb-1">sean@dellito.com</a>
                                </td>
                                <td>Astro Limited</td>
                                <td data-filter="american_express">
                                <img src="assets/media/svg/card-logos/american-express.svg" class="w-35px me-3" alt="" />**** 4477</td>
                                <td>21 Oct 2020, 5:54 pm</td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="../../demo1/dist/apps/customers/view.html" class="menu-link px-3">View</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            <!--begin::Modal - Customers - Add-->
            <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Form-->
                        <form class="form" action="#" id="kt_modal_add_customer_form" data-kt-redirect="../../demo1/dist/apps/customers/list.html">
                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_customer_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bold">Add a Customer</h2>
                                <!--end::Modal title-->
                                <!--begin::Close-->
                                <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                    <i class="ki-duotone ki-cross fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Scroll-->
                                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="Sean Bean" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2">
                                            <span class="required">Email</span>
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Email address must be active">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="sean@dellito.com" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-15">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold mb-2">Description</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" placeholder="" name="description" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Billing toggle-->
                                    <div class="fw-bold fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">Shipping Information
                                    <span class="ms-2 rotate-180">
                                        <i class="ki-duotone ki-down fs-3"></i>
                                    </span></div>
                                    <!--end::Billing toggle-->
                                    <!--begin::Billing form-->
                                    <div id="kt_modal_add_customer_billing_info" class="collapse show">
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">Address Line 1</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="address1" value="101, Collins Street" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">Address Line 2</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="address2" value="" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold mb-2">Town</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" placeholder="" name="city" value="Melbourne" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row g-9 mb-7">
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold mb-2">State / Province</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder="" name="state" value="Victoria" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                            <!--begin::Col-->
                                            <div class="col-md-6 fv-row">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold mb-2">Post Code</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid" placeholder="" name="postcode" value="3000" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-7 fv-row">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold mb-2">
                                                <span class="required">Country</span>
                                                <span class="ms-1" data-bs-toggle="tooltip" title="Country of origination">
                                                    <i class="ki-duotone ki-information fs-7">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="country" aria-label="Select a Country" data-control="select2" data-placeholder="Select a Country..." data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold">
                                                <option value="">Select a Country...</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="AX">Aland Islands</option>
                                                <option value="AL">Albania</option>
                                                <option value="DZ">Algeria</option>
                                                <option value="AS">American Samoa</option>
                                                <option value="AD">Andorra</option>
                                                <option value="AO">Angola</option>
                                                <option value="AI">Anguilla</option>
                                                <option value="AG">Antigua and Barbuda</option>
                                                <option value="AR">Argentina</option>
                                                <option value="AM">Armenia</option>
                                                <option value="AW">Aruba</option>
                                                <option value="AU">Australia</option>
                                                <option value="AT">Austria</option>
                                                <option value="AZ">Azerbaijan</option>
                                                <option value="BS">Bahamas</option>
                                                <option value="BH">Bahrain</option>
                                                <option value="BD">Bangladesh</option>
                                                <option value="BB">Barbados</option>
                                                <option value="BY">Belarus</option>
                                                <option value="BE">Belgium</option>
                                                <option value="BZ">Belize</option>
                                                <option value="BJ">Benin</option>
                                                <option value="BM">Bermuda</option>
                                                <option value="BT">Bhutan</option>
                                                <option value="BO">Bolivia, Plurinational State of</option>
                                                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                <option value="BA">Bosnia and Herzegovina</option>
                                                <option value="BW">Botswana</option>
                                                <option value="BR">Brazil</option>
                                                <option value="IO">British Indian Ocean Territory</option>
                                                <option value="BN">Brunei Darussalam</option>
                                                <option value="BG">Bulgaria</option>
                                                <option value="BF">Burkina Faso</option>
                                                <option value="BI">Burundi</option>
                                                <option value="KH">Cambodia</option>
                                                <option value="CM">Cameroon</option>
                                                <option value="CA">Canada</option>
                                                <option value="CV">Cape Verde</option>
                                                <option value="KY">Cayman Islands</option>
                                                <option value="CF">Central African Republic</option>
                                                <option value="TD">Chad</option>
                                                <option value="CL">Chile</option>
                                                <option value="CN">China</option>
                                                <option value="CX">Christmas Island</option>
                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                <option value="CO">Colombia</option>
                                                <option value="KM">Comoros</option>
                                                <option value="CK">Cook Islands</option>
                                                <option value="CR">Costa Rica</option>
                                                <option value="CI">Côte d'Ivoire</option>
                                                <option value="HR">Croatia</option>
                                                <option value="CU">Cuba</option>
                                                <option value="CW">Curaçao</option>
                                                <option value="CZ">Czech Republic</option>
                                                <option value="DK">Denmark</option>
                                                <option value="DJ">Djibouti</option>
                                                <option value="DM">Dominica</option>
                                                <option value="DO">Dominican Republic</option>
                                                <option value="EC">Ecuador</option>
                                                <option value="EG">Egypt</option>
                                                <option value="SV">El Salvador</option>
                                                <option value="GQ">Equatorial Guinea</option>
                                                <option value="ER">Eritrea</option>
                                                <option value="EE">Estonia</option>
                                                <option value="ET">Ethiopia</option>
                                                <option value="FK">Falkland Islands (Malvinas)</option>
                                                <option value="FJ">Fiji</option>
                                                <option value="FI">Finland</option>
                                                <option value="FR">France</option>
                                                <option value="PF">French Polynesia</option>
                                                <option value="GA">Gabon</option>
                                                <option value="GM">Gambia</option>
                                                <option value="GE">Georgia</option>
                                                <option value="DE">Germany</option>
                                                <option value="GH">Ghana</option>
                                                <option value="GI">Gibraltar</option>
                                                <option value="GR">Greece</option>
                                                <option value="GL">Greenland</option>
                                                <option value="GD">Grenada</option>
                                                <option value="GU">Guam</option>
                                                <option value="GT">Guatemala</option>
                                                <option value="GG">Guernsey</option>
                                                <option value="GN">Guinea</option>
                                                <option value="GW">Guinea-Bissau</option>
                                                <option value="HT">Haiti</option>
                                                <option value="VA">Holy See (Vatican City State)</option>
                                                <option value="HN">Honduras</option>
                                                <option value="HK">Hong Kong</option>
                                                <option value="HU">Hungary</option>
                                                <option value="IS">Iceland</option>
                                                <option value="IN">India</option>
                                                <option value="ID">Indonesia</option>
                                                <option value="IR">Iran, Islamic Republic of</option>
                                                <option value="IQ">Iraq</option>
                                                <option value="IE">Ireland</option>
                                                <option value="IM">Isle of Man</option>
                                                <option value="IL">Israel</option>
                                                <option value="IT">Italy</option>
                                                <option value="JM">Jamaica</option>
                                                <option value="JP">Japan</option>
                                                <option value="JE">Jersey</option>
                                                <option value="JO">Jordan</option>
                                                <option value="KZ">Kazakhstan</option>
                                                <option value="KE">Kenya</option>
                                                <option value="KI">Kiribati</option>
                                                <option value="KP">Korea, Democratic People's Republic of</option>
                                                <option value="KW">Kuwait</option>
                                                <option value="KG">Kyrgyzstan</option>
                                                <option value="LA">Lao People's Democratic Republic</option>
                                                <option value="LV">Latvia</option>
                                                <option value="LB">Lebanon</option>
                                                <option value="LS">Lesotho</option>
                                                <option value="LR">Liberia</option>
                                                <option value="LY">Libya</option>
                                                <option value="LI">Liechtenstein</option>
                                                <option value="LT">Lithuania</option>
                                                <option value="LU">Luxembourg</option>
                                                <option value="MO">Macao</option>
                                                <option value="MG">Madagascar</option>
                                                <option value="MW">Malawi</option>
                                                <option value="MY">Malaysia</option>
                                                <option value="MV">Maldives</option>
                                                <option value="ML">Mali</option>
                                                <option value="MT">Malta</option>
                                                <option value="MH">Marshall Islands</option>
                                                <option value="MQ">Martinique</option>
                                                <option value="MR">Mauritania</option>
                                                <option value="MU">Mauritius</option>
                                                <option value="MX">Mexico</option>
                                                <option value="FM">Micronesia, Federated States of</option>
                                                <option value="MD">Moldova, Republic of</option>
                                                <option value="MC">Monaco</option>
                                                <option value="MN">Mongolia</option>
                                                <option value="ME">Montenegro</option>
                                                <option value="MS">Montserrat</option>
                                                <option value="MA">Morocco</option>
                                                <option value="MZ">Mozambique</option>
                                                <option value="MM">Myanmar</option>
                                                <option value="NA">Namibia</option>
                                                <option value="NR">Nauru</option>
                                                <option value="NP">Nepal</option>
                                                <option value="NL">Netherlands</option>
                                                <option value="NZ">New Zealand</option>
                                                <option value="NI">Nicaragua</option>
                                                <option value="NE">Niger</option>
                                                <option value="NG">Nigeria</option>
                                                <option value="NU">Niue</option>
                                                <option value="NF">Norfolk Island</option>
                                                <option value="MP">Northern Mariana Islands</option>
                                                <option value="NO">Norway</option>
                                                <option value="OM">Oman</option>
                                                <option value="PK">Pakistan</option>
                                                <option value="PW">Palau</option>
                                                <option value="PS">Palestinian Territory, Occupied</option>
                                                <option value="PA">Panama</option>
                                                <option value="PG">Papua New Guinea</option>
                                                <option value="PY">Paraguay</option>
                                                <option value="PE">Peru</option>
                                                <option value="PH">Philippines</option>
                                                <option value="PL">Poland</option>
                                                <option value="PT">Portugal</option>
                                                <option value="PR">Puerto Rico</option>
                                                <option value="QA">Qatar</option>
                                                <option value="RO">Romania</option>
                                                <option value="RU">Russian Federation</option>
                                                <option value="RW">Rwanda</option>
                                                <option value="BL">Saint Barthélemy</option>
                                                <option value="KN">Saint Kitts and Nevis</option>
                                                <option value="LC">Saint Lucia</option>
                                                <option value="MF">Saint Martin (French part)</option>
                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                <option value="WS">Samoa</option>
                                                <option value="SM">San Marino</option>
                                                <option value="ST">Sao Tome and Principe</option>
                                                <option value="SA">Saudi Arabia</option>
                                                <option value="SN">Senegal</option>
                                                <option value="RS">Serbia</option>
                                                <option value="SC">Seychelles</option>
                                                <option value="SL">Sierra Leone</option>
                                                <option value="SG">Singapore</option>
                                                <option value="SX">Sint Maarten (Dutch part)</option>
                                                <option value="SK">Slovakia</option>
                                                <option value="SI">Slovenia</option>
                                                <option value="SB">Solomon Islands</option>
                                                <option value="SO">Somalia</option>
                                                <option value="ZA">South Africa</option>
                                                <option value="KR">South Korea</option>
                                                <option value="SS">South Sudan</option>
                                                <option value="ES">Spain</option>
                                                <option value="LK">Sri Lanka</option>
                                                <option value="SD">Sudan</option>
                                                <option value="SR">Suriname</option>
                                                <option value="SZ">Swaziland</option>
                                                <option value="SE">Sweden</option>
                                                <option value="CH">Switzerland</option>
                                                <option value="SY">Syrian Arab Republic</option>
                                                <option value="TW">Taiwan, Province of China</option>
                                                <option value="TJ">Tajikistan</option>
                                                <option value="TZ">Tanzania, United Republic of</option>
                                                <option value="TH">Thailand</option>
                                                <option value="TG">Togo</option>
                                                <option value="TK">Tokelau</option>
                                                <option value="TO">Tonga</option>
                                                <option value="TT">Trinidad and Tobago</option>
                                                <option value="TN">Tunisia</option>
                                                <option value="TR">Turkey</option>
                                                <option value="TM">Turkmenistan</option>
                                                <option value="TC">Turks and Caicos Islands</option>
                                                <option value="TV">Tuvalu</option>
                                                <option value="UG">Uganda</option>
                                                <option value="UA">Ukraine</option>
                                                <option value="AE">United Arab Emirates</option>
                                                <option value="GB">United Kingdom</option>
                                                <option value="US" selected="selected">United States</option>
                                                <option value="UY">Uruguay</option>
                                                <option value="UZ">Uzbekistan</option>
                                                <option value="VU">Vanuatu</option>
                                                <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                <option value="VN">Vietnam</option>
                                                <option value="VI">Virgin Islands</option>
                                                <option value="YE">Yemen</option>
                                                <option value="ZM">Zambia</option>
                                                <option value="ZW">Zimbabwe</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::Label-->
                                                <div class="me-5">
                                                    <!--begin::Label-->
                                                    <label class="fs-6 fw-semibold">Use as a billing adderess?</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget planning</div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Switch-->
                                                <label class="form-check form-switch form-check-custom form-check-solid">
                                                    <!--begin::Input-->
                                                    <input class="form-check-input" name="billing" type="checkbox" value="1" id="kt_modal_add_customer_billing" checked="checked" />
                                                    <!--end::Input-->
                                                    <!--begin::Label-->
                                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_add_customer_billing">Yes</span>
                                                    <!--end::Label-->
                                                </label>
                                                <!--end::Switch-->
                                            </div>
                                            <!--begin::Wrapper-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Billing form-->
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Discard</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Modal - Customers - Add-->
            <!--begin::Modal - Adjust Balance-->
            <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Export Customers</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            <form id="kt_customers_export_form" class="form" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold form-label mb-5">Select Export Format:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select data-control="select2" data-placeholder="Select a format" data-hide-search="true" name="format" class="form-select form-select-solid">
                                        <option value="excell">Excel</option>
                                        <option value="pdf">PDF</option>
                                        <option value="cvs">CVS</option>
                                        <option value="zip">ZIP</option>
                                    </select>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold form-label mb-5">Select Date Range:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Pick a date" name="date" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Row-->
                                <div class="row fv-row mb-15">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold form-label mb-5">Payment Type:</label>
                                    <!--end::Label-->
                                    <!--begin::Radio group-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Radio button-->
                                        <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                            <input class="form-check-input" type="checkbox" value="1" checked="checked" name="payment_type" />
                                            <span class="form-check-label text-gray-600 fw-semibold">All</span>
                                        </label>
                                        <!--end::Radio button-->
                                        <!--begin::Radio button-->
                                        <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                            <input class="form-check-input" type="checkbox" value="2" checked="checked" name="payment_type" />
                                            <span class="form-check-label text-gray-600 fw-semibold">Visa</span>
                                        </label>
                                        <!--end::Radio button-->
                                        <!--begin::Radio button-->
                                        <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                            <input class="form-check-input" type="checkbox" value="3" name="payment_type" />
                                            <span class="form-check-label text-gray-600 fw-semibold">Mastercard</span>
                                        </label>
                                        <!--end::Radio button-->
                                        <!--begin::Radio button-->
                                        <label class="form-check form-check-custom form-check-sm form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="4" name="payment_type" />
                                            <span class="form-check-label text-gray-600 fw-semibold">American Express</span>
                                        </label>
                                        <!--end::Radio button-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Discard</button>
                                    <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card-->
            <!--end::Modals-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
<!--begin::Footer-->
<div id="kt_app_footer" class="app-footer">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2023&copy;</span>
            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
<!--end::Footer-->
@endsection