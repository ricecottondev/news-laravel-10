@extends('layouts.indracostorepoint.app')

@section('content')
    <section>
        <div class="container py-4">
            <a class="text-decoration-none" href="index.html">
                <img src="{{ asset('sdamember-template/img/png/logo_isp.png') }}" height="auto"
                    style="width: 65vw; max-width: 320px;" alt="">
            </a>
        </div>
    </section>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Reset Password</div>
                        <div class="card-body">
                            <form action="{{ route('reset.password.post') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail
                                        Address</label>
                                    <div class="col-md-6">
                                        @if (!empty($email))
                                            <input type="text" id="email_address" class="form-control" name="email"
                                                required autofocus value="{{ $email }}" readonly>
                                        @endif

                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required
                                            autofocus>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                        Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password-confirm" class="form-control"
                                            name="password_confirmation" required autofocus>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                        @endif

                                    </div>

                                </div>



                                <div class="col-md-6 offset-md-4 mt-3">

                                    <button type="submit" class="btn btn-primary">

                                        Reset Password

                                    </button>

                                </div>

                            </form>



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>
@endsection
