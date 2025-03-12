<?php
session_start();

date_default_timezone_set('Europe/Paris');

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //filtre
    $priceQuery = $conn->query("SELECT MIN(priceAnimals) AS min_price, MAX(priceAnimals) AS max_price FROM animals");
    $priceResult = $priceQuery->fetch(PDO::FETCH_ASSOC);
    $minPrice = $priceResult['min_price'] ?? 0;
    $maxPrice = $priceResult['max_price'] ?? 300.00;

    $filter = [];
    $sql = "SELECT idAnimals, nameAnimals, priceAnimals, typeAnimals, imageAnimals FROM animals WHERE 1=1";

    $filterCondition = [];
    if (isset($_GET['filter_dog'])) {
        $filterCondition[] = "typeAnimals = 'Chiens'";
    }

    if (isset($_GET['filter_cat'])) {
        $filterCondition[] = "typeAnimals = 'Chat'";
    }

    if (isset($_GET['filter_turtle'])) {
        $filterCondition[] = "typeAnimals = 'Tortue'";
    }

    if (isset($_GET['filter_lapin'])) {
        $filterCondition[] = "typeAnimals = 'Lapin'";
    }

    if (isset($_GET['filter_panda'])) {
        $filterCondition[] = "typeAnimals = 'Panda'";
    }

    if (!empty($filterCondition)) {
        $sql .= " AND (" . implode(" OR ", $filterCondition) . ")";
    }

    if (isset($_GET['price_min']) && isset($_GET['price_max'])) {
        $min_price = $_GET['price_min'];
        $max_price = $_GET['price_max'];
        $sql .= " AND priceAnimals BETWEEN $min_price AND $max_price";
    }
    $stmt = $conn->query($sql);
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

<style>
    .imageAnimals {
        width: 100px;
        height: 100px;
    }

    .quantity-input {
        width: 25px; /* Ajustez cette valeur selon vos besoins */
    }
</style>

<!-- Barre de navigation -->
<div class="navbar">
    <?php include 'navbar.php'; ?>
</div>
<br><br><br><br><br><br>
<h1 class="store-title">Choix des animaux</h1>

<form method="get" class="filter-form" id="filter-form">
    <label>
        <input type="checkbox" name="filter_dog" value="Dog" <?php echo isset($_GET['filter_dog']) ? 'checked' : ''; ?>>
        Chien
    </label>

    <label>
        <input type="checkbox" name="filter_cat" value="Cat" <?php echo isset($_GET['filter_cat']) ? 'checked' : ''; ?>>
        Chat
    </label>

    <label>
        <input type="checkbox" name="filter_turtle" value="Turtle" <?php echo isset($_GET['filter_turtle']) ? 'checked' : ''; ?>>
        Tortue
    </label>

    <label>
        <input type="checkbox" name="filter_lapin" value="Lapin" <?php echo isset($_GET['filter_lapin']) ? 'checked' : ''; ?>>
        Lapin
    </label>

    <label>
        <input type="checkbox" name="filter_panda" value="Panda" <?php echo isset($_GET['filter_panda']) ? 'checked' : ''; ?>>
        Panda
    </label>

    <div class="price-slider">
        <input type="range" name="price_min" min="<?php echo $minPrice; ?>" max="<?php echo $maxPrice; ?>" value="<?php echo isset($_GET['price_min']) ? $_GET['price_min'] : $minPrice; ?>" step="1" style="width: 15%" id="minPrice">
        <input type="range" name="price_max" min="<?php echo $minPrice; ?>" max="<?php echo $maxPrice; ?>" value="<?php echo isset($_GET['price_max']) ? $_GET['price_max'] : $maxPrice; ?>" step="1" style="width: 15%" id="maxPrice">
    </div>

    <div class="price-values">
        <span> Prix minimum: <span id="price_min"><?php echo isset($_GET['price_min']) ? $_GET['price_min'] : $minPrice; ?></span> €</span>
        <span> Prix maximum: <span id="price_max"><?php echo isset($_GET['price_max']) ? $_GET['price_max'] : $maxPrice; ?></span> €</span>
    </div>
</form>

<div class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <a href="fiche_produit.php?idAnimals=<?php echo htmlspecialchars($product['idAnimals']); ?>">
                <h2><?php echo htmlspecialchars($product['nameAnimals']); ?></h2>
                <img class="imageAnimals" src="<?php echo htmlspecialchars($product['imageAnimals']); ?>" alt="<?php echo htmlspecialchars($product['nameAnimals']); ?>">
            </a>
                <p>Type de peluche: <?php echo htmlspecialchars($product['typeAnimals']); ?></p>
                <p>Prix: <?php echo htmlspecialchars($product['priceAnimals']); ?>€</p>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['idAnimals']; ?>">
                    <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1">
                    <br>
                    <button type="submit" name="add_to_cart">Ajouter au panier</button>
                </form>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.star-rating').forEach(function (rating) {
            const stars = rating.querySelectorAll('.star');
            const nameAnimals = rating.getAttribute('data-nameAnimals');
            const noteInput = document.getElementById('note_' + nameAnimals);

            stars.forEach(function (star) {
                star.addEventListener('click', function () {
                    let value = this.getAttribute('data-note');
                    noteInput.value = value;

                    stars.forEach(s => s.classList.remove("selected"));
                    for (let i = 0; i <= value; i++) {
                        stars[i].classList.add("selected");
                    }
                });
            });
        });
    });

    const minSlider = document.getElementById('minPrice');
    const maxSlider = document.getElementById('maxPrice');
    const minPriceLabel = document.getElementById('price_min');
    const maxPriceLabel = document.getElementById('price_max');
    const filterForm = document.getElementById('filter-form');

    minSlider.addEventListener('input', function () {
        if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
            maxSlider.value = minSlider.value;
        }
        minPriceLabel.textContent = minSlider.value;
        filterForm.submit();
    });

    maxSlider.addEventListener('input', function () {
        if (parseInt(maxSlider.value) < parseInt(minSlider.value)) {
            minSlider.value = maxSlider.value;
        }
        maxPriceLabel.textContent = maxSlider.value;
        filterForm.submit();
    });

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            filterForm.submit();
        });
    });
</script>

<?php include "footer.php"?>

</body>
</html>