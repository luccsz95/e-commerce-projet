<?php
$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if(isset($_GET['query'])) {
    $search = htmlspecialchars(trim($_GET['query']));

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $stmt = $conn->prepare("SELECT * FROM animals WHERE typeAnimals LIKE :query");
    $query = '%' . $search . '%';
    $stmt->bindParam(':query', $query, PDO::PARAM_STR);
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

<h1>Résultats pour "<?= htmlspecialchars($search) ?>"</h1>

<div class="product-list">
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $result): ?>
            <div class="product">
                <h2><?= htmlspecialchars($result['typeAnimals']) ?></h2>
<!--                <img src="--><?php //= htmlspecialchars($result['image']) ?><!--" alt="--><?php //= htmlspecialchars($result['nameAnimals']) ?><!--">-->
                <p><?= htmlspecialchars($result['nameAnimals']) ?></p>
                <p><?= htmlspecialchars($result['genderAnimals']) ?></p>
                <p><?= htmlspecialchars($result['raceAnimals']) ?></p>
                <h3>Prix : <?= htmlspecialchars($result['priceAnimals']) ?> €</h3>

                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($result['idAnimals']) ?>">
                    <button type="submit">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun résultat trouvé pour "<?= htmlspecialchars($search) ?>"</p>
    <?php endif; ?>
</div>

</body>
</html>