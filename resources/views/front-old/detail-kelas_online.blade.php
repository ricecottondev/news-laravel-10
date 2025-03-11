@extends('front/layout')

@section('konten')
    <!-- detail product section -->
    <section>
        <div class="container">
            <div class="row">

                <!-- header menu -->
                <div class="col-12">
                    <div class="pt-4 d-flex justify-content-between d-lg-none">
                        <a href="/fkelasonline" class="btn btn-lg border-0 rounded-0">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        {{-- <a href="/cart" class="btn btn-lg border-0 rounded-0 position-relative">
                           
                        </a> --}}
                    </div>
                    <div class="d-none d-lg-block mb-4">
                        <a href="/fkelasonline" class="text-inherit">
                            <i class="bi bi-chevron-left"></i> Back To Kelas Online
                        </a>
                    </div>
                </div>
                <!-- end of header menu -->

                <!-- foto produk -->
                <div class="col-lg-6 col-xl-5 col-xxl-auto mb-5 mb-lg-0">
                    <div id="fotoDetailCoffee" class="carousel slide d-lg-flex align-items-start" data-bs-ride="false">
                        <div class="carousel-inner mb-3 mb-lg-0 order-lg-2">

                          

                            <div class="position-relative" id="coffeeVariant">
                                <img src="{{ url('files/news-images/' . $kelas_online->image) }}" class="img-fluid"
                                    alt="">
                              
                            </div>
                           
                        </div>
                       
                    </div>
                    
                </div>
                <!-- end of foto produk -->

                <!-- kolom spesifikasi -->
                <div class="col-lg-6 col-xl-7  spesifikasi-produk ms-xxl-auto">
                    <p class="mb-2">Last Update {{ $kelas_online->updated_at }}</p>
                    <h3 class="gotham-bold fs-2 fs-lg-3">{{ $kelas_online->title }}</h3>
                    <p>Author : {{ $kelas_online->author }}</p>
                    <p class="text-justify">{!! $kelas_online->text !!}</p>
                </div>
             
                <div class="col-lg-12 mt-3">
                    <div id="addproduct-accordion" class="custom-accordion">
                        

@foreach ($kelas_online_detail as $detailitem)
<div class="card mb-2">
    <a href="#addproduct-billinginfo-collapse{{$detailitem->id}}" class="text-dark" data-bs-toggle="collapse"
        aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
        <div class="p-4">

            <div class="d-flex align-items-center">
                <div class="me-3">
                    <div class="avatar-xs">
                        <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                            {{$loop->index + 1}}
                        </div>
                    </div>
                </div>
                <div class="flex-1 overflow-hidden">
                    <h5 class="font-size-16 mb-1">{{$detailitem->title}}</h5>
                    <p class="text-muted text-truncate mb-0">{{$detailitem->short_desc}}</p>
                </div>
                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
            </div>

        </div>
    </a>

    <div id="addproduct-billinginfo-collapse{{$detailitem->id}}" class="collapse collapsed" data-bs-parent="#addproduct-accordion">
        <div class="p-4 border-top">
            {!!$detailitem->text!!}
        </div>
    </div>
</div>
@endforeach

                        
        
                        {{-- asdasd --}}
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- edn of detail product section -->

    <!-- alternate product -->
    {{-- <section>
        <div class="container">
            <h5 class="gotham-bold mb-4">Others News</h5>
            <div id="sliderAlternateProduct" class="carousel carousel-dark slide carousel-product" data-bs-ride="carousel"
                data-bs-pause="false">
                <div class="carousel-inner">

                    <!-- product item -->
                    <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
                    @foreach ($kelas_online as $item)
                        @if ($loop->index == 0)
                            <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white active" >
                            @else
                                <div class="carousel-item row flex-nowrap gx-xxl-5 bg-white">
                        @endif

                        <div class="col-auto col-product">
                            <div class="card card-product border-0 rounded-0 text-center">
                                <div class="card-header position-relative p-0 rounded-0 border-0">
                                    <a href="/fnews/{{ $item->id }}" class="text-text-decoration-none">
                                        <img src="{{ url('files/news-images/' . $item->image) }}" class="img-fluid">
                                        <img src="{{ url('files/news-images/' . $item->image) }}" class="img-fluid">
                                    </a>
                                </div>
                                <div class="card-body text-capitalize px-0 pb-0">
                                    <div class="cart-title fw-bold lh-sm">{{ $item->title }}</div>

                                    <div class="harga-produk mb-0">

                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
                @endforeach
               

            </div>

            <!-- carousel control/ navigator slider -->
            <div class="carousel-control d-none d-md-block">
                <button
                    class="carousel-control-prev justify-content-end align-items-start bg-white translate-middle-y py-4"
                    type="button" data-bs-target="#sliderAlternateProduct" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" style="width: 40px; height: 40px;"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Preview</span>
                </button>
                <button
                    class="carousel-control-next justify-content-end align-items-start bg-white translate-middle-y py-4"
                    type="button" data-bs-target="#sliderAlternateProduct" data-bs-slide="next">
                    <span class="carousel-control-next-icon" style="width: 40px; height: 40px;"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
        </div>
    </section> --}}
@endsection

@section('popup')
    <!-- navigasi menu detail product -->


    <!-- toast/ notifikasi add product -->
@endsection
