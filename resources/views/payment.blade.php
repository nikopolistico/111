<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* General Body Styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #121212;
            /* Dark background */
            color: #ffffff;
            /* Light text */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('/background/summer.jpg');
            /* Background image */
            background-size: cover;
            background-position: center;
        }

        /* Payment Container */
        .payment-container {
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent dark background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            width: 450px;
            backdrop-filter: blur(5px);
        }

        h2 {
            text-align: center;
            color: #f1f1f1;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-size: 18px;
            color: #f1f1f1;
            margin-bottom: 10px;
        }

        .form-group #card-element {
            background-color: #2d2d2d;
            /* Darker input background */
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #555;
            font-size: 16px;
            color: #fff;
        }

        .form-group button {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            background-color: #ff5c8d;
            /* Bright color for button */
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #e04e79;
            /* Button hover effect */
        }

        .error-message {
            color: #ff5c8d;
            /* Error message color */
            font-size: 16px;
            text-align: center;
            margin-top: 15px;
        }

        .return-button {
            display: inline-block;
            margin-top: 1rem;
            /* mt-4 */
            background-color: #3b82f6;
            /* bg-blue-500 */
            color: white;
            /* text-white */
            padding: 0.5rem 1rem;
            /* py-2 px-4 */
            border-radius: 9999px;
            /* rounded-full */
            text-align: center;
            text-decoration: none;
            /* Remove underline */
            transition: background-color 0.3s ease;
            /* smooth hover transition */
        }

        .return-button:hover {
            background-color: #2563eb;
            /* hover:bg-blue-600 */
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <h2>Payment Details</h2>
        <form action="/payment" method="POST" id="payment-form">
            @csrf
            <div class="form-group">
                <label for="card-element">Credit or Debit Card</label>
                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
            </div>

            <div class="form-group">
                <button type="submit" id="submit">Pay Now</button>
            </div>

            <div class="error-message" id="error-message"></div>
        </form>
        <a href="{{ route('meal-plans.create') }}" class="return-button">
            Return to Meal Plans
        </a>
    </div>

    <script>
        // Set your publishable key
        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        var errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            errorMessage.textContent = ''; // Clear any previous error messages

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Display error message
                    errorMessage.textContent = result.error.message;
                } else {
                    // Append the token to the form and submit
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);

                    form.submit();
                }
            });
        });
    </script>
</body>

</html>