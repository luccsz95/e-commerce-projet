<?php
// Vérifie si une session n'est pas déjà démarrée avant de la démarrer
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar avec PHP et CSS intégré</title>
    <link rel="stylesheet" href="style/navbar.css">
</head>
<body>

<!-- Barre de navigation -->
<div class="navbar">

    <!-- Liens de navigation à droite -->
    <div class="navbar-right">
        <?php if (!isset($_SESSION['firstname'])): ?>
            <!-- Si l'utilisateur n'est pas connecté, afficher Connexion -->
            <a href="connexion.php">Se connecter</a>
        <?php else: ?>
            <!-- Si l'utilisateur est connecté, afficher Déconnexion -->
            <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['firstname']); ?></span>
            <form action="logout.php" method="POST" style="display:inline;">
                <button type="submit">Se déconnecter</button>
            </form>
        <?php endif; ?>
        <a href="store.php">Store Page</a>
    </div>
</div>

</body>
</html>