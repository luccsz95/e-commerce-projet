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
    <link rel="stylesheet" href="style/command_history.css">
    <title>Historique de commandes</title>
</head>

<body>
    <?php include "navbar.php" ?>
    <br><br><br><br><br><br><br>

    <div class="container">
        <h1>Historique des commandes</h1>
        <?php if (!empty($groupedOrders)): ?>
            <ul>
                <?php foreach ($groupedOrders as $orderId => $order): ?><br>
                    <li>
                        <strong>Date de commande : <?php echo htmlspecialchars($order['date']); ?></strong><br><br>
                        Produits :
                        <ul>
                            <?php foreach ($order['products'] as $product): ?>
                                <li><?php echo htmlspecialchars($product['name']); ?> - Quantité : <?php echo htmlspecialchars($product['quantity']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <br>
                        Montant total : <?php echo htmlspecialchars($order['amount']); ?> €
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune commande trouvée.</p>
        <?php endif; ?>
    </div>

    <?php include "footer.php" ?>

</body>

</html>