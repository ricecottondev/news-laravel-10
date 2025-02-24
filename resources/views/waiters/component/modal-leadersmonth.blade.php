<div id="modal-leadersmonth" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable" style="$modal-fade-transform: scale(.8)">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0 position-absolute top-0 start-0" style="z-index: 100;">

                <div id="buttonclosemodal"><button class="btn-close text-bg-light" data-bs-dismiss="modal"></button></div>


            </div>
            <div class="modal-body p-0 m-3">


                <div class="row">

                    <div class="col-lg-12 mb-2 mt-5">
                        <div class="card text-center my-auto" style="width: 100%;">
                            <div class="card-body align-items-center justify-content-center">
                                    <div class="text-center">
                                    <h3 class="fw-bold text-capitalize fs-3 mb-0">
                                        TOP 5 BULAN {{ Str::upper($month_string) }} {{ Str::upper($year) }}
                                    </h3>
                                   </div>
                                   
                                   <div class="text-center" style="font-size: 10px">
                                    Data Terakhir Terupdate Pada
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Dapatkan 10 poin untuk setiap kode unik terdaftar dan menagkan hadiah e-wallet @rp. 2.000.000,00 TOP 5 setiap bulannya
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    Belum ada TOP 5
                                   </div>
                                   <div class="text-center" style="font-size: 10px">
                                    *Leader Board Ini Bersifat Sementara Dan Belum Final
                                   </div>
                                   <div class="text-left" style="font-size: 10px">
                                    <br>
                                  
                                   </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-lg-12 mb-4 mt-2">
                        <h4>Leaders Board</h4>
                        <ol id="listleadersmonth" class="list-group">

                        </ol>

                    </div>
                    
                    {{-- <div class="col-lg-12 mb-4 d-none">
                        <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value="2307"
                                name="kodeunik1" id="kodeunik1" maxlength="4" style="font-size: 1rem!important;"> -
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value="2603"
                                name="kodeunik2" id="kodeunik2" maxlength="4" style="font-size: 1rem!important;">
                            -
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value="1728"
                                name="kodeunik3" id="kodeunik3" maxlength="4" style="font-size: 1rem!important;">
                            -
                            <input class="form-control border-0 px-3 bg-transparent" placeholder="____" value="2088"
                                name="kodeunik4" id="kodeunik4" maxlength="4" style="font-size: 1rem!important;">
                        </div>
                    </div> --}}

                    <div class="col-lg-12 mb-4 d-none">
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
