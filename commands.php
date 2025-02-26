<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$idUser = $_SESSION['user_id'];
//var_dump($idUser);
$cart = $_SESSION['cart'];
$amount = $_SESSION['total_price'];

$idAdresse = $_SESSION['idAdresse'];
var_dump($idAdresse);
//var_dump($amount);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare("INSERT INTO command (idUsers, amount) VALUES (:idUsers, :amount)");
    $sql->execute([
        'idUsers' => $idUser,
        'amount' => $amount
    ]);

    $idCommand = $conn->lastInsertId();

    $sqlDetails = $conn->prepare("INSERT INTO command_details (idCommand, idAnimals, idAdresse) VALUES (:idCommand, :idAnimals, :idAdresse)");

    foreach ($_SESSION['cart'] as $idAnimals) {
        $sqlDetails->execute([
            'idCommand' => $idCommand,
            'idAnimals' => $idAnimals,
            'idAdresse' => $idAdresse
        ]);
    }

    echo json_encode(['success' => 'Commande validée avec succès']);

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php include "navbar.php"?>
<h1>toto</h1>
</body>
</html>
