{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Store
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
                        @foreach ($brand as $item)
                            <a class="nav-link {{ request()->has('search') && request('search') === $item ? 'active' : '' }}"
                                href="{{ route('belanja.index', ['merchant' => request('merchant'), 'search' => $item]) }}">
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
                @foreach ($merchant as $item)
                    <a class="list-group-item bg-transparent text-reset  {{ request()->has('merchant') && request('merchant') === $item ? 'fw-bold' : '' }}"
                        href="{{ route('belanja.index', ['merchant' => $item]) }}">
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
                    <x-product-card :products="$product" />
                    {{-- @foreach ($product as $item)
                        <div class="col">
                            <a class="text-decoration-none text-reset" href="{{ $item['url'] }}">
                                <div class="card rounded-0 bg-light border-0 text-reset">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <div class="ratio ratio-1x1"> --}}
                    {{-- <img src="{{ asset('sdamember-template/img/product/no_images.svg') }}"
                                                    width="100%" height="auto" alt=""> --}}
                    {{-- <img src="{{ $item['gambar'] }}" class="bg-light" width="100%"
                                                    height="auto" alt="">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body text-capitalize">
                                                <p class="card-text small mb-0">{{ $item['kategori'] }}</p>
                                                <h5 class="card-title fw-medium fs-reset mb-0">{{ $item['namaproduk'] }}
                                                </h5>
                                                <p class="card-text small mb-2">{{ $item['kemasan'] }}</p>
                                                <p class="card-text fw-medium">Rp
                                                    {{ number_format($item['harga'], 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach --}}


                </div>
            </div>
        </section>



    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#navdown ul li:nth-child(3) a').addClass('active');
        })
    </script>
@endpush
