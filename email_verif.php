<<<<<<< HEAD
<?php

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$token = $_GET['token'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
  <p> Votre email a été vérifié, vous pouvez fermer cette page.</p>
</body>
=======
<?php

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$token = $_GET['token'];

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
  <p> Votre email a été vérifié, vous pouvez fermer cette page.</p>
</body>
>>>>>>> 067a71daa5aa9c4da8cb1c846334084d381c66b8
</html>