<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['address'])) {
    $_SESSION['idAdresse'] = $_POST['address'];
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT idAnimals, nameAnimals, priceAnimals FROM animals");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT idUsers, adresseUsers, idAdresse FROM adresse WHERE idUsers = :idUsers");
    $stmt->bindParam(':idUsers', $_SESSION['user_id']);
    $stmt->execute();
    $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

if(isset($_SESSION['cart'])) {
    $cart_items = $_SESSION['cart'];
} else {
    $cart_items = [];
}

$total_price = 0;
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finalisation de l'achat</title>
    <link rel="stylesheet" href="style/checkout.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
<?php include 'navbar.php' ?>

<h1>Finalisation de l'achat</h1>

<?php if (!empty($cart_items)): ?>
    <div class="checkout-container">
        <!-- Partie Gauche : Tableau des Produits -->
        <div class="cart-section">
            <table class="cart-table">
                <thead>
                <tr>
                    <th>Nom du produit</th>
                    <th>Prix</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cart_items as $idAnimals) : ?>
                    <?php
                    foreach ($products as $product) {
                        if ($product['idAnimals'] == $idAnimals) {
                            $total_price += $product['priceAnimals'];
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['nameAnimals']); ?></td>
                                <td><?php echo htmlspecialchars($product['priceAnimals']); ?>€</td>
                            </tr>
                            <?php
                            break;
                        }
                    }
                    ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Partie Droite : Sélection de l'adresse + Prix Total + Formulaire -->
        <div class="payment-section">
            <h2>Total : <?php echo number_format($total_price, 2, ',', ' '); ?>€</h2>

            <form action="" method="post">
                <label for="address">Sélectionnez une adresse de livraison :</label>

                <select name="address" id="address" required>
                    <?php foreach ($addresses as $address):
                        $isSelected = ($address['idAdresse'] == $selectedAddressId) ? 'selected' : '';
                        ?>
                        <option value="<?php echo htmlspecialchars($address['idAdresse']); ?>" <?php echo $isSelected; ?>>
                            <?php echo htmlspecialchars($address['adresseUsers']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Valider l'adresse</button>
            </form>

            <form id="payment-form" method="post">
                <p>Livrez à une autre adresse ? <a href="adresseUsers.php">Cliquer ici</a></p>
                <input type="hidden" id="idAdresse" name="idAdresse" value="<?php echo htmlspecialchars($selectedAddressId); ?>">

                <div id="card-element"></div>
                <button type="submit">Payer</button>
                <div id="payment-result"></div>
            </form>
        </div>
    </div>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?>

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
        window.location.href = "commands.php";

        /*await fetch('clear_cart_after_payement.php', {
            method: 'POST',
        });*/
    });
</script>
</body>

</html>