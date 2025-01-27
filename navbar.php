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
    <!--<style>
        /* Style de la barre de navigation */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: black;
            padding: 10px 20px;
            z-index: 1000; /* Assure que la navbar reste au-dessus des autres éléments */
        }

        /* Ajouter un espace sous la navbar pour éviter que le contenu ne soit masqué */
        body {
            margin-top: 80px; /* Ajuste la hauteur pour correspondre à celle de la navbar */
        }

        /* Style de l'image dans la navbar */
        .navbar-logo {
            height: 60px;
        }

        /* Style des liens de la navbar */
        .navbar-right a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-family: Arial, sans-serif;
        }

        /* Changement de couleur au survol des liens */
        .navbar-right a:hover {
            background-color: #555;
            border-radius: 5px;
        }
    </style>-->
</head>
<body>


<!-- Barre de navigation -->
<div class="navbar">

    <!-- Image à gauche -->
    <!-- <div class="navbar-left"><img src="images/logo.jpg" alt="Logo" class="navbar-logo"></div> -->

    <!-- Liens de navigation à droite -->
    <div class="navbar-right">
        <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
            <!-- Si l'utilisateur n'est pas connecté, afficher Connexion et Inscription -->
            <a href="store.php">Store Page</a>
            <a href="connexion.php">Se connecter</a>
            <a href="inscription.php">S'inscrire</a>
        <?php else: ?>
            <!-- Si l'utilisateur est connecté, afficher Déconnexion -->
            <span>Bienvenue, <?php echo $_SESSION['username']; ?></span>
            <a href="store.php">Store Page</a>
            <a href="logout.php">Déconnexion</a>
        <?php endif; ?>
    </div>
</div>


</body>
</html>
