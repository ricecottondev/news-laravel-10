@if (isset($product))
@foreach ($product as $prdct)
<div class="offcanvas offcanvas-bottom bg-transparent border-0" data-bs-backdrop="static" tabindex="-1"
id="detail-produk-{{ $prdct->id }}" aria-labelledby="detail-produkLabel" style="--bs-offcanvas-height: auto;">
<div class="offcanvas-header">
    <button type="button" class="btn-close ms-auto btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>
<div class="offcanvas-body p-0" style="background-color: #cea787; color: #70421d;">
    <div id="img-detail-produk" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#img-detail-produk" data-bs-slide-to="0" aria-label="Slide 1"
                class="active"></button>
            <button type="button" data-bs-target="#img-detail-produk" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#img-detail-produk" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">

            @php
            $urlImgError = url('files/' . 'imagenotavailable.jpg');
            if (!empty($prdct->fileimages)) {
                $image = json_decode($prdct->fileimages);
            } else {
                $image = "";
            } 
            @endphp

            @if ($image == "")
                <img class="img-fluid rounded" src="{{ url('files/' . 'imagenotavailable.jpg') }}">
                @php
                    $img = 'imagenotavailable.jpg';
                @endphp
            @else
                @for ($i = 0; $i < count($image); $i++)
                    @if ($i==0)
                    <div class="carousel-item position-relative active">
                        <img src="{{ url('files/product-images/'.$image[$i]) }}"
                            class="d-block w-100 position-absolute top-50 start-50 translate-middle" alt="">
                    </div> 
                    @else
                    <div class="carousel-item position-relative">
                        <img src="{{ url('files/product-images/'.$image[$i]) }}"
                            class="d-block w-100 position-absolute top-50 start-50 translate-middle" alt="">
                    </div>
                    @endif
                @endfor
                @php
                $img = $image[0];
                @endphp
                {{-- <img src="{{ url('files/product-images/'.$image[0]) }}" class="img-fluid rounded" alt=""> --}}
            @endif


         
        </div>
        <button class="carousel-control-prev display-2" data-bs-target="#img-detail-produk" data-bs-slide="prev">
            <i class="bi bi-chevron-left"></i>
        </button>
        <button class="carousel-control-next display-2" data-bs-target="#img-detail-produk" data-bs-slide="next">
            <i class="bi bi-chevron-right"></i>
        </button>
    </div>
    <style>
        #img-detail-produk .carousel-item {
            height: 36vh;
        }
    </style>
    <div class="container py-3">
        <div class="row row-cols-auto justify-content-between align-items-center mb-3">
            <div class="col">
                <h5 class="fw-semibold text-capitalize mb-1">{{ $prdct->name }}</h5>
                <div class="small">supresso single origin</div>
            </div>
            <div class="col fw-semibold">
                {{ $prdct->price * 1000 }}
                {{-- Rp 45.000,- --}}
            </div>
        </div>
        <div class="overflow-auto mb-3">
            <ul id="portionRequest" class="nav nav-pills flex-nowrap row g-2 text-center fw-semibold">
                <li class="nav-item col">
                    <a class="nav-link active" href="#">Small<br>Rp&nbsp;45.000,-</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#">Medium<br>Rp&nbsp;45.000,-</a>
                </li>
                <li class="nav-item col">
                    <a class="nav-link" href="#">Large<br>Rp&nbsp;45.000,-</a>
                </li>
            </ul>
            <style>
                #portionRequest .nav-link {
                    color: #cea787;
                    background-color: #70421d;
                    font-size: .875em;
                    padding: .375rem .75rem;
                }
            </style>
        </div>
        <textarea name="" id=""
            class="form-control rounded-0 border-start-0 border-top-0 border-end-0 bg-transparent px-0" cols="1"
            rows="1" placeholder="Tap to enter special requirement" style="border-color: rgba(112, 66, 29, 1);"></textarea>
    </div>
    <div style="background-color: rgba(0,0,0,.075);">
        <div class="container py-3 d-flex justify-content-between align-items-center">
            <strong>Mods</strong>
            <span>Choose up to 1</span>
        </div>
    </div>
    <div class="container py-3">
        <ul id="customRequest" class="list-unstyled mb-5">
            <li class="form-check">
                <input class="form-check-input rounded-circle" type="checkbox" value="" id="customRequest1"
                    checked>
                <label class="form-check-label d-flex" for="customRequest1">
                    <span class="w-50">Skinny&nbsp;Milk</span>
                    <span class="w-50 d-inline-flex align-items-center justify-content-between">
                        <span>+&nbsp;Rp&nbsp;</span> <span>5.000,-</span>
                    </span>
                </label>
            </li>
            <li class="form-check">
                <input class="form-check-input rounded-circle" type="checkbox" value="" id="customRequest2">
                <label class="form-check-label d-flex" for="customRequest2">
                    <span class="w-50">Soy&nbsp;Milk</span>
                    <span class="w-50 d-inline-flex align-items-center justify-content-between">
                        <span>+&nbsp;Rp&nbsp;</span> <span>5.000,-</span>
                    </span>
                </label>
            </li>
            <li class="form-check">
                <input class="form-check-input rounded-circle" type="checkbox" value=""
                    id="customRequest3">
                <label class="form-check-label d-flex" for="customRequest3">
                    <span class="w-50">Oat&nbsp;Milk</span>
                    <span class="w-50 d-inline-flex align-items-center justify-content-between">
                        <span>+&nbsp;Rp&nbsp;</span> <span>5.000,-</span>
                    </span>
                </label>
            </li>
        </ul>
        <style>
            #customRequest>li {
                padding-top: .325rem;
                padding-bottom: .325rem;
                border-bottom: solid 1px rgba(112, 66, 29, .5);
            }

            #customRequest>li:last-child {
                border-color: transparent !important;
            }
        </style>


