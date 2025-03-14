<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $animals = null; // Initialize the variable

    if (isset($_GET['idAnimals'])) {
        $id = (int) $_GET['idAnimals'];
        $stmt = $conn->prepare("SELECT * FROM animals WHERE idAnimals = :idAnimals");
        $stmt->execute(['idAnimals' => $id]);
        $animals = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if (!$animals) {
        die("<p>Produit non trouvé. <a href='store.php'>Retourner à la boutique</a></p>");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['firstname'])) {
        $firstname = $_SESSION['firstname'];
        $nameAnimals = $animals['nameAnimals'];
        $comment = trim($_POST['comment']);
        $note = (int)$_POST['note'];
        $date_ajout = date('Y-m-d H:i:s');
        $bonsoir = $_POST['add_comment'];

        if (!empty($comment) && $note >= 1 && $note <= 5 && isset($bonsoir)) {
            $stmt = $conn->prepare("INSERT INTO comments (idAnimals, nameAnimals, firstname, comment, note, dateComment) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$id, $nameAnimals, $firstname, $comment, $note, $date_ajout]);
            echo "<p style='color: green;'>Votre commentaire a été ajouté avec succès.</p>";

            header('Location:'. $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "<p style='color: red;'>La note doit être comprise entre 1 et 5.</p>";
        }
    }

    $commentStmt = $conn->prepare("SELECT * FROM comments WHERE nameAnimals = ? ORDER BY dateComment DESC");
    $commentStmt->execute([$animals['nameAnimals']]);
    $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (\PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/store.css">
    <title>Fiche Produit</title>
</head>
<body>

<style>
    .star-rating {
        display: flex;
        justify-content: center;
        gap: 5px;
        cursor: pointer;
        margin: 10px 0;
    }

    .star {
        font-size: 24px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star:hover, .star.selected {
        color: gold;
    }

    .imageAnimals {
        width: 200px;
        height: 200px;
    }

    .comment {
        background-color: white;
        padding: 15px;
        margin-top: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 3px black;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .comment:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 6px black;
    }

    .comment strong {
        font-size: 16px;
        color: #333;
    }

    .comment span {
        font-size: 14px;
        color: gold;
    }

    .comment p {
        margin-top: 10px;
        line-height: 1.6;
        font-size: 14px;
        color: #555;
    }

    .comment small {
        display: block;
        margin-top: 10px;
        font-size: 12px;
        color: #666;
    }

    textarea {
        width: 50%;
        min-height: 80px;
        margin-top: 5px;
        padding: 10px;
        border-radius: 5px;
        resize: none;
        font-size: 14px;
    }

    .add_comment_btn, .add_to_cart {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px 20px;
        background-color: #2e7d32;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .add_comment_btn:hover, .add_to_cart:hover {
        background-color: #255d27;
    }

    .connected-add-comment {
        text-align: center;
        margin: 20px 0;
    }

    .comment-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        margin: 20px 0;
    }

    .comment-container label,
    .comment-container textarea {
        width: 50%;
        text-align: center;
    }

    .form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .content-product{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .quantity-input {
        width: 25px;
        margin : 0;
    }

    .quantity-container {
        display: flex;
        justify-content: center; /* Center the input field horizontally */
    }

</style>

<div class="navbar">
    <?php include 'navbar.php'; ?>
</div>

<br><br><br><br><br>

<div class="content-product">
    <h1 class="product-title"><?php echo htmlspecialchars($animals['nameAnimals']); ?></h1>
    <img class="imageAnimals" src="<?php echo htmlspecialchars($animals['imageAnimals']); ?>" alt="<?php echo htmlspecialchars($animals['nameAnimals']); ?>">
    <p>Type: <?php echo htmlspecialchars($animals['typeAnimals']); ?></p>
    <p>Prix: <?php echo htmlspecialchars($animals['priceAnimals']); ?>€</p>

    <form method="post" action="cart.php">
        <input type="hidden" name="product_id" value="<?php echo $animals['idAnimals']; ?>">
        <div class="quantity-container">
            <input class="quantity-input" type="number" id="quantity" name="quantity" value="1" min="1">
        </div>
        <br>
        <button class="add_to_cart" type="submit" name="add_to_cart">Ajouter au panier</button>
    </form>
</div>

<h2>Donnez votre avis</h2>
<?php if (isset($_SESSION['firstname'])): ?>
    <form class="form" action="" method="post">
        <div class="comment-container">
            <label>Commentaire :</label>
            <textarea name="comment" required></textarea>
        </div>
        <input type="hidden" name="note" id="note" value="0">
        <div class="star-rating">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="star" data-note="<?php echo $i; ?>">★</span>
            <?php endfor; ?>
        </div>
        <button class="add_comment_btn" type="submit" id="add_comment" name="add_comment">Ajouter un commentaire</button>
    </form>
<?php else: ?>
    <p class="connected-add-comment"><a href="connexion.php">Connectez-vous</a> pour ajouter un commentaire</p>
<?php endif; ?>

<div class="comments-section">
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <strong><?php echo htmlspecialchars($comment['firstname']); ?></strong>
            <span><?php echo str_repeat('⭐', $comment['note']); ?></span>
            <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
            <small ><?php echo $comment['dateComment']; ?></small>
        </div>
    <?php endforeach; ?>
</div>

<script>
    const stars = document.querySelectorAll('.star');
    const noteInput = document.getElementById('note');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            let value = this.getAttribute('data-note');
            noteInput.value = value;

            stars.forEach(s => s.classList.remove("selected"));
            for (let i = 0; i < value; i++) {
                stars[i].classList.add("selected");
            }
        });
    });
</script>

<?php include "footer.php"?>

</body>
</html>