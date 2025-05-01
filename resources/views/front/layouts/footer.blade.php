<!-- Footer -->
<footer class="text-white py-4" style="background-color: #cba34e;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 d-none">
                <h3 class="h5">About Us</h3>
                <p>Welcome to Factabot, your trusted source for up-to-date news and insights. Our mission is to deliver
                    accurate, relevant, and engaging news to our audience.
                </p>
                <p>
                    We utilize cutting-edge AI technology to generate news summaries, which are then reviewed and
                    refined by our editorial team to ensure factual accuracy and readability. Our goal is to provide
                    well-structured and insightful content for our readers.
                </p>
            </div>

            <div class="col-md-4 d-none">
                <h3 class="h5">Follow Us</h3>
                <div class="d-flex">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-md-4">
                <a href="/about" style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">About Us</a>
                <br>
                <a href="/history" style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">History</a>
                <br>
                <a href="/faq" style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">FAQ</a>
                <br>
                <a href="/editorial-policy" style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">Editorial Policy</a>
                <br>
                <a href="/privacy-policy" style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">Privacy Policy</a>
            </div>
            <div class="col-md-4">
                <h3 class="h5" style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">Contact Us</h3>
                <p style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">Email: factabot@gmail.com</p>
                {{-- <p style="font-size: 18px ;font-weight: bold;text-decoration: none ;color:#4d4d4d">Phone: (+61) 0424777146</p> --}}
            </div>

            <div class="text-center mt-3" style="color: #4d4d4d; font-weight: bold; font-size: 16px;">
                <span id="current-time"></span>
            </div>
        </div>
    </div>

    <script>
        const timezone = "{{ config('app.timezone') }}";

        function updateTime() {
            // Pakai Intl.DateTimeFormat untuk format lokal dengan timezone
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

        // Update setiap detik
        setInterval(updateTime, 1000);
        updateTime(); // panggil pertama kali
    </script>
</footer>
