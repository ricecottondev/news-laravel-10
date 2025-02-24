<div id="modal-kodeunik" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable" style="$modal-fade-transform: scale(.8)">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0 position-absolute top-0 start-0" style="z-index: 100;">

                <div id="buttonclosemodal"><button class="btn-close text-bg-light" data-bs-dismiss="modal"></button></div>


            </div>
            <div class="modal-body p-0 m-3">
                <div id="carousel-detail-img" class="carousel slide mt-5">
                    <div class="carousel-indicators">
                        <button data-bs-target="#carousel-detail-img" data-bs-slide-to="0" class="active"></button>
                        <button data-bs-target="#carousel-detail-img" data-bs-slide-to="1"></button>
                        {{-- <button data-bs-target="#carousel-detail-img" data-bs-slide-to="2"></button> --}}
                    </div>

                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <img src="{{ url('files/info-images/') . '/' . 'snews11.png' }}" class="d-block w-100"
                                alt="">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ url('files/info-images/') . '/' . 'snews13.png' }}" class="d-block w-100"
                                alt="">
                        </div>

                        {{-- <div class="carousel-item">
                    <img src="{{ url('files/imagenotavailable.jpg') }}" class="d-block w-100"
                        alt="">
                </div> --}}

                    </div>
                    <button class="carousel-control-prev" data-bs-target="#carousel-detail-img" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" data-bs-target="#carousel-detail-img" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>

                <div class="row">
                    <div class="col-lg-12 mb-4">

                        <div class="card text-center my-auto" style="width: 100%; height: 100px;">
                            <div class="card-body align-items-center justify-content-center">
                                <div class="text-center" style="font-size: 12px; font-weight: 600">
                                    Dapatkan hadiah langsung dengan submit kode unik!
                                </div>
                                <div class="text-center" style="font-size: 10px">
                                    Masukkan kode unik yang tertera pada kemasan dan menangkan hadiah langsung Pulsa,
                                    Logam Mulia hingga Iphone 14
                                </div>
                                {{-- <div class="text-center">
                                    Total Akumulasi Poin Anda
                                   </div> --}}
                                {{-- <div class="text-center">
                                    <h3 class="fw-bold text-capitalize fs-3 mb-0">
                                        0 POIN
                                    </h3>
                                   </div> --}}

                            </div>
                        </div>


                    </div>
                    <div class="col-lg-12 mb-4">
                        <div id="reader"></div>

                        {{-- <div id="qr-reader-results"></div> --}}
                        <div id="reader-results"></div>

                       
                        <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                name="kodeunik1" id="kodeunik1" maxlength="4" style="font-size: 1rem!important;"> -
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                name="kodeunik2" id="kodeunik2" maxlength="4" style="font-size: 1rem!important;">
                            -
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                name="kodeunik3" id="kodeunik3" maxlength="4" style="font-size: 1rem!important;">
                            -
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value=""
                                name="kodeunik4" id="kodeunik4" maxlength="4" style="font-size: 1rem!important;">
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4 ">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <button type="button" onclick="checkkode()" class="btn text-bg-dark">
                                KIRIM
                            </button>
                            {{-- <a data-bs-toggle="modal" data-bs-target="#tes" class="nav-link">
                            <div class="card-body align-items-center d-flex justify-content-center">
                                Submit Kode Unik s
                            </div>
                            </a> --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-dark-subtle"></div>
        </div>
    </div>
</div>
