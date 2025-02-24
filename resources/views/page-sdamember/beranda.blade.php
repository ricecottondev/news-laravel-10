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
        $(document).ready(function() {

            $('#modalDataDiri').on('shown.bs.modal', function() {
                // Lakukan AJAX di sini
                $.ajax({
                    url: '{{ route('getjne') }}',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const select = $('#province');

                        // Pastikan data memiliki struktur yang benar
                        if (data.success && data.data && Array.isArray(data.data)) {
                            // Loop melalui data dan tambahkan opsi ke elemen <select>
                            $.each(data.data, function(index, province) {
                                select.append($('<option>', {
                                    text: province,
                                    value: province
                                }));
                            });
                        } else {
                            console.error('Struktur data tidak sesuai dalam respons AJAX.');
                        }
                    },
                    error: function(err) {
                        console.error('Error in AJAX request:', err);
                    }
                });


                $('#province').on('change', function() {
                    const selectedProvince = $(this).val();
                    if (selectedProvince) {
                        // Lakukan AJAX untuk mendapatkan data kota berdasarkan provinsi
                        $.ajax({
                            url: '{{ route('getcity') }}', // Ganti dengan endpoint yang sesuai
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                province: selectedProvince
                            }, // Kirim parameter provinsi
                            success: function(cityData) {
                                const selectCity = $('#city');

                                // Bersihkan opsi kota sebelum menambahkan yang baru
                                selectCity.empty();

                                // Tambahkan opsi "Pilih City" dengan nilai kosong
                                selectCity.append($('<option>', {
                                    text: 'Pilih Kota',
                                    value: '',
                                    disabled: true,
                                    selected: true
                                }));

                                // Pastikan data memiliki struktur yang benar
                                if (cityData.success && cityData.data && Array.isArray(
                                        cityData.data)) {
                                    // Tambahkan opsi kota ke elemen <select> kota
                                    $.each(cityData.data, function(index, city) {
                                        selectCity.append($('<option>', {
                                            text: city,
                                            value: city
                                        }));
                                    });
                                } else {
                                    console.error(
                                        'Struktur data tidak sesuai dalam respons AJAX.'
                                    );
                                }
                            },
                            error: function(err) {
                                console.error('Error in AJAX request:', err);
                            }
                        });
                    }
                });


                // Tambahkan event listener untuk memanggil fungsi saat kota dipilih
                $('#city').on('change', function() {
                    const selectedCity = $(this).val();
                    const selectedProvince = $('#province').val();
                    if (selectedCity) {
                        // Lakukan AJAX untuk mendapatkan data kecamatan berdasarkan kota
                        $.ajax({
                            url: '{{ route('getdistrict') }}', // Ganti dengan endpoint yang sesuai
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                city: selectedCity,
                                province: selectedProvince
                            },
                            success: function(districtData) {
                                const selectDistrict = $('#district');

                                // Bersihkan opsi kecamatan sebelum menambahkan yang baru
                                selectDistrict.empty();

                                // Tambahkan opsi "Pilih District" dengan nilai kosong
                                selectDistrict.append($('<option>', {
                                    text: 'Pilih Kecamatan',
                                    value: '',
                                    disabled: true,
                                    selected: true
                                }));

                                if (districtData.success && districtData.data && Array
                                    .isArray(districtData.data)) {
                                    // Tambahkan opsi kecamatan ke elemen <select> kecamatan
                                    $.each(districtData.data, function(index,
                                        district) {
                                        selectDistrict.append($('<option>', {
                                            text: district,
                                            value: district
                                        }));
                                    });
                                } else {
                                    console.error(
                                        'Struktur data tidak sesuai dalam respons AJAX.'
                                    );
                                }
                            },
                            error: function(err) {
                                console.error('Error in AJAX request:', err);
                            }
                        });
                    }
                });


                // ...

                // Tambahkan event listener untuk memanggil fungsi saat kecamatan dipilih
                $('#district').on('change', function() {
                    const selectedDistrict = $(this).val();
                    const selectedCity = $('#city').val(); // Ambil nilai kota yang dipilih
                    const selectedProvince = $('#province')
                        .val(); // Ambil nilai provinsi yang dipilih

                    if (selectedDistrict && selectedCity && selectedProvince) {
                        // Lakukan AJAX untuk mendapatkan data subdistrict berdasarkan kecamatan, kota, dan provinsi
                        $.ajax({
                            url: '{{ route('getsubdistrict') }}', // Ganti dengan endpoint yang sesuai
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                district: selectedDistrict,
                                city: selectedCity,
                                province: selectedProvince
                            },
                            success: function(subdistrictData) {
                                const selectSubdistrict = $('#subdistrict');

                                // Set nilai kode pos berdasarkan data yang diterima
                                $('#kodepos').val(subdistrictData.GetZipCode);

                                // Bersihkan opsi subdistrict sebelum menambahkan yang baru
                                selectSubdistrict.empty();

                                // Tambahkan opsi "Pilih Subdistrict" dengan nilai kosong
                                selectSubdistrict.append($('<option>', {
                                    text: 'Pilih Kelurahan',
                                    value: '',
                                    disabled: true,
                                    selected: true
                                }));

                                if (subdistrictData.success && subdistrictData.data &&
                                    Array.isArray(subdistrictData.data)) {
                                    // Tambahkan opsi subdistrict ke elemen <select> subdistrict
                                    $.each(subdistrictData.data, function(index,
                                        subdistrict) {
                                        selectSubdistrict.append($('<option>', {
                                            text: subdistrict,
                                            value: subdistrict
                                        }));
                                    });
                                } else {
                                    console.error(
                                        'Struktur data tidak sesuai dalam respons AJAX.'
                                    );
                                }
                            },
                            error: function(err) {
                                console.error('Error in AJAX request:', err);
                            }
                        });
                    }
                });

                // ...



            });


            $('#dataDiriForm').on('submit', function(event) {
                event.preventDefault();
                // Ambil nilai dari semua input dan select
                const namaKTP = $('#nama_ktp').val();
                const telp = $('#telp').val();
                const birthDate = $('#birth_date').val();
                const gender = $('#gender').val();
                const address = $('#address').val();
                const province = $('#province').val();
                const city = $('#city').val();
                const district = $('#district').val();
                const subdistrict = $('#subdistrict').val();
                const kodepos = $('#kodepos').val();


                // Lakukan validasi data sebelum mengirimkan ke server
                // if (!namaKTP || !telp || !birthDate || !gender || !address || !province || !city || !
                //     district || !subdistrict || !kodepos) {
                //     Swal.fire({
                //         title: 'Perhatian!',
                //         text: 'Harap lengkapi semua field ',
                //         icon: 'warning',
                //         confirmButtonText: 'OK'
                //     });
                //     return;
                // }
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                // Lakukan AJAX untuk mengirim data ke server
                $.ajax({
                    url: '{{ route('post.datadiri') }}', // Ganti dengan endpoint yang sesuai
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        _token: csrfToken,
                        nama_ktp: namaKTP,
                        telp: telp,
                        birth_date: birthDate,
                        gender: gender,
                        address: address,
                        provinsi: province,
                        kota: city,
                        kecamatan: district,
                        kelurahan: subdistrict,
                        kodepos: kodepos
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#modalDataDiri').modal('hide');
                            Swal.fire('Sukses', 'Profil Berhasil Di Perbarui',
                                'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            console.error('Gagal menyimpan data:', response.message);
                            // Tambahan tindakan setelah penyimpanan gagal (pesan kesalahan, dll.)
                        }
                    },
                    error: function(err) {
                        console.error('Error in AJAX request:', err);
                    }
                });
            });




            $(".close-qr, .cancel-btn").click(function() {

                // Dapatkan referensi ke tombol "Stop Scanning" berdasarkan ID
                const stopButton = document.getElementById("html5-qrcode-button-camera-stop");

                // Otomatis klik tombol "Stop Scanning"
                stopButton.click();
            });

            function klaimPoints(kode) {

                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST",
                    url: "{{ route('klaimpoint.index') }}",
                    data: {
                        kode: kode,
                        _token: token
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#modalRedeemPoin').modal('hide');
                            Swal.fire({
                                title: 'Klaim Point',
                                text: 'Berhasil Melakukan Klaim Point',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            // $("#total-point").text(response.point);

                            // html5QrcodeScanner.clear().then(_ => {
                            //     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            // })
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);

                        } else {
                            // alert(response.message);
                            Swal.fire({
                                title: 'Gagal',
                                text: response.message,
                                icon: 'warning',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            $("#klaim-show").click(function() {

                function onScanFailure(error) {

                }

                function onScanSuccess(decodedText, decodedResult) {

                    // console.log(decodedText);
                    $('#kode').val(decodedText);
                    //auto klaim point
                    // klaimPoints(decodedText);

                    // Dapatkan referensi ke tombol "Stop Scanning" berdasarkan ID
                    const stopButton = document.getElementById("html5-qrcode-button-camera-stop");

                    // Otomatis klik tombol "Stop Scanning"
                    stopButton.click();

                }


                // let html5QrcodeScanner = new Html5QrcodeScanner(
                //     "reader", {
                //         fps: 10,
                //         qrbox: 150,
                //         supportedScanTypes: [
                //             // Html5QrcodeScanType.SCAN_TYPE_FILE,
                //             Html5QrcodeScanType.SCAN_TYPE_CAMERA
                //         ],
                //     },
                //     /* verbose= */
                //     false);

                // html5QrcodeScanner.render(onScanSuccess, onScanFailure);

                // $('#modalRedeemPoint').on('shown.bs.modal', function() {

                // });

                $.ajax({
                    url: 'check-data-diri', // Gantilah dengan URL yang sesuai
                    type: 'GET',
                    success: function(data) {
                        // Logika Anda di sini berdasarkan respons Ajax
                        if (data.success === false) {
                            Swal.fire({
                                title: "Info!",
                                text: "Silahkan lengkapi data diri anda terlebih dahulu",
                                icon: "info",
                                didClose: function() {
                                    // Tampilkan modal setelah SweetAlert ditutup
                                    $('#modalDataDiri').modal('show');
                                }
                            });
                        } else {

                            $('#modalRedeemPoin').modal('show');
                            let html5QrcodeScanner = new Html5QrcodeScanner(
                                "reader", {
                                    fps: 10,
                                    qrbox: 150,
                                    supportedScanTypes: [
                                        Html5QrcodeScanType.SCAN_TYPE_CAMERA
                                    ],
                                },
                                /* verbose= */
                                false);

                            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
                        }
                    },
                    error: function() {

                    }
                });
            })

            $("#kode").on("input", function() {
                var sanitized = $(this).val().replace(/[^a-zA-Z0-9]/g, '');

                var formatted = '';
                for (var i = 0; i < sanitized.length; i++) {
                    if (i % 4 === 0 && i > 0) {
                        formatted += '-';
                    }
                    formatted += sanitized.charAt(i);
                }

                $(this).val(formatted);
            });


            //ok


            $(".klaim-point").click(function() {
                var kode = $("#kode").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('klaimpoint.index') }}",
                    data: {
                        kode: kode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#total-point").text(response.point);
                            $('#modalRedeemPoin').modal('hide');
                            Swal.fire({
                                title: 'Klaim Point',
                                text: 'Berhasil Melakukan Klaim Point',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: response.message,
                                icon: 'warning',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);

                    }
                });
            });


            $('#navdown ul li:first-child a').addClass('active');
        })
    </script>
@endpush
