<h1>Checkout</h1>
<form id="payment-form">
    <div id="card-element"></div>
    <button id="submit">Pay</button>
    <div id="error-message"></div>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('<?php echo getenv('stripe.key') ?>');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const { clientSecret } = await fetch('<?= base_url('checkout/createPaymentIntent') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(r => r.json());

        const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: cardElement,
            }
        });

        if (error) {
            document.getElementById('error-message').textContent = error.message;
        } else {
            window.location.href = '<?= base_url('success') ?>';
        }
    });
</script>
