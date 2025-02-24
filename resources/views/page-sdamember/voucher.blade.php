{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Voucher
@endsection

@section('content')
    <main class="wrapper">


        <section>
            <div class="container">
                <h4 class="fw-medium fs-3 text-capitalize">Vouchers</h4>
                <p class="mb-5">
                    2 Voucher yang bisa kamu gunakan
                </p>

                <div class="rounded-4 bg-secondary-subtle">
                    <div class="card">
                        <img src="/sdamember-template/img/jpg/banner-promo.jpg" class="card-img-top">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">

                                    <p class="p-0 m-0 fw-bold">  <i class="icon-e-voucher_icon_red me-2"></i> Nama Item E - voucher</p>
                                    <p class="p-0 my-0 fs-6" style="margin-left: 35px;"><small> Berlaku sampai dd/mm/yy </small></p>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="text-decoration-none text-reset">
                                        <p class="p-0 m-0">Tukarkan</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class="row g-3 gx-lg-5">
                    @if ($buttonClaim)
                        <input type="text" id="search" placeholder="Cari voucher" value="{{ request('search') }}"
                            class="form-control form-control rounded-0" autocomplete="off">
                    @endif

                    @foreach ($vouchers as $merchant)
                        <div class="col col-12">

                            <div class="mt-3 p-3 w-100 text-center text-bg-secondary fs-5 fw-medium rounded-4">
                                <span>{{ $merchant->merchant_name }}</span>
                            </div>
                        </div>
                        @foreach ($merchant->vouchers as $voucher)
                            <div class="col col-12 col-md-6">
                                <a class="text-reset text-decoration-none" href="/detail-voucher">
                                    <div class="card text-reset bg-light border-0 rounded-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col col-auto">
                                                <div class="p-3">
                                                    <i class="icon-diskon" style="font-size: 5rem;"></i>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="card-body">

                                                    <h5 class="card-title mb-0">{{ $voucher->label }}</h5>
                                                    <p class="card-text mb-0">{{ $voucher->short_desc }}</p>
                                                    <p class="card-text small mb-0" style="color: #fd4f00;">
                                                        Berlaku Sampai {{ $voucher->date_end }}
                                                    </p>
                                                    <p class="card-text fw-medium fs-5">{{ $voucher->pointneed }} POIN</p>

                                                    @if ($buttonClaim)
                                                        <div>
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="btn-klaim" data-id="{{ $voucher->id }}"
                                                                data-point="{{ $voucher->pointneed }}">Tukar</button>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                id="btn-gunakan" data-id="{{ $voucher->id }}"
                                                                data-point="{{ $voucher->pointneed }}"
                                                                data-label="{{ $voucher->label }}"
                                                                data-kode="{{ $voucher->kode_voucher }}">Gunakan</button>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach



                </div> --}}
            </div>
        </section>


        <!-- modal Edit Name -->
        {{-- <div class="modal fade modalVoucherUsed" id="modalVoucherUsed" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="modalVoucherUsed" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-0 bg-light">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-medium fs-5" id="modalVoucherUsed">Aktivasi Berhasil</h5>

                    </div>
                    <div class="modal-body text-center d-flex flex-column row-gap-4">
                        <p id="text-body"></p>


                        <div class="modal-footer border-0">
                            <button type="button" id="closeModalVoucher" class="btn btn-lg rounded-0 btn-dark w-100"
                                data-bs-dismiss="modal">Oke</button>

                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </main>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#closeModalVoucher', function() {
                // Reload halaman setelah tombol "Oke" ditekan
                location.reload();
            });

            $(document).on('click', '#btn-gunakan', function() {
                event.preventDefault();
                // Ambil data dari atribut data pada tombol
                var voucherId = $(this).data('id');
                var pointNeeded = $(this).data('point');
                var voucherLabel = $(this).data('label');
                var kodeVocuher = $(this).data('kode');

                // Tampilkan SweetAlert
                Swal.fire({
                    title: voucherLabel,
                    text: 'Aktifkan voucher melalui kasir',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Aktifkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    // Handle aksi setelah user mengklik Ya atau Batal
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/gunakan-voucher', // Ganti dengan URL endpoint sesuai dengan kebutuhan Anda
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: voucherId
                            },
                            success: function(response) {
                                const text =
                                    `Voucher ${voucherLabel} dengan Kode Voucher: ${kodeVocuher} berhasil digunakan`;
                                $('#text-body').text(text);
                                $('#modalVoucherUsed').modal('show');

                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error', 'Gagal menggunakan voucher.',
                                    'error');
                            }
                        });
                    }
                });
            });

            $('#search').on('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    var searchTerm = $(this).val();
                    window.location.href = '/voucher?search=' + encodeURIComponent(searchTerm);
                }
            });


            $(document).on('click', '#btn-klaim', function() {
                event.preventDefault();

                var voucherId = $(this).data('id');
                var getPoint = $(this).data('point');
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Tukar voucher ini dengan ' + getPoint + ' poin',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, tukar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('klaimvoucher.index') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: voucherId
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Sukses',
                                        text: 'Voucher berhasil ditukar dengan poin',
                                        icon: 'success',
                                        confirmButtonText: 'Lihat Voucher'
                                    }).then(() => {
                                        window.location.href =
                                            '/member-voucher';
                                    });

                                } else {
                                    Swal.fire('Gagal', data.message, 'error');
                                }
                            },
                            error: function(error) {
                                console.error('Gagal mengklaim voucher');
                            }
                        });
                    }
                });

            });




        })
    </script>
@endpush
