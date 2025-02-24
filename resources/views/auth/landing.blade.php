{{-- @extends('layouts.indracostorepoint.app') --}}
@extends('layouts.sdamember.app')
@section('title')
    Member
@endsection

@section('content')
    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ asset('sdamember-template/img/png/logo_isp.png') }}" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-4">
            <figure class="figure m-0">
                <img src="{{ asset('sdamember-template/img/account/maskot.png') }}" class="figure-img" width="auto"
                    style="height: 32vh;" alt="...">
                <figcaption class="figure-caption fs-5 fw-medium">Halo.</figcaption>
            </figure>
        </div>
    </section>


    <section>
        <div class="container py-4">
            <div class="d-grid gap-2">
                <a class="btn btn-lg btn-dark rounded-0" href="{{ route('login') }}">Masuk</a>
                <a class="btn btn-lg bg-light text-dark rounded-0" href="{{ route('register') }}">Daftar</a>
            </div>
        </div>
    </section>
@endsection
