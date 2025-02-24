{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Merchant
@endsection

@section('content')
    <main class="wrapper">



        <section>
            <div class="container">
                <h4 class="fw-medium fs-3 text-capitalize">Merchants</h4>
                <p class="mb-5">
                    Kunjungi Merchant yang kamu butuhkan
                </p>
                <div class="row row-cols-1 row-cols-md-2 g-3 gx-lg-5">

                    @foreach ($merchants as $merchant)
                        <div class="col">
                            <div class="card text-reset bg-light border-0 rounded-0">
                                <div class="row g-0">
                                    <div class="col col-4 d-flex align-items-center justify-content-center"
                                        style="background-color: #d1d2d2;">
                                        <div>
                                            <img src="{{ $merchant->image }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col col-8">
                                        <div class="card-body d-flex flex-column h-100">
                                            <div class="flex-grow-1">
                                                <p class="card-title small mb-0"> {{ $merchant->label }}</p>
                                                <h5 class="card-title fs-reset fw-medium mb-0">
                                                    {{ $merchant->merchant_name }}</h5>
                                                {{-- <p class="card-text small mb-0">Marketplace</p> --}}
                                            </div>
                                            <p class="card-text small flex-grow-0">
                                                <a class="text-decoration-none" style="color: #fd4f00;"
                                                    href="{{ $merchant->url }}">
                                                    Kunjungi Sekarang <i class="icon-chevron_right"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>

    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#navdown ul li:last-child a').addClass('active');
        })
    </script>
@endpush
