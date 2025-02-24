<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    @if (!empty($title))
        <title>SDA Global &bull; {{ $title }}</title>
    @else
        <title>SDA Global</title>
    @endif

    <link rel="icon" href="{{ url('ui/img/logo.ico') }}">
    <link rel="stylesheet" href="{{ url('ui/dist52/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('ui/bootstrap-icons-1.9.1/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('ui/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/libs/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('ui/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('ui/fonts/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('ui/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ url('ui/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('ui/css/navtop.css') }}">
    <link rel="stylesheet" href="{{ url('ui/css/navdown.css') }}">
    <link rel="stylesheet" href="{{ url('ui/css/footer.css') }}">
    @if (!empty($pages))
        {{-- <link rel="stylesheet" href="https://www.supresso.com/beta/public/ui/css/{{ $pages }}.css"> --}}
        {{-- <link rel="stylesheet" href="http://127.0.0.1:8000/ui/css/{{ $pages }}.css"> --}}
        <link rel="stylesheet" href="{{ url('ui/css/') }}/{{ $pages }}.css">
    @endif

    <!-- garis bantu front end -->
    <style>
        * {
            /* outline: solid 1px green; */
        }
    </style>
</head>

<body>

    @yield('notifikasi')
    @include('front/navtop')
    @include('front/navdown')
    @include('front/scrolltop')

    <main class="wrapper">
        @yield('konten')
    </main>

    {{-- this loading spinner --}}
    <div class="collapse backdrop-spinner" id="loading">
        <div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center flex-column text-light fs-4"
            style="background-color: rgba(0,0,0,.5); z-index: 3000;">
            <div class="spinner-border" role="status"></div>
            <span class="p-3">Loading...Please Wait</span>
        </div>
    </div>


    @include('front/footer')
    @yield('popup')

    {{-- modal search --}}
    <div class="modal fade" id="modal-search" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modal-searchLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    {{-- <h1 class="modal-title fs-5" id="modal-searchLabel">Modal title</h1> --}}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    <div class="input-group rounded border overflow-hidden">
                        <input type="search" class="form-control bg-transparent rounded-0 border-0"
                            placeholder="Search..." id="input-search">
                        <button class="btn border-0" id="btn-search"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class="modal-body">
                    {{-- history/ hasil pencarian --}}
                    <h5><strong>Searching History</strong></h5>
                    <div class="d-flex flex-wrap gap-1 mb-4" id="history-search">
                        {{-- {{dump($_SESSION['search-history'])}} --}}
                        {{-- @php
                            if (isset($_SESSION['search-history'])){
                                foreach ($_SESSION['search-history'] as $keyword) {
                                    echo '<button class="btn btn-sm btn-outline-secondary text-capitalize">'. $keyword .'</button>';
                                }
                            }
                        @endphp --}}
                        {{-- <button class="btn btn-sm btn-outline-secondary text-capitalize">history pencarian</button>
                        <button class="btn btn-sm btn-outline-secondary text-capitalize">history pencarian</button>
                        <button class="btn btn-sm btn-outline-secondary text-capitalize">history pencarian</button>
                        <button class="btn btn-sm btn-outline-secondary text-capitalize">history pencarian</button>
                        <button class="btn btn-sm btn-outline-secondary text-capitalize">history pencarian</button> --}}
                    </div>
                    <h5><strong>Searching Result</strong></h5>
                    <ul class="list-group list-group-flush" id="body-search">
                        {{-- <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li>
                        <li class="list-group-item px-0">
                            <a class="text-decoration-none" href="#">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </li> --}}
                    </ul>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HQB3WHD8HW"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-HQB3WHD8HW');
    </script>

    {{-- <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/js/jquery-3.6.0.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/js/popper.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/dist52/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/select2/select2.min.js"></script>
    <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/js/global.js"></script> --}}

    <script type="text/javascript" src="{{url('ui/js/jquery-3.6.0.min.js')}}"></script>
	<script type="text/javascript" src="{{url('ui/dist52/js/bootstrap.bundle.min.js')}}"></script>
	<script type="text/javascript" src="{{url('ui/swiper/swiper-bundle.min.js')}}"></script>
	<script type="text/javascript" src="{{url('ui/select2/select2.min.js')}}"></script>
	<script type="text/javascript" src="{{url('ui/js/global.js')}}"></script>


    <script>
        // fungsi spinner

        // $(document).ready(function() {
        // 	if ($('.backdrop-spinner').hasClass('show')) {
        // 		$('html').addClass('no-scroll');
        // 	} else {
        // 		$('html').removeClass('no-scroll');
        // 	}
        // });

        // fungsi tooltip
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

        $('#triggerSpinner').click(function() {
            if ($('.backdrop-spinner').hasClass('show')) {
                $('html').addClass('no-scroll');
            } else {
                $('html').removeClass('no-scroll');
            }
        });

        // garis bantu
        [].forEach.call(document.querySelectorAll("*"), function(a) {

        });
    </script>
    @if (!empty($pages))
        {{-- <script type="text/javascript" src="https://www.supresso.com/beta/public/ui/js/{{ $pages }}.js"></script> --}}
        <script type="text/javascript" src="{{ url('ui/js/') }}/{{ $pages }}.js"></script>
    @endif

    <script type="text/javascript">
        [].forEach.call(document.querySelectorAll("*"), function(a) {

        });

        const getUserLoginId = () => {
            return @json(Auth::user()) == null ? "guest" : @json(Auth::user()).id;
        }

        const getUserLoginName = () => {
            return @json(Auth::user()) == null ? "guest" : @json(Auth::user()).name;
        }

        $("#btn-search").on("click", function() {

            let name = $("#input-search").val();
            if (name == "") {
                $("#body-search").html("");
                return;
            }

            let url = "{{ url('/') }}";

            $.ajax({
                url: "{{ url('/search') }}" + "/" + name,
                method: "GET",
                success: function(res) {
                    console.log("hasil search");
                    console.log(res);

                    getSearchHistory();

                    if (res != null && res.length > 0) {
                        let str = ``;
                        $.each(res, function(i, item) {
                            str += `<li class="list-group-item px-0">
                                    <a class="text-decoration-none" href="${url}/fproducts/${item.id}">${item.product_name} ${item.product_weight} G</a>
                                    </li>`;
                        });
                        $("#body-search").html(str);
                    } else {
                        $("#body-search").html(`<li class="list-group-item px-0">Not found</li>`);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        })

        function getSearchHistory() {

            $.ajax({
                url: "{{ url('/search-history') }}",
                method: "GET",
                success: function(res) {
                    console.log("hasil search history");
                    // console.log(res);

                    if (res != null && res.length > 0) {
                        let str = ``;

                        let batas = res.length >= 10 ? res.length - 10 : 0;

                        for (let i = res.length - 1; i >= batas; i--) {
                            str +=
                                `<button class="btn btn-sm btn-outline-secondary text-capitalize" onclick="setToInputSearch('${res[i]}')">${res[i]}</button>`;
                        }

                        $("#history-search").html(str);
                    } else {
                        $("#history-search").html("");
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function setToInputSearch(key) {
            $("#input-search").val(key);
        }

        $("#modal-search").on("show.bs.modal", function() {
            getSearchHistory();
        });
    </script>

    <div class="collapse backdrop-spinner" id="loading-screen">
        <div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center"
            style="background-color: rgba(0,0,0,.5); z-index: 3000;">
            <div class="spinner-border text-light" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</body>

</html>
