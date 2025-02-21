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

    $stmt = $conn->prepare("SELECT firstname, lastname, email, phonenumber FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
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
    <title>Mon Profil</title>
</head>
<body>
<?php include "navbar.php"?>

<h1>Mon Profil</h1>
<p><strong>Nom :</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
<p><strong>Prénom :</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
<p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
<p><strong>Numéro de téléphone :</strong> <?php echo htmlspecialchars($user['phonenumber']); ?></p>

<a href="account.php">Modifier mes informations</a>
</body>
</html>