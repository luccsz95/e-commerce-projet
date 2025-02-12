<?php
$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if(isset($_GET['product'])) {
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
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Résultats</title>
</head>
<body>
<?php include 'navbar.php';?>

<h1>Résultats pour "<?= htmlspecialchars($search_term) ?>"</h1>

<div class="product-list">
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $result): ?>
            <div class="product">
                <h2><?= htmlspecialchars($result['typeAnimals']) ?></h2>
                <p><?= htmlspecialchars($result['nameAnimals']) ?></p>
                <h3>Prix : <?= htmlspecialchars($result['priceAnimals']) ?> €</h3>

                <form action="cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($result['idAnimals']) ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun résultat trouvé pour "<?= htmlspecialchars($search_term) ?>"</p>
    <?php endif; ?>
</div>

</body>
</html>