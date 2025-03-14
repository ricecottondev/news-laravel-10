<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe - FactaBot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        }

        .btn-subscribe:hover {
            background: #0056b3;
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

            <div class="subscribe-option" id="free-trial">
                <h5>🎉 Free 30-Day Trial</h5>
                <p>Enjoy premium access for 30 days for free!</p>
            </div>

            <div class="subscribe-option mt-3" id="paid">
                <h5>💰 Paid Subscription - $1/Week</h5>
                <p>Get full premium access for only $1 per week.</p>
            </div>

            <button id="subscribe-btn" class="btn btn-subscribe w-100 mt-4" disabled>Subscribe Now</button>

            <p class="headline-info mt-3">If you do not choose, you will only receive headline summaries.</p>

            <a href="/" class="btn-home">← Back to Home</a>

            <form action="/create-checkout-session.php" method="POST">
                <!-- Add a hidden field with the lookup_key of your Price -->
                <input type="hidden" name="lookup_key" value="{{PRICE_LOOKUP_KEY}}" />
                <button id="checkout-and-portal-button" type="submit">Checkout</button>
              </form>
        </div>
    </div>

    <script>
        let selectedOption = null;

        document.getElementById("free-trial").addEventListener("click", function () {
            selectOption("free-trial");
        });

        document.getElementById("paid").addEventListener("click", function () {
            selectOption("paid");
        });

        function selectOption(option) {
            selectedOption = option;
            document.getElementById("free-trial").classList.remove("selected");
            document.getElementById("paid").classList.remove("selected");

            document.getElementById(option).classList.add("selected");
            document.getElementById("subscribe-btn").disabled = false;
        }

        document.getElementById("subscribe-btn").addEventListener("click", function () {
            if (selectedOption === "free-trial") {
                alert("You have selected the Free 30-Day Trial!");
            } else if (selectedOption === "paid") {
                alert("You have selected the Paid Subscription - $1/Week!");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
