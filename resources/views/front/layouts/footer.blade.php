<!-- Footer -->
<footer class="text-white py-4" style="background-color: #f7ca46;">
    <div class="container">
        <div class="row">
            <!-- About Us Section (hidden) -->
            <div class="col-md-4 d-none">
                <h3 class="h5">About Us</h3>
                <p>Welcome to Factabot, your trusted source for up-to-date news and insights. Our mission is to deliver
                    accurate, relevant, and engaging news to our audience.
                </p>
                <p>
                    We utilize cutting-edge AI technology to generate news summaries, which are then reviewed and
                    refined by our editorial team to ensure factual accuracy and readability.
                </p>
            </div>

            <!-- Follow Us Section (hidden) -->
            <div class="col-md-4 d-none">
                <h3 class="h5">Follow Us</h3>
                <div class="d-flex">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="col-md-4">
                <a href="/about" class="footer-link">About Us</a><br>
                <a href="/history" class="footer-link">History</a><br>
                <a href="/faq" class="footer-link">FAQ</a><br>
                <a href="/editorial-policy" class="footer-link">Editorial Policy</a><br>
                <a href="/privacy-policy" class="footer-link">Privacy Policy</a>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4">
                <h3 class="h5 footer-link">Contact Us</h3>
                <p class="footer-link">Email: ricecottondev@gmail.com</p>
            </div>

        </div>

        <!-- Logo Partners Section -->
        <div class="row justify-content-center align-items-center mt-4">

        </div>

        <!-- Time Display -->
        <div class="d-none text-center mt-3" style="color: #4d4d4d; font-weight: bold; font-size: 16px;">
            <span id="current-time"></span>
        </div>
    </div>

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

    <style>
        .footer-link {
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
            color: #121212;
        }

        .footer-link:hover {
            text-decoration: underline;
            color: #121212;
        }
    </style>
</footer>
