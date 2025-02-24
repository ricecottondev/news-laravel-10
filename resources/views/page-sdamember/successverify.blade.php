{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Verifikasi Email
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


            <div class="mb-8" style=" margin-bottom: 70px;">
                <img src="{{ asset('sdamember-template/img/png/success.png') }}" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </div>

            @if ($success)
                <div class="alert alert-success mt-9">
                    {{ $success }}
                </div>
            @endif
        </div>
    </section>
@endsection
