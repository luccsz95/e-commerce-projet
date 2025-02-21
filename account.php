<?php
session_start();
session_regenerate_id(true);
/*var_dump($_SESSION);
die(); // Arrête l'exécution ici pour voir la sortie*/

$servername = "localhost";
$dbname = "e_commerce_project";
$dbusername = "root";
$dbpassword = "";

if (!isset($_SESSION["email"])) {
    header("Location: connexion.php");
    exit;
}

$email = $_SESSION["email"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT idUser, firstname, lastname, email FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur introuvable";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newLastname = htmlspecialchars(trim($_POST["lastname"]));
        $newfirstname = htmlspecialchars(trim($_POST["firstname"]));
        $newEmail = htmlspecialchars(trim($_POST["email"]));
        $newPhonenumber = htmlspecialchars(trim($_POST["phonenumber"]));
        $newPassword = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : null;

        try {
            $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname, email = :email, phonenumber = :phonenumber" . ($newPassword ? ", password = :password" : "") . " WHERE idUser = :idUser";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':lastname', $newLastname);
            $stmt->bindParam(':firstname', $newfirstname);
            $stmt->bindParam(':email', $newEmail);
            $stmt->bindParam(':phonenumber', $newPhonenumber);
            if ($newPassword) {
                $stmt->bindParam(':password', $newPassword);
            }
            $stmt->bindParam(':idUser', $user['idUser']);
            $stmt->execute();

            $_SESSION["email"] = $newEmail;
            $_SESSION["firstname"] = $newfirstname;
            $_SESSION["lastname"] = $newLastname;

            echo "<p style='color: green'>Votre compte a bien été mis à jour</p>";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon Profil</title>
</head>
<body>
<?php include "navbar.php"?>

<h1>Mon Profil</h1>
<form action="account.php" method="post">
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname" id="lastname" required>

    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname" id="firstname" required>

    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" required>

    <label for="phonenumber">Numéro de téléphone :</label>
    <input type="text" name="phonenumber" id="phonenumber" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password">

    <input type="submit" value="Mettre à jour">
</form>

<p>Vous pouvez également supprimer votre compte :</p>
<form action="delete_account.php" method="post">
    <input type="submit" value="Supprimer mon compte">
</form>
</body>
</html>