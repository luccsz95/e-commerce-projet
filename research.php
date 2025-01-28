<?php
// Activer le rapport d'erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure les fichiers nécessaires
include 'connexion.php';

// Démarrer la session si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Gestion de la recherche
if (isset($_GET['query'])) {
    $search = htmlspecialchars($_GET['query']);

    try {
        $connexion = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $connexion->prepare("SELECT * FROM users WHERE firstname LIKE :query");
        $stmt->execute(['query' => '%' . $search . '%']);
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        $resultats = [];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .result-item { margin-bottom: 15px; }
        .not-found { color: red; font-weight: bold; }
    </style>
</head>
<body>
<h1>Résultats de recherche pour "<?= htmlspecialchars($search) ?>"</h1>
<div class="result-list">
    <?php if (!empty($resultats)): ?>
        <?php foreach ($resultats as $user): ?>
            <div class="result-item">
                <h2><?= htmlspecialchars($user['firstname']) ?></h2>
                <p>Email : <?= htmlspecialchars($user['email']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="not-found">Aucun résultat trouvé pour votre recherche.</p>
    <?php endif; ?>
</div>
<div>
    <a href="index.php">Retour à l'accueil</a>
</div>
</body>
</html>
