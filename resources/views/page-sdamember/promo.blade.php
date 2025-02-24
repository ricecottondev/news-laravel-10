{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Promo
@endsection

@section('content')
    <nav id="navtopBelanja">
        <div class="bg-body border-bottom border-5 border-light">
            <div class="container">
                <ul class="nav flex-nowrap column-gap-4" style="font-size: 1.5rem; margin-left: -.5rem;">
                    <li class="nav-item">
                        <a id="triggerSidebarBelanja" class="nav-link" data-bs-toggle="offcanvas" href="#sidebarBelanja">
                            <i class="icon-menu opacity-0"></i>
                            <i class="icon-menu icon-trigger"></i>
                        </a>
                    </li>
                    <li class="nav-item d-flex flex-nowrap overflow-x-auto" style="font-size: 1rem;">
                        @foreach ($PromoCollection as $item)
                            <a class="nav-link {{ request()->has('search') && request('search') === $item ? 'active' : '' }}"
                                href="{{ route('promo.index', ['search' => $item]) }}">
                                <h1>{{ $item }}</h1>
                            </a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start border-0 bg-light text-reset" data-bs-scroll="true" data-bs-backdrop="static"
        tabindex="-1" id="sidebarBelanja" aria-labelledby="sidebarBelanjaLabel" style="max-width: 280px;">
        <div class="offcanvas-body p-0">
            <div class="list-group list-group-flush text-capitalize">
                @foreach ($PromoCollection as $item)
                    <a class="list-group-item bg-transparent text-reset  {{ request()->has('search') && request('search') === $item ? 'fw-bold' : '' }}"
                        href="{{ route('promo.index', ['search' => $item]) }}">
                        <h1>{{ $item }}</h1>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <main class="wrapper">

        <section class="py-3 py-md-4 py-lg-5">
            <div class="container">
                <div class="row row-cols-1 gy-3 row-cols-md-2 gx-md-4 gx-lg-5">
                    <x-product-card :products="$formattedData" />



                </div>
            </div>
        </section>



    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#navdown ul li:nth-child(2) a').addClass('active');
        })
    </script>
@endpush
