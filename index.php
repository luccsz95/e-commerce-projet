<?php
session_start(); // Démarrer la session pour accéder aux variables de session
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
</head>
<body>
<?php include 'navbar.php';?>
<br><br><br><br><br><br><br>
<h1 class="title">Bienvenue</h1>

<?php
if (isset($_SESSION['firstname'])) {
    echo "<h2>" . htmlspecialchars($_SESSION['firstname']) . " !</h2>";
}
?>

<?php include "footer.php"?>

</body>
</html>