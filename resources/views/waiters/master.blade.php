<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUPRESSO &bull; {{ $title }}</title>

    <link rel="icon" href="../waiters-assets/img/logo.ico">
    <link rel="stylesheet" href="../waiters-assets/bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../waiters-assets/bootstrap-icons-1.10.3/bootstrap-icons.css">
    <link rel="stylesheet" href="../waiters-assets/fonts/gotham.css">
    <link rel="stylesheet" href="../waiters-assets/css/styles.css">
</head>

<body>

    {{-- navbar --}}
    @include('waiters/component/nav-sidebar')

    {{-- header menu --}}
    @if ($pages == 'landing' || $pages == 'Landing' || $pages == 'submenu' || $pages == 'Submenu' || $pages == 'cart')
        @include('waiters/component/header')
    @endif

    {{-- header menu for pay pages --}}
    @if ($pages == 'pay')
        <header
            style="background-color: #cea787; box-shadow: 0 0 1rem rgba(0,0,0,.15); border-top: solid 1px rgba(112,66,29,.375); border-bottom: solid 1px rgba(112,66,29,.375);">
            <div class="container py-4 text-center">
                <img src="../waiters-assets/img/logo.svg" class="img-fluid" width="50" alt="">
            </div>
        </header>
    @endif

    <main class="wrapper" data-bs-spy="scroll" data-bs-target="#navtab-submenu" data-bs-smooth-scroll="true"
        tabindex="0">
        @yield('konten')
    </main>

    {{-- navdown tombol view cart pages --}}
    @if ($pages == 'landing' || $pages == 'Landing' || $pages == 'submenu' || $pages == 'Submenu')
        <nav class="navbar fixed-bottom py-3"
            style="background-color: #cea787; box-shadow: 0 0 1rem rgba(0,0,0,.15); border-top: solid 1px rgba(112,66,29,.375);">
            <div class="container">
                <a class="btn btn-dark w-100" href="cart">View Cart ({{ Cart::getTotalQuantity() }})</a>
            </div>
        </nav>
        <style>
            body {
                padding-bottom: 70.4px;
            }
        </style>
    @endif

    {{-- detail produk --}}
    @include('waiters/component/detail')

    {{-- navdown menu halaman cart --}}
    @if ($pages == 'cart')
        <nav class="navbar fixed-bottom py-3"
            style="background-color: #cea787; box-shadow: 0 0 1rem rgba(0,0,0,.15); border-top: solid 1px rgba(112,66,29,.375);">
            <div class="container d-block">
                <div class="row row-cols-2 g-3">
                    <div class="col">
                        <button class="btn btn-dark w-100">Dine-In</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-light w-100">Takeaway</button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 col-md-8">Subtotal</div>
                    <div class="col-6 col-md-4 d-flex justify-content-between align-items-center">
                        <span>Rp</span> <span>145.000,-</span>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 col-md-8">Voucher</div>
                    <div class="col-6 col-md-4 text-end">(Rp&nbsp;5.000,-)</div>
                </div>
                <div class="row fw-semibold mb-4">
                    <div class="col-6 col-md-8">Total</div>
                    <div class="col-6 col-md-4 d-flex justify-content-between align-items-center">
                        <span>Rp</span> <span>140.000,-</span>
                    </div>
                </div>
                <a class="btn btn-dark w-100" href="pay">Next</a>
            </div>
        </nav>
        <style>
            body {
                padding-bottom: 244.8px;
            }
        </style>
    @endif

    <script src="../waiters-assets/jquery-3.6.1/jquery-3.6.1.min.js"></script>
    <script src="../waiters-assets/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../waiters-assets/js/script.js"></script>

</body>

</html>
