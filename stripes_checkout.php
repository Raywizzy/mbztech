<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for the payment form */
        .card-element-container {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 5px;
        }
        .card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .text-danger {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-4">Secure Checkout</h1>
                <div class="card">
                    <div class="card-body">
                        <!-- Payment form -->
                        <form id="payment-form">
                            <div class="form-group">
                                <label for="card-element">Credit or Debit Card</label>
                                <div class="card-element-container">
                                    <div id="card-element" class="card-element"></div>
                                </div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                            </div>
                            <button id="submit" class="btn btn-primary btn-block">Pay Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stripe JS library -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_live_51OaIZkIH2gA0D6imWXp4zkRXZ68rJsS8Q3WdEASIWqWKapQVxiFGTCdZmsANw6RULPwBzkaJYdjxxlIDDmaZWPfx0068gPoyNw');
        var elements = stripe.elements();

        var style = {
            base: {
                fontSize: '16px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            },
        };
        var cardElement = elements.create('card', { style: style });
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        var errorElement = document.getElementById('card-errors');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            }).then(function(result) {
                if (result.error) {
                    errorElement.textContent = result.error.message;
                } else {
                    var paymentMethodId = result.paymentMethod.id;

                    fetch('/process_payment.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ payment_method_id: paymentMethodId })
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        if (data && data.success) {
                            window.location.href = 'success-page.html';
                        } else {
                            errorElement.textContent = 'Payment failed. Please try again.';
                        }
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                        errorElement.textContent = 'An error occurred. Please try again.';
                    });
                }
            });
        });
    </script>
</body>
</html>
