@extends('front/layouts.layout')

@push('styles')
<style>
    .about-container {
        background-color: #1e1e1e;
        color: #d6cfbd;
        font-family: 'Roboto', sans-serif;
        padding: 2rem 1rem;
    }

    .about-container h2, .highlight-text {
        color: #cba34e;
    }

    .about-container p {
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 1.2rem;
    }

    .about-image {
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    }

    .about-row {
        margin-bottom: 3rem;
    }

    .text-emphasis {
        font-size: 1.5rem;
        font-weight: bold;
        color: #cba34e;
    }

    .overlay-text {
        position: absolute;
        top: 10%;
        left: 10%;
        color: #fff;
        font-size: 2rem;
        font-weight: bold;
        z-index: 2;
    }

    .overlay-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
    }

    .overlay-wrapper img {
        display: block;
        width: 100%;
        height: auto;
    }
</style>
@endpush

@section('content')
<section>
    <div class="container about-container">

        <h2 class="fw-bold text-uppercase mb-4">About FactaBot</h2>

        {{-- Section 1 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_1.png') }}" class="about-image" alt="About image 1">
            </div>
            <div class="col-md-6">
                <p><span class="highlight-text">No billionaire sugar daddies.</span></p>
                {{-- <p>We’re not funded by billionaires. We’re not pushing anyone’s agenda. We’re just here to cut through the noise and give you facts, with a side of snark.</p> --}}
            </div>
        </div>

        {{-- Section 2 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_2.png') }}" class="about-image" alt="About image 2">
            </div>
            <div class="col-md-6">
                {{-- <p>The media doesn’t want you informed. They want you enraged. Addicted. Divided. Because rage gets clicks, and clicks get money.</p> --}}
                {{-- <p>We’re not playing that game.</p> --}}
            </div>
        </div>

        {{-- Section 3 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_3.png') }}" class="about-image" alt="About image 3">
            </div>
            <div class="col-md-6">
                {{-- <p>Factabot uses AI to pull stories from all sides of the battlefield. Left, right, center, weird corners of the internet—you name it.</p> --}}
                {{-- <p>Then we strip the spin, call the contradictions, and give you the receipts. You decide what’s real.</p> --}}
            </div>
        </div>

         {{-- Section 4 --}}
         <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_4.png') }}" class="about-image" alt="About image 3">
            </div>
            <div class="col-md-6">
                {{-- <p>Factabot uses AI to pull stories from all sides of the battlefield. Left, right, center, weird corners of the internet—you name it.</p> --}}
                {{-- <p>Then we strip the spin, call the contradictions, and give you the receipts. You decide what’s real.</p> --}}
            </div>
        </div>

        {{-- Section 5 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_5.png') }}" class="about-image" alt="About image 3">
            </div>
            <div class="col-md-6">
                {{-- <p>Factabot uses AI to pull stories from all sides of the battlefield. Left, right, center, weird corners of the internet—you name it.</p> --}}
                {{-- <p>Then we strip the spin, call the contradictions, and give you the receipts. You decide what’s real.</p> --}}
            </div>
        </div>

        {{-- Section 6 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_6.png') }}" class="about-image" alt="About image 3">
            </div>
            <div class="col-md-6">
                {{-- <p>Factabot uses AI to pull stories from all sides of the battlefield. Left, right, center, weird corners of the internet—you name it.</p> --}}
                {{-- <p>Then we strip the spin, call the contradictions, and give you the receipts. You decide what’s real.</p> --}}
            </div>
        </div>

        {{-- Section 7 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_7.png') }}" class="about-image" alt="About image 3">
            </div>
            <div class="col-md-7">
                {{-- <p>Factabot uses AI to pull stories from all sides of the battlefield. Left, right, center, weird corners of the internet—you name it.</p> --}}
                {{-- <p>Then we strip the spin, call the contradictions, and give you the receipts. You decide what’s real.</p> --}}
            </div>
        </div>

        {{-- Section 8 --}}
        <div class="row about-row align-items-center">
            <div class="col-md-6">
                <img src="{{ url('images/new_about_us_8.png') }}" class="about-image" alt="About image 3">
            </div>
            <div class="col-md-7">
                {{-- <p>Factabot uses AI to pull stories from all sides of the battlefield. Left, right, center, weird corners of the internet—you name it.</p> --}}
                {{-- <p>Then we strip the spin, call the contradictions, and give you the receipts. You decide what’s real.</p> --}}
            </div>
        </div>

        {{-- Final Emphasis Section --}}
        {{-- <div class="row about-row">
            <div class="col-md-12">
                <div class="overlay-wrapper">
                    <div class="overlay-text">News Deserves Better.</div>
                    <img src="{{ url('images/new_about_us_final.png') }}" alt="So do you" class="img-fluid">
                </div>
            </div>
        </div> --}}

        <div class="text-center mt-5">
            {{-- <p class="text-emphasis">So do you.</p> --}}
        </div>

    </div>
</section>
@endsection
