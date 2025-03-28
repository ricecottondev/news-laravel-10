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
            {{-- <form action="" class="text-start d-flex flex-column gap-4"> --}}
                <h3 class="h5">About Us</h3>
                <p>Welcome to Factabot, your trusted source for up-to-date news and insights. Our mission is to deliver
                    accurate, relevant, and engaging news to our audience.
                </p>
                <p>
                    We utilize cutting-edge AI technology to generate news summaries, which are then reviewed and
                    refined by our editorial team to ensure factual accuracy and readability. Our goal is to provide
                    well-structured and insightful content for our readers.
                </p>
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
