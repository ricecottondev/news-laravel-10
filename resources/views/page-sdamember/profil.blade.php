{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Profile
@endsection

<style>
    .banner-level {
        height: 150px;
    }
</style>

@section('content')
    <main class="wrapper">
        <section class="border-0">
            <div class="container">


                <div class="card border-0">
                    <div class="card-body rounded-3 banner-level bgi-gold">
                        <div class="d-flex flex-column justify-content-left p-lg-5">
                            <div class="inner-card">
                                <div class="row justify-content-between">
                                    <div class="col col-auto">
                                        <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                                            <label for="imageInput" style="cursor: pointer;">
                                                <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                                                    <img class="rounded-circle" src="{{ $userImageProfile }}" alt=""
                                                        id="userImage">
                                                </div>
                                            </label>
                                            <input type="file" id="imageInput" style="display: none;" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col text-white">
                                        <h4 class="fw-medium fs-5 mb-0 text-capitalize">{{ Auth::user()->name }}</h4>
                                        <div><small>ID 0000 0000 0000</small></div>
                                        <div>Tipe Member
                                            <span class="icon-white_icon ms-2"></span>
                                            <span class="text-light ">Gold</span>
                                            <span class="text-light ms-2">Poin: 25</span>
                                        </div>
                                        <div class="mt-1">
                                            <div class="progress" role="progressbar" aria-label="Basic example"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar progress-bar-striped bg-gold" style="width: 25%">
                                                </div>
                                            </div>
                                            <div class="text-end text-light">
                                                <small> raih 10.001 poin lagi untuk meraih Platinum</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-0 d-none">
            <div class="container d-flex flex-column row-gap-5">
                <div class="row gx-3">
                    <div class="col col-auto">
                        <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                            <label for="imageInput" style="cursor: pointer;">
                                <div class="ratio ratio-1x1 bg-light rounded-circle" style="width: 90px;">
                                    <img class="rounded-circle" src="{{ $userImageProfile }}" alt="" id="userImage">
                                </div>
                            </label>
                            <input type="file" id="imageInput" style="display: none;" accept="image/*">
                        </div>
                    </div>
                    <div class="col">
                        <h4 class="fw-medium fs-3 text-capitalize">Hi, <br> <span
                                id="name">{{ Auth::user()->name }}</span>.</h4>
                        {{-- <span>
                            Arabica Member <img src="{{ asset('sdamember-template/img/svg/arabica.svg') }}"
                                width="auto" height="30" alt="">
                        </span> --}}
                    </div>
                    <div class="col col-auto">
                        <a class="text-reset text-decoration-none" style="font-size: 1.75rem;" data-bs-toggle="modal"
                            href="#modalEditProfil">
                            <i class="icon-edit"></i>
                        </a>
                    </div>
                </div>
                {{-- <div class="row justify-content-between gx-4 d-none">
                    <div class="col">
                        <div>Poin</div>
                        <div class="fw-medium fs-3" id="total-point">{{ $totalPoint }}</div>
                        <div>
                            <a class="text-decoration-none" data-bs-toggle="modal" href="#modalRiwayatPoint">Riwayat
                                Poin</a>
                        </div>
                    </div>
                    <div class="col col-auto">
                        <div>My Voucher</div>
                        <div class="fw-medium fs-3">{{ $voucherCount }}</div>
                        <div>
                            <a class="text-decoration-none" href="{{ route('member-voucher.index') }}">Lihat Detail</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>

        <section class="py-0">
            <nav class="list-group list-group-flush rounded-0 text-capitalize" style="border-top: solid 1px #dee2e6;">
                <a class="list-group-item text-reset py-4 px-0" data-bs-toggle="modal" href="#modalDataDiri"
                    id="klaim-show">
                    <div class="container fw-bold">
                        <i class="icon-pengaturan_icon_2 me-2"></i>
                        <span>Pengaturan</span>
                    </div>
                </a>
                {{-- <a class="list-group-item text-reset py-4 px-0" href="{{ route('member-voucher.index') }}">
                    <div class="container fw-bold">
                        <i class="icon-e-voucher_icon_2 me-2"></i>
                        Voucher
                    </div>
                </a> --}}
                <a class="list-group-item text-reset py-4 px-0" data-bs-toggle="modal" href="#modalDataDiri"
                    id="klaim-show">
                    <div class="container fw-bold">
                        <i class="icon-faq_icon_2 me-2"></i>
                        FAQ
                    </div>
                </a>
                <a class="list-group-item text-reset py-4 px-0" data-bs-toggle="modal" href="#modalDataDiri"
                    id="klaim-show">
                    <div class="container fw-bold">
                        <i class="icon-Layanan-Pelanggan me-2"></i>
                        Layanan Pelanggan
                    </div>
                </a>

                {{-- <a class="list-group-item text-reset py-4 px-0" href=" {{ '/generate-qr-member/' . $memberId }}">
                    <div class="container fw-bold">
                        <i class="icon-qr_black_icon me-2"></i>
                        Qr Code
                    </div>
                </a> --}}
                <a class="list-group-item text-reset py-4 px-0" href="{{ route('logout') }}">
                    <div class="container fw-bold">
                        keluar
                    </div>
                </a>

            </nav>
        </section>

    </main>

    <!-- modal redeem poin -->
    <div class="modal fade" id="modalDataDiri" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalDataDiriLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-medium fs-5" id="modalDataDiriLabel">Data Diri</h5>
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


    <!-- modal Riwayat poin -->
    @if (isset($logPoint))
        <div class="modal fade modalRiwayatPoint" id="modalRiwayatPoint" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalRedeemPoinLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <h5 class="modal-title fw-medium fs-5" id="modalRedeemPoinLabel">Riwayat Point</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <ol class="list-group list-group-flush list-group-numbered">
                            @foreach ($logPoint as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-start px-0">
                                    <div class="ms-2 me-auto">
                                        <span>
                                            <small>{{ $item->formatted_datetime }}</small>
                                            <br>
                                            <strong>Kode : {{ $item->id_uniquecode }}</strong>
                                            <br>
                                            Point : {{ $item->point }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ol>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- modal Edit Name -->
    <div class="modal fade modalEditProfil" id="modalEditProfil" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="modalRedeemPoinLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0 bg-light">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-medium fs-5" id="modalRedeemPoinLabel">Edit Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center d-flex flex-column row-gap-4">
                    <input class="form-control form-control-lg rounded-0" type="file" id="formImage"
                        accept="image/*">
                    <input type="text" id="input-name" value="{{ Auth::user()->name }}" placeholder="Masukan Nama"
                        class="form-control form-control-lg rounded-0">


                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-lg rounded-0 bg-white text-dark w-100"
                            data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-lg rounded-0 btn-dark w-100 edit-profile">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#modalDataDiri').on('shown.bs.modal', function() {
                // Lakukan AJAX di sini




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

            });


            $("#klaim-show").click(function() {
                $.ajax({
                    url: 'check-data-diri', // Gantilah dengan URL yang sesuai
                    type: 'GET',
                    success: function(data) {
                        // Logika Anda di sini berdasarkan respons Ajax
                        if (data.success === false) {



                            selectJne()
                            $('#modalDataDiri').modal('show');
                        } else {


                            $('#nama_ktp').val(data.data.nama_ktp).attr('readonly', 'readonly');
                            $('#telp').val(data.data.telp);
                            $('#birth_date').val(data.data.birth_date).attr('readonly',
                                'readonly');
                            $('#gender').val(data.data.gender).prop('disabled', true);

                            $('#address').val(data.data.address).attr('readonly', 'readonly');

                            $('#kodepos').val(data.data.kodepos).attr('readonly', 'readonly');
                            createAndSetOption('#province', data.data.provinsi);
                            createAndSetOption('#city', data.data.city);
                            createAndSetOption('#district', data.data.kecamatan);
                            createAndSetOption('#subdistrict', data.data.desa);
                            $('#province, #city, #district, #subdistrict').prop('disabled',
                                true);
                            $('#province').trigger('change');
                            $('#city').trigger('change');
                            $('#district').trigger('change');
                            $('#subdistrict').trigger('change');

                            $('#modalDataDiri').modal('show');
                        }
                    },
                    error: function() {

                    }
                });
            })

            function createAndSetOption(selectId, value) {
                var option = $('<option>', {
                    value: value,
                    text: value,
                    selected: 'selected',
                });
                $(selectId).empty().append(option);
            }




            $("#imageInput").change(function() {
                var fileInput = document.getElementById("imageInput");
                var file = fileInput.files[0];

                var formData = new FormData();
                formData.append("imageFile", file);


                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                formData.append("_token", csrfToken);


            });



            $('.edit-profile').click(function() {
                var newName = $('#input-name').val();
                var fileInput = document.getElementById("formImage");
                var file = fileInput.files[0];
                var imageFile = $('#formImage')[0].files[0];
                // console.log(newName);
                var formData = new FormData();
                formData.append('name', newName);
                formData.append('imageFile', imageFile);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                formData.append("_token", csrfToken);


            });


            $('#navdown ul li:first-child(5) a').addClass('active');
        })
    </script>
@endpush
