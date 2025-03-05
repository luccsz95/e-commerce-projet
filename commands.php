<?php
session_start();
session_regenerate_id(true); // Régénérer l'ID de session pour éviter les attaques de fixation de session

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$idUser = $_SESSION['user_id'];
$cart = $_SESSION['cart'];
$amount = $_SESSION['total_price'];
$idAdresse = $_SESSION['idAdresse'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $conn->prepare("INSERT INTO command (idUsers, amount) VALUES (:idUsers, :amount)");
    $sql->execute([
        'idUsers' => $idUser,
        'amount' => $amount
    ]);

    $idCommand = $conn->lastInsertId();

    $sqlDetails = $conn->prepare("INSERT INTO command_details (idCommand, idAnimals, idAdresse, quantity) VALUES (:idCommand, :idAnimals, :idAdresse, :quantity)");

    foreach ($cart as $item) {
        $sqlDetails->execute([
            'idCommand' => $idCommand,
            'idAnimals' => $item['product_id'],
            'idAdresse' => $idAdresse,
            'quantity' => $item['quantity']
        ]);
    }

    // Vider le panier après l'insertion des détails de la commande
    $_SESSION['cart'] = [];
    $_SESSION['total_price'] = 0;

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
    <h1>Commande validée avec succès !</h1>
</body>
</html>