@extends('layouts.indracostorepoint.app')
@section('title')
    Forgout Password
@endsection
@section('content')
    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="index.html">
                <img src="{{ asset('sdamember-template/img/png/logo_isp.png') }}" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-4">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('forget.password.post') }}" method="POST" class="text-start d-flex flex-column gap-4">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control rounded-0  @error('email') is-invalid @enderror" type="email"
                        id="email" name="email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <button class="btn btn-lg btn-dark rounded-0" type="submit">Ganti Password</button>


            </form>
            <div class="text-end" style="margin-bottom: 2rem;">
                <a class=" text-decoration-none mt-3" style="color: #fd4f00;" href="{{ route('login') }}">Login</a>
            </div>
        </div>

    </section>
@endsection
