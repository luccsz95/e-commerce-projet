<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon Profil</title>
</head>
<body>
<?php include "navbar.php"?>

    <h1>Mon Profil</h1>
    <form action="account.php" method="post">
        <label for="lastname">Nom :</label>
        <label for="firstname">Prénom :</label>
        <label for="email">Adresse email :</label>
        <input type="email" name="email" id="email" required>
        <label for="phonenumber">Numéro de téléphone :</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Mettre à jour">
    </form>
    <p>Vous pouvez également supprimer votre compte :</p>
    <form method="post">
        <input type="submit" value="Supprimer mon compte">
    </form>
    <a href="store.php">Retour à la boutique</a>
</body>
</html>
