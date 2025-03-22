<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe to a Cool News Plan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f8f9fa;
        }

        .subscribe-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .subscribe-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .subscribe-box h3 {
            margin-bottom: 20px;
        }

        .subscribe-option {
            border: 2px solid transparent;
            padding: 15px;
            border-radius: 8px;
            transition: 0.3s;
            cursor: pointer;
        }

        .subscribe-option:hover {
            border-color: #007bff;
        }

        .selected {
            border-color: #007bff !important;
            background: rgba(0, 123, 255, 0.1);
        }

        .btn-subscribe {
            background: #007bff;
            color: white;
            transition: 0.3s;
            position: relative;
        }

        .btn-subscribe:hover {
            background: #0056b3;
        }

        /* Loading spinner */
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid white;
            border-top: 3px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            0% { transform: translateY(-50%) rotate(0deg); }
            100% { transform: translateY(-50%) rotate(360deg); }
        }

        .headline-info {
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
        }

        .btn-home {
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-home:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="subscribe-container">
        <div class="subscribe-box">
            <h3>Select Your Subscription</h3>
            <p>Please choose one of the options below:</p>

            <div class="subscribe-option" data-plan="price_1R26JEG79v7Vucc9WZggw9sV">
                <h5>💰 Weekly Subscription - $1/Week</h5>
                <p>Get full premium access for only $1 per week.</p>
            </div>

            <div class="subscribe-option mt-3" data-plan="price_1R26TgG79v7Vucc9UShXcRxT">
                <h5>📅 Monthly Subscription - $10/Month</h5>
                <p>Get full premium access for $10 per month.</p>
            </div>

            <div class="subscribe-option mt-3" data-plan="price_1R26UDG79v7Vucc9EFhos47z">
                <h5>🌟 Yearly Subscription - $100/Year</h5>
                <p>Get full premium access for $100 per year.</p>
            </div>

            <button id="subscribe-btn" class="btn btn-subscribe w-100 mt-4" disabled>
                Subscribe Now
                <div class="loading-spinner" id="loading-spinner"></div>
            </button>

            <p class="headline-info mt-3">If you do not choose, you will only receive headline summaries.</p>

            <a href="/" class="btn-home">← Back to Home</a>
        </div>
    </div>

    <script>
        let selectedPlan = null;

        document.querySelectorAll(".subscribe-option").forEach(option => {
            option.addEventListener("click", function () {
                document.querySelectorAll(".subscribe-option").forEach(el => el.classList.remove("selected"));
                this.classList.add("selected");
                selectedPlan = this.getAttribute("data-plan");
                document.getElementById("subscribe-btn").disabled = false;
            });
        });

        document.getElementById("subscribe-btn").addEventListener("click", function () {
            if (!selectedPlan) {
                alert("Please select a subscription plan.");
                return;
            }

            const subscribeBtn = document.getElementById("subscribe-btn");
            const loadingSpinner = document.getElementById("loading-spinner");

            // Tampilkan loading dan ubah tombol
            subscribeBtn.disabled = true;
            subscribeBtn.innerHTML = "Processing... <div class='loading-spinner' id='loading-spinner'></div>";
            loadingSpinner.style.display = "inline-block";
console.log(selectedPlan);
            fetch("http://127.0.0.1:8000/api/api-checkout/session", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ lookup_key: selectedPlan })
            })
            .then(response => response.json())
            .then(data => {
                if (data.url) {
                    window.location.href = data.url;
                } else {
                    throw new Error("Error processing subscription.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("An error occurred. Please try again.");
                subscribeBtn.innerHTML = "Subscribe Now";
                loadingSpinner.style.display = "none";
                subscribeBtn.disabled = false;
            });
        });
    </script>

</body>
</html>
