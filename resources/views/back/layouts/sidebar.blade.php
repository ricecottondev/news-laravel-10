<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
            data-kt-menu-expand="false">
            <!--begin:Menu item-->

            @role('Admin')
            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('dashboard') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-element-11 fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                        </i>
                    </span>
                    <span class="menu-title">Dashboards</span>
                </a>
                <!--end:Menu link-->
            </div>
            @endrole
            <!--end:Menu item-->
            {{-- @dump('ok') --}}




            @role('Admin')


            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/users') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Users</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/chat-gpt') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Chat GPT</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/country') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Country</span>
                </a>
                <!--end:Menu link-->
            </div>

            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/categories') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">Categories</span>
                </a>
                <!--end:Menu link-->
            </div>



            <div class="menu-item">
                <!--begin:Menu link-->
                <a class="menu-link" href="{{ url('/news') }}">
                    <span class="menu-icon">
                        <i class="ki-duotone ki-square-brackets fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <span class="menu-title">News</span>
                </a>
                <!--end:Menu link-->
            </div>
            @endrole


        </div>




        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
@role('Admin')
<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
    <a href="https://preview.keenthemes.com/html/metronic/docs"
        class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100"
        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click"
        title="200+ in-house components and 3rd-party plugins">
        <span class="btn-label">Docs & Components</span>
        <i class="ki-duotone ki-document btn-icon fs-2 m-0">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
</div>
@endrole
