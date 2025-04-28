@extends('front/layouts.layout')
@push('styles')
    <style>
        .editorial_policy-container {
            background-color: #1e1e1e;
            color: #d6cfbd;
            font-family: 'Roboto', sans-serif;
            padding-left: 1rem;
            padding-right: 1rem;
            font-size: 18px;
        }

        .editorial_policy-container h2,
        .editorial_policy-container h4,
        .editorial_policy-container h4 {
            color: #cba34e;
        }

        .editorial_policy-container p,
        .editorial_policy-container li {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .editorial_policy-container ul {
            padding-left: 1.2rem;
        }

        .editorial_policy-container ul li {
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
        <div class="container editorial_policy-container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ url('') }}/sdamember-template/img/logo/sda-member-logo.png" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container editorial_policy-container py-4">
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

            <h1>Factabot Terms</h1>

            <h4>1. Acceptance of Terms</h4>
            <p>WBy accessing or using Factabot (the "App" or "Website"), you agree to these Terms of Service.
                If you don't agree, please close the app, delete your browser history, and find a news outlet that won't make you laugh accidentally.</p>

            <h4>2. About Factabot</h4>
            <p>Factabot provides satirical commentary based on real-world news events.
                We collect real news, then sprinkle it with sarcasm, parody, and very questionable jokes.
                Factabot is not a literal news service and should not be treated as a substitute for primary reporting.</p>

            <h4>3. User Responsibilities</h4>
            <p>You agree to:

                Understand that Factabot content is intended for entertainment and commentary.

                Verify facts yourself if you need the full context or are preparing your PhD thesis.

                Not sue us because you missed the satire label.

                Use Factabot responsibly and legally (no robots or bots scraping us, please).</p>

            <h4>4. Intellectual Property</h4>
            <p>All original content on Factabot (text, designs, branding, images) belongs to Factabot or is used under appropriate licenses.
                You may share, laugh, repost — but don't steal or repackage without attribution (or we’ll send you strongly worded emails).</p>

            <h4>5. Third-Party Links</h4>
            <p>We sometimes link to third-party news articles, memes, or other resources.
                We are not responsible for what happens once you leave Factabot.
                If you get lost on the internet for three hours because of a YouTube rabbit hole — that’s on you.</p>

            <h4>6. No Warranties</h4>
            <p>We provide Factabot "as is."
                No promises. No guarantees. No refunds on your wasted time.
                We try to be accurate and hilarious, but life happens.</p>

            <h4>7. Limitation of Liability</h4>
            <p>In no event will Factabot, its owners, contributors, AI assistants, or fictional mascots be liable for:
<ul>
                <li>Lost profits</li>

                <li>Emotional damage</li>

                <li>Keyboard rage</li>

                <li>Minor existential crises arising from the use of Factabot.</p></li>
</ul>

            <h4>8. Changes to Terms</h4>
            <ul>
                <li>We may update these Terms of Service anytime.</li>
                <li>When we do, we'll post it here.</li>
                <li>By continuing to use Factabot, you accept the latest version (and hopefully bring snacks).</li>
            </ul>



            <h4>9. Contact</h4>
            <p>Questions, concerns, random memes?
                </p>
                <p>📧 ricecottondev@gmail.com</p>


            <hr>



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
