<div id="modalSearching" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div class="input-group input-group-lg border border-2 border-dark rounded overflow-hidden">
                    <button class="btn px-2"><i class="bi bi-search"></i></button>
                    <!--
                  <input type="search" class="form-control border-0 px-0 bg-transparent" placeholder="Search Menu" style="font-size: 1rem!important;">
                  -->
                    <input type="search" name="keyword" id="keyword"
                        class="form-control border-0 px-0 bg-transparent" placeholder="Pencarian"
                        style="font-size: 1rem!important;">
                </div>
                <!--
               <button class="btn text-dark border-0 d-md-none" data-bs-dismiss="modal">Cancel</button>
               -->
                <button class="btn text-dark border-0 d-md-none" data-bs-dismiss="modal">Batal</button>
            </div>
            <div class="modal-body">

                <!-- section riwayat pencarian -->
                <section class="mb-4">

                    <!-- jika tidak terdapat riwayat pencarian -->
                    <!--
                  <p class="text-center opacity-50">No recent searches</p>
                  -->
                    @if (isset($latestSearchHistory) && (count($latestSearchHistory) > 0))
                        <h6 class="small"><strong>Riwayat Pencarian</strong></h6>
                        <div class="list-group text-capitalize">
                            @foreach ($latestSearchHistory as $History)
                                <a class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center"
                                    href="{{ route('search.index', ['keyword' => $History]) }}">
                                    <div>
                                        <i class="bi bi-clock-history me-2"></i>
                                        <span>{{ $History }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center opacity-50">Tidak Ada Riwayat Pencarian</p>
                    @endif

                </section>
                <hr class="mb-4">
                <!-- preview search section -->
                @if(isset($popularSearches))
                <section class="mb-4">
                    <!--
                  <h6 class="small"><strong>Searching Item</strong></h6>
                  -->
                    <h6 class="small"><strong>Popular Pencarian</strong></h6>
                    <div class="list-group text-capitalize">
                        @foreach ($popularSearches as $popular)
                            <a class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center "
                                href="{{ route('search.index', ['keyword' => $popular]) }}">
                                <div>
                                    <i class="bi bi-file-earmark me-2"></i>
                                    <span>{{ $popular }}</span>
                                </div>
                                {{-- <div class="btn-group" style="margin-right: -.5rem;">
                                <button class="btn px-2" style="color: inherit;">
                                    <i class="bi bi-arrow-return-left"></i>
                                </button>
                            </div> --}}
                            </a>
                        @endforeach


                    </div>
                </section>
                @endif
                <hr class="mb-4">
                <!-- preview search section -->
                 @if(isset($promoSeacrh))
                <section class="mb-4">
                    <!--
                  <h6 class="small"><strong>Searching Item</strong></h6>
                  -->
                    <h6 class="small"><strong>Promo</strong></h6>
                    <div class="list-group text-capitalize">

                        @foreach ($promoSeacrh as $promo)
                            <a class="list-group-item list-group-item-action d-flex flex-nowrap justify-content-between align-items-center "
                                href="{{ route('search.index', ['keyword' => $promo]) }}">
                                <div>
                                    <i class="bi bi-info-square"></i>
                                    <span>{{ $promo }}</span>
                                </div>
                                {{-- <div class="btn-group" style="margin-right: -.5rem;">
                                <button class="btn px-2" style="color: inherit;">
                                    <i class="bi bi-arrow-return-left"></i>
                                </button>
                            </div> --}}
                            </a>
                        @endforeach


                    </div>
                </section>
                @endif




            </div>
            <div class="modal-footer border-dark-subtle">
                <p class="text-end"><small><small>Search by</small> INDRACO</small></p>
            </div>
        </div>
    </div>
</div>
<style>
    #modalSearching .list-group-item.active {
        background-color: #565656;
        border-color: #565656;
    }
</style>
