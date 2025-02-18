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
    $sql = "SELECT idAnimals, nameAnimals, priceAnimals, typeAnimals FROM animals WHERE 1=1";

    $filterCondition = [];
    if (isset($_GET['filter_dog'])) {
        $filterCondition[] = "typeAnimals = 'Dog'";
    }

    if (isset($_GET['filter_cat'])) {
        $filterCondition[] = "typeAnimals = 'Cat'";
    }

    if (isset($_GET['filter_turtle'])) {
        $filterCondition[] = "typeAnimals = 'Turtle'";
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

<!-- Barre de navigation -->
<div class="navbar">
    <?php include 'navbar.php'; ?>
</div>

<h1 class="store-title">Choix des animaux</h1>

<form method="get" class="filter-form" id="filter-form">
    <label>
        <input type="checkbox" name="filter_dog" value="Dog" <?php echo isset($_GET['filter_dog']) ? 'checked' : ''; ?>>
        Chien
        <input type="checkbox" name="filter_cat" value="Cat" <?php echo isset($_GET['filter_cat']) ? 'checked' : ''; ?>>
        Chat
        <input type="checkbox" name="filter_turtle" value="Turtle" <?php echo isset($_GET['filter_turtle']) ? 'checked' : ''; ?>>
        Tortue
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
            </a>
                <p>Type de peluche: <?php echo htmlspecialchars($product['typeAnimals']); ?></p>
                <p>Prix: <?php echo htmlspecialchars($product['priceAnimals']); ?>€</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['idAnimals']; ?>">
                    <button type="submit" name="add_to_cart">Ajouter au panier</button>
                </form>

                <!--<h2>Donnez votre avis</h2>
            <?php /*if(isset($_SESSION['firstname'])): */?>
                <form action="" method="post">
                    <input type="hidden" name="nameAnimals" value="<?php /*echo htmlspecialchars($product['nameAnimals']); */?>">
                    <label>Commentaire :</label>
                    <textarea name="comment" required></textarea>
                    <input type="hidden" name="note" id="note" value="0">
                    <div class="star-rating" data-nameAnimals="<?php /*echo htmlspecialchars($product['nameAnimals']); */?>">
                        <?php /*for ($i = 0; $i <= 5; $i++): */?>
                            <span class="star" data-note="<?php /*echo $i; */?>">⭐</span>
                        <?php /*endfor; */?>
                    </div>
                    <button type="submit" name="add_comment">Ajouter un commentaire</button>
                </form>
            <?php /*else: */?>
                <p><a href="connexion.php">Connectez-vous</a> pour ajouter un commentaire</p>
            <?php /*endif; */?>

            <div class="comments-section">
                <?php /*foreach ($comments as $comment): */?>
                    <div class="comment">
                        <strong><?php /*echo htmlspecialchars($comment['firstname']); */?></strong>
                        <span><?php /*echo str_repeat('⭐', $comment['note']); */?></span>
                        <p><?php /*echo nl2br(htmlspecialchars($comment['comment'])); */?></p>
                        <small><?php /*echo $comment['dateComment']; */?></small>
                    </div>
                <?php /*endforeach; */?>
            </div>-->
        </div>
    <?php endforeach; ?>
</div>

<script>
    /*document.addEventListener("DOMContentLoaded", function () {
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
    });*/

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

</body>
</html>