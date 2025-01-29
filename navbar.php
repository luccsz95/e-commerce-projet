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
    <title>Navbar avec PHP et CSS intégré</title>
    <link rel="stylesheet" href="style/navbar.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="navbar.js"></script>
</head>
<body>

<div class="navbar">
    <div class="navbar-right">
        <?php if (!isset($_SESSION['firstname'])): ?>
            <a href="connexion.php">Se connecter</a>
        <?php else: ?>
            <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['firstname']); ?></span>
            <form action="logout.php" method="POST" style="display:inline;">
                <button type="submit">Se déconnecter</button>
            </form>
        <?php endif; ?>

        <form class="search-form" role="search">
            <datalist id="data-list"></datalist>
            <input class="nav-search" type="search" id="query" name="query" placeholder="Search" aria-label="Search">
            <button class="btn-search" type="submit">Search</button>
        </form>

        <a href="cart.php">Panier</a>
        <a href="store.php">Store Page</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        const productInput = $('#query');
        const datalist = $('#data-list');

        function handleProductSearch() {
            const query = productInput.val();
            if (query.length > 0) {
                fetchProductSuggestions(query);
            } else {
                datalist.empty();
            }
        }

        function fetchProductSuggestions(query) {
            $.ajax({
                url: 'recup_animals.php',
                type: 'GET',
                data: { search_term: query },
                success: function(response) {
                    datalist.html(response);
                },
                error: function() {
                    console.error('Erreur lors de la récupération des suggestions.');
                    datalist.html('<option value="">Erreur lors de la récupération des suggestions.</option>');
                }
            });
        }

        productInput.on('input', handleProductSearch);
    });
</script>

</body>
</html>