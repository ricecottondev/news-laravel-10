@extends('front/layouts.layout')

@push('styles')
    <style>
        .privacy_policy-container {
            background-color: #1e1e1e;
            color: #d6cfbd;
            font-family: 'Roboto', sans-serif;
            padding-left: 1rem;
            padding-right: 1rem;
            font-size: 18px;
        }

        .privacy_policy-container h2,
        .privacy_policy-container h4,
        .privacy_policy-container h4 {
            color: #cba34e;
        }

        .privacy_policy-container p,
        .privacy_policy-container li {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .privacy_policy-container ul {
            padding-left: 1.2rem;
        }

        .privacy_policy-container ul li {
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
        <div class="container privacy_policy-container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ url('') }}/sdamember-template/img/logo/sda-member-logo.png" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container privacy_policy-container py-4">
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
                <div class="container py-4 privacy-policy-container">




                    <h2 class="fw-bold mb-4 text-uppercase">Factabot Privacy Policy</h2>

                    <h4>1. Introduction</h4>
                    <p>Factabot respects your privacy (and frankly, we don't have time to stalk you). This Privacy Policy explains how we collect, use, and protect your information.</p>

                    <h4>2. What We Collect</h4>
                    <p>Depending on how you use Factabot, we may collect:</p>
                    <ul>
                        <li>Basic usage data (like page views, app opens)</li>
                        <li>Optional email addresses if you sign up for newsletters (coming soon)</li>
                        <li>Cookie data (because, internet)</li>
                    </ul>
                    <p>We do not collect:</p>
                    <ul>
                        <li>Personal chats</li>
                        <li>Bank details</li>
                        <li>Your secret fanfiction archive</li>
                    </ul>

                    <h4>3. How We Use Your Data</h4>
                    <p>We may use your data to:</p>
                    <ul>
                        <li>Improve the app</li>
                        <li>Send occasional emails (only if you opt-in)</li>
                        <li>Figure out if people actually like our jokes</li>
                    </ul>
                    <p>We will never sell your data. Ever. Not even for unlimited coffee.</p>

                    <h4>4. Cookies</h4>
                    <p>Yes, we use cookies — the tech kind, not the chocolate chip kind. Cookies help us remember your preferences and improve user experience. You can disable cookies anytime in your browser settings (but some features may get weird).</p>

                    <h4>5. Sharing Data</h4>
                    <p>We don’t share personal data with third parties except:</p>
                    <ul>
                        <li>If legally required (e.g., court orders, alien invasions)</li>
                        <li>To trusted services that help us run Factabot, under strict privacy agreements</li>
                    </ul>

                    <h4>6. Third-Party Links</h4>
                    <p>When you click on external links from Factabot, you are subject to their privacy policies, not ours.
                        (We’re not responsible if you end up buying weird things at 2 a.m.)</p>

                    <h4>7. Data Retention</h4>
                    <p>We only keep your data as long as necessary to operate Factabot smoothly.
                        If you unsubscribe or ask us nicely, we’ll delete your data.</p>

                    <h4>8. Changes to This Policy</h4>
                    <p>We may update this Privacy Policy from time to time.
                        Changes take effect once posted here.</p>

                    <h4>9. Contact Us</h4>
                    <p>Questions about privacy?<br>
                    📧 <a href="mailto:ricecottondev@gmail.com" class="text-warning">ricecottondev@gmail.com</a></p>

                </div>
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





@endsection
