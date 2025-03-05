<?php
session_start();
session_regenerate_id(true); // Régénérer l'ID de session pour éviter les attaques de fixation de session

if (isset($_SESSION['idUser'])) {
    $id_user = $_SESSION['idUser'];
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

include 'bdd.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT idAnimals, nameAnimals, priceAnimals FROM animals");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$total = 0;

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][] = ['product_id' => $product_id, 'quantity' => $quantity];
    header("Location: cart.php");
    exit;
}

if (isset($_POST['remove_item'])) {
    $idAnimals = $_POST['idAnimals'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $idAnimals) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }

    header("Location: cart.php");
    exit;
}

if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $_SESSION['cart'][$key]['quantity'] = $quantity;
                break;
            }
        }
    }

    header("Location: cart.php");
    exit;
}

$cart_items = $_SESSION['cart'];

if (isset($_SESSION['idUser'])) {
    $stmt = $conn->prepare("SELECT adresseUsers FROM adresse WHERE idUsers = :idUsers");
    $stmt->bindParam(':idUsers', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $user_address = $stmt->fetchColumn();

    if (isset($_POST['checkout'])) {
        if ($user_address) {
            header("Location: checkout.php");
        } else {
            header("Location: adresseUsers.php");
        }
        exit;
    }
} else {
    echo "L'utilisateur n'est pas connecté.";
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/cart.css">
    <title>Panier</title>
</head>
<body>

<?php include 'navbar.php'; ?>
<br><br><br><br><br>
<h1>Votre Panier</h1>

<?php if (!empty($cart_items)): ?>

    <div class="cart-container">
        <div class="cart-products">
            <table>
                <thead>
                    <tr>
                        <th class="name_product">Nom du produit</th>
                        <th class="price_product">Prix par unitée</th>
                        <th class="quantity_product">Quantité</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item) : ?>
                        <?php
                        $product = array_filter($products, function ($prod) use ($item) {
                            return $prod['idAnimals'] == $item['product_id'];
                        });

                        if (!empty($product)) {
                            $product = array_values($product)[0];
                            $total += $product['priceAnimals'] * $item['quantity'];
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['nameAnimals']); ?></td>
                                <td><?php echo htmlspecialchars($product['priceAnimals']); ?>€</td>
                                <td>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                        <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                                        <button type="submit" name="update_quantity">Mettre à jour</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="idAnimals" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                        <button type="submit" name="remove_item">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php }
                        $_SESSION['total_price'] = $total; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="cart-summary">
            <p class="total">Total : <?php echo number_format($total, 2, ',', ' '); ?> €</p>

            <div class="actions">
                <form method="post" style="display: inline;">
                    <button type="submit" name="checkout" class="checkout">Payer</button>
                </form>

                <form method="post" style="display: inline;">
                    <button type="submit" name="clear_cart" class="clear-cart">Vider le panier</button>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="empty-cart">
        <p>Votre panier est vide.</p>
    </div>
<?php endif ?>

<?php include "footer.php" ?>

</body>
</html>