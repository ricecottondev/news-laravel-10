<!DOCTYPE html>
<html lang="en">

<head>
    @include('front.layouts.head')
    {{-- <script src="layout/head.js"></script> --}}
    <title>FactaBot &bull; Home</title>

    @stack('styles')
    <style>
        * {
            outline: solid 1px green;
            outline: solid 1px transparent;
        }
    </style>
</head>

<body>
    @include('front.layouts.navtop')
    @include('front.layouts.sidebar')
    {{-- <script src="layout/navtop.js"></script> --}}
    {{-- <script src="layout/sidebar.js"></script> --}}
    <header>
        @include('front.layouts.header-menu')
        @include('front.layouts.running-text')

        {{-- <script src="layout/header-menu.js"></script>
        <script src="layout/running-text.js"></script> --}}
    </header>
    <main class="mb-5">



        @yield('content')

    </main>

    <div id="modalFormTestimoni" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="d-flex flex-nowrap column-gap-2 align-items-center">
                        <div class="ratio ratio-1x1" style="width: 2rem;">
                            <img src="/assets/template3/asset/img/logo-bot.png" class="object-fit-cover"
                                alt="">
                        </div>
                        <h5 class="mb-0">
                            <b class="fw-bold">
                                Leave Testimoni
                            </b>
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-md-4">
                    <form action="" class="d-flex flex-column row-gap-3">
                        <div class="form-group border-bottom">
                            <!-- <label for="" class="form-label small mb-2">*Name</label> -->
                            <input type="text" class="form-control shadow-none border-0 px-0" placeholder="Name">
                        </div>
                        <div class="form-group border-bottom">
                            <!-- <label for="" class="form-label small mb-2">*Address</label> -->
                            <input type="text" class="form-control shadow-none border-0 px-0"
                                placeholder="Address">
                        </div>
                        <div class="form-group border-bottom">
                            <!-- <label for="" class="form-label small mb-2">*Testimoni</label> -->
                            <textarea name="" rows="5" class="form-control shadow-none border-0 px-0" id=""
                                placeholder="Type Testimoni"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 px-md-4 pb-4">
                    <button class="btn btn-warning w-100">
                        <i class="fas fa-paper-plane"></i> Send Testimonial
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('front.layouts.footbar')
    {{-- <script src="layout/footbar.js"></script> --}}
    <script src="/assets/template3/js/theme.js"></script>
    <script src="/assets/template3/js/global.js"></script>
</body>

</html>
