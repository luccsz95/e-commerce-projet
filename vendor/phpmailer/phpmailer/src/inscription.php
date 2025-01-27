<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'incription</title>
    <link rel="stylesheet" href="../../style/inscription.css">
</head>
<body>

<div class="">
    <div class="header">
        <a class="logo-link" href="../../index.php"><img src="../../images/Image_immeuble.jpg" alt="logo"></a> <!-- ../image/Image_immeuble.jpg -->
    </div>
</div>

<div class="signup">
    <h2>Inscription</h2>
    <form action="" method="POST" onsubmit="return validateform()">
        <label for="lastname">Nom de famille</label>
        <input type="text" name="lastname" id="lastname" placeholder="Nom de famille" required>

        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>

        <label for="phonenumber">Numéro de téléphone</label>
        <input type="text" name="phonenumber" id="phonenumber" placeholder="Numéro de téléphone" maxlength="10" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>

        <label for="confirm-password">Confirmer le mot de passe</label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmer le mot de passe" required>

        <input type="submit" value="S'inscrire">
        <p>Déjà un compte ? <a href="../../connexion.php">Connectez-vous ici</a></p>

    </form>

    <p id="error-msg"></p>
</div>

<script>
    function validateform() {
        var lastname = document.getElementById('lastname').value;
        var firstname = document.getElementById('firstname').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('confirm-password').value;
        var phonenumber = document.getElementById('phonenumber').value;

        if (lastname == "" || firstname == "" || email == "" || password == "" || confirm_password == "" || phonenumber == "") {
            document.getElementById('error-msg').innerHTML = "Tous les champs sont obligatoires";
            return false;
        }

        if (password != confirm_password) {
            document.getElementById('error-msg').innerHTML = "Les mots de passe ne correspondent pas";
            errorMSG.style.color = "red";
            return false;
        }

        return true;
    }
    }
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirm-password']);
    $phonenumber = htmlspecialchars($_POST['phonenumber']);

    if ($password != $confirmPassword) {
        echo "<p style='color: red;'>Les mots de passe ne correspondent pas</p>";
        exit;
    }

    include "bdd.php";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<p style='color: red;'>Cet email est déjà utilisé</p>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (lastname, firstname, email, password, phonenumber) VALUES (:lastname, :firstname, :email, :password, :phonenumber)");
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':phonenumber', $phonenumber);
            if ($stmt->execute()) {
                header("Location: connexion.php");
                exit();
            } else {
                echo "<p style='color: red;'>Erreur lors de l'inscription</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    $conn = null;
}
?>
</body>
</html>
