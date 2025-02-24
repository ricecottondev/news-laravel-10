@extends('front/layout')

@section('konten')
    <!-- detail product section -->
    <section>
        <div class="container">
            <div class="row">

                <!-- header menu -->
                <div class="col-12">
                    <div class="pt-4 d-flex justify-content-between d-lg-none">
                        <a href="/fnews" class="btn btn-lg border-0 rounded-0">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                        <a href="/cart" class="btn btn-lg border-0 rounded-0 position-relative">
                           
                        </a>
                    </div>
                    <div class="d-none d-lg-block mb-4">
                        <a href="/fnews" class="text-inherit">
                            <i class="bi bi-chevron-left"></i> Back To List News
                        </a>
                    </div>
                </div>
                <!-- end of header menu -->

                <!-- foto produk -->
                <div class="col-lg-6 col-xl-5 col-xxl-auto mb-5 mb-lg-0">
                    <div id="fotoDetailCoffee" class="carousel slide d-lg-flex align-items-start" data-bs-ride="false">
                        <div class="carousel-inner mb-3 mb-lg-0 order-lg-2">

                          

                            <div class="position-relative" id="coffeeVariant">
                                <img src="{{ url('files/news-images/' . $news_detail->image) }}" class="img-fluid"
                                    alt="">
                              
                            </div>
                           
                        </div>
                       
                    </div>
                    
                </div>
                <!-- end of foto produk -->

                <!-- kolom spesifikasi -->
                <div class="col-lg-6 col-xl-7  spesifikasi-produk ms-xxl-auto">
                    <p class="mb-2">News {{ $news_detail->updated_at }}</p>
                    <h3 class="gotham-bold fs-2 fs-lg-3">{{ $news_detail->title }}</h3>
                    <p>Author : {{ $news_detail->author }}</p>
                    <p class="text-justify">{!! $news_detail->text !!}</p>
                </div>
             
                <div class="col-lg-12 mt-3">
                    <div id="addproduct-accordion" class="custom-accordion">
                        <div class="card mb-2">
                            <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse"
                                aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                                <div class="p-4">
        
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    01
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Product Info</h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
        
                                </div>
                            </a>
        
                            <div id="addproduct-billinginfo-collapse" class="collapse collapsed" data-bs-parent="#addproduct-accordion">
                                <div class="p-4 border-top">
                                    <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> SKU:</label>
                                            <div class="col-md-10">
                                            <input class="form-control" type="text" name="sku" placeholder="">
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Name :</label>
                                            <div class="col-md-10">
                                            <input class="form-control" type="text" name="product_name" placeholder="">
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Detail :</label>
                                            <div class="col-md-10">
                                            <textarea class="form-control" style="height:150px" name="product_detail" placeholder=""></textarea>
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Shortdetail :</label>
                                            <div class="col-md-10">
                                            <textarea class="form-control" style="height:150px" name="product_shortdetail" placeholder=""></textarea>
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Brand :</label>
                                            <div class="col-md-10">
                                            <input class="form-control" type="text" name="product_brand" placeholder="">
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Collection :</label>
                                            <div class="col-md-10">
                                                <select class="form-select" name="product_collection">
                                              
                                                </select>
                                        
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Type :</label>
                                            <div class="col-md-10">
        
                                                <select class="form-select" name="product_type">
                                               
                                                </select>
        
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Form :</label>
                                            <div class="col-md-10">
        
                                                <select class="form-select" name="product_form">
                                              
                                                </select>
        
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Package :</label>
                                            <div class="col-md-10">
                                                <select class="form-select" name="product_package">
                                              
                                                </select>
        
                                        
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Price :</label>
                                            <div class="col-md-10">
                                            <input class="form-control" type="text" name="product_price" placeholder="">
                                            </div>
                                    
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-package-label"> Product Price Currency :</label>
                                            <div class="col-md-10">
                                            <input class="form-control" type="text" name="product_price_currency" placeholder="">
                                            </div>
                                    
                                        </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="card mb-2">
                            <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
                                aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                                aria-controls="addproduct-img-collapse">
                                <div class="p-4">
        
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    02
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Product Image</h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
        
                                </div>
                            </a>
        
                            <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                                <div class="p-4 border-top">
                                   
        
                                    <div class="input-group hdtuto control-group lst increment" >
                                   
                                    <input type="file" name="filenames[]" class="myfrm form-control">
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                    </div>
        
                                    <div class="clone hide">
                                    <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                        <input type="file" name="filenames[]" class="myfrm form-control">
                                        <div class="input-group-btn"> 
                                        <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                    </div>
        
        
        
                                </div>
                            </div>
                        </div>
        
                        <div class="card mb-2">
                            <a href="#addproduct-metadata-collapse" class="text-dark collapsed" data-bs-toggle="collapse"
                                aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                                aria-controls="addproduct-metadata-collapse">
                                <div class="p-4">
        
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                    03
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="font-size-16 mb-1">Meta Data</h5>
                                            <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                        </div>
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
        
                                </div>
                            </a>
        
                            <div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                                <div class="p-4 border-top">
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Weight :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_weight" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Width :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_width" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Height :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_height" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Length :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_length" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Acidity Score :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_acidityscore" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Acidity Desc :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_aciditydesc" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Body Score :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_bodyscore" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Body Desc :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_bodydesc" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Roast Desc :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_roastdesc" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Type Desc :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_typedesc" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Product Intensity :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="product_intensity" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label"> Status Stock :</label>
                                                        <div class="col-md-10">
                                                        <input class="form-control" type="text" name="status_stock" placeholder="">
                                                        </div>
                                                
                                                    </div>
                                                
                                                    <div class="mb-3 row">
                                                        <label class="col-md-2 col-package-label">Status :</label>
                                                        <div class="col-md-10">
                                                            <select class="form-select" name="status">
                                                                <option>Active</option>
                                                                <option>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- edn of detail product section -->

    <!-- alternate product -->
    <section>
        <div class="container">
            <h5 class="gotham-bold mb-4">Others News</h5>
            <div id="sliderAlternateProduct" class="carousel carousel-dark slide carousel-product" data-bs-ride="carousel"
                data-bs-pause="false">
                <div class="carousel-inner">

                    <!-- product item -->
                    <!-- untuk produk out of stock add class 'out-stock' on 'card-product', add class 'd-none' on 'wobler' when prodcut didn't have discount, harga produk ada dua pilihan 'harga-normal' dan 'harga-promo' -->
                    @foreach ($res_news as $item)
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
    </section>
@endsection

@section('popup')
    <!-- navigasi menu detail product -->


    <!-- toast/ notifikasi add product -->
@endsection
