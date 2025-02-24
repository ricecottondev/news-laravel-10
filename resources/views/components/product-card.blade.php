@props(['products'])
@foreach ($products as $product)
    <div class="col">
        <a class="text-decoration-none text-reset" href="{{ $product['url'] }}">
            <div class="card rounded-0 bg-light border-0 text-reset position-relative">
                <!-- Add the Promo badge -->
                @if (isset($product['label_promo']))
                    <span class="badge text-bg-danger position-absolute top-0 end-0">{{ $product['label_promo'] }}</span>
                @endif

                <div class="row g-0">
                    <div class="col-4">
                        <div class="position-relative">
                            <div class="ratio ratio-1x1">
                                <img src="{{ $product['gambar'] }}" class="bg-light" width="100%" height="auto"
                                    alt="">
                            </div>

                        </div>
                    </div>



                    <div class="col-8">
                        <div class="card-body text-capitalize">
                            <p class="card-text small mb-0">{{ $product['kategori'] }}</p>
                            <h5 class="card-title fw-medium fs-reset mb-0">{{ $product['namaproduk'] }}</h5>
                            <p class="card-text small mb-2">{{ $product['kemasan'] }}</p>
                            <p class="card-text fw-medium">Rp {{ number_format($product['harga'], 0, ',', '.') }},-</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
