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

    // Récupère l'id de l'utilisateur
    $stmt = $conn->prepare("SELECT idUser FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $idUser = $user['idUser'];

    /*// Supprimer les enregistrements liés à l'utilisateur dans d'autres tables
    $stmt = $conn->prepare("DELETE FROM orders WHERE userId = :idUser");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();*/ // pas encore implémenté

    $stmt = $conn->prepare("DELETE FROM comments WHERE idComment = :idComment");
    $stmt->bindParam(':idComment', $idComment);
    $stmt->execute();

    // Supprimer l'utilisateur de la base de données
    $stmt = $conn->prepare("DELETE FROM users WHERE idUser = :idUser");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();

    // Détruire la session
    session_unset();
    session_destroy();

    // Rediriger l'utilisateur
    header("Location: goodbye.php");
    exit;

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>