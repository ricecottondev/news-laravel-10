<nav class="navtop text-bg-dark sticky-top" style="z-index: 1030;">
    <div class="container-lg px-0 px-lg-3 py-lg-2 position-relative d-flex align-items-center flex-nowrap column-gap-3">
        <div class="flex-grow-0">
            <h1 class="text-reset fs-reset lh-base m-0">
                <a href="/" class="text-reset text-decoration-none d-flex align-items-center column-gap-2">
                    <div class="ratio ratio-1x1" style="width: 3.6rem;">
                        <img src="/assets/template3/asset/img/logo-bot.png" class="object-fit-contain" alt="">
                    </div>
                    <div>
                        <h5 class="mb-0 fs-4 lh-1">
                            <b class="fw-bold">FactaBot</b>
                        </h5>
                        <p class="text-uppercase mb-0 lh-1 text-warning">
                            <small style="font-size: calc(.5em + .125vw);">Real news. Sharp jokes. Zero
                                puppeteers</small>
                        </p>
                    </div>
                </a>
            </h1>
        </div>
        <div class="flex-grow-1">
            <div class="float-end d-flex flex-nowrap gap-1 column-gap-lg-3 align-items-center">
                <div>
                    <small id="date-display"><span class="d-none d-lg-inline">2025,</span> June, 12</small>
                </div>
                <div class="d-none d-md-block">

                    <form action="/search" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="search" name="q"
                                class="form-control border-light border-end-0 shadow-none" placeholder="Snoop Around"
                                required style="max-width: 20vw;">
                            <button class="btn btn-outline-light border-start-0 shadow-none">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>


                    <div class="d-none input-group">
                        <input type="search" class="form-control border-light border-end-0 shadow-none"
                            placeholder="Search">
                        <button class="btn btn-outline-light border-start-0 shadow-none">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                </div>
                <div class="d-none d-md-block">
                    <a href="/login" class="btn btn-outline-light">
                        Join the Roast
                    </a>
                </div>
                <button class="btn rounded-0 border-0 shadow-none p-3 p-lg-0" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebar">
                    <i class="fas fa-bars fa-xl"></i>
                </button>
            </div>
        </div>
    </div><!-- end container -->
</nav><!-- end navtop -->

@push('scripts')
    <script>
        const today = new Date();

        const year = today.getFullYear();
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const month = monthNames[today.getMonth()];
        const day = today.getDate();

        const formattedDate = `<span class="d-none d-lg-inline">${year},</span> ${month}, ${day}`;

        document.getElementById('date-display').innerHTML = formattedDate;
    </script>
@endpush
