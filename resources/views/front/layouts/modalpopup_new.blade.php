<style>
    .fade-out {
        animation: fadeOut 0.5s forwards;
    }

    .fade-in {
        animation: fadeIn 0.5s forwards;
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
            visibility: visible;
        }
    }
</style>

<!-- Bootstrap Modal -->
<div class="modal fade" id="newsPopupModal" tabindex="-1" aria-labelledby="contributorModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
            style="background-color: #1d1b18; color: #f5f0e6; border-radius: 1rem; overflow: hidden;">
            <div class="modal-body p-5">
                {{-- <button id="customCloseBtn" class="btn text-white position-absolute top-0 end-0 m-3 fs-4 d-none"
                    aria-label="Close">
                    <i class="fas fa-times"></i>
                </button> --}}

                <button id="customCloseBtn" type="button" class="btn text-white position-absolute top-0 end-0 m-3 fs-4"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>

                <!-- Form Section -->
                <div id="formSection">
                    <form id="contributorForm">
                        <h1 class="text-danger fw-bold mb-4 text-center" style="font-size: 2rem;">You're Early. And
                            Kinda Legendary.</h1>

                        <p class="mb-4" style="color: #cba34e; font-size: 1.1rem;">
                            Factabot is in beta—and you showed up before it was polished, perfect, or even stable.
                        </p>
                        <p class="mb-4" style="color: #cba34e; font-size: 1.1rem;">
                            We’re building this chaos machine with your feedback, and we want to <strong>immortalize
                                you</strong> on our <strong>Founding Contributors Wall</strong>—a forever list of
                            legends who helped shape it.
                        </p>
                        <p class="mb-4" style="color: #cba34e; font-size: 1.1rem;">
                            <strong>Want your name etched</strong> in our history (and maybe a future Wikipedia page)?
                        </p>
                        <input type="text" id="name" name="name" class="form-control mb-3"
                            placeholder="Your Name" required>
                        <input type="email" id="email" name="email" class="form-control mb-3"
                            placeholder="Your Email" required>
                        <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off">

                        <button type="submit" class="btn btn-warning w-100 fw-bold">Add Me to the Wall</button>

                        <p class="text-light text-center mt-3">No pressure. Just eternal glory.</p>
                    </form>
                </div>

                <!-- Thank You Section -->
                <div id="thankYouSection" class="d-none text-center">

                    <h1 class="fw-bold mb-4 text-danger text-uppercase" style="font-size: 1.8rem;">You Beautiful<br>Beta
                        Hero, You.</h1>

                    <p class="mb-4" style="color: #cba34e; font-size: 1.1rem;">
                        Your name’s in. Your place in Factabot history is secured.
                    </p>
                    <p class="mb-4" style="color: #cba34e; font-size: 1.1rem;">
                        Thanks for helping us build something smarter, sassier, and way less corporate than whatever the
                        algorithm served you yesterday.
                    </p>
                    <p class="mb-4" style="color: #cba34e; font-size: 1.1rem;">
                        Now go break something else in the app—we’re watching (in a totally non-creepy way).
                    </p>
                    <a href="/" class="btn btn-danger fw-bold px-5 py-2" style="font-size: 1.2rem;">Back to the
                        Headlines</a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = new bootstrap.Modal(document.getElementById('newsPopupModal'), {
            backdrop: 'static',
            keyboard: false
        });

        const form = document.getElementById('contributorForm');
        const formSection = document.getElementById('formSection');
        const thankYouSection = document.getElementById('thankYouSection');

        const submittedKey = 'contributor_form_submitted';
        const shownCountKey = 'contributor_modal_shown_count';

        const hasSubmitted = localStorage.getItem('factabot_contributor_submitted');

        // if (!hasSubmitted) {
        //     modal.show();
        // }

        if (!localStorage.getItem('factabot_contributor_name') && !localStorage.getItem(
                'factabot_contributor_email')) {
            if (!localStorage.getItem(submittedKey)) {
                let shownCount = parseInt(localStorage.getItem(shownCountKey) || '0', 10);
                if (shownCount < 3) {
                    modal.show();
                    shownCount++;
                    localStorage.setItem(shownCountKey, shownCount);
                }
            }
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();

            if (name && email) {
                fetch('/contributor-signup', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: name,
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Sukses submit
                        localStorage.setItem('factabot_contributor_submitted', 'true');
                        localStorage.setItem('factabot_contributor_name', name);
                        localStorage.setItem('factabot_contributor_email', email);

                        formSection.classList.add('fade-out');
                        formSection.addEventListener('animationend', function handler() {
                            formSection.classList.add('d-none');
                            thankYouSection.classList.remove('d-none');
                            thankYouSection.classList.add('fade-in');
                            formSection.removeEventListener('animationend', handler);
                        });

                        document.getElementById('customCloseBtn').classList.remove('d-none');
                        document.getElementById('customCloseBtn').addEventListener('click',
                            function() {
                                modal.hide();
                            });
                    })
                    .catch(error => {
                        console.error('Error saving contributor:', error);
                        alert('Something went wrong. Please try again!');
                    });
            } else {
                alert("Please fill your name and email!");
            }
        });
    });
</script>

document.addEventListener("DOMContentLoaded", function () {
const modal = new bootstrap.Modal(document.getElementById('newsPopupModal'), {
backdrop: 'static',
keyboard: false
});

const form = document.getElementById('contributorForm');
const formSection = document.getElementById('formSection');
const thankYouSection = document.getElementById('thankYouSection');

// Cek apakah user sudah pernah submit
const hasSubmitted = localStorage.getItem('factabot_contributor_submitted');

if (!hasSubmitted) {
// Kalau belum, munculkan modal
modal.show();
}

form.addEventListener('submit', function (e) {
e.preventDefault();

const name = document.getElementById('name').value.trim();
const email = document.getElementById('email').value.trim();

if (name && email) {
// Simpan ke Local Storage
localStorage.setItem('factabot_contributor_submitted', 'true');
localStorage.setItem('factabot_contributor_name', name);
localStorage.setItem('factabot_contributor_email', email);

// Animasi transisi
formSection.classList.add('fade-out');
formSection.addEventListener('animationend', function handler() {
formSection.classList.add('d-none');
thankYouSection.classList.remove('d-none');
thankYouSection.classList.add('fade-in');

formSection.removeEventListener('animationend', handler);
});

// Setelah selesai Thank You, boleh klik Back to Headlines atau close
document.getElementById('customCloseBtn').classList.remove('d-none');
document.getElementById('customCloseBtn').addEventListener('click', function () {
modal.hide();
});
} else {
alert("Please fill your name and email!");
}
});
});
</script>
