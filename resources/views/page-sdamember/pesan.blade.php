@extends('layouts.indracostorepoint.app-home')
@section('title')
    UI Akun
@endsection

@section('content')
    <main class="wrapper">
        <section>
            <div class="container">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="p-0 m-0">Kotak Masuk</p>
                            </div>
                            <div class="col-auto">
                                <p class="p-0 m-0">dd/mm/yy</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="text-decoration-none text-dark">Selengkapnya</a>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="p-0 m-0">Kotak Masuk</p>
                            </div>
                            <div class="col-auto">
                                <p class="p-0 m-0">dd/mm/yy</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="text-decoration-none text-dark">Selengkapnya</a>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="p-0 m-0">Kotak Masuk</p>
                            </div>
                            <div class="col-auto">
                                <p class="p-0 m-0">dd/mm/yy</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="text-decoration-none text-dark">Selengkapnya</a>
                    </div>
                </div>
            </div>

        </section>

    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#navdown ul li:nth-child(2) a').addClass('active');
        })
    </script>
@endpush
