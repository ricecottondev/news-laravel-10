@extends('layouts.indracostorepoint.app')
@section('title')
    UI Akun Masuk
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
            <form action="" class="text-start d-flex flex-column gap-4">
                <div class="form-group">
                    <label for="" class="form-label">Nama Pengguna</label>
                    <input class="form-control rounded-0" type="text" id="">
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Kata Sandi</label>
                    <div class="input-group border">
                        <input class="form-control rounded-0 border-0" type="password" id="">
                        <button class="btn">
                            <i class="bi bi-eye-slash-fill"></i>
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="text-end" style="margin-bottom: 2rem;">
                    <a class="text-reset text-decoration-none" href="#">Lupa Kata Sandi?</a>
                </div>
                <a class="btn btn-lg btn-dark rounded-0" href="akun.html">Masuk</a>
                <div class="d-flex align-items-center gap-2">
                    <hr class="m-0 opacity-100 w-100">
                    <span>atau</span>
                    <hr class="m-0 opacity-100 w-100">
                </div>
                <div class="text-center fs-3 d-flex align-items-center gap-4 justify-content-center">
                    <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-google"></i>
                    </a>
                    <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-apple"></i>
                    </a>
                </div>
            </form>
        </div>
    </section>

    <section>
        {{-- <div class="container py-4">
            <span>
                Belum punya akun SDA MEMBER? <a class="text-decoration-none" style="color: #fd4f00;"
                    href="{{ route('register') }}">Daftar</a>
            </span>
        </div> --}}
    </section>
@endsection
