<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: connexion.php");
    exit;
}

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

$email = $_SESSION["email"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT idUser, firstname, lastname, email, phonenumber FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['idUser'];

        $stmt = $conn->prepare("SELECT adresseUsers FROM adresse WHERE idUsers = :idUsers");
        $stmt->bindParam(':idUsers', $user['idUser']);
        $stmt->execute();
        $addresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retrieve the user's order history
        $stmt = $conn->prepare("
            SELECT c.idCommand, c.commandDate, c.amount, a.nameAnimals, cd.quantity
            FROM command c
            INNER JOIN command_details cd ON c.idCommand = cd.idCommand
            INNER JOIN animals a ON a.idAnimals = cd.idAnimals
            WHERE c.idUsers = :idUsers
            ORDER BY c.idCommand, a.nameAnimals;
        ");
        $stmt->bindParam(':idUsers', $user['idUser']);
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Group products by order ID
        $groupedOrders = [];
        foreach ($orders as $order) {
            $groupedOrders[$order['idCommand']]['date'] = $order['commandDate'];
            $groupedOrders[$order['idCommand']]['amount'] = $order['amount'];
            $groupedOrders[$order['idCommand']]['products'][] = [
                'name' => $order['nameAnimals'],
                'quantity' => $order['quantity']
            ];
        }
    } else {
        echo "Utilisateur introuvable";
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/view_account.css">
    <title>Mon Profil</title>
</head>

<body>
    <?php include "navbar.php" ?>
    <br><br><br><br><br><br><br>

    <div class="container">
        <h1>Mon Profil</h1>
        <p><strong>Nom :</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
        <p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Numéro de téléphone :</strong> <?php echo htmlspecialchars($user['phonenumber']); ?></p>
        <p><strong>Adresses :</strong></p>
        <ul>
            <?php foreach ($addresses as $address): ?>
                <li><?php echo htmlspecialchars($address['adresseUsers']); ?></li>
            <?php endforeach; ?>
        </ul>
        <a href="account.php" class="information">Modifier mes informations</a>
        <a href="command_history.php" class="information">Voir mon historique de commande</a>
    </div>

    <?php include "footer.php" ?>

</body>

</html>