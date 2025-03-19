<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$isAdmin = false;

if (isset($_SESSION['email'])) {
    $query = "SELECT idUser FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $_SESSION['email']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['idUser'] == 0) {
        $isAdmin = true;
    }
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
<!-- <nav class="navbar">
    <a href="index.php"><img src="image/logo_chat.png" style="height: 100px; width:100px;"></a>
    <?php if (!isset($_SESSION['firstname'])): ?>
        <a href="connexion.php" class="btn">Se connecter</a>
    <?php else: ?>
        <span style="color: white; margin-left: 10px;">Bienvenue, <?php echo htmlspecialchars($_SESSION['firstname']); ?></span>
        <form action="logout.php" method="POST" style="display:inline;">
            <button type="submit" class="btn">Se déconnecter</button>
        </form>
        <?php if ($isAdmin): ?>
            <a href="admin_dashboard.php" class="btn">Admin</a>
        <?php else: ?>
            <a href="view_account.php" class="btn">Mon compte</a>
        <?php endif; ?>
    <?php endif; ?>


    <form class="search-form" role="search" action="search.php" method="GET" style="display: flex; align-items: center;">
        <input list="products" name="product" id="product" class="nav-search"
               placeholder="Rechercher un produit" type="search" style="width: 350px;">
        <datalist id="products"></datalist>
        <button type="submit" class="btn-search">Rechercher</button>
    </form>

    <a href="store.php" class="btn">Animaux</a>
    <a href="cart.php" class="btn">Panier
        <?php
            if($cart_count > 0) {echo '| ' . $cart_count;}
            else {echo '';}
        ?>
    </a>
</nav> -->

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
    <a href="cart.php" class="btn">Panier
        <?php
            if($cart_count > 0) {echo '| ' . $cart_count;}
            else {echo '';}
        ?>
    </a>

    <?php if (isset($_SESSION['firstname'])): ?>
        <?php if ($isAdmin): ?>
            <a href="admin_dashboard.php" class="btn">Admin</a>
        <?php else: ?>
            <a href="view_account.php" class="btn">Mon compte</a>
        <?php endif; ?>
    <?php endif; ?>
</nav>
</body>

</html>