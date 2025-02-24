<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{url('/')}}" class="logo logo-dark">
            <span class="logo-sm">
                <h5 class="mt-4">SUPRESSO-WAITERS</h5>
            </span>
            <span class="logo-lg">
                <h5 class="mt-4">SUPRESSO-WAITERS</h5>
            </span>
        </a>

        <a href="{{url('/')}}" class="logo logo-light">
            <span class="logo-sm">
                <h5 class="mt-4">SUPRESSO-WAITERS</h5>
            </span>
            <span class="logo-lg">
                <h5 class="mt-4">SUPRESSO-WAITERS</h5>
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                <li>
                    {{-- <a href="{{url('index')}}"> --}}
                    <a href="{{url('admin/dashboard')}}">
                        <i class="uil-home-alt"></i><span class="badge rounded-pill bg-primary float-end">01</span>
                        <span>@lang('translation.Dashboard')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-user-circle"></i>
                        <span>@lang('Users Management')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ route('users.index') }}>@lang('Users')</a></li>
                        <li><a href={{ route('roles.index') }}>@lang('Roles')</a></li>
                        <li><a href={{ route('permissions.index') }}>@lang('Permissions')</a></li>
                       
                        {{-- @can('menu-permission')
                        <li><a href={{ route('permissions.index') }}>@lang('Permissions')</a></li> 
                        @endcan --}}
                    </ul>
                </li>


                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>@lang('Master')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                     
                        <li><a href={{ url('') }}>@lang('Customer')</a></li>
                        <li><a href={{ url('') }}>@lang('Categories')</a></li>
                        <li><a href={{ url('') }}>@lang('Products')</a></li>
                        <li><a href={{ url('') }}>@lang('Income')</a></li>
                    </ul>
                </li>

               

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-store"></i>
                        <span>@lang('Store')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href={{ url('admin/orders') }}>@lang('Order History')</a></li>
                        <li><a href={{ url('admin/discount-product') }}>@lang('Discount Product')</a></li>
                        <li><a href={{ url('admin/discount-cluster') }}>@lang('Discount Promo')</a></li>
                        <li><a href={{ url('admin/flashsale') }}>@lang('Flash Sale')</a></li>
                        <li><a href={{ url('admin/freegift') }}>@lang('Set Free Gift')</a></li>
                    </ul>
                </li>

              

                <li class="menu-title">@lang('Setting')</li>
                <li>
                    <a href="{{url('admin/websetup')}}">
                        <i class="uil-analytics"></i>
                        <span>@lang('Setup Web')</span>
                    </a>
                </li>
              

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->