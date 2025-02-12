<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="navbar.js" defer></script>
    <link rel="stylesheet" href="style/navbar.css">
</head>

<body>
<nav class="navbar">
    <a href="index.php"><img src="image/logo_chat.png" style="height: 100px; width:100px;"></a>
    <?php if (!isset($_SESSION['firstname'])): ?>
        <a href="connexion.php" class="btn">Se connecter</a>
    <?php else: ?>
        <span style="color: white; margin-left: 10px;">Bienvenue, <?php echo htmlspecialchars($_SESSION['firstname']); ?></span>
        <form action="logout.php" method="POST" style="display:inline;">
            <button type="submit" class="btn">Se déconnecter</button>
        </form>
    <?php endif; ?>


    <form class="search-form" role="search" action="search.php" method="GET" style="display: flex; align-items: center;">
        <input list="products" name="product" id="product" class="nav-search"
               placeholder="Rechercher un produit" type="search" style="width: 350px;">
        <datalist id="products"></datalist>
        <button type="submit" class="btn-search">Rechercher</button>
    </form>

    <a href="store.php" class="btn">Animaux</a>
    <a href="cart.php" class="btn">Panier</a>

</nav>
</body>

</html>