<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe to a Cool News Plan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <section>
        <div class="product">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14px" height="16px" viewBox="0 0 14 16" version="1.1">
                <defs/>
                <g id="Flow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="0-Default" transform="translate(-121.000000, -40.000000)" fill="#E184DF">
                        <path d="M127,50 L126,50 C123.238576,50 121,47.7614237 121,45 C121,42.2385763 123.238576,40 126,40 L135,40 L135,56 L133,56 L133,42 L129,42 L129,56 L127,56 L127,50 Z M127,48 L127,42 L126,42 C124.343146,42 123,43.3431458 123,45 C123,46.6568542 124.343146,48 126,48 L127,48 Z" id="Pilcrow"/>
                    </g>
                </g>
            </svg>
            <div class="description">
                <h3>Starter Plan</h3>
                <h5>$20.00 / month</h5>
            </div>
        </div>

        <!-- Laravel Form untuk Stripe Checkout -->
        <form action="{{ route('checkout.session') }}" method="POST">
            @csrf
            <!-- Add a hidden field with the lookup_key of your Price -->
            <input type="hidden" name="lookup_key" value="{{ env('STRIPE_LOOKUP_KEY') }}" />
            <button id="checkout-and-portal-button" type="submit">Checkout</button>
        </form>

        <!-- Button untuk kembali ke Home -->
        <div style="margin-top: 20px;">
            <a href="{{ route('home') }}" style="text-decoration: none; color: #fff; background-color: #007bff; padding: 10px 15px; border-radius: 5px;">
                Back to Home
            </a>
        </div>
    </section>
</body>
</html>
