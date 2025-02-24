<header class="sticky-top"
    style="background-color: #cea787; box-shadow: 0 0 1rem rgba(0,0,0,.15); border-top: solid 1px rgba(112,66,29,.375); border-bottom: solid 1px rgba(112,66,29,.375);">
    <div class="container py-4">

        <div class="row row-cols-auto align-items-center gx-3">
            <div class="col me-auto">
                <h3 class="fw-bold mb-0">Hi, Welcome</h3>
            </div>
            <div class="col me-md-4">
                <a class="fw-semibold text-decoration-none" data-bs-toggle="collapse" style="color: #70421d;"
                    href="#header-cari">
                    Search <span class="d-none d-md-inline">Menu</span>
                </a>
            </div>
            <div class="col">
                <span class="fw-semibold">Table 2</span>
            </div>
        </div>

        {{-- collapse header cari --}}
        <div class="collapse" id="header-cari">
            <div class="py-2">
                <div class="input-group mb-2" style="border-bottom: solid 1px #70421d;">
                    <input type="search" placeholder="Search..."
                        class="form-control bg-transparent rounded-0 border-0 px-0">
                    <button class="btn border-0" style="color: inherit;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <ul id="hasil-header-cari" class="nav nav-pills row text-capitalize text-nowrap text-center g-1">
                    <li class="nav-item col">
                        <a class="nav-link" href="#">minuman&nbsp;<i class="bi bi-x"></i></a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">makanan&nbsp;<i class="bi bi-x"></i></a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">food&nbsp;<i class="bi bi-x"></i></a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">single origin&nbsp;<i class="bi bi-x"></i></a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link" href="#">supresso&nbsp;<i class="bi bi-x"></i></a>
                    </li>
                </ul>
                <style>
                    #hasil-header-cari .nav-link {
                        border: solid 1px transparent;
                        background-color: rgba(112, 66, 29, .25);
                        color: #70421d;
                        font-size: .875em;
                        padding: .25rem .5rem;
                    }

                    #hasil-header-cari .nav-link:hover,
                    #hasil-header-cari .nav-link.active {
                        border: solid 1px #70421d;
                        background-color: #70421d;
                        color: #cea787;
                    }
                </style>
            </div>
        </div>

        {{-- collapse submenu link --}}
        @if ($pages == 'Submenu')
            <div id="submenu-list" class="collapse show">
                <div class="table-responsive pt-2">
                    <ul id="navtab-submenu" class="nav nav-pills flex-nowrap text-capitalize text-nowrap fw-semibold">
                        @foreach ($subcategory as $subcat)
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu-{{ $subcat->id }}">{{ $subcat->name }}</a>
                        </li>
                        @endforeach

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#submenu-coffee">coffee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu-drip">coffee drip</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu-frappe">frappe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#submenu-main-course">main course</a>
                        </li> --}}
                    </ul>
                    <style>
                        #navtab-submenu li a {
                            color: inherit;
                        }

                        #navtab-submenu li a.active {
                            color: #cea787;
                            background-color: #70421d;
                        }
                    </style>
                </div>
            </div>
        @endif

        {{-- collapse cart title --}}
        @if ($pages == 'cart')
            <div class="collapse show">
                <div class="fw-semibold pt-3">Cart.</div>
            </div>
        @endif

    </div>
</header>
