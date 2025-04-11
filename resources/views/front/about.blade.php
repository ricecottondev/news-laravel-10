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
            <h2 class="fw-bold mb-4 text-uppercase">About Us</h2>

            {{-- Section 1 --}}
            <div class="row about-row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('') }}/images/about_us_1.png" class="img-fluid about-image" alt="Factabot Image">
                </div>
                <div class="col-md-6">
                    <p>Once upon a headline, three regular guys—no trust funds, no media empires, no PR teams—were sitting around, scrolling through their feeds, and realizing something unsettling: depending on where you got your news, you were living in a different universe.</p>

                    <p>One app says the world is on fire. Another swears it’s all fake. One outlet worships a politician like a rock star, the other paints them as a villain. Same story. Different spin. Who’s lying? Who’s winning? Spoiler: not us.</p>
                </div>
            </div>

            {{-- Section 2 --}}
            <div class="row about-row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('') }}/images/about_us_2.png" class="img-fluid about-image" alt="Factabot Image">
                </div>
                <div class="col-md-6">
                    <h4 class="fw-semibold mt-3">That’s when it hit us: the news isn’t broken by accident. It’s broken by design.</h4>
                    <p>The media isn’t about truth anymore—it’s a business. A billion-dollar, outrage-powered, ad-fueled monster run by corporations, clickbait junkies, and political gatekeepers. They don’t want peace. They want panic. They don’t want you informed. They want you enraged, addicted, divided—because rage gets clicks, and clicks get money.</p>
                </div>
            </div>

            {{-- Section 3 --}}
            <div class="row about-row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('') }}/images/about_us_3.png" class="img-fluid about-image" alt="Factabot Image">
                </div>
                <div class="col-md-6">
                    <h4 class="fw-semibold mt-3">We were fed up.</h4>
                    <ul>
                        <li>Fed up with fake objectivity.</li>
                        <li>Fed up with billionaire narratives.</li>
                        <li>Fed up with a system that silences nuance and sells division.</li>
                    </ul>
                </div>
            </div>

            {{-- Section 4 --}}
            <div class="row about-row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('') }}/images/about_us_4.png" class="img-fluid about-image" alt="Factabot Image">
                </div>
                <div class="col-md-6">
                    <p class="highlight-yellow">So we built Factabot—a digital middle finger to partisan manipulation.</p>
                    <p>We use AI to pull stories from all sides of the ideological battlefield. Left, right, establishment, independent. We strip the spin, call out the contradictions, and serve it straight. You get the facts, the context, the receipts—then you make up your own damn mind.</p>
                    <p>We don’t believe in echo chambers. We believe in clarity, complexity, and calling BS when we see it—no matter who it comes from.</p>
                </div>
            </div>

            {{-- Section 5 --}}
            <div class="row about-row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('') }}/images/about_us_5.png" class="img-fluid about-image" alt="Factabot Image">
                </div>
                <div class="col-md-6 text-start">
                    <p class="highlight-yellow">
                        We’re not here to win elections or sell you merch.<br>
                        We’re here because truth deserves better. And so do you.
                    </p>
                    <div class="mt-3">
                        <p><strong>Jonas</strong> – The witty one. Ex-copywriter turned spin-slayer. Obsessed with logic, language, and chess. Writes the headlines that make you spit out your coffee.</p>
                        <p><strong>Eli</strong> – The thoughtful one. Quietly brilliant, loves data visualizations and sci-fi paperbacks. Always the first to say, “Wait, that headline feels off.”</p>
                        <p><strong>Max</strong> – The passionate one. Talks with his hands, lives in hoodies, and built the app’s prototype between ramen breaks. Constantly calling out hypocrisy—with receipts.</p>

                    </div>

                </div>


            </div>

            {{-- Disclaimer --}}
            <div class="about-disclaimer text-center">
                <hr class="my-5">
                <p style="font-size: 10px"><em><strong>Disclaimer: </strong> Eli, Max, and Jonas are fictional alter egos—created to represent every one of us who's fed up with media bias, billionaire narratives, and political spin. They’re not real, but the frustration (and the fight for truth) definitely is.</em></p>
            </div>
        </div>
    </section>
@endsection
