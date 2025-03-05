<?php
session_start();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Au revoir</title>
</head>
<body class="goodbye-page">

<style>
    .goodbye-page {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .title {
        color: #333;
        font-size: 2.5em;
        margin-bottom: 20px;
    }

    .goodbye-paragraphe {
        color: #666;
        font-size: 1.2em;
        margin-bottom: 30px;
    }

    .link_index {
        display: inline-block;
        padding: 10px 20px;
        font-size: 1em;
        color: #fff;
        background-color: #2e7d32;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .link_index:hover {
        background-color: #255d27;
    }
</style>

<?php include "navbar.php"?>
<br><br><br><br><br><br><br>
<h1 class="title">Au revoir</h1>
<p class="goodbye-paragraphe">Votre compte a été supprimé avec succès. Nous sommes désolés de vous voir partir.</p>

<a class="link_index" href="index.php">Retour à l'accueil</a>

<?php include "footer.php"?>

</body>
</html>
