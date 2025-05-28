<!DOCTYPE html>
<html lang="en">

<head>
    @include('front.layouts.head')
    <script src="layout/head.js"></script>
    <title>FactaBot &bull; Home</title>
    <link rel="stylesheet" href="/assets/template3/css/landing.css">
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

        <section class="pt-1">
            <div
                class="source-news text-bg-warning text-center py-1 small mb-3 d-md-flex flex-wrap align-items-md-center px-md-3 justify-content-md-center column-gap-md-4 py-xl-0">
                <div class="text-nowrap">The News Is Full of Spin. Here's the Sarcastic Truth, straight from</div>
                <div class="d-flex flex-nowrap justify-content-center gap-2 align-items-center">
                    <div>
                        <img src="assets/template3/asset/img/abc-logo-v1.png" width="20" height="auto" alt=""
                            class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/abc-logo-v1.png" width="35" height="auto"
                            alt="" class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                    <div>
                        <img src="assets/template3/asset/img/theguardian-logo.png" width="55" height="auto"
                            alt="" class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/theguardian-logo.png" width="80" height="auto"
                            alt="" class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                    <div>
                        <img src="assets/template3/asset/img/sbsnews-logo.png" width="55" height="auto"
                            alt="" class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/sbsnews-logo.png" width="95" height="auto"
                            alt="" class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                    <div>
                        <img src="assets/template3/asset/img/7news.png" width="50" height="auto" alt=""
                            class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/7news.png" width="85" height="auto" alt=""
                            class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                    <div>
                        <img src="assets/template3/asset/img/9news.png" width="50" height="auto" alt=""
                            class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/9news.png" width="95" height="auto" alt=""
                            class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                    <div>
                        <img src="assets/template3/asset/img/10news.png" width="50" height="auto" alt=""
                            class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/10news.png" width="75" height="auto" alt=""
                            class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                    <div>
                        <img src="assets/template3/asset/img/smh.png" width="20" height="auto" alt=""
                            class="my-1 my-lg-0 d-lg-none">
                        <img src="assets/template3/asset/img/smh.png" width="40" height="auto" alt=""
                            class="my-1 my-lg-0 d-none d-lg-inline">
                    </div><!-- end col -->
                </div>
                <div class="text-nowrap">and anyone who still does journalism</div>
            </div><!-- end source news -->

            <div class="journalist">
                <div class="container-lg">
                    <div class="journalist">
                        <h5 class="fs-reset mb-3">
                            <b class="fw-bold">
                                Our Journalists
                            </b>
                        </h5>
                        <div class="journalist-list pb-3 text-center text-md-start">
                            <div class="row g-0 flex-nowrap">
                                <div class="col">
                                    <div class="row g-3 journalist-item">
                                        <div class="col col-12 col-md-7">
                                            <div class="ratio ratio-1x1 border border-3 border-danger">
                                                <img src="assets/template3/asset/img/user/clara.jpg"
                                                    class="object-fit-cover" alt="">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col col-12 col-md-5">
                                            <h5 class="fs-4 text-danger">
                                                <a href="#" class="text-reset link-hover-underline">
                                                    <b class="fw-bold">Clara</b>
                                                </a>
                                            </h5>
                                            <p class="m-0">
                                                Let's fix the news, with facts, fire and wink.
                                            </p>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end col -->
                                <div class="col col-auto">
                                    <div class="vr h-100 mx-3"></div>
                                </div><!-- end col -->
                                <div class="col">
                                    <div class="row g-3 journalist-item">
                                        <div class="col col-12 col-md-7">
                                            <div class="ratio ratio-1x1 border border-3 border-warning">
                                                <img src="assets/template3/asset/img/user/lola.jpg"
                                                    class="object-fit-cover" alt="">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col col-12 col-md-5">
                                            <h5 class="fs-4 text-warning">
                                                <a href="#" class="text-reset link-hover-underline">
                                                    <b class="fw-bold">Lola</b>
                                                </a>
                                            </h5>
                                            <p class="m-0">
                                                It is legal, unfortunately for them.
                                            </p>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end col -->
                                <div class="col col-auto">
                                    <div class="vr h-100 mx-3"></div>
                                </div><!-- end col -->
                                <div class="col">
                                    <div class="row g-3 journalist-item">
                                        <div class="col col-12 col-md-7">
                                            <div class="ratio ratio-1x1 border border-3 border-white">
                                                <img src="assets/template3/asset/img/user/phor.jpg"
                                                    class="object-fit-cover" alt="">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col col-12 col-md-5">
                                            <h5 class="fs-4 text-white">
                                                <a href="#" class="text-reset link-hover-underline">
                                                    <b class="fw-bold">Phor</b>
                                                </a>
                                            </h5>
                                            <p class="m-0">
                                                When the truth hits, it hits like Phor.
                                            </p>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div><!-- end journalist -->
                </div><!-- end container -->
            </div><!-- end journalist -->

            <hr class="mt-0">
        </section>

        @yield('content')

    </main>

    <div id="modalFormTestimoni" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="d-flex flex-nowrap column-gap-2 align-items-center">
                        <div class="ratio ratio-1x1" style="width: 2rem;">
                            <img src="assets/template3/asset/img/logo-bot.png" class="object-fit-cover"
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
    <script src="assets/template3/js/theme.js"></script>
    <script src="assets/template3/js/global.js"></script>
</body>

</html>
