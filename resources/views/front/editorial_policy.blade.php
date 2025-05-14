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

            <h1>Editorial Policy</h1>
            <p><strong>Introduction</strong><br>
                Factabot is a satirical news aggregation and commentary platform. We collect, summarize, and reframe
                real-world news events from reputable sources — but with humor, sarcasm, and critical commentary.</p>

            <p>Our mission is to make news readable, laughable, and occasionally uncomfortable, while staying grounded in
                facts. News can be truthful and funny — without losing meaning.</p>

            <p>This Editorial Policy outlines how Factabot operates, what users can expect, and where responsibility lies
                (hint: not with your uncle who gets his news from memes).</p>

            <h4>1. Content Aggregation and Satirical Presentation</h4>
            <p>We aggregate real news stories and reframe them with humor, sarcasm, and parody. We do not fabricate events,
                crimes, scandals, or quotes. We mock, roast, and joke — but don’t invent news.</p>

            <h4>2. Editorial Independence</h4>
            <p>Factabot has full editorial independence.
                We don’t answer to politicians, corporations, or billionaires (and they’re usually not funny enough anyway).
                The opinions, jokes, and commentary published are our own and do not reflect the views of the original news
                sources.</p>

            <h4>3. No Endorsement of Original Content</h4>
            <p>Aggregating a story does not mean we endorse it.
                Factabot may cover topics from across the political, social, and economic spectrum — and make fun of all
                sides equally badly.
                We are not affiliated with, nor responsible for, the editorial policies of any original publisher.</p>

            <h4>4. Accuracy and User Responsibility</h4>
            <p>We aim to base every article on real, verifiable reporting.
                However, we are not a replacement for primary news sources.
                We encourage users to verify stories themselves if they need the full context (or just want a less hilarious
                version).

                Readers should remember: we interpret, we don’t report.</p>

            <h4>5. Satire and Legal Disclaimer</h4>
            <p>Factabot content is satirical commentary protected under Australian, U.S., and international free speech
                laws.
                By using Factabot, you acknowledge:</p>
            <ul>
                <li>We use humor, parody, and exaggeration.</li>
                <li>Articles are based on real news events but framed in a satirical and critical manner.</li>
                <li>You are responsible for your interpretation and use of the information.</li>
            </ul>
            <p>No article should be taken as literal news reporting.
                If you think it is, we recommend a quick Google search — or a coffee.</p>

            <h4>6. Copyright and Fair Use</h4>
            <p>Factabot respects intellectual property rights.
                We do not claim ownership of original reporting.
                Our use of factual summaries falls within fair use guidelines for commentary, criticism, and satire.
                If you believe content infringes your rights, contact us — we take valid concerns seriously (and fake ones
                hilariously).</p>

            <h4>7. Visual Content and Fictional Representation</h4>
            <p>All images, characters, and visuals on Factabot — including any depictions of staff, contributors, or mascots
                — are fictional, stylized, or AI-generated.
                Any resemblance to real persons, living or dead, is purely coincidental (or, frankly, unlucky for them).</p>
            <p>We do not use real photos of team members, and any visual representation should be viewed as illustrative
                only.</p>

            <h4>8. Third-Party Links</h4>
            <p>Factabot may link to external articles, memes, videos, or bizarre political campaign ads.
                We are not responsible for the content, security, or sanity of third-party websites.</p>
            <p>Proceed at your own risk (and sense of humor).</p>

            <h4>9. Corrections Policy</h4>
            <p>If we accidentally misstate or bungle a key fact, we’ll fix it.
                Corrections will be posted promptly because we believe readers deserve transparency — and because admitting mistakes is funnier than pretending otherwise
            </p>

            <h4>10. Updates and Changes</h4>
            <p>We reserve the right to update this Editorial Policy if laws, facts, or the general absurdity of the world changes.
                Updates will be posted here.
                By continuing to use Factabot, you accept the latest version of this Policy (and hopefully still have a sense of humor).</p>

            <h4>11. Contact Us</h4>
            <p>For questions, concerns, copyright issues, or to send us your best conspiracy theory memes:<br>
                📧 <a href="mailto:ricecottondev@gmail.com" class="text-warning">ricecottondev@gmail.com</a></p>

            <p>We review every serious concern. (And some unserious ones too.)</p>
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
