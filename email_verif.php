<?php

date_default_timezone_set('Europe/Paris');

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$token = $_GET['token'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$current_time = new DateTime();

$stmt = $conn->prepare("SELECT token, date_inscription FROM users WHERE token = :token");
$stmt->bindParam(':token', $token);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user === false) {
    echo "<p style='color : red;'>Le lien est invalide ou a expiré. Veuillez vous réinscrire</p> <a href='vue_inscription.php'>Retour à l'inscription</a>";
    exit;
}

try {
    $date_inscription = new DateTime($user['date_inscription']);
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

/*var_dump($current_time);

echo "-------------------";

var_dump($date_inscription);

echo "-------------------";*/

$interval = $current_time->diff($date_inscription);

/*var_dump($interval);
exit;*/

if ($interval->i >= 15 || $interval->h > 0) {
    $delete_user = $conn->prepare('DELETE FROM users WHERE token = :token');
    $delete_user->execute(['token' => $token]);
    echo "<p style='color : red;'>Le lien a expiré. Veuillez vous réinscrire</p> <a href='vue_inscription.php'>Retour à l'inscription</a>";
    exit;
}

$update_token= $conn->prepare('UPDATE users SET etat_du_token = 1 WHERE token = :token');
$update_token->execute(['token' => $token]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérification d'email</title>
</head>
<body>
<p> Votre email a été vérifié, vous pouvez retourner à la page de connexion.</p>
<a href="connexion.php">Retour à la page de connexion</a>
</body>
</html>