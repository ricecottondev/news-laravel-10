<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>SDA MEMBER &bull; LOGIN</title>
    <link rel="icon" href="{{ url('') }}/sdamember-template/img/logogram.ico">
    <link rel="stylesheet"
        href="{{ url('') }}/sdamember-template/assets/bootstrap-5.3.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="{{ url('') }}/sdamember-template/assets/bootstrap-icons-1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/fonts/HelveticaNeue/HelveticaNeue.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/fonts/icomoon/icomoon.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/css/styles.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/css/topbar.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/css/navtop_belanja.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/css/sidebar_belanja.css">
    <link rel="stylesheet" href="{{ url('') }}/sdamember-template/css/navdown.css">

    <style>
        * {
            /* outline: solid 1px green; */
            outline: solid 1px transparent;
        }
    </style>
</head>

<body class="text-center justify-content-evenly">
    {{-- <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script> --}}


    {{-- <style media="screen">
        /* * {outline: solid 1px green;} */

        .category-list .category-item .card .card-img-overlay {
            bottom: unset;
        }

        .category-item {
            margin-bottom: 1.5rem;
        }

        .category-item:last-of-type {
            margin-bottom: 0;
        }
    </style> --}}

    <header class=" d-none text-bg-light border-top border-bottom border-dark-subtle sticky-top shadow">
        <div class="container py-4">
            <div class="row">
                {{-- <div class="col">
                    <h3 class="fw-bold text-capitalize fs-4 mb-0">

                        <br class="d-md-none">
                        <!-- jika account active / user menginputkan nama sebagai tamu (guest) wording "welcome" hilang digantikan nama user -->
                        <!-- <span>pradhokot</span> -->
                    </h3>
                </div> --}}
                <div class="col col-auto mx-auto">
                    <a class="navbar-brand me-0" href="{{ url('menu') }}">
                        <img src="../images/logo-baru-dark.svg" height="auto" style="width: 36vw; max-width: 160px;"
                            alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="d-none wrapper">

        <div class="container">
            {{-- <h6 class="mb-4">LOGIN</h6> --}}

            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div id="carousel-detail-img" class="carousel slide">
                        <div class="carousel-indicators">
                            <button data-bs-target="#carousel-detail-img" data-bs-slide-to="0" class="active"></button>
                            <button data-bs-target="#carousel-detail-img" data-bs-slide-to="1"></button>
                            {{-- <button data-bs-target="#carousel-detail-img" data-bs-slide-to="2"></button> --}}
                        </div>

                        {{-- <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ url('files/info-images/') . '/' . 'banner-1.jpg' }}" class="d-block w-100"
                                    alt="">
                            </div>

                            <div class="carousel-item">
                                <img src="{{ url('files/info-images/') . '/' . 'banner-2.jpg' }}" class="d-block w-100"
                                    alt="">
                            </div>
                        </div> --}}
                        <button class="carousel-control-prev" data-bs-target="#carousel-detail-img"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" data-bs-target="#carousel-detail-img"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <form class="form w-100" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group input-group-lg border rounded overflow-hidden mb-4">
                            <!--begin::Email-->
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="text" placeholder="Email" name="email" autocomplete="off"
                                class="form-control bg-transparent rounded-0" />
                            <!--end::Email-->
                        </div>
                        <div class="input-group input-group-lg border rounded overflow-hidden mb-4">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                class="form-control bg-transparent rounded-0" />
                        </div>
                        <button type="submit" class="btn text-bg-dark w-100">
                            <span class="indicator-label">Sign In </span>
                        </button>
                    </form>



                </div>

                <div class="col-lg-12 text-center">
                    or
                </div>

                <div class="col-lg-12 mb-2">
                    <a href="/auth/google" class="btn btn-secondary w-100 mt-2">
                        Login With Google
                    </a>
                </div>
            </div>


        </div>

    </main>



    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ url('') }}/sdamember-template/img/logo/sda-member-logo.png" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-4">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- <form action="" class="text-start d-flex flex-column gap-4"> --}}
            <form class="text-start d-flex flex-column gap-4" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <!--begin::Email-->
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="text" name="email" autocomplete="off"
                        class="form-control bg-transparent rounded-0" />
                    <!--end::Email-->
                    {{-- <input class="form-control rounded-0" type="text" id=""> --}}
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Kata Sandi</label>
                    <div class="input-group border">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="password" name="password" autocomplete="off"
                            class="form-control bg-transparent rounded-0" id="password-field" />
                        <input type="text" name="password_display" autocomplete="off"
                            class="form-control bg-transparent rounded-0" id="password-field-display"
                            style="display: none;" />
                        <button class="btn" id="toggle-password" type="button">
                            <i class="bi bi-eye-slash-fill"></i>
                            <i class="bi bi-eye-fill" style="display: none;"></i>
                        </button>
                    </div>
                </div>
                <div class="text-end" style="margin-bottom: 2rem;">
                    <a class="text-reset text-decoration-none" href="{{ route('forget.password.get') }}">Lupa Kata
                        Sandi?</a>
                </div>
                {{-- <a class="btn btn-lg btn-dark rounded-0" href="akun.html">Masuk</a> --}}
                <button type="submit" class="btn btn-lg btn-dark rounded-0">
                    <span class="indicator-label">Masuk </span>
                </button>
                <div class="d-flex align-items-center gap-2">
                    <hr class="m-0 opacity-100 w-100">
                    <span>atau</span>
                    <hr class="m-0 opacity-100 w-100">
                </div>
                <div class="text-center fs-3 d-flex align-items-center gap-4 justify-content-center">
                    <a class="text-reset text-decoration-none" href="/auth/google">
                        <i class="bi bi-google"></i>
                    </a>
                    {{-- <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-apple"></i>
                    </a> --}}
                </div>
            </form>
        </div>
    </section>

    <section>
        <div class="container py-4">
            <span>
                Belum punya akun SDA MEMBER? <a class="text-decoration-none" style="color: #fd4f00;"
                    href="{{ route('register') }}">Daftar</a>
            </span>
        </div>
    </section>

    {{-- this loading spinner --}}
    <div class="collapse backdrop-spinner" id="loading">
        <div class="position-fixed start-0 top-0 end-0 bottom-0 w-100 h-100 d-flex justify-content-center align-items-center flex-column text-light fs-4"
            style="background-color: rgba(0,0,0,.5); z-index: 3000;">
            <div class="spinner-border" role="status"></div>
            <span class="p-3">Loading...Please Wait</span>
        </div>
    </div>

    <script src="{{ url('') }}/sdamember-template/components/modal_searching.js"></script>

    <script src="{{ url('') }}/sdamember-template/assets/jquery-3.6.1/jquery-3.6.1.min.js"></script>
    <script src="{{ url('') }}/sdamember-template/assets/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="{{ url('') }}/sdamember-template/js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password-field');
            const hiddenPasswordField = document.getElementById('password-field-display');
            const toggleButton = document.getElementById('toggle-password');
            const eyeIconFill = toggleButton.querySelector('.bi-eye-fill');
            const eyeIconSlashFill = toggleButton.querySelector('.bi-eye-slash-fill');

            toggleButton.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    if (hiddenPasswordField) {
                        hiddenPasswordField.type = 'text';
                    }
                    eyeIconFill.style.display = 'inline';
                    eyeIconSlashFill.style.display = 'none';

                } else {
                    passwordField.type = 'password';
                    if (hiddenPasswordField) {
                        hiddenPasswordField.type = 'password';
                    }
                    eyeIconFill.style.display = 'none';
                    eyeIconSlashFill.style.display = 'inline';

                }
            });
        });
    </script>



</body>

</html>
