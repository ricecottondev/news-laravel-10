@extends('layouts.indracostorepoint.app')
@section('title')
    Register
@endsection
@section('content')
    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ asset('sdamember-template/img/logo/sda-member-logo.png') }}" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-4">
            <form method="POST" action="{{ route('registerstore') }}" class="text-start d-flex flex-column gap-4">
                @csrf

                <div class="form-group">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" id="name" type="text">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input class="form-control rounded-0 @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" id="email" type="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Kata Sandi</label>
                    <div class="input-group border">
                        <input class="form-control rounded-0  @error('password') is-invalid @enderror" name="password"
                            value="{{ old('password') }}" id="password-field"type="password">

                        <input type="text" name="password_display" autocomplete="off"
                            class="form-control bg-transparent rounded-0" id="password-field-display"
                            style="display: none;" />

                        <button class="btn" id="toggle-password" type="button">
                            <i class="bi bi-eye-slash-fill"></i>
                            <i class="bi bi-eye-fill" style="display: none;"></i>
                        </button>

                    </div>
                    @error('password')
                        <span class="text-danger" role="alert">
                            <strong style="font-size: 14px;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="input-group border">
                        <input class="form-control rounded-0 @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" id="password-confirmation-field" type="password">

                        <input type="text" name="password_confirmation_display" autocomplete="off"
                            class="form-control bg-transparent rounded-0" id="password-confirmation-field-display"
                            style="display: none" />

                        <button class="btn" id="toggle-password-confirmation" type="button">
                            <i class="bi bi-eye-slash-fill"></i>
                            <i class="bi bi-eye-fill" style="display: none;"></i>
                        </button>
                    </div>

                    @error('password_confirmation')
                        <span class="text-danger" role="alert">
                            <strong style="font-size: 14px;">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <button class="btn btn-lg btn-dark rounded-0" type="submit">Daftar</button>
                <div class="d-flex align-items-center gap-2">
                    <hr class="m-0 opacity-100 w-100">
                    <span>atau</span>
                    <hr class="m-0 opacity-100 w-100">
                </div>
                <div class="text-center fs-3 d-flex align-items-center gap-4 justify-content-center">
                    <a class="text-reset text-decoration-none" href="/auth/google">
                        <i class="bi bi-google"></i>
                    </a>
                    {{-- <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a class="text-reset text-decoration-none" href="#">
                        <i class="bi bi-apple"></i>
                    </a> --}}
                </div>
            </form>
        </div>
    </section>

    <section>
        <div class="container py-4">
            <span>
                Sudah punya akun SDA Member? <a class="text-decoration-none" style="color: #fd4f00;"
                    href="{{ route('login') }}">Masuk</a>
            </span>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password-field');
            const hiddenPasswordField = document.getElementById('password-field-display');
            const toggleButton = document.getElementById('toggle-password');
            const eyeIconFill = toggleButton.querySelector('.bi-eye-fill');
            const eyeIconSlashFill = toggleButton.querySelector('.bi-eye-slash-fill');

            toggleButton.addEventListener('click', function() {
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    if (hiddenPasswordField) {
                        hiddenPasswordField.type = 'text';
                    }
                    eyeIconFill.style.display = 'inline';
                    eyeIconSlashFill.style.display = 'none';

                } else {
                    passwordField.type = 'password';
                    if (hiddenPasswordField) {
                        hiddenPasswordField.type = 'password';
                    }
                    eyeIconFill.style.display = 'none';
                    eyeIconSlashFill.style.display = 'inline';

                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const passwordConfirmationField = document.getElementById('password-confirmation-field');
            const passwordConfirmationFieldDisplay = document.getElementById('password-confirmation-field-display');
            const toggleButtonConfirmation = document.getElementById('toggle-password-confirmation');
            const eyeIconFillConfirmation = toggleButtonConfirmation.querySelector('.bi-eye-fill');
            const eyeIconSlashFillConfirmation = toggleButtonConfirmation.querySelector('.bi-eye-slash-fill');

            toggleButtonConfirmation.addEventListener('click', function() {
                if (passwordConfirmationField.type === 'password') {
                    passwordConfirmationField.type = 'text';
                    if (passwordConfirmationFieldDisplay) {
                        passwordConfirmationFieldDisplay.type = 'text';
                    }
                    eyeIconFillConfirmation.style.display = 'inline';
                    eyeIconSlashFillConfirmation.style.display = 'none';
                } else {
                    passwordConfirmationField.type = 'password';
                    if (passwordConfirmationFieldDisplay) {
                        passwordConfirmationFieldDisplay.type = 'password';
                    }
                    eyeIconFillConfirmation.style.display = 'none';
                    eyeIconSlashFillConfirmation.style.display = 'inline';
                }
            });
        });
    </script>
@endsection
