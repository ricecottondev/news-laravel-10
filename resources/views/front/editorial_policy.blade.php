@extends('front/layouts.layout')
@section('content')
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
            <h1>Editorial Policy</h1>
            <p>At Factabot, we are committed to maintaining the highest journalistic standards. Our editorial process
                follows these key principles:</p>
            <ul>
                <li><strong>Accuracy:</strong> All news content undergoes human review to verify facts and prevent
                    misinformation.</li>
                <li><strong>Transparency:</strong> We clearly indicate the sources of our news and adhere to fair use
                    policies.</li>
                <li><strong>Impartiality:</strong> Our news content remains neutral and unbiased, focusing on delivering
                    factual information.</li>
                <li><strong>AI & Human Moderation:</strong> While AI helps generate content, our editorial team refines,
                    edits, and validates every article before publication.</li>
            </ul>
            <p>We strive to provide quality journalism and value feedback from our users to improve our services.</p>
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
