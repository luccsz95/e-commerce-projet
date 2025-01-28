<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store</title>
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
            <a href="index.php">Page d'accueil </a>
            <a href="connexion.php">Se connecter</a>
            <a href="vendor/phpmailer/inscription.php">S'inscrire</a>
        <?php else: ?>
            <!-- Si l'utilisateur est connecté, afficher Déconnexion -->
            <span>Bienvenue, <?php echo $_SESSION['username']; ?></span>
            <a href="store.php">Store Page</a>
            <a href="logout.php">Déconnexion</a>
        <?php endif; ?>
    </div>
</div>

<h1 class="store-title">Choix des produits</h1>


<style>
    .card {
        border: 1px solid black;
        height: 200px;
        width: 200px;
        margin: 10px;
        float: left;
    }

    .card-body {
        border: 1px solid red;
        text-align: center;
        height: 150px;
        width: 150px;
        margin: 0px;
    }

    /* Style général pour la navbar */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2e7d32; /* Vert foncé pour correspondre au style d'inscription */
        padding: 10px 20px;
        z-index: 1000; /* Assure que la navbar reste au-dessus des autres éléments */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Ajouter un espace sous la navbar pour éviter que le contenu ne soit masqué */
    body {
        margin-top: 80px; /* Ajuste la hauteur pour correspondre à celle de la navbar */
    }

    /* Style des liens dans la navbar */
    .navbar-right a {
        color: #ffffff;
        text-decoration: none;
        padding: 10px 20px;
        font-family: 'Arial', sans-serif;
        font-size: 1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .navbar-right a:hover {
        background-color: #255d27; /* Teinte plus foncée de vert pour le survol */
        transform: scale(1.05);
    }

    /* Style de bienvenue pour l'utilisateur connecté */
    .navbar-right span {
        color: #ffffff;
        font-family: 'Arial', sans-serif;
        font-size: 1rem;
        margin-right: 15px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            align-items: flex-start;
            padding: 15px;
        }

        .navbar-right {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .navbar-right a {
            width: 100%;
            text-align: left;
            padding: 10px;
        }

        .navbar-right span {
            margin-bottom: 10px;
        }
    }

</style>

<div class="card">
    <div class="card-body">
        <h5>Maison à vendre</h5>
        <p>Belle maison à Los Angeles</p>
        <p>Prix : 1 500 000€</p>
        <a href="#"> Ajouter au panier</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Maison</h5>
        <p>Exemple</p>
        <a href="#"> Ajouter au panier</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Card Title</h5>
        <p>Exemple</p>
        <a href="#"> Ajouter au panier</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Card Title</h5>
        <p>Exemple</p>
        <a href="#"> Ajouter au panier</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5>Card Title</h5>
        <p>Exemple</p>
        <a href="#"> Ajouter au panier</a>
    </div>
</div>

</body>
</html>