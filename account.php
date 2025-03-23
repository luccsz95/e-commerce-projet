<?php
session_start();
session_regenerate_id(true);

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

    $stmt = $conn->prepare("SELECT idUser, firstname, lastname, email, phonenumber FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Utilisateur introuvable";
        exit;
    }

    $stmt = $conn->prepare("SELECT adresseUsers FROM adresse WHERE idUsers = :idUsers");
    $stmt->bindParam(':idUsers', $user['idUser']);
    $stmt->execute();
    $address = $stmt->fetchColumn();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newLastname = htmlspecialchars(trim($_POST["lastname"]));
        $newFirstname = htmlspecialchars(trim($_POST["firstname"]));
        $newEmail = htmlspecialchars(trim($_POST["email"]));
        $newPhonenumber = htmlspecialchars(trim($_POST["phonenumber"]));
        $newAddress = htmlspecialchars(trim($_POST["address"]));
        $newPassword = !empty($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : null;

        try {
            $sql = "UPDATE users SET lastname = :lastname, firstname = :firstname, email = :email, phonenumber = :phonenumber" . ($newPassword ? ", password = :password" : "") . " WHERE idUser = :idUser";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':lastname', $newLastname);
            $stmt->bindParam(':firstname', $newFirstname);
            $stmt->bindParam(':email', $newEmail);
            $stmt->bindParam(':phonenumber', $newPhonenumber);
            if ($newPassword) {
                $stmt->bindParam(':password', $newPassword);
            }
            $stmt->bindParam(':idUser', $user['idUser']);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE adresse SET adresseUsers = :adresseUsers WHERE idUsers = :idUsers");
            $stmt->bindParam(':adresseUsers', $newAddress);
            $stmt->bindParam(':idUsers', $user['idUser']);
            $stmt->execute();

            $_SESSION["email"] = $newEmail;
            $_SESSION["firstname"] = $newFirstname;
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
    <link rel="stylesheet" href="style/account.css">
    <title>Mon Profil</title>
</head>
<body>
<?php include "navbar.php"?>
<br><br><br><br><br><br><br>
<h1>Mon Profil</h1>
<form class="form-account" action="account.php" method="post">
    <label for="lastname">Nom :</label>
    <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>

    <label for="firstname">Prénom :</label>
    <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>

    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

    <label for="phonenumber">Numéro de téléphone :</label>
    <input type="text" name="phonenumber" id="phonenumber" value="<?php echo htmlspecialchars($user['phonenumber']); ?>" required>

    <label for="address">Adresse :</label>
    <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($address); ?>" readonly required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password">

    <!-- Bouton pour accéder à adresseUsers.php -->
    <!--<p>Gérer vos adresses :</p>
    <button class="button-adresses"><a href="adresseUsers.php" style="text-decoration: none; color: white;">Gérer mes adresses</a></button>-->

    <input type="submit" value="Mettre à jour">
</form>

<p>Vous pouvez également modifier vos adresses :</p>
<form class="form" action="ModifyAdresseUsers.php" method="post">
    <input type="submit" value="Modifier vos adresses" formaction="ModifyAdresseUsers.php">
</form>

<p>Vous pouvez également supprimer votre compte :</p>
<form class="form"  action="delete_account.php" method="post">
    <input type="submit" value="Supprimer mon compte">
</form>

<?php include "footer.php"?>

</body>
</html>