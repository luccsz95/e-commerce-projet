<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    //var_dump($token);
} else {
    // Rediriger ou afficher un message d'erreur si le token est absent
    die('Token manquant.');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="style/newPassword.css">
</head>
<body>

<style>


</style>

<?php echo '<form action="new_password.php?token=' . urlencode($token) . '" method="POST">';?>
    <h2>Entrez votre nouveau mot de passe</h2>
    <label for="password">Entrez votre nouveau mot de passe :</label>
    <input type="password" id="newPassword" name="newPassword" required placeholder="Votre nouveau mot de passe">
    <br><br>
    <label for="password_confirm">Confirmez votre nouveau mot de passe :</label>
    <input type="password" id="password_confirm" name="password_confirm" required placeholder="Confirmez votre nouveau mot de passe">
    <br><br>
    <input type="submit" value="Réinitialiser votre mot de passe">
</body>
</html>