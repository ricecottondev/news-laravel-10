{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Home
@endsection

@section('content')
    <main class="wrapper">

        <section>
            <div class="container d-flex flex-column row-gap-3">
                <div>
                    <h4 class="fw-medium fs-3 text-capitalize">Hi, {{ Auth::user()->name }}!</h4>
                    <div>ID 0000 0000 0000</div>
                    <div>Tipe Member <span class="icon-gold_icon ms-2"></span> <span class="cl-gold">Gold</span> </div>
                    <div class="mt-3">
                        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100">
                            <div class="progress-bar progress-bar-striped bg-gold" style="width: 25%"></div>
                        </div>
                        <div class="text-end text-dark">
                            <small> raih 10.001 poin lagi untuk meraih Platinum</small>
                        </div>
                    </div>
                </div>

                <div class="card border-0">
                    <div class="card-body rounded-3 banner-level bgi-gold">
                        <div class="d-flex flex-column justify-content-left p-lg-5">
                            <div class="inner-card p-3">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <img src="{{ asset('sdamember-template/img/png/bintang.png') }}">
                                    </div>
                                    <div class="text-white">
                                        <h4 class="fs-bold m-0">Total Poin Anda</h4>
                                        <h3>1.999.999<h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="menu" class="card border-0 bg-primary">
                    <div class="card-body rounded-3">
                        <div class="text-white mb-2">
                            Fitur
                        </div>
                        <div class="container text-center py-3">
                            <div class="row row-cols-4 row-cols-lg-4 g-2 g-lg-3">
                                <div class="col">
                                    <a class="nav-link text-reset active" href="https://point.indraco.com/home">
                                        <i class="icon-penukaran_poin_icon"></i>
                                        <br><small class="text-light"> Penukaran Poin</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="nav-link text-reset" href="https://point.indraco.com/promo">
                                        <i class="icon-lokasi_toko_icon"></i>
                                        <br><small class="text-light"> Lokasi Toko</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="nav-link text-reset" href="https://point.indraco.com/belanja">
                                        <i class="icon-tokoSDAcom_icon"></i>
                                        <br><small class="text-light"> tokoSDA.com</small>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="nav-link text-reset" href="https://point.indraco.com/voucher">
                                        <i class="icon-lainnya_icon"></i>
                                        <br><small class="text-light">Tampilkan <br>Lainya</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body rounded-top-4 bg-secondary-subtle">
                            <div class="row justify-content-between mb-2">
                                <div class="col">
                                    <h6 class="fw-bold">Promosi</h6>
                                </div>
                                <div class="col col-auto">
                                    <a class="text-decoration-none text-dark" href="#">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('sdamember-template/img/jpg/banner-promo.jpg') }}" class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text fw-bold">Judul</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="card-text">Sub title</p>
                                        <p class="#">dd/mm/yyyy</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>

    <!-- modal redeem poin -->
    <div class="modal fade" id="modalRedeemPoin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalRedeemPoinLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-medium fs-5" id="modalRedeemPoinLabel">Redeem Code</h5>
                    <button type="button" class="btn-close close-qr" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center d-flex flex-column row-gap-4">
                    <input type="text" id="kode" class="form-control form-control-lg rounded-0" maxlength="19"
                        autocomplete="off">

                    <div id="reader"></div>

                    {{-- <div id="qr-reader-results"></div> --}}
                    <div id="reader-results"></div>

                    {{-- <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script> --}}
                    <script src="{{ URL::asset('/assets/libs/html5-qrcode/html5-qrcode.min.js') }}"></script>
                    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
                    {{-- <script src="html5-qrcode-demo.js"></script> --}}
                    {{-- <p class="text-capitalize">
                        kartu hadiah & promosi code
                        <br>
                        <a class="text-decoration-none" style="color: #fd4f00;" href="#">Terms & Conditions</a>
                    </p> --}}
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-lg rounded-0 bg-white text-dark w-100 cancel-btn"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-lg rounded-0 btn-dark w-100 klaim-point">Klaim Poin</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal Data Diri -->
    <div class="modal fade" id="modalDataDiri" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDataDiriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-medium fs-5" id="modalDataDiriLabel">Silahkan Mengisi Data Diri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="dataDiriForm">
                    <div class="modal-body  d-flex flex-column row-gap-4">
                        <div class="form-group">
                            <label for="nama_ktp" class="form-label">Nama KTP</label>
                            <input type="text" id="nama_ktp" class="form-control form-control rounded-0"
                                autocomplete="off" required>
                        </div>

                        <!-- Other Required Profile Fields -->


                        <div class="form-group">
                            <label for="telp" class="form-label">Telepon</label>
                            <input type="text" id="telp" class="form-control form-control rounded-0"
                                autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Tanggal Lahir</label>
                            <input type="date" id="birth_date" class="form-control form-control rounded-0"
                                autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select id="gender" class="form-control form-control rounded-0" required>
                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Laki-laki">Laki-Laki</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea id="address" class="form-control form-control-lg rounded-0" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="province" class="form-label">Provinsi</label>
                            <select id="province" class="form-control form-control rounded-0" required>
                                <option value="" disabled selected>Pilih Provinsi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="city" class="form-label">Kota</label>
                            <select id="city" class="form-control form-control rounded-0" required>
                                <option value="" disabled selected>Pilih Kota</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district" class="form-label">Kecamatan</label>
                            <select id="district" class="form-control form-control rounded-0" required>
                                <option value="" disabled selected>Pilih Kecamatan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subdistrict" class="form-label">Kelurahan</label>
                            <select id="subdistrict" class="form-control form-control rounded-0" required>
                                <option value="" disabled selected>Pilih Kelurahan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kodepos" class="form-label">Kode Pos</label>
                            <input type="text" id="kodepos" class="form-control form-control rounded-0" required
                                autocomplete="off" readonly>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-lg rounded-0 bg-white text-dark w-100"
                            data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-lg rounded-0 btn-dark w-100 data-diri" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
