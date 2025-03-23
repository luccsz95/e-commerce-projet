<?php
session_start();

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if (!isset($_SESSION['idUser'])) {
    echo "Utilisateur non connecté";
    exit;
}

$idUser = $_SESSION['idUser'];
$adresses = [];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les adresses de l'utilisateur
    $stmt = $conn->prepare("SELECT idAdresse, adresseUsers FROM adresse WHERE idUsers = :idUser");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $adresses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['address_id']) && isset($_POST['new_address'])) {
        // Mettre à jour l'adresse sélectionnée
        $stmt = $conn->prepare("UPDATE adresse SET adresseUsers = :newAddress WHERE idAdresse = :addressId AND idUsers = :idUser");
        $stmt->bindParam(':newAddress', $_POST['new_address']);
        $stmt->bindParam(':addressId', $_POST['address_id']);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();
        echo "Adresse mise à jour avec succès";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/modifyAdresseUsers.css">
    <title>Modifier vos adresses</title>
</head>
<body>

<?php include "navbar.php" ?>
<br><br><br><br><br><br><br><br><br>
<h1>Modifier votre adresse</h1>

<form action="" method="post" class="modify-address-form">
    <label for="address_id">Sélectionnez une adresse à modifier :</label>
    <select name="address_id" id="address_id" required>
        <?php foreach ($adresses as $address): ?>
            <option value="<?php echo htmlspecialchars($address['idAdresse']); ?>">
                <?php echo htmlspecialchars($address['adresseUsers']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="new_address">Nouvelle adresse :</label>
    <input type="text" name="new_address" id="new_address" class="new_address" required>

    <button type="submit">Modifier l'adresse</button>
</form>

<?php include "footer.php" ?>

</body>
</html>