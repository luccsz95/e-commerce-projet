<?php
session_start();

$cart_items = $_SESSION['cart'];
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finalisation de l'achat</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <?php include 'navbar.php' ?>

    <h1>Finalisation de l'achat</h1>

    <?php if (!empty($cart_items)): ?>


        <p>Vous avez <?php echo count($cart_items); ?> articles dans votre panier.</p>
    <?php else: ?>
        <p>Votre panier est vide.</p>
    <?php endif; ?>
    <form id="payment-form">
        <div id="card-element"></div>
        <button type="submit">Payer</button>
        <div id="payment-result"></div>
    </form>

    <script>
        const stripe = Stripe('pk_test_51QrcwuLUXdwi5EWDa2YC6hxkz4AjQEUuV3GdJeAJtnNtcIhX646SzWYeO9MplVNVOsDKmBL0awqT51NclmQFD9Ur00a3ZzOBRK');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.getElementById('payment-form').addEventListener('submit', async (event) => {
            event.preventDefault();


            const response = await fetch('payement.php', {
                method: 'POST',
            });

            const {
                clientSecret
            } = await response.json();


            const result = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                },
            });


            document.getElementById('payment-result').innerText = result.error ?
                'Erreur : ' + result.error.message :
                'Paiement réussi!';
        });
    </script>
</body>

</html>