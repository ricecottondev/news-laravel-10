<footer class="footbar text-bg-warning small">
    <div class="container py-4 px-0">
        <div class="row g-0 row-cols-1 row-cols-md-auto row-gap-3 justify-content-md-between"
            style="align-items: last baseline;">
            <div class="col px-3">
                @include('front.layouts.nav-side')
                {{-- <script src="layout/nav-side.js"></script> --}}
            </div><!-- end col -->
            <div class="col d-md-none">
                <hr class="opacity-100">
            </div>
            <div class="col px-3">
                <p class="text-center text-lg-start">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> FactaBot. All rights reserved.
                </p>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->

    <script>
        function getQueryParam(key) {
            const params = new URLSearchParams(window.location.search);
            return params.get(key);
        }

        // window.addEventListener("unload", function() {
        navigator.sendBeacon("/track-page-duration", JSON.stringify({
            url: window.location.href,
            duration: Math.round(performance.now() / 1000),
            source: getQueryParam('source') // kirimkan source jika ada
        }));
        //});

        window.addEventListener("unload", function() {
            navigator.sendBeacon("/track-page-duration", JSON.stringify({
                url: window.location.href,
                duration: Math.round(performance.now() / 1000),
                source: getQueryParam('source') // kirimkan source jika ada
            }));
        });
    </script>

    <script>
        const timezone = "{{ config('app.timezone') }}";

        function updateTime() {
            const now = new Date();
            const formatter = new Intl.DateTimeFormat('en-NZ', {
                timeZone: timezone,
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });

            document.getElementById('current-time').innerText = formatter.format(now);
        }

        setInterval(updateTime, 1000);
        updateTime();
    </script>
</footer><!-- end footbar -->
