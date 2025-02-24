<nav id="navtop" class="navbar navbar-expand-lg small">
    <div class="container">

        <div class="navbar-brand d-lg-none" href="{{ url('/') }}">
            <img class="d-none" src="{{ url('ui/img/navbar/logo.svg') }}" width="55" height="55">
            <strong class="gotham-bold  fs-2 fs-lg-3 text-primary">DIGITAL MENU</strong>
        </div>
        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
            <img class="d-none" src="{{ url('ui/img/navbar/logo.svg') }}" width="80" height="80">
            <strong class="gotham-bold  fs-2 fs-lg-3 text-primary">DIGITAL MENU</strong>
        </a>

        <button class="btn border-0 d-lg-none" data-bs-toggle="modal" data-bs-target="#modal-search">
            <i class="bi bi-search"></i>
        </button>

        <div class="collapse navbar-collapse text-uppercase fw-bold">

            @include('front/menu')

            <ul class="navbar-nav d-none d-lg-flex">


                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="modal" href="#modal-search">
                        search
                    </a>
                </li>



                @php
                    $pagemark = '';
                    if (isset($title)) {
                        $pagemark = $title;
                    }
                @endphp

                <li class="nav-item">
                    @if (!empty(Auth::user()))
                        @if (Auth::user()->hasRole('member') == 1)
                            <a class="nav-link" href="{{ url('member/board') }}">
                                {{ Str::ucfirst(Auth::user()->name) }}
                            </a>
                        @else
                            <a class="nav-link {{ $pagemark === 'account' ? 'active' : '' }}"
                                href="{{ url('admin/orders') }}">
                                {{ Str::ucfirst(Auth::user()->name) }}
                            </a>
                        @endif
                    @else
                        <a class="nav-link {{ $pagemark === 'account' ? 'active' : '' }}" href="{{ url('login') }}"
                            onclick="$('#loading').collapse('show');">
                            Account
                        </a>
                    @endif
                </li>

                <li class="nav-item position-relative">
                    @if (!empty($pagemark) && $pagemark != '')
                        <a class="nav-link {{ $pagemark === 'Shopping Cart' ? 'active' : '' }}"
                            href="{{ url('fcart') }}" onclick="$('#loading').collapse('show');">cart</a>
                        <span class="badge text-light rounded-pill position-absolute top-0 translate-middle"
                            style="left: 75%; font-size: .875em; background-color: #fd4f00;">{{ Cart::getTotalQuantity() }}</span>
                    @endif
                </li>

            </ul>
        </div>

    </div>
</nav>
