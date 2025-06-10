<div class="running-text text-bg-warning border-top border-bottom border-danger border-2">
    <div class="container-lg px-0 px-lg-3">
        <div class="row flex-nowrap g-0">
            <div class="col col-auto">
                <button class="btn btn-primary rounded-3 border-0 shadow-none" data-bs-toggle="modal"
                    data-bs-target="#modalFormTestimoni">
                    Roast Us Back
                </button>
            </div><!-- end col -->
            <div class="col">
                {{-- <marquee behavior="" direction="" class="h-100 d-flex align-items-center">
               <a href="#" target="_blank" class="text-decoration-none text-reset">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, sit magni nam esse quas laboriosam consequatur sed aperiam autem eius distinctio voluptas, odit accusantium cum. Non assumenda eos accusamus asperiores.
               </a>
            </marquee> --}}
                <marquee behavior="" direction="" class="h-100 d-flex align-items-center" id="runningTestimonials">
                    Loading testimonials...
                </marquee>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end running text -->

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/api/testimonials')
                .then(res => res.json())
                .then(data => {
                    const marquee = document.getElementById('runningTestimonials');
                    if (data.length > 0) {
                        marquee.innerHTML = data.map(msg => `<span class="me-5">💬 ${msg}</span>`).join('');
                    } else {
                        marquee.innerHTML = 'No testimonials available yet.';
                    }
                })
                .catch(err => {
                    document.getElementById('runningTestimonials').textContent = 'Error loading testimonials.';
                    console.error(err);
                });
        });
    </script>
@endpush
