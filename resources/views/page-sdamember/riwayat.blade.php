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
                                <p class="p-0 m-0">Anda dapat poin loyalty</p>
                            </div>
                            <div class="col-auto">
                                <p class="p-0 m-0">dd/mm/yy</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <span class="icon-primary_icon me-2 fs-3"></span>
                            <span class="text-dark">+500</span>
                        </div>
                        <a href="#" class="text-decoration-none text-dark">Selengkapnya</a>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="p-0 m-0">Anda dapat poin loyalty</p>
                            </div>
                            <div class="col-auto">
                                <p class="p-0 m-0">dd/mm/yy</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <span class="icon-gift_icon me-2 fs-3"></span>
                            <span class="text-dark">Kupon diskon senilai Rp 500.000,-</span>
                        </div>
                        <a href="#" class="text-decoration-none text-dark">Selengkapnya</a>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p class="p-0 m-0">Anda dapat poin loyalty</p>
                            </div>
                            <div class="col-auto">
                                <p class="p-0 m-0">dd/mm/yy</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <span class="icon-primary_icon me-2 fs-3"></span>
                            <span class="text-dark">+500</span>
                        </div>
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
            $('#navdown ul li:nth-child(4) a').addClass('active');
        })
    </script>
@endpush
