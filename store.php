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
    ?>

    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style/store.css">
        <title>Store</title>
    </head>
    <body>

    <!-- Barre de navigation -->
    <div class="navbar">
        <?php include 'navbar.php'; ?>
    </div>

    <h1 class="store-title">Choix des animaux</h1>

    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?php echo htmlspecialchars($product['nameAnimals']); ?></h2>
                <p>Prix: <?php echo htmlspecialchars($product['priceAnimals']); ?>€</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['idAnimals']; ?>">
                    <button type="submit" name="add_to_cart">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    </body>
    </html>