<form action="{{ route('cart.store') }}"  method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row row-cols-auto align-items-center justify-content-between fs-5 fw-semibold mb-3">
            <div class="col">
                <span class="bi bi-dash-circle-fill" style="cursor: pointer;"></span>
                <span class="mx-2">1</span>
                <span class="bi bi-plus-circle-fill" style="cursor: pointer;"></span>
            </div>
            <div class="col">Rp 150.000,-</div>
        </div>

      
@if (isset($_GET["menu"]))
<input type="hidden" value="{{ $_GET["menu"] }}" name="menu">
@endif
      

        <input type="hidden" value="{{ $prdct->id }}" name="id">
        <input type="hidden" value="{{ $prdct->name }}" name="name">
        <input type="hidden" value="{{ $prdct->description }}" name="description">
        <input type="hidden" value="{{ $prdct->portion }}" name="portion">
        <input type="hidden" value="{{ $prdct->units }}" name="units">
        <input type="hidden" value="{{ $prdct->brand }}" name="brand">
        <input type="hidden" value="{{ $prdct->category }}" name="category">
        <input type="hidden" value="{{ $prdct->subcategory }}" name="subcategory">
        
        {{-- <input type="hidden" value="1" name="quant[2]"  id="qty-product"> --}}
        <input type="hidden" value="1" name="stock"  id="stock-product">
        {{-- <input type="hidden" value="" name="stockweb"  id="stockweb">
        <input type="hidden" value="" name="gramature">
        <input type="hidden" value="" name="collection">
        <input type="hidden" value="" name="discount">
        <input type="hidden" value="" name="pricemaster">
        <input type="hidden" value="" name="priceafterdiscount"> --}}
        <input type="hidden" value="{{ $img }}" name="images">
        <input type="hidden" value="{{ $prdct->price }}" name="price">

        <button class="btn btn-dark w-100">Add To Cart</button>
</form>

       
    </div>
</div>
</div> 
@endforeach
@endif


