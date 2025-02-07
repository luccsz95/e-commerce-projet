<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

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


//$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
$product_id = $_POST['product_id'];
$_SESSION['cart'][] = $product_id;
$cart_items = $_SESSION['cart'];

if (isset($_POST['clear_cart'])) {
    unset($_SESSION['cart']);
    $cart_items = [];
    $count_item = 0;
    header("Location: cart.php");
    exit;
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $product_id;
    header("Location: cart.php");
    exit;
}

if (isset($_POST['remove_item'])) {
    $idAnimals = $_POST['idAnimals'];

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        $key = array_search($idAnimals, $_SESSION['cart']);

        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }

    header("Location: cart.php");
    exit;
}
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <title>Panier</title>
</head>

<body>

<?php include 'navbar.php'; ?>

<h1>Votre Panier</h1>

<?php if (!empty($cart_items)): ?>

    <table>
        <thead>
        <tr>
            <th>Images</th>
            <th>Nom du produit</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart_items as $idAnimals) : ?>
            <?php
            $product = array_filter($products, function ($prod) use ($idAnimals) {
                return $prod['idAnimals'] == $idAnimals;
            });

            if (!empty($product)) {
                $product = array_values($product)[0];
                $total += $product['priceAnimals'];
            }
            ?>

            <tr>
                <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['nameAnimals']; ?>" width="100"></td>
                <td><?php echo htmlspecialchars($product['nameAnimals']); ?></td>
                <td><?php echo htmlspecialchars($product['priceAnimals']); ?>€</td>
                <td>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['idAnimals']); ?>">
                        <button type="submit" name="add_to_cart">Ajouter</button>
                    </form>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="idAnimals" value="<?php echo htmlspecialchars($idAnimals); ?>">
                        <button type="submit" name="remove_item">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>Total : <?php echo number_format($total, 2, ',', ' '); ?> €</p>

    <form method="post">
        <button type="submit" name="clear_cart">Vider le panier</button>
    </form>

    <form method="get" action="checkout.php">
        <button type="submit">Payer</button>
    </form>

<?php else : ?>
    <p>Votre panier est vide.</p>
<?php endif ?>

</body>
</html>