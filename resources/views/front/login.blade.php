@extends('front/layouts.layout')
@section('content')

    <main class="d-none wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-2">
                    <div id="carousel-detail-img" class="carousel slide">
                        <div class="carousel-indicators">
                            <button data-bs-target="#carousel-detail-img" data-bs-slide-to="0" class="active"></button>
                            <button data-bs-target="#carousel-detail-img" data-bs-slide-to="1"></button>
                        </div>


                        <button class="carousel-control-prev" data-bs-target="#carousel-detail-img"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" data-bs-target="#carousel-detail-img"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-12 mb-2">
                    <form class="form w-100" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group input-group-lg border rounded overflow-hidden mb-4">
                            <!--begin::Email-->
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="text" placeholder="Email" name="email" autocomplete="off"
                                class="form-control bg-transparent rounded-0" />
                            <!--end::Email-->
                        </div>
                        <div class="input-group input-group-lg border rounded overflow-hidden mb-4">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                class="form-control bg-transparent rounded-0" />
                        </div>
                        <button type="submit" class="btn text-bg-dark w-100">
                            <span class="indicator-label">Sign In </span>
                        </button>
                    </form>
                </div>

                <div class="col-lg-12 text-center">
                    or
                </div>

                <div class="col-lg-12 mb-2">
                    <a href="/auth/google" class="btn btn-secondary w-100 mt-2">
                        Login With Google
                    </a>
                </div>
            </div>


        </div>

    </main>



    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="/">
                <img src="{{ url('') }}/sdamember-template/img/logo/sda-member-logo.png" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <section>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-body p-4">

                            <h3 class="text-center mb-4">Sign In</h3>

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

                            <form method="POST" action="{{ route('login') }}" class="d-flex flex-column gap-3">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <div class="input-group border">
                                        <input type="password" name="password" id="password-field" class="form-control bg-transparent rounded-0" autocomplete="off">
                                        <input type="text" name="password_display" id="password-field-display" class="form-control bg-transparent rounded-0" style="display: none;">
                                        <button class="btn" id="toggle-password" type="button">
                                            <i class="bi bi-eye-slash-fill"></i>
                                            <i class="bi bi-eye-fill" style="display: none;"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <a href="{{ route('forget.password.get') }}" class="text-decoration-none text-muted small">Forgot Password?</a>
                                </div>

                                <button type="submit" class="btn btn-dark btn-lg rounded-3 w-100">Login</button>

                                <div class="text-center text-muted my-2">or</div>

                                <a href="/auth/google" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-google me-2"></i> Login with Google
                                </a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
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

    <script src="{{ url('') }}/sdamember-template/components/modal_searching.js"></script>

    <script src="{{ url('') }}/sdamember-template/assets/jquery-3.6.1/jquery-3.6.1.min.js"></script>
    <script src="{{ url('') }}/sdamember-template/assets/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="{{ url('') }}/sdamember-template/js/script.js"></script>
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
    </script>



@endsection
