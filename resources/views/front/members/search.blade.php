@extends('layouts.indracostorepoint.app-home')
@section('title')
    UI Beranda
@endsection

@section('content')
    <main class="wrapper">


        <section>
            <div class="container">
                <header class="mb-4">
                    <div class="row justify-content-between">
                        <div class="col">
                            <h6>Produk Yang Kamu Cari <span class="text-uppercase"
                                    style="font-weight: bold;">{{ request('keyword') }}</span></h6>

                        </div>

                    </div>
                </header>
                <div class="row row-cols-1 gy-3 row-cols-md-2 gx-md-4 gx-lg-5">
                    @if (count($data) > 0)
                        <x-product-card :products="$data" />
                        {{-- @foreach ($data as $product)
                            <div class="col">
                                <a class="text-decoration-none text-reset" href="{{ $product['url'] }}">
                                    <div class="card rounded-0 bg-light border-0 text-reset">
                                        <div class="row g-0">
                                            <div class="col-4"> --}}
                        {{-- <div class="ratio ratio-1x1">
                                                <img src="{{ $product['gambar'] ?? asset('sdamember-template/img/product/no_images.svg') }}"
                                                    width="100%" height="auto" alt="{{ $product['namaproduk'] }}">
                                            </div> --}}
                        {{-- <div class="ratio ratio-1x1"> --}}
                        {{-- <img src="{{ asset('sdamember-template/img/product/no_images.svg') }}"
                                                    width="100%" height="auto" alt=""> --}}
                        {{-- <img src="{{ $product['gambar'] }}" class="bg-light" width="100%"
                                                        height="auto" alt="">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body text-capitalize">
                                                    <p class="card-text small mb-0">{{ $product['kategori'] }}</p>
                                                    <h5 class="card-title fw-medium fs-reset mb-0">
                                                        {{ $product['namaproduk'] }}
                                                    </h5>
                                                    <p class="card-text small mb-2">{{ $product['kemasan'] }}</p>
                                                    <p class="card-text fw-medium">Rp
                                                        {{ number_format($product['harga'], 0, ',', '.') }},-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach --}}
                    @else
                        <img src="{{ asset('assets/images/no-results.png') }}" class="rounded mx-auto d-block "
                            alt="No Results Image">
                    @endif
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
