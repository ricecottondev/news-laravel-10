<div id="navdown" class="fixed-bottom d-lg-none bg-white border-top">
    <nav class="navbar navbar-light p-0">
        <div class="collapse navbar-collapse text-uppercase fw-bold" id="navcol">
            @include('front/menu')
        </div>
    </nav>

    @php
        $pagemark = '';
        if(isset($title))
           $pagemark = $title;     
    @endphp

    <nav class="nav flex-nowrap nav-justified">
        <a href="{{ url('') }}" class="nav-link {{ $pagemark === 'Home' ? 'active' : '' }}">
            <img src="{{ url('files/navdown/house.svg') }}" alt="">
        </a>
        <a href="{{ url('fproducts') }}" class="nav-link {{ $pagemark === 'Collection' ? 'active' : '' }}">
            <img src="{{ url('files/navdown/bijikopi.svg') }}" alt="">
        </a>
        <a data-bs-toggle="collapse" href="#navcol" class="nav-link">
            <img src="{{ url('files/navdown/list.svg') }}" alt="">
        </a>
        <a href="{{ url('member/board') }}" class="nav-link {{ $pagemark === 'account' ? 'active' : '' }}">
            <img src="{{ url('files/navdown/person.svg') }}" alt="">
        </a>
        <a href="{{ url('fcart') }}" class="nav-link {{ $pagemark === 'Shopping Cart' ? 'active' : '' }}">
            <span class="position-relative">
                <img src="{{ url('files/navdown/cart.svg') }}" alt="">
                <span
                    class="badge text-light rounded-pill position-absolute top-0 start-100 translate-middle" style="background-color: #fd4f00;">{{ Cart::getTotalQuantity() }}</span>
            </span>
        </a>
    </nav>
</div>


<!-- <div id="navdown" class="fixed-bottom d-none border-top">
    <nav class="navbar bg-white">
        <div class="container-fluid justify-content-around">
            @if (!empty($title ?? '') && $title ?? '' == 'home')
<a href="{{ url('/') }}" id="navdownHome" class="btn btn-lg btn-dot border-0 rounded-0 {{ $title ?? '' ?? '' === 'home' ? 'active' : '' }}">
                <i class="bi bi-house"></i>
                <span class="dot">&bull;</span>
            </a>
@else
<a href="{{ url('/') }}" id="navdownHome" class="btn btn-lg btn-dot border-0 rounded-0">
                <i class="bi bi-house"></i>
                <span class="dot"></span>
            </a>
@endif

            {{-- <a href="{{ url('') }}" id="navdownEmail" class="btn btn-lg btn-dot border-0 rounded-0">
            <i class="bi bi-envelope"></i>
            <span class="dot">&bull;</span>
            </a> --}}

            <a href="{{ url('fproducts') }}" id="navdownEmail" class="btn btn-lg btn-dot border-0 rounded-0 {{ $title ?? '' ?? '' === 'Collection' ? 'active' : '' }}" onclick="$('#loading').collapse('show');">
                {{-- <i class="bi bi-box-seam"></i> --}}

                @if ($title ?? '' == 'Collection')
<img src="{{ url('files/biji-kopi.svg') }}" width="auto" height="20" alt=""><span class="dot">&bull;</span>
@else
<img src="{{ url('files/biji-kopi.svg') }}" width="auto" height="20" style="opacity: 0.5;" alt="">
                <span class="dot"></span>
@endif
            </a>

            <button id="triggerNavcol" class="btn btn-lg btn-dot border-0 rounded-0" data-bs-toggle="collapse" data-bs-target="#navcol">
                <i class="bi bi-list"></i>
                <span class="dot">&bull;</span>
            </button>

            @if (!empty(Auth::user()))
@if (Auth::user()->hasRole('member') == 1)
<a href="{{ url('member/board') }}" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0 {{ $title ?? '' ?? '' === 'account' ? 'active' : '' }}" onclick="$('#loading').collapse('show');">
                <i class="bi bi-person-check"></i>
                @if ($title ?? '' == 'account')
<span class="dot">&bull;</span>
@else
<span class="dot"></span>
@endif
            </a>
@else
<a href="{{ url('login') }}" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0 {{ $title ?? '' ?? '' === 'account' ? 'active' : '' }}" onclick="$('#loading').collapse('show');">
                <i class="bi bi-person"></i>
                @if ($title ?? '' == 'account')
<span class="dot">&bull;</span>
@else
<span class="dot"></span>
@endif
            </a>
@endif
@else
@if (!empty($title ?? '') && $title ?? '' == 'account')
<a href="{{ url('login') }}" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0 {{ $title ?? '' ?? '' === 'account' ? 'active' : '' }}" onclick="$('#loading').collapse('show');">
                <i class="bi bi-person"></i>
                @if ($title ?? '' == 'account')
<span class="dot">&bull;</span>
@else
<span class="dot"></span>
@endif
            </a>
@else
<a href="{{ url('login') }}" id="navdownAccount" class="btn btn-lg btn-dot border-0 rounded-0" onclick="$('#loading').collapse('show');">
                <i class="bi bi-person"></i>
                <span class="dot"></span>
            </a>
@endif
@endif


            @if (!empty($title ?? '') && $title ?? '' == 'Shopping Cart')
<a href="{{ url('fcart') }}" id="navdownCart" class="btn btn-lg btn-dot border-0 rounded-0 overflow-visible {{ $title ?? '' ?? '' === 'Shopping Cart' ? 'active' : '' }}">
                <i class="bi bi-cart"></i>
                @if ($title ?? '' == 'Shopping Cart')
<span class="dot">&bull;</span>
@else
<span class="dot"></span>
@endif
                <span class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x" style="font-size: .55em;">{{ Cart::getTotalQuantity() }}</span>
            </a>
@else
<a href="{{ url('fcart') }}" id="navdownCart" class="btn btn-lg btn-dot border-0 rounded-0 overflow-visible">
                <i class="bi bi-cart"></i>
                <span class="dot"></span>
                <span class="badge text-bg-danger rounded-pill position-absolute top-0 start-75 translate-middle-x" style="font-size: .55em;">{{ Cart::getTotalQuantity() }}</span>
            </a>
@endif

        </div>
    </nav>
</div> -->
