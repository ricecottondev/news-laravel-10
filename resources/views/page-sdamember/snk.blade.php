{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    SnK
@endsection
@section('content')
    <main class="wrapper">

        <section>
            <div class="container">
                <ul class="list-group list-group-flush">

                    <li class="list-group-item px-0">
                        {{-- <h5 class="fs-reset mb-4">
                            Masa Berlaku
                            <br>
                            13 Nov 2023 00:00 - 30 Nov 2023 23:59
                        </h5> --}}
                        <ul class="list-unstyled d-flex flex-column row-gap-5 ">
                            <li>
                                <h4 class="fw-medium fs-3 text-capitalize">
                                    Cara Pakai
                                </h4>
                                <ol class="ps-3 text-start">
                                    <li>
                                        Cek halaman "Gift" untuk melihat voucher yang bisa ditukar dengan poin.
                                    </li>
                                    <li>
                                        Setelah ditukar di halaman "Gift", masuk ke halaman "My Voucher" untuk melihat voucher yg sudah ditukar dengan poin.
                                    </li>
                                    <li>
                                        Voucher bisa digunakan dengan menekan tombol aktifkan di halaman "My Voucher" atau bisa digunakan pada saat checkout di merchant.
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <h4 class="fw-medium fs-3 text-capitalize">
                                    Syarat & Ketentuan
                                </h4>
                                <ol class="ps-3 text-start">
                                    <li>
                                        Kuota Voucher terbatas, hanya dapat digunakan selama kuota masih tersedia.
                                    </li>
                                    <li>
                                        Voucher hanya berlaku untuk pembayaran di semua merchant yang sudah terdaftar di
                                        Indraco
                                        Poin.
                                    </li>
                                    <li>
                                        Dengan menggunakan Voucher ini, Anda telah menyetujui Syarat Layanan Indraco
                                        Poin.
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </section>

    </main>
@endsection
