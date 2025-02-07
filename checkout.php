<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finalisation de l'achat</title>
</head>
<body>
    <h1>Finalisation de l'achat</h1>

    <?php if(!empty($cart_items)): ?>

    <p>Vous avez <?php echo count($cart_items);?> articles dans votre panier.</p>

    <form action="checkout.php" method="post">
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" required>
        <br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <br>

        <label for="address">Adresse</label>
        <input type="text" name="address" id="address" required>
        <br>

        <label for="city">Ville</label>
        <input type="text" name="city" id="city" required>
        <br>

        <label for="zip">Code postal</label>
        <input type="text" name="zip" id="zip" required>
        <br>

        <label for="country">Pays</label>
        <input type="text" name="country" id="country" required>
        <br>

        <label for="payement">Moyen de payement</label>
        <select name="payement" id="payement" required>
            <option value="visa">Visa</option>
            <option value="mastercard">Mastercard</option>
            <option value="paypal">Paypal</option>
        </select>
        <br>

        <button type="submit" name="checkout">Finaliser l'achat</button>
    </form>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>
</body>
</html>
