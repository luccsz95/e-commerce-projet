<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
    header('Location: cart.php');
    exit;
}

if (isset($_GET['product'])) {
    $search_term = htmlspecialchars(trim($_GET['product']));

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $stmt = $conn->prepare("SELECT * FROM animals WHERE nameAnimals LIKE :product");
    $query = '%' . $search_term . '%';
    $stmt->bindParam(':product', $query, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Résultats</title>
    <link rel="stylesheet" href="style/store.css">
</head>
<body>

<style>
    .imageAnimals {
        width: 100px;
        height: 100px;
    }
</style>

<?php include 'navbar.php'; ?>

<h1 class="store-title">Résultats pour "<?= htmlspecialchars($search_term) ?>"</h1>

<div class="products">
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $result): ?>
            <div class="product">
                <a href="fiche_produit.php?idAnimals=<?php echo htmlspecialchars($result['idAnimals']); ?>">
                    <h2><?= htmlspecialchars($result['nameAnimals']) ?></h2>
                    <img class="imageAnimals" src="<?= htmlspecialchars($result['imageAnimals']) ?>" alt="<?= htmlspecialchars($result['nameAnimals']) ?>">
                </a>
                <p><?= htmlspecialchars($result['typeAnimals']) ?></p>
                <p>Prix : <?= htmlspecialchars($result['priceAnimals']) ?> €</p>

                <form action="search.php?product=<?= urlencode($search_term) ?>" method="POST">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($result['idAnimals']) ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-results">Aucun résultat trouvé pour "<?= htmlspecialchars($search_term) ?>"</p>
    <?php endif; ?>
</div>

</body>
</html>
