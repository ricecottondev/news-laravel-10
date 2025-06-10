@extends('front/layouts.layout')

@push('styles')
    <style>
        .about-container {
            background-color: #1e1e1e;
            color: #d6cfbd;
            font-family: 'Roboto', sans-serif;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .about-container h2,
        .about-container h4,
        .about-container h4 {
            color: #cba34e;
        }

        .about-container p,
        .about-container li {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .about-container ul {
            padding-left: 1.2rem;
        }

        .about-container ul li {
            margin-bottom: 0.5rem;
        }

        .about-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.08);
        }

        .highlight-yellow {
            color: #cba34e;
            font-weight: bold;
        }

        .about-row {
            margin-bottom: 2.5rem;
        }

        .about-disclaimer {
            font-size: 12px;
            color: #aaa;
            margin-top: 6rem;
        }
    </style>
@endpush

@section('content')
    <section class="d-none">
        <div class="container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ url('') }}/sdamember-template/img/logo/sda-member-logo.png"
                     style="width: 65vw; max-width: 320px;" alt="Factabot Logo">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-4 about-container">
            <h2 class="fw-bold mb-4 text-uppercase">Contact Us</h2>

            {{-- Section 1 --}}
            <div class="row about-row align-items-center">
                <div class="col-md-6 d-none">
                    {{-- <img src="{{ url('') }}/images/about_us_1.png" class="img-fluid about-image" alt="Factabot Image"> --}}
                </div>
                <div class="col-md-12">
                    <p style="font-size: 18px ;font-weight: bold;text-decoration: none ;color: rgb(214, 207, 189);">Email: ricecottondev@gmail.com</p></div>
            </div>


        </div>
    </section>
    {{-- <script>
        let startTime = Date.now();
        window.addEventListener("beforeunload", function () {
            const duration = Math.round((Date.now() - startTime) / 1000);
            const data = {
                url: window.location.pathname,
                duration: duration
            };

            const blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
            navigator.sendBeacon('/track-page-duration', blob);
        });
    </script> --}}
@endsection
