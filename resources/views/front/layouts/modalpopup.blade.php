<!-- Bootstrap Modal with Close Button -->
<div class="modal fade" id="newsPopupModal" tabindex="-1" aria-labelledby="newsPopupLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content"
            style="background-color: #1d1b18; color: #f5f0e6; border: none; position: relative;">

            <!-- Tombol X untuk Close Modal -->
            <div class="modal-body p-5">
                <button id="customCloseBtn" class="btn text-white position-absolute top-0 end-0 m-3 fs-4"
                    aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

                <h1 class="fw-bold mb-4 text-center" style="font-size: 2rem;">
                    No More Spin. No More BS—Just the Truth—With a Side of Snark.
                </h1>

                <p class="fs-5 mb-4 text-center">
                    Get unfiltered news, biting commentary, and rebel energy—delivered daily to your phone.
                </p>

                <div class="phone-frame-wrapper mx-auto">
                    <div class="phone-content text-center text-light">

                        <div class="text-center mt-5  fade-in-delayed">
                            <a href="https://play.google.com/store/apps/details?id=com.rc.news"
                                class="btn btn-warning fw-bold px-4 py-2 mb-4" style="font-size: 1.1rem;"
                                target="_blank" rel="noopener noreferrer">
                                Download the App
                            </a>
                        </div>


                        <!-- Konten setelah tombol, semua diratakan tengah -->
                        <div class="text-center  fade-in-delayed">
                            <ul class="list-unstyled fs-5 mb-4 d-inline-block text-start">
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>No Sugar-Coated Spin
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>Smart, Savage Commentary
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>Built for Rebels & Truth-Seekers
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-warning me-2"></i>No Ads. No Corporate Agenda
                                </li>
                            </ul>

                            <div
                                class="custom-separator d-flex justify-content-center align-items-center flex-wrap text-warning fw-bold mb-3">
                                <span class="separator-item">For Professionals</span>
                                <span class="separator-divider mx-2">|</span>
                                <span class="separator-item">For Activists</span>
                                <span class="separator-divider mx-2">|</span>
                                <span class="separator-item">For Truth Seekers</span>
                            </div>


                            <p class="fs-5 mb-0">
                                We don't do fake balance or billionaire filters.<br>
                                Just the raw truth with a punchline.
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const newsModalEl = document.getElementById('newsPopupModal');
        const newsModal = new bootstrap.Modal(newsModalEl);

        // Cek apakah modal sudah pernah ditampilkan sebelumnya
        // if (!localStorage.getItem("newsModalShown")) {
             newsModal.show();
        //     localStorage.setItem("newsModalShown", "true");
        // }

        // Tombol Close
        document.getElementById('customCloseBtn').addEventListener('click', function() {
            newsModal.hide();
        });
    });
</script>
