{{-- @extends('layouts.indracostorepoint.app-home') --}}
@extends('layouts.sdamember.app-home')
@section('title')
    Notification
@endsection

@section('content')
    <main class="wrapper">

        <section>
            <div class="container">
                <h5 class="fw-medium fs-3 mb-5">Kotak Masuk</h5>
            </div>
            <nav class="list-group list-group-flush rounded-0 text-capitalize"
                style="border-top: solid 1px #dee2e6; border-bottom: solid 1px #dee2e6;">
                <a class="list-group-item text-reset py-4 px-0" data-bs-toggle="modal" href="#modalPromo">
                    <div class="container">
                        <div class="row row-row align-items-center">
                            <div class="col">
                                <h5 class="fw-medium">Promo</h5>
                                <p class="small mb-0">Lihat Semua Promo di sini</p>
                            </div>
                            <div class="col col-auto">
                                <i class="icon-chevron_right fs-3"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="list-group-item text-reset py-4 px-0" data-bs-toggle="modal" href="#modalnotif">
                    <div class="container">
                        <div class="row row-row align-items-center">
                            <div class="col">
                                <h5 class="fw-medium">Notifikasi</h5>
                                <p class="small mb-0">Lihat tagihan dan pengingat di sini</p>
                            </div>
                            <div class="col col-auto">
                                <i class="icon-chevron_right fs-3"></i>
                            </div>
                        </div>
                    </div>
                </a>

            </nav>
        </section>

    </main>


    <div class="modal fade modalPromo" id="modalPromo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalRedeemPoinLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title fw-medium fs-5" id="modalRedeemPoinLabel">Promo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-promo-list :data="$promo" />

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Notif --}}
    <div class="modal fade modalnotif" id="modalnotif" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalRedeemPoinLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title fw-medium fs-5" id="modalRedeemPoinLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <x-notif-list :data="$notif" />

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#navdown ul li:first-child a').addClass('active');

            $('.notification-item-notif').click(function() {

                $(this).closest('li').removeClass('bg-body-secondary');

                var notificationId = $(this).data('id');

                $.ajax({
                    url: '/notifications/mark-as-read/' + notificationId,
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (!response.success) {

                            $(this).closest('li').addClass('bg-body-secondary');
                            // alert('Failed to mark notification as read. ' + response.message);
                        }

                        // else {
                        //     alert(response.message);
                        // }
                    },
                    error: function(error) {

                        $(this).closest('li').addClass('bg-body-secondary');
                        console.error('Error marking notification as read:', error);
                    }
                });
            });



            $('.notification-item-promo').click(function() {

                $(this).closest('li').removeClass('bg-body-secondary');

                var notificationId = $(this).data('id');

                $.ajax({
                    url: '/promo/mark-as-read/' + notificationId,
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (!response.success) {

                            $(this).closest('li').addClass('bg-body-secondary');
                            // alert('Failed to mark notification as read. ' + response.message);
                        }

                        // else {
                        //     alert(response.message);
                        // }
                    },
                    error: function(error) {

                        $(this).closest('li').addClass('bg-body-secondary');
                        console.error('Error marking notification as read:', error);
                    }
                });
            });





        })
    </script>
@endpush
